<?php

use App\Http\Controllers\homeController;
use App\Http\Controllers\MagazineController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/AddMagazine', [MagazineController::class, 'index'])->name('AddMagazines');
Route::get('/Magazines', [MagazineController::class, 'showAll'])->name('Magazines.index');
Route::post('/AddMagazines/store', [MagazineController::class, 'store'])->name('StoreMagazine');

Route::get('/Users', [UserController::class, 'showAll'])->name('Users.index');
Route::get('/AddUser', [UserController::class, 'index'])->name('AddUser');
Route::post('/AddUser/store', [UserController::class, 'store'])->name('StoreUser');
