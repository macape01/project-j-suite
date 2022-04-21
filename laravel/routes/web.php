<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\MailController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\ModeloController;
use App\Http\Controllers\UserController;


use App\Http\Controllers\CompanyController;
require __DIR__.'/auth.php';

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

Route::get('/', function (Request $request) {
    $message = 'Loading welcome page';
    Log::info($message);
    $request->session()->flash('info', $message);
    return view('welcome');
 });
 
Route::get('mail/test', [MailController::class, 'test'])->middleware("auth");


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('categories', CategoryController::class)->middleware(['auth', 'role:3']);


Route::resource('modelos', ModeloController::class)->middleware(['auth', 'role.any:1,2,3,4']);

Route::resource('users', UserController::class)->middleware(['auth', 'role:3']);
Route::resource('files', FileController::class)->middleware(['auth', 'role:3']);
Route::resource('companies', CompanyController::class)->middleware(['auth', 'role:3']);
Route::resource('deliveries', DeliveryController::class)->middleware(['auth', 'role:3']);

