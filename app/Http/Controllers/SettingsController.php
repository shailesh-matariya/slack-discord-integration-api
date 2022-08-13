<?php

namespace App\Http\Controllers;

use App\Jobs\SlackSyncJob;
use App\Models\Account;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class SettingsController extends Controller
{
    public function settings(): View
    {
        $account = Auth::user()->account;
        $slackUrl = $this->getSlackUrl();
        $discordUrl = $this->getDiscordUrl();

        return view('settings', compact('account', 'slackUrl', 'discordUrl'));
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

        $user = User::first(); // Auth::user();
        $account = $user->account;

        if ($account) {
            return redirect(route('settings'));
        }

        $account = new Account();
        $account->user()->associate($user);
        $account->platform = 'slack';
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
        return '';
    }
}
