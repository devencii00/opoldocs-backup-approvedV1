<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\MedicalBackgroundController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PatientVerificationController;
use App\Http\Controllers\WalkInController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PersonalInformationController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/password/forgot', [AuthController::class, 'requestPasswordReset']);
Route::post('/password/reset', [AuthController::class, 'resetPassword']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (\Illuminate\Http\Request $request) {
        return $request->user();
    });

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/users/invite', [UserController::class, 'invite']);
    Route::get('/users/{user}/dependents', [UserController::class, 'dependents']);
    Route::apiResource('users', UserController::class);
    Route::apiResource('patients', PatientController::class);
    Route::apiResource('doctors', DoctorController::class);
    Route::apiResource('appointments', AppointmentController::class);
    Route::apiResource('visits', VisitController::class);
    Route::apiResource('prescriptions', PrescriptionController::class);
    Route::apiResource('medicines', MedicineController::class);
    Route::apiResource('queues', QueueController::class);
    Route::apiResource('transactions', TransactionController::class);
    Route::apiResource('walk-ins', WalkInController::class)->only(['index', 'show', 'store']);
    Route::apiResource('personal-information', PersonalInformationController::class)->only(['index', 'show', 'store', 'update']);
    Route::apiResource('patient-verifications', PatientVerificationController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
    Route::apiResource('services', \App\Http\Controllers\ServiceController::class);
    Route::apiResource('prescription-items', \App\Http\Controllers\PrescriptionItemController::class);
    Route::apiResource('medical-backgrounds', MedicalBackgroundController::class);

    Route::get('/notifications', [NotificationController::class, 'index']);
    Route::patch('/notifications/{notification}', [NotificationController::class, 'update']);
    Route::delete('/notifications/{notification}', [NotificationController::class, 'destroy']);

    Route::get('/chatbot/questions', [\App\Http\Controllers\ChatbotController::class, 'questions']);
    Route::get('/chatbot/questions/{chatbotQuestion}', [\App\Http\Controllers\ChatbotController::class, 'question']);
    Route::get('/chatbot/options/{chatbotOption}', [\App\Http\Controllers\ChatbotController::class, 'option']);
});
