<?php

namespace App\Modules\Moodle\Routes;

use Illuminate\Support\Facades\Route;
use App\Modules\Moodle\Controllers\CertificateController;

/*
|--------------------------------------------------------------------------
| Certificate Routes
|--------------------------------------------------------------------------
|
| Here is where you can register certificate routes for your module. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group.
|
*/

Route::prefix('moodle/certificates')->name('moodle.certificates.')->middleware(['web'])->group(function () {
    // Certificate Generation
    Route::post('/generate', [CertificateController::class, 'generate'])->name('generate');
    Route::post('/generate-batch', [CertificateController::class, 'generateBatch'])->middleware('auth', 'admin')->name('generate-batch');
    
    // Certificate Download
    Route::get('/download/{filename}', [CertificateController::class, 'download'])->name('download');
    
    // Certificate Verification
    Route::get('/verify', [CertificateController::class, 'verifyForm'])->name('verify.get');
    Route::post('/verify', [CertificateController::class, 'verify'])->name('verify.post');
    Route::get('/verify/{certificate_id}', [CertificateController::class, 'verifyById'])->name('verify.id');
    
    // Certificate Templates
    Route::get('/templates', [CertificateController::class, 'templates'])->middleware('auth', 'admin')->name('templates');
    Route::get('/templates/{id}', [CertificateController::class, 'templatePreview'])->middleware('auth', 'admin')->name('templates.preview');
    Route::post('/templates', [CertificateController::class, 'storeTemplate'])->middleware('auth', 'admin')->name('templates.store');
    Route::put('/templates/{id}', [CertificateController::class, 'updateTemplate'])->middleware('auth', 'admin')->name('templates.update');
    Route::delete('/templates/{id}', [CertificateController::class, 'destroyTemplate'])->middleware('auth', 'admin')->name('templates.destroy');
    
    // Certificate API
    Route::prefix('api')->middleware(['api', 'auth:api'])->group(function () {
        Route::get('/{certificate_id}', [CertificateController::class, 'apiVerify'])->name('api.verify');
        Route::post('/generate', [CertificateController::class, 'apiGenerate'])->name('api.generate');
    });
});

// Public Certificate Verification
Route::get('/verify-certificate/{certificate_id}', [CertificateController::class, 'publicVerify'])->name('moodle.verify-certificate');
