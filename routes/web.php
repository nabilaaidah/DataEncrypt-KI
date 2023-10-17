<?php

use App\Http\Controllers\InformationController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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


// Register
Route::get('/', [UserController::class, 'showRegister']);
Route::post('/', [UserController::class, 'storeRegister'])->name('user.register');

// Login
Route::get('/user/login', [UserController::class, 'showLogin'])->name('user.showlogin');
Route::post('/user/login', [UserController::class, 'login'])->name('user.login');

// Route::group(['middleware' => ['noCache', 'revalidate']], function(){
//     Route::get('/user/form/{userId}', [UserController::class, 'showForm'])->name('user.showform');
//     Route::post('/user/form/{userId}', [InformationController::class, 'storeInformation'])->name('information.store');
//     Route::get('/user/view/{userId}', [InformationController::class, 'showView'])->name('user.showview');
//     Route::post('/user/view/{userId}', [InformationController::class, 'displayView']);
//     Route::get('/logout', [UserController::class, 'logout'])->name('logout');
// });

Route::group(['middleware' => 'revalidate'], function(){
    Route::get('/user/dashboard/{userId}', [UserController::class, 'showDashboard'])->name('user.dashboard');
});

Route::get('/user/form/{userId}', [UserController::class, 'showForm'])->name('user.showform');
Route::post('/user/form/{userId}', [InformationController::class, 'storeInformation'])->name('information.store');
Route::get('/user/view/{userId}', [InformationController::class, 'showView'])->name('user.showview');
Route::post('/user/view/{userId}', [InformationController::class, 'displayView']);
Route::get('/logout', [UserController::class, 'logout'])->name('logout');