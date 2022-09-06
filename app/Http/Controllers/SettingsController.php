<?php

namespace App\Http\Controllers;

use App\Jobs\DiscordSyncJob;
use App\Jobs\SlackSyncJob;
use App\Models\Account;
use App\Models\AccountChannel;
use App\Models\AccountUser;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class SettingsController extends Controller
{
    public function settings(): View
    {
        $account = Auth::user()->account;
        if ($account) {
            config()->set('auth.account', $account);
        }
        $slackUrl = $this->getSlackUrl();
        $discordUrl = $this->getDiscordUrl();
        $channels = AccountChannel::query()->get();
        $defaultChannel = $channels->where('is_default', true)->first();
        $subscribed = Auth::user()->subscribed();
        return view('settings', compact('account', 'slackUrl', 'discordUrl', 'channels', 'defaultChannel', 'subscribed'));
    }

    private function getSlackUrl(): string
    {
        $scopes = implode(",", [
            'channels:history',
            'channels:join',
            'channels:read',
            'incoming-webhook',
            'reactions:read',
            'users:read',
            'team:read',
            'files:read'
        ]);
        $userScopes = implode(",", [
            'channels:history',
            'search:read',
            'users:read',
            'reactions:read'
        ]);
        $slackClientId = config('services.slack.client_id');
        $redirectUrl = config('services.slack.redirect_url');
        $state = 'patel.shailesh987@gmail.com' . '-' . bcrypt(1);

        return "https://slack.com/oauth/authorize?client_id={$slackClientId}&scope={$scopes}&user_scope={$userScopes}&redirect_uri={$redirectUrl}&granular_bot_scope=1&single_channel=0&install_redirect=&tracked=1&state={$state}";
    }

    public function slackCodeHandle(Request $request): RedirectResponse
    {
        $url = 'https://slack.com/api/oauth.v2.access';

        $response = Http::get($url, [
            'client_id' => config('services.slack.client_id'),
            'client_secret' => config('services.slack.secret'),
            'code' => $request->code,
            'redirect_uri' => config('services.slack.redirect_url')
        ]);

        $response = json_decode($response->body());

        $user = Auth::user();
        $account = $user->account;

        if ($account) {
            return redirect(route('settings'));
        }

        $account = new Account();
        $account->user()->associate($user);
        $account->platform = Account::PLATFORM_SLACK;
        $account->team_id = $response->team->id;
        $account->workspace = $response->team->name;
        $account->app_id = $response->app_id;
        $account->auth_user = $response->authed_user->id;
        $account->user_access_token = $response->authed_user->access_token;
        $account->bot_access_token = $response->access_token;
        $account->bot_user = $response->bot_user_id;
        $account->bot_scope = $response->scope;
        $account->user_scope = $response->authed_user->scope;
        $account->save();

        dispatch_sync(new SlackSyncJob($account));

        return redirect(route('settings'));
    }

    public function getDiscordUrl(): string
    {
        $scopes = implode("%20", [
            'guilds',
            'guilds.members.read',
            'bot'
        ]);

        $discordClientId = config('services.discord.client_id');
        $redirectUrl = config('services.discord.redirect_url');
        $permissionId = config('services.discord.permission_id');
        $state = 'patel.shailesh987@gmail.com' . '-' . bcrypt(1);

        return "https://discord.com/api/oauth2/authorize?response_type=code&client_id={$discordClientId}&scope={$scopes}&redirect_uri={$redirectUrl}&prompt=consent&state={$state}&permissions={$permissionId}";
    }

    public function discordCodeHandle(Request $request)
    {
        $url = 'https://discord.com/api/oauth2/token';

        $response = Http::asForm()->post($url, [
            'client_id' => config('services.discord.client_id'),
            'client_secret' => config('services.discord.secret'),
            'grant_type'=> 'authorization_code',
            'code' => $request->code,
            'redirect_uri' => config('services.discord.redirect_url'),
        ]);

        $response = json_decode($response->body());

        if (isset($response->error)){
            return response($response->error." : ".$response->error_description);
        }

        $user = Auth::user();
        $account = $user->account;

        if ($account) {
            return redirect(route('settings'));
        }

        /*if (Account::where('team_id', $response->guild->id)->first()){
            $account = Account::where('team_id',$response->guild->id)->first();
        }else{
            $account = new Account();
        }*/

        $account = new Account();
        $account->user()->associate($user);
        $account->platform = Account::PLATFORM_DISCORD;
        $account->bot_scope = $response->scope;
        $account->discord_access_token = $response->access_token;
        $account->discord_refresh_token = $response->refresh_token;
        $account->discord_access_token_expire_at = Carbon::now()->addSeconds($response->expires_in);
        $account->workspace = $response->guild->name;
        $account->team_id = $response->guild->id;
        $account->save();

        dispatch_sync(new DiscordSyncJob($account));

//      return response()->json(['msg'=>'Check the database']);
        return redirect(route('settings'));
    }

    public function setChannelVisibility(Request $request)
    {
        $channel = AccountChannel::query()->where('account_id', $request->account_id)
            ->where('channelId', $request->channel_id)
            ->first();

        $channel->update([
                'is_visible'=> $request->is_visible
            ]);
        return response()->json([
            'status' => true,
            'message' => 'Saved successfully!'
        ]);
    }

    public function setUserAnonymize(Request $request)
    {
        $account = Account::find($request->account_id);
        $account->is_anonymize = $request->is_anonymize;
        $account->save();

        return response()->json([
            'status' => true,
            'message' => 'Saved successfully!'
        ]);
    }

    public function setDefaultChannel(Request $request)
    {
        $account = Account::find($request->channel['account_id']);
        config()->set('auth.account', $account);

        $channel = AccountChannel::find($request->channel['id']);
        AccountChannel::query()->where('account_id', $channel->account_id)->update([
            'is_default'=> false
        ]);
        $channel->update([
            'is_default'=> $request->is_default
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Saved successfully!'
        ]);
    }

    public  function removeAccount(): \Illuminate\Http\JsonResponse
    {

        $account = Auth::user()->account;
        config()->set('auth.account', $account);
        $account->removeAccount();


        return response()->json([
            'status' => true,
            'message' => 'Removed successfully!'
        ]);
    }
}
