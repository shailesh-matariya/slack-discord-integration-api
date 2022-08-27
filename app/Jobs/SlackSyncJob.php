<?php

namespace App\Jobs;

use App\Models\Account;
use App\Models\AccountChannel;
use App\Models\AccountUser;
use App\Models\Attachment;
use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class SlackSyncJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public Account $account;
    public PendingRequest $botClient;
    public PendingRequest $userClient;
    public ?Collection $users = null;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Account $account)
    {
        $this->account = $account;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        config()->set('auth.account', $this->account);

        $this->botClient = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->account->bot_access_token
        ]);
        $this->userClient = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->account->user_access_token
        ]);

        $userResponse = $this->botClient->get('https://slack.com/api/users.list');

        $users = json_decode($userResponse->body());

        foreach ($users->members as $user) {
            $accountUser = AccountUser::where('userId', $user->id)->first();

            if (! $accountUser) {
                $accountUser = new AccountUser();
                $accountUser->account()->associate($this->account);
                $accountUser->userId = $user->id;
            }

            $accountUser->username = $user->name;
            $accountUser->name = $user->real_name;
            $accountUser->profile = $user->profile->image_72;
            $accountUser->save();
        }

        $channelResponse = $this->botClient->get('https://slack.com/api/conversations.list');

        $channelResponse = json_decode($channelResponse->body());

        foreach ($channelResponse->channels as $channel) {
            $accountChannel = AccountChannel::where('channelId', $channel->id)->first();

            if (! $accountChannel) {
                $accountChannel = new AccountChannel();
                $accountChannel->account()->associate($this->account);
                $accountChannel->channelId = $channel->id;
            }

            $accountChannel->name = $channel->name;
            $accountChannel->is_private = $channel->is_private;
            $accountChannel->member_count = $channel->num_members;
            $accountChannel->is_visible = !$channel->is_private;
            $accountChannel->save();

            $this->syncMessages($accountChannel);
        }
    }

    private function syncMessages(AccountChannel $accountChannel)
    {
        $payload = [
            'channel' => $accountChannel->channelId
        ];
        $lastTS = '';
        if ($accountChannel->last_message_timestamp) {
            $payload['oldest'] = $accountChannel->last_message_timestamp;
            $lastTS = $accountChannel->last_message_timestamp;
        }

        $messageResponse = $this->userClient->get('https://slack.com/api/conversations.history', $payload);
        $messageResponse = json_decode($messageResponse->body());

        if (empty($this->users)) {
            $this->users = AccountUser::all();
        }

        foreach ($messageResponse->messages as $message) {
            $user = $this->users->where('userId', $message->user)->first();

            if ($user) {
                $messageModel = Message::where('ts', $message->ts)->first();

                if (! $messageModel) {
                    $messageModel = new Message();
                    $messageModel->channel()->associate($accountChannel);
                    $messageModel->type = $message->type;
                    $messageModel->ts = $message->ts;
                    $messageModel->thread_ts = $message->thread_ts ?? null;
                    $messageModel->userId = $message->user;
                }

                $messageModel->message = $message->text;
                $messageModel->save();

                if (! empty($message->thread_ts)) {
                    $this->syncThreadMessages($messageModel, $accountChannel);
                }

                if (! empty($message->files)) {
                    $attachments = [];
                    foreach ($message->files as $file) {
                        $attachments[] = new Attachment([
                            'url' => $file->permalink,
                            'file_name' => $file->name,
                            'description' => $file->mimetype,
                            'size' => $file->size,
                        ]);
                    }

                    $messageModel->attachments()->saveMany($attachments);
                }
            }

            $lastTS = $lastTS > $message->ts ? $lastTS : $message->ts;
        }

        if (isset($lastTS)) {
            $accountChannel->last_message_timestamp = $lastTS;
            $accountChannel->save();
        }

        if ($messageResponse->has_more) {
            $this->syncMessages($accountChannel);
        }
    }

    private function syncThreadMessages(Message $message, AccountChannel $accountChannel)
    {
        $payload = [
            'channel' => $accountChannel->channelId,
            'ts' => $message->ts
        ];

        $lastTS = '';
        if ($accountChannel->last_message_timestamp) {
            $payload['oldest'] = $accountChannel->last_message_timestamp;
            $lastTS = $accountChannel->last_message_timestamp;
        }

        $messageResponse = $this->userClient->get('https://slack.com/api/conversations.replies', $payload);
        $messageResponse = json_decode($messageResponse->body());

        foreach ($messageResponse->messages as $message) {
            $user = $this->users->where('userId', $message->user)->first();

            if ($user) {
                $messageModel = Message::where('ts', $message->ts)->first();

                if (! $messageModel) {
                    $messageModel = new Message();
                    $messageModel->channel()->associate($accountChannel);
                    $messageModel->type = $message->type;
                    $messageModel->ts = $message->ts;
                    $messageModel->thread_ts = $message->thread_ts ?? null;
                    $messageModel->userId = $message->user;
                }

                $messageModel->message = $message->text;
                $messageModel->save();

                if (! empty($message->files)) {
                    $attachments = [];
                    foreach ($message->files as $file) {
                        $attachments[] = new Attachment([
                            'url' => $file->permalink,
                            'file_name' => $file->name,
                            'description' => $file->mimetype,
                            'size' => $file->size,
                        ]);
                    }

                    $messageModel->attachments()->saveMany($attachments);
                }
            }
            $lastTS = $lastTS > $message->ts ? $lastTS : $message->ts;
        }

        if (isset($lastTS)) {
            $accountChannel->last_message_timestamp = $lastTS;
            $accountChannel->save();
        }

        if ($messageResponse->has_more) {
            $this->syncThreadMessages($message, $accountChannel);
        }
    }
}
