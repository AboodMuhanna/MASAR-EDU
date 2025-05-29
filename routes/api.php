<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\FacultyDepartmentController;
use App\Http\Controllers\API\CourseController;
use App\Http\Controllers\API\ContactFormController;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\AuthController;

Route::post('/login', [AuthController::class, 'login']);

// ✅ PUBLIC user registration
Route::post('/users', [UserController::class, 'store']);

// 🔒 Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('users', UserController::class)->except(['store']);
    Route::apiResource('faculty-departments', FacultyDepartmentController::class);
    Route::apiResource('courses', CourseController::class);
    Route::apiResource('contact-forms', ContactFormController::class);
    Route::apiResource('logins', LoginController::class);
});
