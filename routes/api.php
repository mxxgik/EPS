<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PatientsController;
use App\Http\Controllers\DoctorsController;
use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\SpecialtiesController;
use App\Http\Controllers\EntitiesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Auth routes
Route::prefix('auth')->group(function () {
    Route::post("login", [AuthController::class, "login"])->name("login");
    Route::post("register", [AuthController::class, "register"])->name("register");
    Route::middleware(['auth:sanctum'])->get('logout', [AuthController::class, "logout"])->name('logout');
});

// Authenticated routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('appointments')->group(function () {
        Route::get("list", [AppointmentsController::class, "index"]);
        Route::put("edit/{id}", [AppointmentsController::class, "update"]);
        Route::delete("delete/{id}", [AppointmentsController::class, "destroy"]);
    });

    Route::prefix('entities')->group(function () {
        Route::get("list", [EntitiesController::class, "index"]);
    });
});

// Patient-specific routes
Route::middleware(['auth:sanctum', 'role:patient'])->group(function () {
    Route::prefix('patients')->group(function () {
        Route::get("show", [PatientsController::class, "show"]);
        Route::put("edit/{id}", [PatientsController::class, "update"]);
        Route::put("edit", [PatientsController::class, "updateSelf"]);
        Route::post("appointments/create", [AppointmentsController::class, "store"]);
    });

    Route::prefix('doctors')->group(function () {
        Route::get("list", [DoctorsController::class, "index"]);
    });
});

// Doctor-specific routes
Route::middleware(['auth:sanctum', 'role:doctor'])->group(function () {
    Route::prefix('doctors')->group(function () {
        Route::get("show/{id}", [DoctorsController::class, "show"]);
        Route::put("edit/{id}", [DoctorsController::class, "update"]);
        Route::put("edit", [DoctorsController::class, "updateSelf"]);
    });

    Route::prefix('patients')->group(function () {
        Route::get("list", [PatientsController::class, "index"]);
    });
});

// Admin-specific routes
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::prefix('patients')->group(function () {
        Route::get("list", [PatientsController::class, "index"]);
        Route::post("create", [PatientsController::class, "store"]);
        Route::delete("delete/{id}", [PatientsController::class, "destroy"]);
        Route::get("listFemale", [PatientsController::class, "listFemalePatients"]);
        Route::get("listMale", [PatientsController::class, "listMalePatients"]);
    });

    Route::prefix('doctors')->group(function () {
        Route::post("create", [DoctorsController::class, "store"]);
        Route::delete("delete/{id}", [DoctorsController::class, "destroy"]);
        Route::get("listMale", [DoctorsController::class, "listMaleDoctors"]);
        Route::get("listFemale", [DoctorsController::class, "listFemaleDoctors"]);
    });

    Route::prefix('appointments')->group(function () {
        Route::get("show/{id}", [AppointmentsController::class, "show"]);
    });

    Route::prefix('specialties')->group(function () {
        Route::get("list", [SpecialtiesController::class, "index"]);
        Route::get("show/{id}", [SpecialtiesController::class, "show"]);
        Route::post("create", [SpecialtiesController::class, "store"]);
        Route::put("edit/{id}", [SpecialtiesController::class, "update"]);
        Route::delete("delete/{id}", [SpecialtiesController::class, "destroy"]);
    });

    Route::prefix('entities')->group(function () {
        Route::get("show/{id}", [EntitiesController::class, "show"]);
        Route::post("create", [EntitiesController::class, "store"]);
        Route::put("edit/{id}", [EntitiesController::class, "update"]);
        Route::delete("delete/{id}", [EntitiesController::class, "destroy"]);
    });
});
