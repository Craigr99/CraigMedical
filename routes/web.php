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
Route::get('/patients/{id}', [AdminPatientController::class, 'show'])->name('admin.patients.show');
Route::get('/patients/{id}/edit', [AdminPatientController::class, 'edit'])->name('admin.patients.edit');
Route::put('/patients/{id}', [AdminPatientController::class, 'update'])->name('admin.patients.update');
Route::delete('/patients/{id}', [AdminPatientController::class, 'destroy'])->name('admin.patients.destroy');

// Visits routes for admin
Route::get('/visits', [AdminVisitController::class, 'index'])->name('admin.visits.index');
Route::get('/visits/create/{id?}', [AdminVisitController::class, 'create'])->name('admin.visits.create');
// Route::get('/visits/create', [AdminVisitController::class, 'create'])->name('admin.visits.create');
Route::post('/visits', [AdminVisitController::class, 'store'])->name('admin.visits.store');
Route::get('/visits/{id}', [AdminVisitController::class, 'show'])->name('admin.visits.show');
Route::get('/visits/{id}/edit', [AdminVisitController::class, 'edit'])->name('admin.visits.edit');
Route::put('/visits/{id}', [AdminVisitController::class, 'update'])->name('admin.visits.update');
Route::delete('/visits/{id}', [AdminVisitController::class, 'destroy'])->name('admin.visits.destroy');
