<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\GutenbergController;

Route::get('/', [BlogController::class, 'welcome'])->name('home');
Route::get('/welcome', [BlogController::class, 'welcome'])->name('welcome');
Route::get('/skills-audit', [BlogController::class, 'skillsAudit'])->name('skills.audit');
Route::get('/spektralsatz', [BlogController::class, 'spektralsatz'])->name('spektralsatz');
Route::get('/job-opening', [BlogController::class, 'jobOpening'])->name('job.opening');

Route::get('/projects', [BlogController::class, 'projects'])->name('projects');
Route::get('/raw/{slug}', [BlogController::class, 'raw'])->name('raw');

Route::get('/api/search', [SearchController::class, 'apiSearch'])->name('api.search');

Route::get('/gutenberg', [GutenbergController::class, 'index'])->name('gutenberg');
Route::get('/gutenberg/fetch', [GutenbergController::class, 'fetchBook'])->name('gutenberg.fetch');
