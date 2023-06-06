<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ContactController;
use App\Mail\HelloMail;
use Illuminate\Support\Facades\Mail;
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
Route::get('/contact', [ContactController::class,'index']);
Route::post('/contact/sendmail', [ContactController::class,'sendMail'])->name('send-mail');

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
Route::post('/admin/visitor/download-excel', [VisitorController::class,'downloadExcel'])->middleware('auth')->name('download-excel');
Route::get('/mail', function () {
    // return view('home');
    // Mail::to('pwtan.work@gmail.com')->send(new HelloMail());
});
