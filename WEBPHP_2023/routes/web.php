<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\LabelController;


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
    Route::get('/userlist', 'getUserView')->name('getUserView');
    Route::get('/userlistCreate', 'getCreateUserView')->name('getCreateUserView');
    Route::post('/userListSave', 'saveUser')->name('saveUser');
    Route::get('/userListEdit/{id}', 'getEditUserView')->name('getEditUserView');
    Route::post('/userListUpdate', 'updateUser')->name('updateUser');

});

Route::controller(PackageController::class)->group(function() {
    Route::get('/packageList', 'getPackages')->name('getPackages');
    Route::get('/packageListCreate', 'getCreatePackageView')->name('getCreatePackageView');
    Route::get('/import', 'getBulkImportView')->name('getBulkImportView');
    Route::post('/bulk-import-csv', 'bulkImportCSV')->name('bulkImportCSV');
    Route::get('/download-csv-template', 'downloadCSVTemplate')->name('downloadCSVTemplate');
    Route::post('/packageListSave', 'createPackage')->name('createPackage');
});

Route::controller(LabelController::class)->group(function() {
    Route::get('/labelCreate/{id}', 'getCreateLabelView')->name('getCreateLabelView');
    Route::post('/labelSave', 'saveLabel')->name('saveLabel');
});
