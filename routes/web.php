<?php

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

use App\Http\Controllers\ApiController;
use App\Http\Controllers\MainController;

Route::get('', [MainController::class, 'index'])->name('index');
Route::post('login', [MainController::class, 'login'])->name('login');
Route::get('chats/{chat}', [MainController::class, 'chat'])->name('chat');
Route::get('chats', [MainController::class, 'chats'])->name('chats');
Route::post('send', [MainController::class, 'send'])->name('send');

Route::get('api/chats/{chat}', [ApiController::class, 'getChat'])->name('api.chats.get');
Route::post('api/chats/{chat}/send', [ApiController::class, 'sendMessage'])->name('api.chats.send');

Route::get('logout', function () {
    Auth::logout();

    return redirect()->route('index');
});
