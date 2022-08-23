<?php

namespace App\Http\Middleware;

use App\Models\Account;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class IdentifyWorkspaceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next): \Illuminate\Http\JsonResponse
    {
//        $account = Account::query()->where([['platform', '=', $request['platform']], ['team_id', '=' , $request['team_id']]])->first();
        $account = null;
        $company_domain = parse_url(config('app.company_slack_url'), PHP_URL_HOST);
        $domain = parse_url($request->input('url'), PHP_URL_HOST);

        if ($domain == $company_domain) {
            $segments = array_values(array_filter(explode('/', parse_url($request->input('url'), PHP_URL_PATH))));
            if (isset($segments[0]) && isset($segments[1]) && $segments[0] == 't') {
                $account = Account::query()->where('team_id', $segments[1])->first();
            } elseif (isset($segments[0]) && isset($segments[1]) && $segments[0] == 'c') {
                $account = Account::query()->where('workspace', $segments[1])->first();
            }
        } elseif ($request->input('url')) {
            $account = Account::query()->whereRaw(" SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(brand_embed_url, '/', 3), '://', -1), '/', 1), '?', 1) = '$domain' ")->first();
        }

        if ($account) {
            config()->set('auth.account', $account);
            return $next($request);
        }
        return response()->json([
            'status' => false,
            'error' => 'not found'
        ])->setStatusCode(404);
    }
}
