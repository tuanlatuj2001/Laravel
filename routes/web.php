<?php


use App\Http\Controllers\Controller_ui\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\test;
use App\Http\Controllers\Controller_ui\LocationController;
use App\Http\Controllers\Controller_ui\AuthController;
use App\Http\Controllers\Controller_ui\UserController;
use App\Http\Controllers\Controller_ui\PermissionControlller;
use App\Http\Controllers\Controller_ui\RoleController;
use App\Http\Controllers\Controller_ui\AssetController;

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

Route::get('/login', [AuthController::class,'login'] );
Route::get('/verify', [AuthController::class,'verify'] );
Route::post('/verifies', [AuthController::class,'verifies'] );
Route::post('/send_code', [AuthController::class,'get_code'] );
Route::get('/code', [AuthController::class,'code'] );
Route::get('/register', [AuthController::class,'register'] );
Route::post('/registers', [AuthController::class,'registers'] );
Route::post('/login_user', [AuthController::class,'loginUser'] );
Route::get('/forgot', [AuthController::class,'forgot'] );
Route::post('/forgot_password', [AuthController::class,'forgot_password'] );
Route::post('change/{id}', [UserController::class, 'change']);
Route::get('change/{id}', [UserController::class, 'show'])->name('change');

Route::middleware(['login'])->group(function () {
    Route::get('/dashboard', [DashboardController::class,'index'] );
    Route::post('/logout', [AuthController::class,'logout'] );
    Route::get('admin/location/list', [LocationController::class,'list'] )->can('location.view');
    Route::get('admin/location/create', [LocationController::class,'create'] )->can('location.create');
    Route::post('admin/location/store', [LocationController::class,'store'] );
    Route::get('admin/location/copy/{id}', [LocationController::class,'copy'] );
    Route::get('admin/location/delete/{id}', [LocationController::class,'delete'] )->can('location.delete');
    Route::get('admin/location/edit/{id}', [LocationController::class,'edit'] )->can('location.edit');
    Route::post('admin/location/update/{id}', [LocationController::class,'update'] );
    Route::post('admin/location/import', [LocationController::class,'import'] );
    Route::get('/admin/user/list', [UserController::class,'list'] )->can('user.view');
    Route::get('/admin/role/list', [RoleController::class,'list'] )->can('role.view');
    Route::get('/admin/role/add', [RoleController::class, 'add'])->can('role.create');
    Route::post('/admin/role/store', [RoleController::class, 'store'])->name('role.store');
    Route::get('/admin/role/edit/{role}', [RoleController::class, 'edit'])->name('role.edit')->can('role.edit');
    Route::post('/admin/role/update/{role}', [RoleController::class, 'update'])->name('role.update');
    Route::get('/admin/role/delete/{role}', [RoleController::class, 'delete'])->name('role.delete')->can('role.delete');
    Route::get('/admin/role/copy/{role}', [RoleController::class, 'copy'])->name('role.copy');
    Route::get('/admin/user/add', [UserController::class, 'create'])->can('user.create');
    Route::post('/admin/user/store', [UserController::class, 'store'])->name('user.add');
    Route::get('/admin/asset/list', [AssetController::class,'index'] )->can('asset.view');
    Route::get('/admin/asset/qr', [AssetController::class,'qr'] );
    Route::get('/admin/asset/qr/{id}', [AssetController::class,'re_generate'] );
    Route::get('/admin/asset/create', [AssetController::class,'create'] )->can('asset.create');
    Route::post('/admin/asset/store', [AssetController::class,'store'] );
    Route::get('/admin/asset/edit/{id}', [AssetController::class,'edit'] )->can('asset.edit');
    Route::post('/admin/asset/update/{id}', [AssetController::class,'update'] );
    Route::post('admin/asset/import', [AssetController::class,'import'] );
    Route::get('admin/asset/print/{id}', [AssetController::class,'print'] );
    Route::post('admin/asset/review', [AssetController::class,'review'] );
    



    

});

