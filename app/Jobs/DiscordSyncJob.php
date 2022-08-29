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
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class DiscordSyncJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Account $account;
    public $botClient;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Account $account)
    {
        $this->account = $account;
        $account->refreshDiscordExpiredToken();
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
            'Authorization' => 'Bot ' . config('services.discord.bot_token')
        ]);

        // Get guild members.
        $userLimit = 1000;
        $afterUser = 0;
        while (true) {
            $userResponse = $this->botClient->get("https://discord.com/api/guilds/{$this->account->team_id}/members", [
                'limit' => $userLimit,
                'after' => $afterUser,
            ]);

            $users = json_decode($userResponse->body());

            if ($users && is_array($users) && !empty($users)) {

                foreach ($users as $user) {
                    $accountUser = AccountUser::where('userId', $user->user->id)->first();

                    if (!$accountUser) {
                        $accountUser = new AccountUser();
                        $accountUser->account()->associate($this->account);
                        $accountUser->userId = $user->user->id;
                    }

                    $accountUser->username = $user->user->username;
                    $accountUser->name = $user->nick;
                    $accountUser->profile = $user->user->avatar;
                    $accountUser->save();
                }

                if (count($users) < $userLimit) {
                    break;
                }

                $afterUser = $users[$userLimit - 1]->user->id;
            } else {
                break;
            }
        }

        // Get guild channels.
        $channelResponse = $this->botClient->get("https://discord.com/api/guilds/{$this->account->team_id}/channels");
        $channels = json_decode($channelResponse->body());

        foreach ($channels as $channel) {
            if ($channel->type == 4) continue;

            $accountChannel = AccountChannel::where('channelId', $channel->id)->first();

            if (!$accountChannel) {
                $accountChannel = new AccountChannel();
                $accountChannel->account()->associate($this->account);
                $accountChannel->channelId = $channel->id;
            }
            $accountChannel->name = $channel->name;
            $accountChannel->is_private = false;
            $accountChannel->is_visible = true;
            $accountChannel->save();

            $this->syncMessages($accountChannel);
        }
    }

    private function syncMessages(AccountChannel $accountChannel, $threadId = null, $threadTimeStamp = null)
    {
        // Sync channel or thread messages.
        $messageLimit = 100;
        $afterMessage = $accountChannel->messages()->latest('id')->first()?->message_id ?? 0;
        while (true) {
            $payload = [
                'limit' => 100,
                /*'around' => "messageId",
                'before' => 'messageId',*/
                'after' => $afterMessage,
            ];
            if (!$threadId) {
                $threadId = $accountChannel->channelId;
            }
            $messageResponse = $this->botClient->get("https://discord.com/api/channels/{$threadId}/messages", $payload);
            $messages = json_decode($messageResponse->body());

            if ($messages && is_array($messages) && !empty($messages)) {

                foreach ($messages as $message) {
                    $user = AccountUser::query()->where('userId', $message->author->id)->first();

                    if ($user) {
                        $messageModel = Message::where('message_id', $message->id)->first();

                        if (!$messageModel) {
                            $messageModel = new Message();
                            $messageModel->channel()->associate($accountChannel);
                            $messageModel->message_id = $message->id;
                            $messageModel->ts = Carbon::parse($message->timestamp)->timestamp;
                            $messageModel->userId = $message->author->id;
                        }
                        $messageModel->discord_type = $message->type;
                        $messageModel->type = 'message';
                        $messageModel->message = $message->content;
                        if ($message->type == 7) {
                            $messageModel->message = "<@{$message->author->id}> has joined the channel";
                        }
                        if ($threadTimeStamp) {
                            $messageModel->thread_ts = $threadTimeStamp;
                        }
                        $messageModel->save();

                        if (!empty($message->thread)) {
                            $messageModel->ts .= "." . rand(0, 999999);
                            $messageModel->thread_ts = $messageModel->ts;
                            $messageModel->save();
                            $this->syncMessages($accountChannel, $message->thread->id, $messageModel->ts);
                        }

                        if (!empty($message->attachments)) {
                            $attachments = [];
                            foreach ($message->attachments as $file) {
                                $attachments[] = new Attachment([
                                    'url' => $file->url,
                                    'file_name' => $file->filename,
                                    'description' => $file->content_type,
                                    'size' => $file->size,
                                ]);
                            }

                            $messageModel->attachments()->saveMany($attachments);
                        }
                    }

                }

                if (count($messages) < $messageLimit) {
                    break;
                }

                $afterMessage = $messages[$messageLimit - 1]->id;
            } else {
                break;
            }
        }
    }
}
