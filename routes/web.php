<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\EmailTemplateController;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::resource('email-templates', EmailTemplateController::class);
    Route::get('/email-templates', [EmailTemplateController::class,'index'])->name("email-templates.index");
    Route::get('/email-templates/create', [EmailTemplateController::class, 'create'])
    ->name('email-templates.create');
    Route::post('/email-templates', [EmailTemplateController::class, 'store'])
    ->name('email-templates.store');
    Route::get('email-templates-trashbin', [EmailTemplateController::class, 'trash'])
    ->name('email-templates.trash');
    Route::post('email-templates/{id}/restore', [EmailTemplateController::class, 'restoretemplate'])
        ->name('email-templates.restoretemplate');
    Route::delete('email-templates/{id}/force-delete', [EmailTemplateController::class, 'forceDelete'])
        ->name('email-templates.force-delete');
});
