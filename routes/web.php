<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\GuestVacancyController;
use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
});

Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/dashboard', function () {
    if(auth()->user()->is_admin) {
        return redirect()->route('admin.vacancies.index');
    }
    return redirect()->route('vacancies.index');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Guest / Applicant Routes
    Route::get('/vacancies', [GuestVacancyController::class, 'index'])->name('vacancies.index');
    Route::get('/vacancies/{vacancy}', [GuestVacancyController::class, 'show'])->name('vacancies.show');
    Route::get('/vacancies/{vacancy}/apply', [ApplicationController::class, 'create'])->name('vacancies.apply');
    Route::post('/vacancies/{vacancy}/apply', [ApplicationController::class, 'store'])->name('applications.store');

    // Admin Routes
    Route::middleware(\App\Http\Middleware\IsAdmin::class)->prefix('admin')->name('admin.')->group(function () {
        Route::resource('vacancies', VacancyController::class);
        Route::get('applications', [ApplicationController::class, 'index'])->name('applications.index');
        Route::patch('applications/{application}/approve', [ApplicationController::class, 'approve'])->name('applications.approve');
        Route::patch('applications/{application}/reject', [ApplicationController::class, 'reject'])->name('applications.reject');
        Route::get('reports', [ApplicationController::class, 'reports'])->name('reports.index');
    });
});
