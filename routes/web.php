<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiagnoseController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\VitalController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware(['auth', 'role:receptionist'])->prefix('/patients')->group(function () {
        Route::get('/create', [PatientController::class, 'create'])->name('patients.create');
        Route::get('/{patient}/edit', [PatientController::class, 'edit'])->name('patients.edit');
        Route::post('/', [PatientController::class, 'store'])->name('patients.store');
        Route::put('/{patient}', [PatientController::class, 'update'])->name('patients.update');
        Route::delete('/{patient}', [PatientController::class, 'destroy'])->name('patients.destroy');
    });

    Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');
    Route::get('/patients/{patient}', [PatientController::class, 'show'])->name('patients.show');
    Route::get('/medicines', [MedicineController::class, 'index'])->name('medicines.index');
    Route::get('/vitals', [VitalController::class, 'index'])->name('vitals.index');
    Route::get('/diagnoses', [DiagnoseController::class, 'index'])->name('diagnoses.index');
    Route::get('/prescriptions', [PrescriptionController::class, 'index'])->name('prescriptions.index');

    Route::middleware(['auth', 'role:receptionist,pharmacist'])->prefix('/medicines')->group(function () {
        Route::get('/create', [MedicineController::class, 'create'])->name('medicines.create');
        Route::get('/{medicine}/edit', [MedicineController::class, 'edit'])->name('medicines.edit');
        Route::post('/', [MedicineController::class, 'store'])->name('medicines.store');
        Route::put('/{medicine}', [MedicineController::class, 'update'])->name('medicines.update');
        Route::delete('/{medicine}', [MedicineController::class, 'destroy'])->name('medicines.destroy');
    });

    Route::middleware(['auth', 'role:nurse'])->prefix('/vitals')->group(function () {
        Route::get('/create', [VitalController::class, 'create'])->name('vitals.create');
        Route::get('/{vital}/edit', [VitalController::class, 'edit'])->name('vitals.edit');
        Route::post('/', [VitalController::class, 'store'])->name('vitals.store');
        Route::put('/{vital}', [VitalController::class, 'update'])->name('vitals.update');
        Route::delete('/{vital}', [VitalController::class, 'destroy'])->name('vitals.destroy');
    });

    Route::middleware(['auth', 'role:doctor'])->prefix('/diagnoses')->group(function () {
        Route::get('/latest/{patient}', [VitalController::class, 'getLatestVital'])->name('vitals.latest');

        Route::get('/create', [DiagnoseController::class, 'create'])->name('diagnoses.create');
        Route::get('/{diagnose}/edit', [DiagnoseController::class, 'edit'])->name('diagnoses.edit');
        Route::post('/', [DiagnoseController::class, 'store'])->name('diagnoses.store');
        Route::put('/{diagnose}', [DiagnoseController::class, 'update'])->name('diagnoses.update');
        Route::delete('/{diagnose}', [DiagnoseController::class, 'destroy'])->name('diagnoses.destroy');
    });

    Route::middleware(['auth', 'role:pharmacist'])->prefix('/prescriptions')->group(function () {
        Route::get('/create', [PrescriptionController::class, 'create'])->name('prescriptions.create');
        Route::get('/{prescription}/edit', [PrescriptionController::class, 'edit'])->name('prescriptions.edit');
        Route::post('/', [PrescriptionController::class, 'store'])->name('prescriptions.store');
        Route::put('/{prescription}', [PrescriptionController::class, 'update'])->name('prescriptions.update');
        Route::delete('/{prescription}', [PrescriptionController::class, 'destroy'])->name('prescriptions.destroy');
    });
});
