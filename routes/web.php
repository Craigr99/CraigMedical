<?php

use App\Http\Controllers\Admin\DoctorController as AdminDoctorController;
use App\Http\Controllers\Admin\PatientController as AdminPatientController;
use App\Http\Controllers\Admin\VisitController as AdminVisitController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin/home', [AdminDoctorController::class, 'home'])->name('admin.home');

// Doctors routes for admin
Route::get('/doctors', [AdminDoctorController::class, 'index'])->name('admin.doctors.index');
Route::get('/doctors/create', [AdminDoctorController::class, 'create'])->name('admin.doctors.create');
Route::post('/doctors', [AdminDoctorController::class, 'store'])->name('admin.doctors.store');
Route::get('/doctors/{id}', [AdminDoctorController::class, 'show'])->name('admin.doctors.show');
Route::get('/doctors/{id}/edit', [AdminDoctorController::class, 'edit'])->name('admin.doctors.edit');
Route::put('/doctors/{id}', [AdminDoctorController::class, 'update'])->name('admin.doctors.update');
Route::delete('/doctors/{id}', [AdminDoctorController::class, 'destroy'])->name('admin.doctors.destroy');

Route::get('/patients', [AdminPatientController::class, 'index'])->name('admin.patients.index')->middleware('auth');
Route::get('/visits', [AdminVisitController::class, 'index'])->name('admin.visits.index')->middleware('auth');
