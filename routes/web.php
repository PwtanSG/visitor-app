<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
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
Route::get('/', [VisitorController::class,'create']);
Route::post('/visitor', [VisitorController::class,'store']);
Route::get('/visitor/register', [VisitorController::class,'create']);

Route::get('/admin/login', [LoginController::class, 'index'])->name('login');
Route::post('/admin/login', [LoginController::class, 'store']);
Route::post('/admin/logout', [LogoutController::class, 'store'])->name('logout');
// Route::get('/register', [RegisterController::class, 'index'])->name('register');
// Route::post('/register', [RegisterController::class, 'store']);

Route::get('/admin/visitor', [VisitorController::class, 'index'])->middleware('auth')->name('visitor');
Route::get('/admin/visitor/{id}', [VisitorController::class,'show'])->middleware('auth');
Route::put('/admin/visitor/{id}', [VisitorController::class,'update'])->middleware('auth');;
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::post('/admin/visitor/view-pdf', [VisitorController::class,'viewPDF'])->middleware('auth')->name('view-pdf');
Route::post('/admin/visitor/download-pdf', [VisitorController::class,'downloadPDF'])->middleware('auth')->name('download-pdf');
// Route::get('/home', function () {
//     return view('home');
// });
