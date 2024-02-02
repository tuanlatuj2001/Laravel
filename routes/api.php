<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GetDataController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\AssetController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register']);
Route::post('verify', [AuthController::class, 'verify']);
Route::post('login', [AuthController::class, 'loginUser']);
Route::post('getcode', [AuthController::class, 'get_code']);
Route::post('forgot', [AuthController::class, 'forgot']);
Route::get('/get-models/{manufacturer}', [AssetController::class, 'getModels']);
Route::get('/get-deparments/{deparment}', [AssetController::class, 'getDeparment']);

Route::get('asset', [AssetController::class, 'list']);
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('user', [AuthController::class, 'userDetails']);
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('deparment', [GetDataController::class, 'deparment']);
    Route::get('countrie', [GetDataController::class, 'countrie']);
    Route::get('categorie', [GetDataController::class, 'categorie']);
    Route::get('manufacturer', [GetDataController::class, 'manufacturer']);
    Route::get('modele', [GetDataController::class, 'modele']);
    Route::get('supplier', [GetDataController::class, 'supplier']);
    Route::get('location', [LocationController::class, 'list']);
    Route::post('location/create', [LocationController::class, 'create']);
    Route::post('location/copy/{id}', [LocationController::class, 'copy']);
    Route::post('location/update/{id}', [LocationController::class, 'edit']);
    Route::delete('location/delete/{id}', [LocationController::class, 'delete']);
    Route::post('location/import', [LocationController::class, 'import']);

    Route::post('asset/create', [AssetController::class, 'create']);
    Route::post('asset/update/{id}', [AssetController::class, 'update']);
    Route::delete('asset/delete/{id}', [AssetController::class, 'delete']);
    Route::post('asset/import', [AssetController::class, 'import']);

    Route::get('asset/code', [AssetController::class, 'generate']);
    Route::get('asset/code/regenerate/{id}', [AssetController::class, 're_generate'])->name('regenerate');

});