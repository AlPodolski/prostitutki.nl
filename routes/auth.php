<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::post('/cabinet/image/delete', \App\Http\Controllers\Cabinet\ImageController::class);
    Route::post('/cabinet/image/add', [\App\Http\Controllers\Cabinet\ImageController::class, 'add']);
});

Route::get('login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::middleware('redirect')->group(function () {

    Route::domain('{city}.' . SITE)->group(function () {

        Route::middleware('captcha')->group(function () {
            Route::post('login', [AuthenticatedSessionController::class, 'store']);
            Route::post('register', [RegisteredUserController::class, 'store']);
        });

        Route::middleware('guest')->group(function () {

            Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

            Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

            Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

            Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

            Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.update');
        });

        Route::middleware('auth')->group(function () {

            Route::middleware('captcha')->group(function () {
                Route::post('/cabinet/pay', [\App\Http\Controllers\Cabinet\PayController::class, 'processing']);
            });

            Route::get('/cabinet/pay', [\App\Http\Controllers\Cabinet\PayController::class, 'index']);

            Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice');

            Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

            Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

            Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

            Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

            Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');

            Route::prefix('cabinet')->group(function () {

                Route::post('post/publication', [\App\Http\Controllers\Cabinet\PostController::class, 'publication']);

                Route::post('post/up', [\App\Http\Controllers\Cabinet\PostController::class, 'up']);

                Route::post('post/update-tarif', [\App\Http\Controllers\Cabinet\PostController::class, 'updateTarif']);

                Route::post('post/publication/all/stop', [\App\Http\Controllers\Cabinet\PostController::class, 'stop']);
                Route::post('post/publication/all', [\App\Http\Controllers\Cabinet\PostController::class, 'all']);

                Route::post('/message', \App\Http\Controllers\Cabinet\MessageController::class);

                Route::post('message/file', [\App\Http\Controllers\Cabinet\MessageController::class, 'file']);

                Route::resource('post', \App\Http\Controllers\Cabinet\PostController::class);

                Route::get('/', App\Http\Controllers\Cabinet\IndexController::class);
                Route::get('/claim', [App\Http\Controllers\Cabinet\ClaimController::class, 'index']);

            });

        });
    });

});
