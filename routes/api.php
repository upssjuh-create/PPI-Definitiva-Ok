<?php
// routes/api.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SignatureController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Rotas Públicas
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Eventos públicos (com autenticação opcional para verificar inscrição)
Route::get('/events', [EventController::class, 'index'])->middleware('auth:sanctum');
Route::get('/events/{id}', [EventController::class, 'show'])->middleware('auth:sanctum');

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
    Route::post('/registrations/{registrationId}/cancel', [RegistrationController::class, 'cancel']);
    Route::post('/check-in', [RegistrationController::class, 'checkIn']);

    // Pagamentos
    Route::get('/payments/{paymentId}/pix/generate', [\App\Http\Controllers\PixController::class, 'generatePixQRCode']);
    Route::get('/payments/{paymentId}/pix/status', [\App\Http\Controllers\PixController::class, 'checkPixPaymentStatus']);
    Route::post('/payments/{paymentId}/pix/confirm', [\App\Http\Controllers\PixController::class, 'confirmPixPayment']);
    Route::post('/payments/card/token', [\App\Http\Controllers\CardController::class, 'createCardToken']);
    Route::post('/payments/{paymentId}/card', [\App\Http\Controllers\CardController::class, 'processCardPayment']);

    // Certificados
    Route::post('/registrations/{registrationId}/certificate', [CertificateController::class, 'generate']);
    Route::get('/certificates/{id}', [CertificateController::class, 'show']);
    Route::get('/certificates/{certificateId}/download', [CertificateController::class, 'download']);
    Route::get('/my-certificates', [CertificateController::class, 'myCertificates']);

    // Perguntas
    Route::get('/events/{eventId}/questions', [QuestionController::class, 'index']);
    Route::post('/events/{eventId}/questions', [QuestionController::class, 'store']);
    Route::put('/questions/{questionId}', [QuestionController::class, 'update']);
    Route::delete('/questions/{questionId}', [QuestionController::class, 'destroy']);

    // Assinaturas
    Route::get('/signatures', [SignatureController::class, 'index']);
    Route::post('/signatures', [SignatureController::class, 'store']);
    Route::put('/signatures/{id}', [SignatureController::class, 'update']);
    Route::delete('/signatures/{id}', [SignatureController::class, 'destroy']);

    // Perfil
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::put('/profile', [ProfileController::class, 'update']);

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
        Route::get('/events/{id}/registrations', [AdminController::class, 'getEventRegistrations']);
        Route::get('/events/{id}/details', [AdminController::class, 'completedEventDetails']);
        Route::get('/events/{id}/export', [AdminController::class, 'exportReport']);

        // Cancelamentos
        Route::get('/cancellations', [AdminController::class, 'cancellations']);
        Route::post('/cancellations/{id}/approve', [AdminController::class, 'approveCancellation']);
        Route::post('/cancellations/{id}/reject', [AdminController::class, 'rejectCancellation']);

        // Respostas de perguntas (Admin)
        Route::post('/questions/{questionId}/answer', [QuestionController::class, 'answer']);
        Route::put('/questions/{questionId}/answer', [QuestionController::class, 'updateAnswer']);
        Route::delete('/questions/{questionId}/answer', [QuestionController::class, 'deleteAnswer']);
    });
});

// Webhooks de pagamento (não requer auth)
Route::post('/payments/webhook', [PaymentController::class, 'webhook']);
Route::post('/mercadopago/webhook', [\App\Http\Controllers\PixController::class, 'mercadoPagoWebhook'])->name('mercadopago.webhook');