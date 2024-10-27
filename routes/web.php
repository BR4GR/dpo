<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\BlogController::class, 'welcome'])->name('home');


Route::get('/skills-audit', [App\Http\Controllers\BlogController::class, 'skillsAudit'])->name('skills.audit');
