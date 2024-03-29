<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\LabelController;
use App\Http\Controllers\PickupController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TrackandtraceController;

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

Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);

    return redirect()->back();
});

Route::controller(LoginRegisterController::class)->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
});

Route::controller(TrackandtraceController::class)->group(function () {
    Route::get('/trackandtrace', 'getTrackandtraceView')->name('getTrackandtraceView');
    Route::post('/order', 'getOrderView')->name('getOrderView');
});

Route::controller(ReviewController::class)->group(function () {
    Route::get('/reviewlist', 'getReviewView')->name('getReviewView');
    Route::get('/writeReview', 'getCreateReviewView')->name('getCreateReviewView');
    Route::post('/saveReview', 'saveReview')->name('saveReview');
});

Route::group(['middleware' => ['auth']], function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/userlist', 'getUserView')->name('getUserView');
        Route::get('/userlistCreate', 'getCreateUserView')->name('getCreateUserView');
        Route::post('/userListSave', 'saveUser')->name('saveUser');
        Route::get('/userListEdit/{id}', 'getEditUserView')->name('getEditUserView');
        Route::post('/userListUpdate', 'updateUser')->name('updateUser');
        Route::get('/customerList', 'getCustomerView')->name('getCustomerView');
        Route::get('/customerlist/resetCustomerFilters', 'resetCustomerFilters')->name('resetCustomerFilters');
    });

    Route::controller(PackageController::class)->group(function () {
        Route::get('/packageList', 'getPackages')->name('getPackages');
        Route::get('/packageList/resetFilters', 'resetFilters')->name('resetFilters');
        Route::get('/packageListCreate', 'getCreatePackageView')->name('getCreatePackageView');
        Route::get('/import', 'getBulkImportView')->name('getBulkImportView');
        Route::get('/download-csv-template', 'downloadCSVTemplate')->name('downloadCSVTemplate');
        Route::get('/deliveredPackages', 'getDeliveredPackagesView')->name('getDeliveredPackagesView');
        Route::get('/customerlist/resetDeliveredPackagesFilters', 'resetDeliveredPackagesFilters')->name('resetDeliveredPackagesFilters');
    });

    Route::controller(LabelController::class)->group(function () {
        Route::get('/getLabelView', 'getLabels')->name('getLabels');
        Route::get('/labelCreate/{id}', 'getCreateLabelView')->name('getCreateLabelView');
        Route::post('/labelSave', 'saveLabel')->name('saveLabel');
        Route::post('/labelSaveBulk', 'saveLabelBulk')->name('saveLabelBulk');
        Route::post('/labelPrintBulk', 'printLabelBulk')->name('printLabelBulk');
        Route::get('/resetLabelFilters', 'resetLabelFilters')->name('resetLabelFilters');
    });

    Route::controller(PickupController::class)->group(function () {
        Route::get('/pickuplist', 'getPickupView')->name('getPickupView');
        Route::post('/pickupSaveBulk', 'savePickupBulk')->name('savePickupBulk');
        Route::post('/pickupCreateBulk', 'getCreatePickupBulk')->name('getCreatePickupBulk');
        Route::get('/pickupCreate/{id}', 'getCreatePickupView')->name('getCreatePickupView');
        Route::post('/pickupSave', 'savePickup')->name('savePickup');
        Route::get('/pickupCalendar', 'getCalendarView')->name('getCalendarView');
        Route::post('/pickupCalendarNewWeek', 'changeCalendarWeek')->name('changeCalendarWeek');
        Route::get('/resetPickupFilters', 'resetPickupFilters')->name('resetPickupFilters');
    });

    Route::controller(StatusController::class)->group(function () {
        Route::get('/statuslist', 'getStatusView')->name('getStatusView');
        Route::get('/updateStatus/{id}', 'getUpdateStatusView')->name('getUpdateStatusView');
    });
});
