<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AccountChannel;
use App\Models\AccountUser;
use App\Models\Message;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $isSubscribed = config('auth.account')->user->subscribed();
        foreach ($users as $user) {
            if ($user->account->is_anonymize) {
                $user->name = $isSubscribed ? fake()->name : $user->name;
                $user->profile = $isSubscribed ? 'https://ui-avatars.com/api/?name=' . urlencode($user->name) : $user->profile;
            }
        }

        return response()->json([
            'status' => true,
            'user_collection' => $users,
            'platform' => config('auth.account')->platform
        ]);
    }

    //Get Slack chat from particular channel
    public function getChannelMessages(Request $request): \Illuminate\Http\JsonResponse
    {
        $account = config('auth.account');
        $query = Message::query()
            ->where('account_channel_id', $request['channel_id'])
            ->where(function (Builder $q) {
                $q->whereRaw('ts = thread_ts')
                    ->orWhereNull('thread_ts');
            })
            ->with(['attachments', 'replies.reactions', 'reactions'])
            ->withCount(['replies', 'reactions']);

        if ($account->brand_popular_by)
        {
            if (count($account->brand_popular_by) === 1 && in_array('replies', $account->brand_popular_by)) {
                $query->orderByDesc('replies_count');
            } elseif (count($account->brand_popular_by) === 1 && in_array('reactions', $account->brand_popular_by)) {
                $query->orderByDesc('reactions_count');
            } else {
                $query->orderByDesc('reactions_count')
                    ->orderByDesc('replies_count');
            }
        }

        $messages = $query->latest('id')
        ->paginate(40);
        return response()->json([
            'status' => true,
            'message_collection' => $messages
        ]);
    }

    //Get brand config
    public function getBrandConfig(Request $request): \Illuminate\Http\JsonResponse
    {
        $isSubscribed = config('auth.account')->user->subscribed();
        return response()->json([
            'status' => true,
            'brand_config' => [
                'brand_popular_by' =>$isSubscribed ? config('auth.account')->brand_popular_by : null,
                'brand_logo' =>$isSubscribed ? config('auth.account')->brand_logo : null,
                'brand_logo_url' =>$isSubscribed ? config('auth.account')->brand_logo_url : null,
                'brand_primary_color' =>$isSubscribed ? config('auth.account')->brand_primary_color : null,
                'brand_secondary_color' =>$isSubscribed ? config('auth.account')->brand_secondary_color : null,
                'brand_custom_code' =>$isSubscribed ? config('auth.account')->brand_custom_code : null,
                'brand_cname_records' =>$isSubscribed ? config('auth.account')->brand_cname_records : null,
                'brand_embed_url' =>$isSubscribed ? config('auth.account')->brand_embed_url : null,
                'brand_custom_domain' =>$isSubscribed ? config('auth.account')->brand_custom_domain : null
            ]
        ]);
    }
}
