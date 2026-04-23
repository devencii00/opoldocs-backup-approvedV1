<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\LogEntry;
use App\Models\PatientVerification;
use App\Models\Prescription;
use App\Models\Queue;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function show(Request $request, string $role = 'admin')
    {
        $role = strtolower($role);

        $allowed = ['admin', 'doctor', 'receptionist', 'patient'];

        if (! in_array($role, $allowed, true)) {
            abort(404);
        }

        $section = $request->query('section');
        $userId = $request->query('user_id');

        $currentUser = null;
        $doctorId = null;

        if ($userId && $role !== 'admin') {
            $currentUser = User::find($userId);
        }

        if ($role === 'doctor' && $currentUser) {
            $doctorId = $currentUser->user_id;
        }

        $data = [
            'role' => $role,
            'section' => $section,
        ];

        if ($role === 'admin') {
            $patientCount = User::where('role', 'patient')->count();
            $doctorCount = User::where('role', 'doctor')->count();
            $verificationCount = PatientVerification::count();
            $recentLogsCount = LogEntry::count();

            $userRoleCounts = User::selectRaw('role, COUNT(*) as users_count')
                ->groupBy('role')
                ->get()
                ->map(function ($row) {
                    return (object) [
                        'role_name' => $row->role,
                        'users_count' => $row->users_count,
                    ];
                });

            $recentUsers = User::latest('user_id')->limit(10)->get();

            $recentPatients = User::where('role', 'patient')
                ->latest('user_id')
                ->limit(10)
                ->get();

            $recentVerifications = PatientVerification::with('patient')
                ->latest('verification_id')
                ->limit(10)
                ->get();

            $recentTransactions = Transaction::latest('transaction_datetime')
                ->limit(10)
                ->get();

            $recentAuditLogs = LogEntry::with('user')
                ->latest('created_at')
                ->limit(10)
                ->get();

            $data['adminMetrics'] = [
                'patientCount' => $patientCount,
                'doctorCount' => $doctorCount,
                'pendingVerificationsCount' => $verificationCount,
                'recentLogsCount' => $recentLogsCount,
            ];

            $data['adminUserRoleCounts'] = $userRoleCounts;
            $data['adminRecentUsers'] = $recentUsers;
            $data['adminRecentPatients'] = $recentPatients;
            $data['adminRecentVerifications'] = $recentVerifications;
            $data['adminRecentTransactions'] = $recentTransactions;
            $data['adminRecentAuditLogs'] = $recentAuditLogs;
        } elseif ($role === 'doctor') {
            $today = now()->toDateString();

            $appointmentsToday = Appointment::whereDate('appointment_datetime', $today)
                ->when($doctorId, function ($q) use ($doctorId) {
                    $q->where('doctor_id', $doctorId);
                })
                ->count();

            $queueToday = Queue::whereDate('queue_datetime', $today)
                ->when($doctorId, function ($q) use ($doctorId) {
                    $q->whereHas('appointment', function ($sub) use ($doctorId) {
                        $sub->where('doctor_id', $doctorId);
                    });
                })
                ->count();

            $completedToday = Transaction::whereDate('visit_datetime', $today)
                ->when($doctorId, function ($q) use ($doctorId) {
                    $q->whereHas('prescriptions', function ($sub) use ($doctorId) {
                        $sub->where('doctor_id', $doctorId);
                    });
                })
                ->count();

            $recentAppointments = Appointment::with(['patient', 'doctor'])
                ->when($doctorId, function ($q) use ($doctorId) {
                    $q->where('doctor_id', $doctorId);
                })
                ->latest('appointment_datetime')
                ->limit(50)
                ->get();

            $recentVisits = Transaction::with(['appointment.patient'])
                ->when($doctorId, function ($q) use ($doctorId) {
                    $q->whereHas('prescriptions', function ($sub) use ($doctorId) {
                        $sub->where('doctor_id', $doctorId);
                    });
                })
                ->latest('visit_datetime')
                ->limit(50)
                ->get();

            $recentQueue = Queue::with(['appointment.patient', 'appointment.doctor'])
                ->when($doctorId, function ($q) use ($doctorId) {
                    $q->whereHas('appointment', function ($sub) use ($doctorId) {
                        $sub->where('doctor_id', $doctorId);
                    });
                })
                ->latest('queue_datetime')
                ->limit(50)
                ->get();

            $doctorPatients = collect();

            if ($doctorId) {
                $patientIds = Appointment::where('doctor_id', $doctorId)
                    ->distinct()
                    ->pluck('patient_id');

                $doctorPatients = User::where('role', 'patient')
                    ->whereIn('user_id', $patientIds)
                    ->latest('user_id')
                    ->limit(50)
                    ->get();
            }

            $recentPrescriptions = Prescription::with(['transaction.appointment.patient', 'doctor', 'items'])
                ->when($doctorId, function ($q) use ($doctorId) {
                    $q->where('doctor_id', $doctorId);
                })
                ->latest('prescribed_datetime')
                ->limit(50)
                ->get();

            $appointmentsCountQuery = Appointment::query();
            $visitsCountQuery = Transaction::query();
            $prescriptionsCountQuery = Prescription::query();
            $queueCountQuery = Queue::query();

            if ($doctorId) {
                $appointmentsCountQuery->where('doctor_id', $doctorId);
                $visitsCountQuery->whereHas('prescriptions', function ($q) use ($doctorId) {
                    $q->where('doctor_id', $doctorId);
                });
                $prescriptionsCountQuery->where('doctor_id', $doctorId);
                $queueCountQuery->whereHas('appointment', function ($q) use ($doctorId) {
                    $q->where('doctor_id', $doctorId);
                });
            }

            $activitySummary = [
                'totalAppointments' => $appointmentsCountQuery->count(),
                'totalVisits' => $visitsCountQuery->count(),
                'totalPrescriptions' => $prescriptionsCountQuery->count(),
                'totalQueueEntries' => $queueCountQuery->count(),
            ];

            $data['doctorMetrics'] = [
                'appointmentsToday' => $appointmentsToday,
                'queueToday' => $queueToday,
                'completedToday' => $completedToday,
            ];

            $data['doctorRecentAppointments'] = $recentAppointments;
            $data['doctorRecentVisits'] = $recentVisits;
            $data['doctorRecentQueue'] = $recentQueue;
            $data['doctorPatients'] = $doctorPatients;
            $data['doctorRecentPrescriptions'] = $recentPrescriptions;
            $data['doctorActivitySummary'] = $activitySummary;
        } elseif ($role === 'receptionist') {
            $today = now()->toDateString();

            $newRegistrationsToday = User::where('role', 'patient')
                ->whereDate('created_at', $today)
                ->count();

            $appointmentsToday = Appointment::whereDate('appointment_datetime', $today)->count();

            $waitingCount = Queue::whereDate('queue_datetime', $today)
                ->where('status', 'waiting')
                ->count();

            $receptionQueue = Queue::with(['appointment.patient', 'appointment.doctor'])
                ->whereDate('queue_datetime', $today)
                ->orderBy('queue_number')
                ->get();

            $receptionAppointments = Appointment::with(['patient', 'doctor'])
                ->whereDate('appointment_datetime', $today)
                ->orderBy('appointment_datetime')
                ->get();

            $data['receptionMetrics'] = [
                'newRegistrationsToday' => $newRegistrationsToday,
                'appointmentsToday' => $appointmentsToday,
                'waitingCount' => $waitingCount,
            ];

            $data['receptionQueue'] = $receptionQueue;
            $data['receptionAppointments'] = $receptionAppointments;
        } elseif ($role === 'patient') {
            $data['patientDashboard'] = true;
        }

        return view('dashviews.main', $data);
    }
}
