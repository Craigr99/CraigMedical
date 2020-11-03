<?php

use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\VisitController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Doctors routes
Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors.index')->middleware('auth');
Route::get('/doctors/create', [DoctorController::class, 'create'])->name('doctors.create')->middleware('auth');
Route::post('/doctors', [DoctorController::class, 'store'])->name('doctors.store')->middleware('auth');
Route::get('/doctors/{id}', [DoctorController::class, 'show'])->name('doctors.show')->middleware('auth');
Route::get('/doctors/{id}/edit', [DoctorController::class, 'edit'])->name('doctors.edit')->middleware('auth');
Route::put('/doctors/{id}', [DoctorController::class, 'update'])->name('doctors.update')->middleware('auth');
Route::delete('/doctors/{id}', [DoctorController::class, 'destroy'])->name('doctors.destroy')->middleware('auth');

Route::get('/patients', [PatientController::class, 'index'])->name('patients.index')->middleware('auth');
Route::get('/visits', [VisitController::class, 'index'])->name('visits.index')->middleware('auth');
