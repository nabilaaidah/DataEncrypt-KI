<?php

use App\Http\Controllers\InformationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RequestController;
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
Route::get('/', [AuthController::class, 'showRegister']);
Route::post('/', [AuthController::class, 'storeRegister'])->name('user.register');

// Login
Route::get('/user/login', [AuthController::class, 'showLogin'])->name('user.showlogin');
Route::post('/user/login', [AuthController::class, 'login'])->name('user.login');

// Link Login
Route::get('/login/{requestId}', [AuthController::class, 'showLinkLogin'])->name('link.showlogin');
Route::post('/login/{requestId}', [AuthController::class, 'linklogin'])->name('link.login');

Route::middleware(['auth'])->group(function (){
    // Dashboard
    Route::get('/user/dashboard/{userId}', [UserController::class, 'showDashboard'])->name('user.dashboard');
    
    // Form
    Route::get('/user/form/{userId}', [UserController::class, 'showForm'])->name('user.showform');
    Route::post('/user/form/{userId}', [InformationController::class, 'storeInformation'])->name('information.store');
    
    // View
    Route::get('/user/view/{userId}/{id}', [InformationController::class, 'showView'])->name('user.showview');
    
    // List data user OG
    Route::get('/user/list/{userId}', [InformationController::class, 'listData'])->name('information.listdata');
    
    // Insert password
    Route::post('/user/insertPassword/{userId}', [UserController::class, 'checkPassword'])->name('user.checkpassword');
    
    // Insert Email 
    Route::get('/user/insertEmail/{userId}', [UserController::class, 'showInsertEmail'])->name('user.showinsertemail');
    Route::post('/user/insertEmail/{userId}', [UserController::class, 'checkEmail'])->name('user.checkemail');
    
    // List other data
    Route::get('/user/otherdata/{userId}/{requestedId}', [InformationController::class, 'listOtherData'])->name('user.listotherdata');

    // Request
    Route::post('/user/storingRequest/{userId}/{requestedId}/{informationId}', [RequestController::class, 'storingRequest'])->name('request.storingrequest');
    Route::get('/user/showRequest/{userId}', [RequestController::class, 'showRequestList'])->name('request.showlist');
    Route::post('/user/storingAcc/{requestId}', [RequestController::class, 'storingAccept'])->name('request.accept');
    Route::post('/user/storingDecline/{requestId}', [RequestController::class, 'storingDecline'])->name('request.decline');

    // Mail
    Route::get('/user/sendEmail/{requestId}', [RequestController::class, 'sendEmail'])->name('request.sendemail');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
