<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PackageApiController;
use App\Http\Controllers\StatusApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(PackageApiController::class)->group(function () {
    Route::post('/createPackage', 'createPackage')->name('createPackage');
    Route::post('/bulk-import-csv', 'bulkImportCSV')->name('bulkImportCSV');
});


Route::controller(StatusApiController::class)->group(function () {
    Route::post('/updateStatus', 'updateStatus')->name('updateStatus');
});


