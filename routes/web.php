<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Livewire\Admin\Users\ListUsers;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/dashboard', DashboardController::class)->name('admin.dashboard');

Route::get('admin/users', ListUsers::class)->name('admin.users');
