<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::view('/login', 'login');
Route::post('/login',[AuthController::class,'login']);
Route::middleware(['auth:sanctum', 'admin'])->group(function () {

    Route::view('/admin/dashboard', 'admin.dashboard')
        ->name('admin.dashboard');

    Route::view('/user/dashboard', 'user.dashboard')
        ->name('user.dashboard');
});


Route::resource('products', ProductController::class);