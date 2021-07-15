<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceController;

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

Route::get('/', [UserController::class, 'home'])->name('home');


Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function() {
    Route::resource('/booking', BookingController::class);
    Route::resource('/service', ServiceController::class);
});

Route::group(['middleware' => 'admin'], function() {
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    
    Route::get('/admin/booking', [AdminController::class, 'getBooking']);
    Route::post('/admin/booking/add', [AdminController::class, 'addBooking']);
    Route::post('/admin/booking/update_status', [AdminController::class, 'updateBookingStatus']);

    Route::get('/admin/user', [AdminController::class, 'getUser']);
    Route::post('/admin/user/update', [AdminController::class, 'updateUser']);
    Route::post('/admin/user/add', [AdminController::class, 'addUser']);
    
    Route::get('/admin/service', [AdminController::class, 'getService']);
    Route::post('/admin/service/update', [AdminController::class, 'updateService']);
    Route::post('/admin/service/add', [AdminController::class, 'addService']);
});