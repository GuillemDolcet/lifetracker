<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TranslationController;
use Illuminate\Support\Facades\Route;

Route::post('/session/locale/{language}', [SessionController::class, 'locale'])->name('session.locale');
Route::post('/session/mode/{mode}', [SessionController::class, 'mode'])->name('session.mode');
Route::get('/translations/{translation}', [TranslationController::class, 'get'])->name('translations.get');

Route::prefix('auth')->group(static function (): void {
    Route::middleware('guest')->group(static function (): void {
        Route::get('login', [SessionController::class, 'create'])->name('login');
        Route::get('forgot-password', [PasswordController::class, 'create'])->name('password.request');
        Route::post('forgot-password', [PasswordController::class, 'email'])->name('password.email');
        Route::get('reset-password/{token}', [PasswordController::class, 'resetPassword'])->name('password.reset');
        Route::post('reset-password', [PasswordController::class, 'update'])->name('password.update');
        Route::post('login', [SessionController::class, 'authenticate'])->name('authenticate');
        Route::get('socials/{social}', [SocialController::class, 'redirect'])->name('socials.redirect');
        Route::get('socials/{social}/callback', [SocialController::class, 'callback'])->name('socials.callback');
    });
    Route::middleware('auth')->group(static function (): void {
        Route::delete('logout', [SessionController::class, 'destroy'])->name('logout');
    });
});

Route::middleware('auth')->group(static function (): void {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    //Events
    Route::get('/calendar', [EventsController::class, 'index'])->name('events.index');
    Route::post('/events', [EventsController::class, 'store'])->name('events.store');
    Route::get('/events', [EventsController::class, 'get'])->name('events.get');
    Route::get('/events/create', [EventsController::class, 'create'])->name('events.create');
    Route::get('/events/{event}/edit', [EventsController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [EventsController::class, 'update'])->name('events.update');
    Route::delete('/events/{event}', [EventsController::class, 'destroy'])->name('events.destroy');
});
