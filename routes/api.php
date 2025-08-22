<?php

use App\Http\Controllers\PatientsController;
use App\Http\Controllers\DoctorsController;
use App\Http\Controllers\AppointmentsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Routers for patients 
Route::get("listPatients", [PatientsController::class,"index"]);
Route::get("showPatient/{id}", [PatientsController::class,"show"]);
Route::post("createPatient", [PatientsController::class,"store"]);
Route::put("editPatient/{id}", [PatientsController::class,"update"]);
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
