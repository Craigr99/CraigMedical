<?php

use App\Http\Controllers\Admin\DoctorController as AdminDoctorController;
use App\Http\Controllers\Admin\PatientController as AdminPatientController;
use App\Http\Controllers\Admin\VisitController as AdminVisitController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Routes to redirect users to their dashboard
Route::get('/admin/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.home');
Route::get('/doctor/home', [App\Http\Controllers\Doctor\HomeController::class, 'index'])->name('doctor.home');
Route::get('/patient/home', [App\Http\Controllers\Patient\HomeController::class, 'index'])->name('patient.home');

// Doctors routes for admin
Route::get('/doctors', [AdminDoctorController::class, 'index'])->name('admin.doctors.index');
Route::get('/doctors/create', [AdminDoctorController::class, 'create'])->name('admin.doctors.create');
Route::post('/doctors', [AdminDoctorController::class, 'store'])->name('admin.doctors.store');
Route::get('/doctors/{id}', [AdminDoctorController::class, 'show'])->name('admin.doctors.show');
Route::get('/doctors/{id}/edit', [AdminDoctorController::class, 'edit'])->name('admin.doctors.edit');
Route::put('/doctors/{id}', [AdminDoctorController::class, 'update'])->name('admin.doctors.update');
Route::delete('/doctors/{id}', [AdminDoctorController::class, 'destroy'])->name('admin.doctors.destroy');

// Patient routes for admin
Route::get('/patients', [AdminPatientController::class, 'index'])->name('admin.patients.index');
Route::get('/patients/create', [AdminPatientController::class, 'create'])->name('admin.patients.create');
Route::post('/patients', [AdminPatientController::class, 'store'])->name('admin.patients.store');

// Visits routes for admin
Route::get('/visits', [AdminVisitController::class, 'index'])->name('admin.visits.index');
Route::get('/visits/create', [AdminVisitController::class, 'create'])->name('admin.visits.create');
Route::post('/visits', [AdminVisitController::class, 'store'])->name('admin.visits.store');
