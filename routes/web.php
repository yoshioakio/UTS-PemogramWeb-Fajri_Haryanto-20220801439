<?php

use App\Http\Controllers\Beasiswa\BeasiswaController;
use App\Http\Controllers\Halo\HaloController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/beasiswa',[BeasiswaController::class,'index'])->name('beasiswa');
Route::post('/beasiswa',[BeasiswaController::class,'store'])->name('beasiswa.post');
Route::put('/beasiswa/{id}',[BeasiswaController::class,'update'])->name('beasiswa.update');
Route::delete('/beasiswa/{id}',[BeasiswaController::class,'destroy'])->name('beasiswa.delete');