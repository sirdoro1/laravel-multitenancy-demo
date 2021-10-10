<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Auth\Tenants\ConfirmablePasswordController;
use App\Http\Controllers\Auth\Tenants\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\Tenants\EmailVerificationPromptController;
use App\Http\Controllers\Auth\Tenants\NewPasswordController;
use App\Http\Controllers\Auth\Tenants\PasswordResetLinkController;
use App\Http\Controllers\Auth\Tenants\RegisterController;
use App\Http\Controllers\Auth\Tenants\VerifyEmailController;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    });

    Auth::routes();

    // Route::get('/login', [LoginController::class, 'create'])
    // ->middleware('guest')
    // ->name('logins');

    // Route::post('/login', [LoginController::class, 'store'])
    // ->middleware('guest');

    // Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
    // ->middleware('guest')
    // ->name('password.requests');

    // Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    // ->middleware('guest')
    // ->name('password.emails');

    // Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    // ->middleware('guest')
    // ->name('password.resets');

    // Route::post('/reset-password', [NewPasswordController::class, 'store'])
    // ->middleware('guest')
    // ->name('password.updates');

    // Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
    // ->middleware('auth')
    // ->name('verification.notices');

    // Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    // ->middleware(['auth', 'signed', 'throttle:6,1'])
    // ->name('verification.verifys');

    // Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    // ->middleware(['auth', 'throttle:6,1'])
    // ->name('verification.sends');

    // Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
    // ->middleware('auth')
    // ->name('password.confirms');

    // Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
    // ->middleware('auth');

    Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logouts');
});


