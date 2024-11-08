<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\SearchController;

Route::get('/', [BlogController::class, 'welcome'])->name('home');
Route::get('/welcome', [BlogController::class, 'welcome'])->name('home');

Route::get('/skills-audit', [BlogController::class, 'skillsAudit'])->name('skills.audit');
Route::get('/spektralsatz', [BlogController::class, 'spektralsatz'])->name('spektralsatz');

Route::get('/search', [SearchController::class, 'search'])->name('search');
