<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Property\CreateController;
use App\Http\Controllers\Property\DestroyController;
use App\Http\Controllers\Property\EditController;
use App\Http\Controllers\Property\IndexController;
use App\Http\Controllers\Property\ShowController;
use App\Http\Controllers\Property\StoreController;
use App\Http\Controllers\Property\UpdateController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::name('property.')->group(function(){
    Route::get('/properties', IndexController::class)
        ->name('index');

    Route::get('/property/create', CreateController::class)
        ->name('create')
        ->middleware(['permission:create-property', 'can:create,App\Models\Property']);

    Route::post('/property/create', StoreController::class)
        ->name('store')
        ->middleware(['permission:create-property', 'can:create,App\Models\Property']);

    Route::get('/property/{property}/edit', EditController::class)
        ->name('edit')
        ->middleware(['permission:edit-own-property', 'can:update,property']);

    Route::post('/property/{property}/edit', UpdateController::class)
        ->name('update')
        ->middleware(['permission:edit-own-property', 'can:update,property']);

    Route::delete('/property/{property}/delete', DestroyController::class)
        ->name('destroy')
        ->middleware(['permission:delete-own-property', 'can:delete,property']);

    Route::get('/property/{property}', ShowController::class)
        ->name('show');
});

require __DIR__.'/auth.php';
