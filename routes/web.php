<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomAuthController;
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



Route::get('/', [CustomAuthController::class, 'dashboard'])->name('dashboard'); 
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 

Route::get('guard', [AdminController::class, 'getGaurd'])->name('admin.getGaurd');
Route::post('guard', [AdminController::class, 'storeGaurd'])->name('admin.storeGaurd');
Route::patch('guard', [AdminController::class, 'updateGaurd'])->name('admin.updateGaurd');
Route::patch('Fingerguard', [AdminController::class, 'Fingerguard'])->name('admin.Fingerguard');
Route::post('deleteGaurd', [AdminController::class, 'deleteGaurd'])->name('admin.delguard');

Route::patch('bayUpdate', [AdminController::class, 'bayUpdate'])->name('admin.bayUpdate');
Route::get('admin', [AdminController::class, 'getAdmin'])->name('admin.getAdmin');
Route::post('admin', [AdminController::class, 'storeAdmin'])->name('admin.storeAdmin');
Route::patch('admin', [AdminController::class, 'updateAdmin'])->name('admin.updateAdmin');
Route::post('deladmin', [AdminController::class, 'delAdmin'])->name('admin.delguard');





Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');


