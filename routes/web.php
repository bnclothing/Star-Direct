<?php

use App\Http\Controllers\homeController;
use App\Http\Controllers\MagazineController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/AddMagazines', [MagazineController::class, 'index'])->name('AddMagazines');
Route::post('/AddMagazines/store', [MagazineController::class, 'store'])->name('StoreMagazine');
Route::post('/AddUser/store', [UserController::class, 'store'])->name('StoreUser');
Route::get('/AddUser', [UserController::class, 'index'])->name('AddUser');
