<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirect '/' to activities (will be protected below)
Route::get('/', function () {
    return redirect()->route('activities.index');
});

// Dashboard route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// ✅ Protected routes — only accessible if authenticated
Route::middleware(['auth'])->group(function () {

    // ✅ Activity Management
    Route::resource('activities', ActivityController::class)->except(['show']);

    // ✅ Activity Logs
    Route::post('/activities/{activity}/log', [ActivityLogController::class, 'store'])->name('activity_logs.store');

    // ✅ User Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ✅ Reports
    Route::get('/reports/daily', [ReportController::class, 'dailyOverview'])->name('reports.daily');
    Route::get('/reports/range', [ReportController::class, 'rangeForm'])->name('reports.range.form');
    Route::post('/reports/range', [ReportController::class, 'rangeReport'])->name('reports.range.submit');
    Route::get('/reports/export/pdf', [ReportController::class, 'exportPdf'])->name('reports.export.pdf');
    Route::get('/reports/export/excel', [ReportController::class, 'exportExcel'])->name('reports.export.excel');
});

// ✅ Laravel Breeze Authentication Routes
require __DIR__.'/auth.php';
