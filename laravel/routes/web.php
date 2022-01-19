<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MailController;
// ...
Route::get('mail/test', [MailController::class, 'test']);
// or
// Route::get('mail/test', 'App\Http\Controllers\MailController@test');

Route::get('/', function () {
    return view('welcome');
});
