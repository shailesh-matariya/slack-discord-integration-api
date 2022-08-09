<?php

namespace App\Http\Middleware;

use App\Models\Account;
use Closure;
use Illuminate\Http\Request;

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
        $account = Account::query()->where([['platform', '=', $request['platform']], ['team_id', '=' , $request['team_id']]])->first();
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
