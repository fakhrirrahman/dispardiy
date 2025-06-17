<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WisataAlamController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('wisata-alam', WisataAlamController::class);
