<?php

use App\Http\Controllers\SettingsController;
use App\Jobs\SlackSyncJob;
use App\Models\Account;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $account = Account::first();

    dispatch(new SlackSyncJob($account));

    return view('welcome');
});

Route::get('/getSlackUrl', [SettingsController::class, 'getSlackUrl']);
Route::get('/redirect/slack', [SettingsController::class, 'slackCodeHandle']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/settings', [SettingsController::class, 'settings'])->name('settings');

    Route::get('/branding', function () {
        return view('branding');
    })->name('branding');

    Route::get('/plans', function () {
        return view('plans');
    })->name('plans');
});
