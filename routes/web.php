<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/catalogue',[FilmController::class,'index'])->name('catalogue');
Route::get('/films/{id}', [FilmController::class, 'show'])->where('id', '[0-9]+')->name('show');
Route::delete('/films/{id}', [FilmController::class, 'destroy'])->name('films.destroy');
Route::get('/films/{id}/edit', [FilmController::class, 'edit'])->name('films.edit');
Route::put('/films/{id}', [FilmController::class, 'update'])->name('films.update');

Route::get('/films/create', [FilmController::class, 'create'])->name('films.create');
Route::post('/films', [FilmController::class, 'store'])->name('films.store');

Route::get('/locations',[LocationController::class,'index'])->name('locations');
Route::get('/locations/{id}', [LocationController::class, 'show'])->where('id', '[0-9]+')->name('locations.show');

Route::get('/inventory',[InventoryController::class,'index'])->name('inventorys');
Route::get('/inventory/{id}', [InventoryController::class, 'show'])->where('id', '[0-9]+')->name('inventorys.show');

require __DIR__.'/auth.php';
