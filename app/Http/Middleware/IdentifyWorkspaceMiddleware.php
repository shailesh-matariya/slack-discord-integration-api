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
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next): \Illuminate\Http\JsonResponse
    {
//        $account = Account::query()->where([['platform', '=', $request['platform']], ['team_id', '=' , $request['team_id']]])->first();
        $account = null;
        if (App::environment('local') && $request->server('HTTP_REFERER') == config('app.company_slack_url')) {
            if ($request->segment(1)=='t') {
                $account = Account::query()->where('team_id', $request->segment(2))->first();
            } elseif ($request->segment(1)=='c') {
                $account_user = DB::table('account_users')->where('username', $request->segment(2))->first();
                if ($account_user) {
                    $account = Account::find($account_user->account_id);
                }
            }
        }elseif ($request->server('HTTP_REFERER')) {
            $account = Account::query()->where('brand_embed_url', $request->server('HTTP_REFERER'))->first();
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
