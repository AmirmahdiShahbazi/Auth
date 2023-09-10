<?php

use Amirsh\Auth\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('',function(){
    dd(Auth::check());
})->name('home')->middleware('web');

Route::prefix('')->group(function(){

    Route::get('register',[AuthController::class,'showRegisterForm'])->name('auth.registerForm')->middleware('web');

    Route::get('login',[AuthController::class,'showLoginForm'])->name('auth.loginForm')->middleware('web');

    Route::post('register',[AuthController::class,'register'])->name('auth.register')->middleware('web');

    Route::post('login',[AuthController::class,'login'])->name('auth.login')->middleware('web');

    Route::get('logout',[AuthController::class,'logout'])->name('auth.logout')->middleware('web');
    
});