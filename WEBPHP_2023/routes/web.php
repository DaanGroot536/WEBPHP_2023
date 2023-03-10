<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PackageController;


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
    return view('welcome');
});

Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
});

Route::controller(UserController::class)->group(function() {
    Route::get('/userlist', 'getUsers')->name('getUsers');
    Route::get('/userlistCreate', 'createUser')->name('createUser');
    Route::post('/userListSave', 'save')->name('save');
    Route::get('/userListEdit/{id}', 'editUser')->name('editUser');
    Route::post('/userListUpdate', 'update')->name('update');

});

Route::controller(PackageController::class)->group(function() {
    Route::get('/packageList', 'getPackages')->name('getPackages');
    Route::get('/packageListCreate', 'createPackage')->name('createPackage');
    Route::get('/import', 'importCSV')->name('importCSV');
    Route::get('/download-csv-template', 'downloadCSVTemplate')->name('downloadCSVTemplate');
    Route::post('/packageListSave', 'savePackage')->name('savePackage');
});
