<?php

namespace App\Modules\Moodle\Routes;

use Illuminate\Support\Facades\Route;
use App\Modules\Moodle\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| Student Routes
|--------------------------------------------------------------------------
|
| Here is where you can register student routes for your module. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" and "auth" middleware groups.
|
*/

Route::prefix('moodle/student')->name('moodle.student.')->middleware(['web', 'auth'])->group(function () {
    // Dashboard
    Route::get('/', [StudentController::class, 'dashboard'])->name('dashboard');
    
    // Courses
    Route::get('/courses', [StudentController::class, 'courses'])->name('courses');
    Route::get('/course/{id}', [StudentController::class, 'courseDetail'])->name('course');
    Route::get('/course/preview/{id}', [StudentController::class, 'coursePreview'])->name('course.preview');
    Route::post('/course/enroll/{id}', [StudentController::class, 'enrollCourse'])->name('course.enroll');
    Route::get('/course/{course_id}/module/{module_id}', [StudentController::class, 'viewModule'])->name('course.module');
    Route::post('/course/{course_id}/module/{module_id}/complete', [StudentController::class, 'completeModule'])->name('course.module.complete');
    
    // Progress
    Route::get('/progress', [StudentController::class, 'progress'])->name('progress');
    Route::get('/progress/{course_id}', [StudentController::class, 'courseProgress'])->name('progress.course');
    
    // Grades
    Route::get('/grades', [StudentController::class, 'grades'])->name('grades');
    Route::get('/grades/{course_id}', [StudentController::class, 'courseGrades'])->name('grades.course');
    
    // Certificates
    Route::get('/certificates', [StudentController::class, 'certificates'])->name('certificates');
    Route::post('/certificates/request', [StudentController::class, 'requestCertificate'])->name('certificates.request');
    Route::get('/certificates/download/{id}', [StudentController::class, 'downloadCertificate'])->name('certificates.download');
    
    // Profile
    Route::get('/profile', [StudentController::class, 'profile'])->name('profile');
    Route::put('/profile', [StudentController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [StudentController::class, 'updatePassword'])->name('profile.password');
    
    // Notifications
    Route::get('/notifications', [StudentController::class, 'notifications'])->name('notifications');
    Route::put('/notifications/{id}/read', [StudentController::class, 'markNotificationAsRead'])->name('notifications.read');
    Route::put('/notifications/read-all', [StudentController::class, 'markAllNotificationsAsRead'])->name('notifications.read-all');
    
    // Calendar
    Route::get('/calendar', [StudentController::class, 'calendar'])->name('calendar');
    Route::get('/calendar/events', [StudentController::class, 'calendarEvents'])->name('calendar.events');
    
    // Forums
    Route::get('/forums', [StudentController::class, 'forums'])->name('forums');
    Route::get('/forum/{id}', [StudentController::class, 'forumDetail'])->name('forum');
    Route::get('/forum/{forum_id}/discussion/{discussion_id}', [StudentController::class, 'forumDiscussion'])->name('forum.discussion');
    Route::post('/forum/{forum_id}/discussion', [StudentController::class, 'createForumDiscussion'])->name('forum.discussion.create');
    Route::post('/forum/discussion/{discussion_id}/reply', [StudentController::class, 'replyForumDiscussion'])->name('forum.discussion.reply');
});
