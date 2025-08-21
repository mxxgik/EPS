<?php

use App\Http\Controllers\PatientsController;
use App\Http\Controllers\DoctorsController;
use App\Http\Controllers\AppointmentsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Routers for patients 
Route::get("listPatients", [PatientsController::class,"index"]);
Route::post("createPatient", [PatientsController::class,"store"]);

//Routers for doctors
Route::get("listDoctors", [DoctorsController::class,"index"]);

//Routers for appointments
Route::get("listAppointments", [AppointmentsController::class,"index"]);