<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PatientsController;
use App\Http\Controllers\DoctorsController;
use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\SpecialtiesController;
use App\Http\Controllers\EntitiesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public routes
Route::post("login", [AuthController::class, "login"])->name("login");
Route::post("register", [AuthController::class, "register"])->name("register");

// Authenticated routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('logout',[AuthController::class, "logout"])->name('logout');
});

// Patient-specific routes
Route::middleware(['auth:sanctum', 'role:patient'])->group(function () {
    Route::get("showPatient", [PatientsController::class,"show"]);
    Route::put("editPatient", [PatientsController::class,"update"]);
    Route::post("createAppointment", [AppointmentsController::class,"store"]);
    Route::get("listDoctors", [DoctorsController::class,"index"]);
    Route::put("editAppointment/{id}", [AppointmentsController::class,"update"]);
});

// Doctor-specific routes
Route::middleware(['auth:sanctum', 'role:doctor'])->group(function () {
    Route::get("showDoctor/{id}", [DoctorsController::class,"show"]);
    Route::put("editDoctor/{id}", [DoctorsController::class,"update"]);
    Route::get("listPatients", [PatientsController::class,"index"]);
    Route::put("editAppointment/{id}", [AppointmentsController::class,"update"]);
});

// Admin-specific routes
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    // Patients management
    Route::get("listPatients", [PatientsController::class,"index"]);
    Route::post("createPatient", [PatientsController::class,"store"]);
    Route::delete("deletePatient/{id}", [PatientsController::class,"destroy"]);
    Route::get("listFemalePatients", [PatientsController::class,"listFemalePatients"]);
    Route::get("listMalePatients", [PatientsController::class,"listMalePatients"]);

    // Doctors management
    Route::post("createDoctor", [DoctorsController::class,"store"]);
    Route::delete("deleteDoctor/{id}", [DoctorsController::class,"destroy"]);
    Route::get("listMaleDoctors", [DoctorsController::class,"listMaleDoctors"]);
    Route::get("listFemaleDoctors", [DoctorsController::class,"listFemaleDoctors"]);

    // Appointments management
    Route::get("listAppointments", [AppointmentsController::class,"index"]);
    Route::get("showAppointments/{id}", [AppointmentsController::class,"show"]);
    Route::delete("deleteAppointment/{id}", [AppointmentsController::class,"destroy"]);
    Route::get("listScheduledAppointments", [AppointmentsController::class,"listScheduledAppointments"]);

    // Specialties management
    Route::get("listSpecialties", [SpecialtiesController::class,"index"]);
    Route::get("showSpecialties/{id}", [SpecialtiesController::class,"show"]);
    Route::post("createSpecialty", [SpecialtiesController::class,"store"]);
    Route::put("editSpecialty/{id}", [SpecialtiesController::class,"update"]);
    Route::delete("deleteSpecialty/{id}", [SpecialtiesController::class,"destroy"]);

    // Entities management
    Route::get("listEntities", [EntitiesController::class,"index"]);
    Route::get("showEntities/{id}", [EntitiesController::class,"show"]);
    Route::post("createEntity", [EntitiesController::class,"store"]);
    Route::put("editEntity/{id}", [EntitiesController::class,"update"]);
    Route::delete("deleteEntity/{id}", [EntitiesController::class,"destroy"]);
});
