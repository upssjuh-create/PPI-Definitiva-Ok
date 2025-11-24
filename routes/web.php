<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\SignatureController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('events');
});

// Rotas de autenticação
Route::get('/login', function () {
    return view('auth');
})->name('login');

Route::get('/register', function () {
    return view('auth');
})->name('register');

// Rotas de eventos
Route::get('/events', function () {
    return view('events');
})->name('events');

Route::get('/my-registrations', function () {
    return view('my-registrations');
})->name('my-registrations');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::get('/check-in', function () {
    return view('check-in');
})->name('check-in');

Route::get('/completed-events', function () {
    return view('completed-events');
})->name('completed-events');

// Rotas Admin
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::get('/admin/events', function () {
    return view('admin.events');
})->name('admin.events');

Route::get('/admin/cancellations', function () {
    return view('admin.cancellations');
})->name('admin.cancellations');

Route::get('/admin/validate-certificates', function () {
    return view('admin.validate-certificates');
})->name('admin.validate.certificates');

Route::get('/admin/signatures', function () {
    return view('admin.signatures');
})->name('admin.signatures');

Route::get('/admin/events/create', function () {
    return view('admin.create-event');
})->name('admin.events.create');

// Rota de edição do evento (Admin)
Route::get('/admin/events/{id}/edit', function ($id) {
    return view('admin.edit-event');
})->name('admin.events.edit');

// Rota de detalhes do evento
Route::get('/events/{id}', function ($id) {
    return view('event-details');
})->name('event.details');

// Rota de visualização do evento (Admin)
Route::get('/admin/events/{id}', function ($id) {
    return view('admin.view-event');
})->name('admin.event.view');

// Rota de relatório do evento (Admin)
Route::get('/admin/events/{id}/report', function ($id) {
    return view('admin.event-report');
})->name('admin.event.report');

// Rotas de inscrição
Route::get('/events/{id}/register', function ($id) {
    return view('confirm-registration');
})->name('event.register');

Route::get('/events/{id}/payment', function ($id) {
    return view('payment');
})->name('event.payment');

Route::get('/events/{id}/confirmation', function ($id) {
    return view('registration-confirmation');
})->name('event.confirmation');

// Rota de certificado
Route::get('/certificates/{id}', [CertificateController::class, 'show'])->name('certificate.view');
Route::get('/certificates/{id}/download', [CertificateController::class, 'download'])->name('certificate.download');

// Rota de validação de certificado
Route::get('/validar-certificado', function () {
    return view('validate-certificate');
})->name('certificate.validate');
