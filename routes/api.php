<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PatientsController;
use App\Http\Controllers\DoctorsController;
use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\SpecialtiesController;
use App\Http\Controllers\EntitiesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Login
Route::post("login", [AuthController::class, "login"])->name("login");

//Register
Route::post("register", [AuthController::class, "register"])->name("register");

//Protected Routes
Route::group(['middleware'=> ['auth:sanctum']], function () {
    Route::get('logout',[AuthController::class, "logout"])->name('logout');
    Route::get("showPatient", [PatientsController::class,"show"]);
    Route::put("editPatient", [PatientsController::class,"update"]);

});

// Routers for patients
Route::get("listPatients", [PatientsController::class,"index"]);
Route::post("createPatient", [PatientsController::class,"store"]);
Route::delete("deletePatient/{id}", [PatientsController::class,"destroy"]);
Route::get("listFemalePatients", [PatientsController::class,"listFemalePatients"]);
Route::get("listMalePatients", [PatientsController::class,"listMalePatients"]);

//Routers for doctors
Route::get("listDoctors", [DoctorsController::class,"index"]);
Route::get("showDoctor/{id}", [DoctorsController::class,"show"]);
Route::post("createDoctor", [DoctorsController::class,"store"]);
Route::put("editDoctor/{id}", [DoctorsController::class,"update"]);
Route::delete("deleteDoctor/{id}", [DoctorsController::class,"destroy"]);
Route::get("listMaleDoctors", [DoctorsController::class,"listMaleDoctors"]);
Route::get("listFemaleDoctors", [DoctorsController::class,"listFemaleDoctors"]);

//Routers for appointments
Route::get("listAppointments", [AppointmentsController::class,"index"]);
Route::get("showAppointments/{id}", [AppointmentsController::class,"show"]);
Route::post("createAppointment", [AppointmentsController::class,"store"]);
Route::put("editAppointment/{id}", [AppointmentsController::class,"update"]);
Route::delete("deleteAppointment/{id}", [AppointmentsController::class,"destroy"]);
Route::get("listScheduledAppointments", [AppointmentsController::class,"listScheduledAppointments"]);

//Routers for specialties
Route::get("listSpecialties", [SpecialtiesController::class,"index"]);
Route::get("showSpecialties/{id}", [SpecialtiesController::class,"show"]);
Route::post("createSpecialty", [SpecialtiesController::class,"store"]);
Route::put("editSpecialty/{id}", [SpecialtiesController::class,"update"]);
Route::delete("deleteSpecialty/{id}", [SpecialtiesController::class,"destroy"]);

//Routers for entities
Route::get("listEntities", [EntitiesController::class,"index"]);
Route::get("showEntities/{id}", [EntitiesController::class,"show"]);
Route::post("createEntity", [EntitiesController::class,"store"]);
Route::put("editEntity/{id}", [EntitiesController::class,"update"]);
Route::delete("deleteEntity/{id}", [EntitiesController::class,"destroy"]);
