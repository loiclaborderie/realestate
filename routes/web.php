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

    Route::middleware('auth')->group(function (){

        Route::get('/property/create', CreateController::class)
            ->name('create')
            ->middleware(['permission:create-property']);

        Route::post('/property/create', StoreController::class)
            ->name('store')
            ->middleware(['permission:create-property']);

        Route::get('/property/edit/{property}', EditController::class)
            ->name('edit')
            ->middleware('can:update,property');

        Route::post('/property/edit/{property}', UpdateController::class)
            ->name('update')
            ->middleware(['can:update,property']);

        Route::get('/address/edit/{address}', \App\Http\Controllers\PropertyAddress\EditController::class)
            ->name('address.edit')
            ->middleware('can:update,address');

        Route::post('/address/edit/{address}', \App\Http\Controllers\PropertyAddress\UpdateController::class)
            ->name('address.update')
            ->middleware(['can:update,address']);

        Route::delete('/property/{property}/delete', DestroyController::class)
            ->name('destroy')
            ->middleware(['can:delete,property']);
    });

    Route::get('/property/{property}', ShowController::class)
        ->name('show');
});

Route::get('/my-properties', \App\Http\Controllers\Property\MyPropertiesList::class)
    ->middleware(['auth', 'permission:view-owned-properties'])
    ->name('my.properties');

require __DIR__.'/auth.php';
