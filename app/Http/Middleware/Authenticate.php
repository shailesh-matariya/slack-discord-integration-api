<?php

namespace App\Http\Middleware;

use App\Models\Account;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }

    protected function authenticate($request, array $guards)
    {
        parent::authenticate($request, $guards);

        if ($request->has('account_id')) {
            $account = Account::find($request->account_id);
            config()->set('auth.account', $account);
        }
    }
}
