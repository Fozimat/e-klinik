<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\VitalController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('/patients')->group(function () {
        Route::get('/', [PatientController::class, 'index'])->name('patients.index');
        Route::get('/create', [PatientController::class, 'create'])->name('patients.create');
        Route::get('/{patient}', [PatientController::class, 'show'])->name('patients.show');
        Route::get('/{patient}/edit', [PatientController::class, 'edit'])->name('patients.edit');
        Route::post('/', [PatientController::class, 'store'])->name('patients.store');
        Route::put('/{patient}', [PatientController::class, 'update'])->name('patients.update');
        Route::delete('/{patient}', [PatientController::class, 'destroy'])->name('patients.destroy');
    });

    Route::prefix('/medicines')->group(function () {
        Route::get('/', [MedicineController::class, 'index'])->name('medicines.index');
        Route::get('/create', [MedicineController::class, 'create'])->name('medicines.create');
        Route::get('/{medicine}', [MedicineController::class, 'show'])->name('medicines.show');
        Route::get('/{medicine}/edit', [MedicineController::class, 'edit'])->name('medicines.edit');
        Route::post('/', [MedicineController::class, 'store'])->name('medicines.store');
        Route::put('/{medicine}', [MedicineController::class, 'update'])->name('medicines.update');
        Route::delete('/{medicine}', [MedicineController::class, 'destroy'])->name('medicines.destroy');
    });

    Route::prefix('/vitals')->group(function () {
        Route::get('/', [VitalController::class, 'index'])->name('vitals.index');
        Route::get('/create', [VitalController::class, 'create'])->name('vitals.create');
        Route::get('/{vital}', [VitalController::class, 'show'])->name('vitals.show');
        Route::get('/{vital}/edit', [VitalController::class, 'edit'])->name('vitals.edit');
        Route::post('/', [VitalController::class, 'store'])->name('vitals.store');
        Route::put('/{vital}', [VitalController::class, 'update'])->name('vitals.update');
        Route::delete('/{vital}', [VitalController::class, 'destroy'])->name('vitals.destroy');
    });
});
