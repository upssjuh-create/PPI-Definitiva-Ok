<?php
// routes/api.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Rotas Públicas
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Eventos públicos
Route::get('/events', [EventController::class, 'index']);
Route::get('/events/{id}', [EventController::class, 'show']);

// Validação pública de certificado
Route::get('/certificates/validate/{code}', [CertificateController::class, 'validate']);

// Rotas Autenticadas
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // Inscrições
    Route::post('/events/{eventId}/register', [RegistrationController::class, 'register']);
    Route::get('/my-registrations', [RegistrationController::class, 'myRegistrations']);
    Route::delete('/registrations/{registrationId}', [RegistrationController::class, 'cancel']);
    Route::post('/check-in', [RegistrationController::class, 'checkIn']);

    // Pagamentos
    Route::post('/payments/{paymentId}/pix', [PaymentController::class, 'processPix']);
    Route::post('/payments/{paymentId}/card', [PaymentController::class, 'processCard']);

    // Certificados
    Route::post('/registrations/{registrationId}/certificate', [CertificateController::class, 'generate']);
    Route::get('/certificates/{certificateId}/download', [CertificateController::class, 'download']);
    Route::get('/my-certificates', [CertificateController::class, 'myCertificates']);

    // Rotas Admin
    Route::middleware('admin')->prefix('admin')->group(function () {
        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard']);

        // Eventos
        Route::post('/events', [EventController::class, 'store']);
        Route::put('/events/{id}', [EventController::class, 'update']);
        Route::delete('/events/{id}', [EventController::class, 'destroy']);
        Route::post('/events/{id}/complete', [AdminController::class, 'completeEvent']);

        // Relatórios
        Route::get('/events/{id}/details', [AdminController::class, 'completedEventDetails']);
        Route::get('/events/{id}/export', [AdminController::class, 'exportReport']);
    });
});

// Webhook de pagamento (não requer auth)
Route::post('/payments/webhook', [PaymentController::class, 'webhook']);