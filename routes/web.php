<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('mahasiswas.index');
});

Route::resource('dosens', DosenController::class)->except(['show']);
Route::resource('mahasiswas', MahasiswaController::class)->except(['show']);
