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
use Illuminate\Support\Facades\DB;

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
            $today = now()->toDateString();
            $startOfMonth = now()->startOfMonth()->toDateString();
            $appointmentsChartStart = now()->subDays(13)->startOfDay();
            $revenueChartStart = now()->subMonths(11)->startOfMonth();

            $patientCount = User::where('role', 'patient')->count();
            $doctorCount = User::where('role', 'doctor')->count();
            $verificationCount = PatientVerification::count();
            $recentLogsCount = LogEntry::count();

            $appointmentsToday = Appointment::whereDate('appointment_datetime', $today)->count();

            $revenueToday = Transaction::whereDate('transaction_datetime', $today)
                ->where('payment_status', 'paid')
                ->sum('amount');

            $revenueThisMonth = Transaction::whereBetween('transaction_datetime', [$startOfMonth, now()])
                ->where('payment_status', 'paid')
                ->sum('amount');

            $userRoleCounts = User::selectRaw('role, COUNT(*) as users_count')
                ->groupBy('role')
                ->get()
                ->map(function ($row) {
                    return (object) [
                        'role_name' => $row->role,
                        'users_count' => $row->users_count,
                    ];
                });

            $recentUsers = User::withCount('children')->latest('user_id')->limit(10)->get();

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
                'appointmentsToday' => $appointmentsToday,
                'revenueToday' => $revenueToday,
                'revenueThisMonth' => $revenueThisMonth,
            ];

            $data['adminUserRoleCounts'] = $userRoleCounts;
            $data['adminRecentUsers'] = $recentUsers;
            $data['adminRecentPatients'] = $recentPatients;
            $data['adminRecentVerifications'] = $recentVerifications;
            $data['adminRecentTransactions'] = $recentTransactions;
            $data['adminRecentAuditLogs'] = $recentAuditLogs;

            $appointmentsCounts = Appointment::query()
                ->selectRaw('DATE(appointment_datetime) as day, COUNT(*) as total_count')
                ->whereNotNull('appointment_datetime')
                ->where('appointment_datetime', '>=', $appointmentsChartStart)
                ->groupBy(DB::raw('DATE(appointment_datetime)'))
                ->orderBy('day')
                ->get()
                ->keyBy('day');

            $appointmentLabels = [];
            $appointmentValues = [];
            for ($cursor = $appointmentsChartStart->copy(); $cursor->lte(now()); $cursor->addDay()) {
                $key = $cursor->toDateString();
                $appointmentLabels[] = $key;
                $appointmentValues[] = (int) (($appointmentsCounts[$key]->total_count ?? 0));
            }

            $revenueRows = Transaction::query()
                ->selectRaw("DATE_FORMAT(transaction_datetime, '%Y-%m') as month_key, SUM(amount) as total_amount")
                ->whereNotNull('transaction_datetime')
                ->where('transaction_datetime', '>=', $revenueChartStart)
                ->where('payment_status', 'paid')
                ->groupBy(DB::raw("DATE_FORMAT(transaction_datetime, '%Y-%m')"))
                ->orderBy('month_key')
                ->get()
                ->keyBy('month_key');

            $revenueLabels = [];
            $revenueValues = [];
            for ($cursor = $revenueChartStart->copy(); $cursor->lte(now()); $cursor->addMonth()) {
                $key = $cursor->format('Y-m');
                $revenueLabels[] = $key;
                $revenueValues[] = (float) (($revenueRows[$key]->total_amount ?? 0));
            }

            $data['adminCharts'] = [
                'appointmentsPerDay' => [
                    'labels' => $appointmentLabels,
                    'values' => $appointmentValues,
                ],
                'revenuePerMonth' => [
                    'labels' => $revenueLabels,
                    'values' => $revenueValues,
                ],
            ];

            $appointmentsByStatusToday = Appointment::selectRaw('status, COUNT(*) as total_count')
                ->whereDate('appointment_datetime', $today)
                ->groupBy('status')
                ->get();

            $noShowCount = Appointment::whereDate('appointment_datetime', $today)
                ->where('status', 'no_show')
                ->count();

            $data['adminReports'] = [
                'appointmentsByStatusToday' => $appointmentsByStatusToday,
                'noShowToday' => $noShowCount,
            ];
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
