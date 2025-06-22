<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WisataAlamController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::group(['middleware' => ['role_or_permission:ADMIN']], function () {


    Route::get('/wisata-alam', [WisataAlamController::class, 'index'])->name('wisata-alam.index');
    Route::get('/wisata-alam/{id}', [WisataAlamController::class, 'show'])->name('wisata-alam.show');
    Route::get('/wisata-alam/create', [WisataAlamController::class, 'create'])->name('wisata-alam.create');
    Route::post('/wisata-alam', [WisataAlamController::class, 'store'])->name('wisata-alam.store');
    Route::get('/wisata-alam/{id}/edit', [WisataAlamController::class, 'edit'])->name('wisata-alam.edit');
    Route::put('/wisata-alam/{id}', [WisataAlamController::class, 'update'])->name('wisata-alam.update');
    Route::delete('/wisata-alam/{id}', [WisataAlamController::class, 'destroy'])->name('wisata-alam.destroy');
});

Route::group(['middleware' => ['role_or_permission:USER']], function () {
    //

});
