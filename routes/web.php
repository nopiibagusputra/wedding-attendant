<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [Auth\AuthController::class, 'index'])->name('login');
Route::post('/auth', [Auth\AuthController::class, 'login'])->name('auth_login');
Route::get('/logout', [Auth\AuthController::class, 'logout'])->name('logout');

//error
Route::view('/error_401', 'error.401')->name('error_401');

//level admin
Route::middleware('auth', 'validatelevels:admin')->group(function () {
    
    //get method
    Route::get('/admin/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/admin/users/list', [Admin\ManagementController::class, 'show'])->name('list_users');
    Route::get('/admin/users/edit/{id}', [Admin\ManagementController::class, 'edit'])->name('edit_users');
    Route::get('/admin/users/hapus/{id}', [Admin\ManagementController::class, 'delete'])->name('hapus_users');
    
    //post method
    Route::post('/admin/users/store', [Admin\ManagementController::class, 'store'])->name('store_users');

    //put method
    Route::put('/admin/users/update/{id}', [Admin\ManagementController::class, 'update'])->name('update_users');

});

//level user
Route::middleware('auth', 'validatelevels:user')->group(function () {
    //get method
    Route::get('/sekolah/dashboard', [Sekolah\DashboardController::class, 'index'])->name('dashboard_sekolah');
  

    //post method
   

    //put method
   
});
