<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SendEmailController;

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
   Log::info(dd(env('MYSQL_ATTR_SSL_KEY')));

   return view('welcome');
});

Route::get('sendemail', 'SendEmailController@index')->name('sendemail');