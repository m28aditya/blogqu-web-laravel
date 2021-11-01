<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;

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

Route::get('/auth/sign-up',[AuthController::class,'signup']);
Route::post('/auth/sign-up',[AuthController::class,'register']);
Route::get('/auth/sign-in',[AuthController::class,'signin'])->name('login');
Route::post('/auth/sign-in',[AuthController::class,'authenticate']);
Route::post('/auth/sign-out',[AuthController::class,'logout']);

Route::get('/',[HomeController::class,'index']);
Route::get('/',[HomeController::class,'search']);

Route::get('/post/{slug}',[HomeController::class,'post']);
Route::get('/post/author/{author}',[HomeController::class,'author']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard',[DashboardController::class,'index']);

    Route::get('/create/post',[DashboardController::class,'create']);
    Route::post('/create/post',[DashboardController::class,'store']);

    Route::get('/detail/post/{id}',[DashboardController::class,'edit']);
    Route::post('/detail/post/{id}',[DashboardController::class,'update']);

    Route::delete('/delete/post/{id}',[DashboardController::class,'destroy']);

    Route::post('/post/{slug}/like',[HomeController::class,'like']);
    Route::post('/post/{slug}/unlike',[HomeController::class,'unlike']);

    Route::post('/post/{slug}/comment',[HomeController::class,'comment']);
});