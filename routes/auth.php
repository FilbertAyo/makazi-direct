<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegistrationWizardController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegistrationWizardController::class, 'showRoleSelection'])
        ->name('register');

    Route::post('register/role', [RegistrationWizardController::class, 'storeRole'])
        ->name('register.role.store');

    Route::get('register/tenant', [RegistrationWizardController::class, 'showTenantForm'])
        ->name('register.tenant');
    Route::post('register/tenant', [RegistrationWizardController::class, 'storeTenant'])
        ->name('register.tenant.store');

    Route::get('register/landlord/details', [RegistrationWizardController::class, 'showLandlordDetails'])
        ->name('register.landlord.details');
    Route::post('register/landlord/details', [RegistrationWizardController::class, 'storeLandlordDetails'])
        ->name('register.landlord.details.store');

    Route::get('register/landlord/documents', [RegistrationWizardController::class, 'showLandlordDocuments'])
        ->name('register.landlord.documents');
    Route::post('register/landlord/documents', [RegistrationWizardController::class, 'storeLandlordDocuments'])
        ->name('register.landlord.documents.store');

    Route::get('register/pending', [RegistrationWizardController::class, 'showPending'])
        ->name('register.pending');

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
