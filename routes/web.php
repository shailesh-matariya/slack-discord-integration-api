<?php

use App\Http\Controllers\BrandingController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Middleware\VerifyCsrfToken;
use App\Jobs\SlackSyncJob;
use App\Models\Account;
use Illuminate\Support\Facades\Artisan;
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
//    $account = Account::first();
//
//    dispatch(new SlackSyncJob($account));

    return view('welcome');
});

Route::get('run', function () {
   Artisan::call('execute:sync');
});

Route::get('/getSlackUrl', [SettingsController::class, 'getSlackUrl']);
Route::get('/redirect/slack', [SettingsController::class, 'slackCodeHandle']);
Route::get('/redirect/discord', [SettingsController::class, 'discordCodeHandle']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/settings', [SettingsController::class, 'settings'])->name('settings');

    Route::get('/branding', [BrandingController::class, 'index'])->name('branding');

    Route::get('/plans', [SubscriptionController::class, 'plans'])->name('plans');

    Route::post('/set-channel-visibility', [SettingsController::class, 'setChannelVisibility'])
        ->name('setChannelVisibility')
        ->withoutMiddleware(VerifyCsrfToken::class);

    Route::post('/set-anonymize', [SettingsController::class, 'setUserAnonymize'])
        ->name('setUserAnonymize')
        ->withoutMiddleware(VerifyCsrfToken::class);

    Route::post('/set-default-channel', [SettingsController::class, 'setDefaultChannel'])
        ->name('setDefaultChannel')
        ->withoutMiddleware(VerifyCsrfToken::class);

    Route::post('set-branding-data', [BrandingController::class, 'setBrandingData'])
        ->name('setBrandingData');

    Route::get('subscribe/checkout', [SubscriptionController::class, 'subscribeCheckout'])->name('subscribe.checkout');
    Route::get('subscribe/success', [SubscriptionController::class, 'subscribeSuccess'])->name('subscribe.success');
    Route::get('subscribe/fail', [SubscriptionController::class, 'subscribeFail'])->name('subscribe.fail');
    Route::get('subscribe/cancel', [SubscriptionController::class, 'subscribeCancel'])->name('subscribe.cancel');

    Route::post('/remove-account', [SettingsController::class, 'removeAccount'])
        ->name('removeAccount')
        ->withoutMiddleware(VerifyCsrfToken::class);
});
