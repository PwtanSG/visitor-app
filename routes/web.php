<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\VisitorController;
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
Route::get('/visitor', [VisitorController::class, 'index']);
Route::get('/visitor/{id}', [VisitorController::class,'show']);
Route::put('/visitor/{id}', [VisitorController::class,'update']);

// Route::get('/home', function () {
//     return view('home');
// });
