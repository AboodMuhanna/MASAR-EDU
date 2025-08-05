<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\FacultyDepartmentController;
use App\Http\Controllers\API\CourseController;
use App\Http\Controllers\API\UserCourseController;
use App\Http\Controllers\API\ContactFormController;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\Api\AdminAuthController;
use App\Http\Controllers\Api\AdminPasswordResetController;
use App\Http\Controllers\API\UserAuthController;

// Admin routes
Route::prefix('admin')->group(function () {
    Route::post('/register', [AdminAuthController::class, 'register']);
    Route::post('/login', [AdminAuthController::class, 'login']);

    Route::middleware('auth:admin')->group(function () {
        Route::get('/profile', [AdminAuthController::class, 'profile']);
        Route::post('/logout', [AdminAuthController::class, 'logout']);
    });

    Route::post('/password/email', [AdminPasswordResetController::class, 'sendResetLink']);
    Route::post('/password/reset', [AdminPasswordResetController::class, 'reset']);
});

// User routes
Route::prefix('user')->group(function () {
    Route::post('/register', [UserAuthController::class, 'register']);
    Route::post('/login', [UserAuthController::class, 'login']);

    Route::middleware('auth:api')->group(function () {
        Route::get('/profile', [UserAuthController::class, 'profile']);
        Route::post('/logout', [UserAuthController::class, 'logout']);
        Route::post('/add-course', [UserCourseController::class, 'store']);
    });
});

// باقي الـ API resources
Route::apiResource('users', UserController::class);
Route::apiResource('faculty-departments', FacultyDepartmentController::class);
Route::apiResource('courses', CourseController::class);
Route::apiResource('contact-forms', ContactFormController::class);
Route::apiResource('logins', LoginController::class);
