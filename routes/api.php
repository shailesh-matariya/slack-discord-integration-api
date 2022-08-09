<?php

use App\Http\Controllers\Api\SlackController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Slack
Route::middleware('workspace')->group(function() {
    Route::get('/slack-channels', [SlackController::class, 'getChannels']);
    Route::get('/slack-users', [SlackController::class, 'getUsers']);
    Route::get('/channel-messages', [SlackController::class, 'getChannelMessages']);
});
