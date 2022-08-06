<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SettingsController extends Controller
{
    public function settings()
    {

    }

    public function getSlackUrl()
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

        $url = "https://slack.com/oauth/authorize?client_id={$slackClientId}&scope={$scopes}&user_scope={$userScopes}&redirect_uri={$redirectUrl}&granular_bot_scope=1&single_channel=0&install_redirect=&tracked=1&state={$state}";
        echo $url;
    }

    public function slackCodeHandle(Request $request)
    {
        $url = 'https://slack.com/api/oauth.v2.access';

        $response = Http::get($url, [
            'client_id' => config('services.slack.client_id'),
            'client_secret' => config('services.slack.secret'),
            'code' => $request->code,
            'redirect_uri' => config('services.slack.redirect_url')
        ]);

        $response = json_decode($response->body());

        //https://api.slack.com/legacy/oauth
        //https://api.slack.com/methods/oauth.access
        dd($response);
    }

    public function getDiscordUrl()
    {
    }
}
