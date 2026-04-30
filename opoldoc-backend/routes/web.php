<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\QueueDisplayController;
use App\Http\Controllers\PrescriptionReceiptController;
use App\Http\Controllers\UserController;
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

Route::get('/queue-display', [QueueDisplayController::class, 'page'])->name('queue.display');
Route::get('/queue-display/data', [QueueDisplayController::class, 'data'])->name('queue.display.data');

Route::get('/print/prescriptions/{prescriptionId}', [PrescriptionReceiptController::class, 'show'])->name('print.prescription');

Route::get('/signatures/{user}', [UserController::class, 'signature'])->name('public.signature');
