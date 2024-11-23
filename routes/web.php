<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\PlantMonitoringController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Route::group(['prefix' => 'master', 'middleware' => ['auth:web', 'verified']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::name('role.')->prefix('role')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('index');
        Route::get('/create', [RoleController::class, 'create'])->name('create');
        Route::post('/store', [RoleController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [RoleController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [RoleController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [RoleController::class, 'destroy'])->name('destroy');
        Route::get('/data', [RoleController::class, 'data'])->name('data');
    });

    Route::name('user.')->prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [UserController::class, 'destroy'])->name('destroy');
        Route::get('/data', [UserController::class, 'data'])->name('data');
    });

    Route::name('plant.')->prefix('plant')->group(function () {
        Route::get('/', [PlantController::class, 'index'])->name('index');
        Route::get('/create', [PlantController::class, 'create'])->name('create');
        Route::post('/store', [PlantController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [PlantController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [PlantController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [PlantController::class, 'destroy'])->name('destroy');
        Route::get('/data', [PlantController::class, 'data'])->name('data');
    });

    Route::name('plant-monitoring.')->prefix('plant-monitoring')->group(function () {
        Route::get('/{id}/show', [PlantMonitoringController::class, 'show'])->name('show');
        Route::get('/{id}/data', [PlantMonitoringController::class, 'data'])->name('data');
    });
});

require __DIR__.'/auth.php';
