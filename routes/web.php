<?php

use App\Http\Controllers\BejegyzesekController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/bejegyzesek', [BejegyzesekController::class, 'index'])->name('bejegyzesek.index');
Route::post('/bejegyzesek', [BejegyzesekController::class, 'store'])->name('bejegyzesek.store');
Route::get('/bejegyzesek/{id}', [BejegyzesekController::class, 'show'])->name('bejegyzesek.show');


require __DIR__ . '/auth.php';
