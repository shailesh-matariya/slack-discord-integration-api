<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AccountChannel;
use App\Models\AccountUser;
use App\Models\Message;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class SlackController extends Controller
{
    //Get Slack channels from particular workspace
    public function getChannels(Request $request): \Illuminate\Http\JsonResponse
    {
        $channels = AccountChannel::query()->visible()->get();
        return response()->json([
            'status' => true,
            'channel_collection' => $channels
        ]);
    }

    //Get Slack users from particular workspace
    public function getUsers(Request $request): \Illuminate\Http\JsonResponse
    {
        $users =  AccountUser::query()->get();
        foreach ($users as $user) {
            if ($user->account->is_anonymize) {
                $user->name = fake()->name;
                $user->profile = 'https://ui-avatars.com/api/?name=' . urlencode($user->name);
            }
        }

        return response()->json([
            'status' => true,
            'user_collection' => $users
        ]);
    }

    //Get Slack chat from particular channel
    public function getChannelMessages(Request $request): \Illuminate\Http\JsonResponse
    {
        $messages = Message::query()
            ->where('account_channel_id', $request['channel_id'])
            ->where(function (Builder $q) {
                $q->whereRaw('ts = thread_ts')
                    ->orWhereNull('thread_ts');
            })
            ->with(['attachments', 'replies'])
            ->orderBy('ts', 'desc')
            ->paginate(40);

        return response()->json([
            'status' => true,
            'message_collection' => $messages
        ]);
    }

    //Get brand config
    public function getBrandConfig(Request $request): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => true,
            'brand_config' => config('auth.account')->only([
                'brand_popular_by',
                'brand_logo',
                'brand_logo',
                'brand_primary_color',
                'brand_custom_code',
                'brand_cname_records',
                'brand_embed_url',
                'brand_custom_domain'
            ])
        ]);
    }
}
