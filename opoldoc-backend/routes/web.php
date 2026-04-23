<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landings.webadmin-login');
});

Route::get('/webadmin-login', function () {
    return view('landings.webadmin-login');
})->name('webadmin.login');

Route::get('/first-login', function () {
    return view('landings.first-login');
})->name('first.login');

Route::get('/staff-first-login', function () {
    return view('landings.staff-first-login');
})->name('staff.first.login');

Route::get('/forgot-password', function () {
    return view('landings.forgot-password');
})->name('password.forgot');

Route::get('/create-account', function () {
    return view('landings.create-account');
})->name('create.account');

Route::get('/dashboard/{role?}', [DashboardController::class, 'show'])->name('dashboard');
