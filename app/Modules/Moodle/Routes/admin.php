<?php

namespace App\Modules\Moodle\Routes;

use Illuminate\Support\Facades\Route;
use App\Modules\Moodle\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your module. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" and "auth" middleware groups.
|
*/

Route::prefix('moodle/admin')->name('moodle.admin.')->middleware(['web', 'auth'])->group(function () {
    // Dashboard
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    // Users
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/users/search', [AdminController::class, 'searchUsers'])->name('users.search');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
    Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{id}', [AdminController::class, 'destroyUser'])->name('users.destroy');
    Route::get('/users/{id}/courses', [AdminController::class, 'getUserCourses'])->name('users.courses');
    Route::get('/users/completed-courses', [AdminController::class, 'getCompletedCourses'])->name('users.completed-courses');

    // Courses
    Route::get('/courses', [AdminController::class, 'courses'])->name('courses');
    Route::post('/courses', [AdminController::class, 'storeCourse'])->name('courses.store');
    Route::put('/courses/{id}', [AdminController::class, 'updateCourse'])->name('courses.update');
    Route::delete('/courses/{id}', [AdminController::class, 'destroyCourse'])->name('courses.destroy');
    Route::get('/courses/{id}/content', [AdminController::class, 'courseContent'])->name('courses.content');
    Route::get('/courses/{id}/content/get', [AdminController::class, 'getCourseContent'])->name('courses.content.get');
    Route::post('/courses/{id}/content', [AdminController::class, 'updateCourseContent'])->name('courses.content.update');

    // Enrollments
    Route::get('/enrollments', [AdminController::class, 'enrollments'])->name('enrollments');
    Route::post('/enrollments/enroll', [AdminController::class, 'enrollUser'])->name('enrollments.enroll');
    Route::put('/enrollments/update', [AdminController::class, 'updateEnrollment'])->name('enrollments.update');
    Route::delete('/enrollments/unenroll', [AdminController::class, 'unenrollUser'])->name('enrollments.unenroll');

    // Certificates
    Route::get('/certificates', [AdminController::class, 'certificates'])->name('certificates');
    Route::delete('/certificates/{id}', [AdminController::class, 'destroyCertificate'])->name('certificates.destroy');

    // Settings
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::post('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');
    Route::post('/test-connection', [AdminController::class, 'testConnection'])->name('test-connection');

    // Categories
    Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
    Route::post('/categories', [AdminController::class, 'storeCategory'])->name('categories.store');
    Route::put('/categories/{id}', [AdminController::class, 'updateCategory'])->name('categories.update');
    Route::delete('/categories/{id}', [AdminController::class, 'destroyCategory'])->name('categories.destroy');

    // Reports
    Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
    Route::get('/reports/users', [AdminController::class, 'usersReport'])->name('reports.users');
    Route::get('/reports/courses', [AdminController::class, 'coursesReport'])->name('reports.courses');
    Route::get('/reports/enrollments', [AdminController::class, 'enrollmentsReport'])->name('reports.enrollments');
    Route::get('/reports/certificates', [AdminController::class, 'certificatesReport'])->name('reports.certificates');
    Route::get('/reports/export/{type}', [AdminController::class, 'exportReport'])->name('reports.export');
});
