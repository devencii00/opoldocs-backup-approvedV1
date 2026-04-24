@php
    $metrics = $doctorMetrics ?? [];
    $appointmentsToday = (int) ($metrics['appointmentsToday'] ?? 0);
    $queueToday = (int) ($metrics['queueToday'] ?? 0);
    $completedToday = (int) ($metrics['completedToday'] ?? 0);
    $recentAppointments = $doctorRecentAppointments ?? [];
    $recentVisits = $doctorRecentVisits ?? [];
    $recentQueue = $doctorRecentQueue ?? [];

    $sectionKey = $section ?? 'overview';

    $effectiveSectionKey = $sectionKey;

    if ($effectiveSectionKey === 'my-schedule') {
        $effectiveSectionKey = 'appointments';
    } elseif ($effectiveSectionKey === 'history') {
        $effectiveSectionKey = 'visits';
    }

    $sectionTitles = [
        'my-patients' => 'My patients',
        'appointments' => 'My Schedule',
        'queue' => 'Queue',
        'visits' => 'History',
        'history' => 'History',
        'prescriptions' => 'Prescription',
        'my-activity' => 'My activity',
        'consultation' => 'Consultation',
        'settings-doctor' => 'Settings',
    ];

    $sectionSubtitles = [
        'my-patients' => 'Patients you are actively seeing or have seen recently.',
        'appointments' => 'Review upcoming and recent appointments.',
        'queue' => 'See today’s queue and recent queue entries.',
        'visits' => 'View past patient visits and records.',
        'history' => 'View past patient visits and records.',
        'prescriptions' => 'Review prescriptions you have issued.',
        'my-activity' => 'High-level view of your recent clinical activity.',
        'consultation' => 'Consult with a selected patient and record notes.',
        'settings-doctor' => 'Update your profile, password, and signature.',
    ];
@endphp

<div class="space-y-6">
    @if ($sectionKey === 'overview')
        <div>
            <h1 class="text-2xl font-semibold text-slate-900 mb-1">Doctor Dashboard</h1>
            <p class="text-sm text-slate-500">Today’s appointments, queue list, and notifications for your clinic day.</p>
        </div>

    <div class="grid gap-4 grid-cols-1 lg:grid-cols-3">
            <div class="bg-white border border-slate-200 rounded-[18px] p-5 lg:col-span-2 shadow-[0_2px_10px_rgba(15,23,42,0.04)]">
                <div class="flex items-center justify-between mb-3">
                    <h2 class="text-sm font-semibold text-slate-900">Today&apos;s schedule</h2>
                    <span class="text-[0.7rem] text-slate-400 uppercase tracking-widest">Consultations</span>
                </div>
                <div class="grid gap-3 grid-cols-1 sm:grid-cols-3 text-sm text-slate-600">
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                        <div class="text-xs text-slate-500 mb-1">Today’s appointments</div>
                        <div class="font-serif font-bold text-xl text-slate-900">{{ number_format($appointmentsToday) }}</div>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                        <div class="text-xs text-slate-500 mb-1">In queue</div>
                        <div class="font-serif font-bold text-xl text-slate-900">{{ number_format($queueToday) }}</div>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                        <div class="text-xs text-slate-500 mb-1">Completed today</div>
                        <div class="font-serif font-bold text-xl text-slate-900">{{ number_format($completedToday) }}</div>
                    </div>
                </div>

                <div class="mt-5 grid gap-3 grid-cols-1 md:grid-cols-2">
                    <div class="p-3.5 rounded-xl border border-slate-100 bg-slate-50">
                        <div class="text-xs font-semibold text-slate-700 mb-1">Recent visits</div>
                        <div class="max-h-52 overflow-y-auto scrollbar-hidden">
                            @if (count($recentVisits))
                                <ul class="space-y-2 text-xs text-slate-600">
                                    @foreach ($recentVisits as $visit)
                                        <li class="flex items-start justify-between gap-2">
                                            <div>
                                                <div class="font-semibold text-slate-900 text-[0.8rem]">
                                                    {{ optional(optional($visit->patient)->personalInformation)->full_name ?? 'Patient #' . $visit->patient_id }}
                                                </div>
                                                <div class="text-[0.7rem] text-slate-500">
                                                    {{ \Illuminate\Support\Str::limit($visit->reason_for_visit ?? 'No reason specified', 60) }}
                                                </div>
                                            </div>
                                            <div class="text-[0.7rem] text-slate-400 whitespace-nowrap">
                                                {{ optional($visit->visit_date)->format('Y-m-d') ?? $visit->visit_date }}
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-[0.72rem] text-slate-400">No recent visits yet.</p>
                            @endif
                        </div>
                    </div>
                    <div class="p-3.5 rounded-xl border border-slate-100 bg-slate-50">
                        <div class="text-xs font-semibold text-slate-700 mb-1">Upcoming appointments</div>
                        <div class="max-h-52 overflow-y-auto scrollbar-hidden">
                            @if (count($recentAppointments))
                                <ul class="space-y-2 text-xs text-slate-600">
                                    @foreach ($recentAppointments as $appointment)
                                        <li class="flex items-start justify-between gap-2">
                                            <div>
                                                <div class="font-semibold text-slate-900 text-[0.8rem]">
                                                    {{ optional(optional($appointment->patient)->personalInformation)->full_name ?? 'Patient #' . $appointment->patient_id }}
                                                </div>
                                                <div class="text-[0.7rem] text-slate-500">
                                                    {{ \Illuminate\Support\Str::limit($appointment->reason_for_visit ?? 'No reason specified', 60) }}
                                                </div>
                                            </div>
                                            <div class="text-[0.7rem] text-slate-400 text-right">
                                                <div>{{ $appointment->appointment_date }}</div>
                                                <div>{{ $appointment->appointment_time }}</div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-[0.72rem] text-slate-400">No appointments found.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-slate-200 rounded-[18px] p-5 shadow-[0_2px_10px_rgba(15,23,42,0.04)]">
                <h2 class="text-sm font-semibold text-slate-900 mb-3">Queue list</h2>
                <div class="max-h-80 overflow-y-auto scrollbar-hidden">
                    @if (count($recentQueue))
                        <ul class="space-y-2 text-xs text-slate-600">
                            @foreach ($recentQueue as $queue)
                                <li class="flex items-start justify-between gap-2 border-b border-slate-50 pb-2 last:border-0 last:pb-0">
                                    <div>
                                        <div class="font-semibold text-slate-900 text-[0.8rem]">
                                            Queue #{{ $queue->queue_number }}
                                        </div>
                                        <div class="text-[0.7rem] text-slate-500">
                                            {{ optional(optional(optional($queue->source)->appointment)->patient)->personalInformation->full_name ?? 'Patient' }}
                                        </div>
                                    </div>
                                    <div class="text-right text-[0.7rem] text-slate-400 whitespace-nowrap">
                                        <div>{{ $queue->queue_date }}</div>
                                        <div>{{ optional($queue->status)->status_name ?? '' }}</div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-[0.72rem] text-slate-400">No queue entries yet.</p>
                    @endif
                </div>
            </div>
        </div>

        @php
            $todayDate = now()->toDateString();
            $notifications = collect($recentAppointments)->filter(function ($appointment) use ($todayDate) {
                $dt = $appointment->appointment_datetime ?? null;
                if ($dt instanceof \Carbon\Carbon) {
                    return $dt->toDateString() === $todayDate;
                }

                return (string) ($appointment->appointment_date ?? '') === $todayDate;
            })->take(5);
        @endphp

        <div class="grid gap-4 grid-cols-1 lg:grid-cols-3">
            <div class="lg:col-span-2"></div>
            <div class="bg-white border border-slate-200 rounded-[18px] p-5 shadow-[0_2px_10px_rgba(15,23,42,0.04)]">
                <div class="flex items-center justify-between mb-3">
                    <h2 class="text-sm font-semibold text-slate-900">Notifications</h2>
                    <span class="text-[0.7rem] text-slate-400 uppercase tracking-widest">Today</span>
                </div>
                <p class="text-xs text-slate-500 mb-3">
                    Quick view of today’s upcoming appointments for your patients.
                </p>
                <div class="max-h-64 overflow-y-auto scrollbar-hidden">
                    @if ($notifications->count())
                        <ul class="space-y-2 text-xs text-slate-600">
                            @foreach ($notifications as $appointment)
                                @php
                                    $patientName = optional(optional($appointment->patient)->personalInformation)->full_name ?? 'Patient #' . $appointment->patient_id;
                                    $time = $appointment->appointment_time ?? optional($appointment->appointment_datetime)->format('H:i');
                                @endphp
                                <li class="flex items-start justify-between gap-2 rounded-xl border border-slate-100 bg-slate-50 px-3 py-2">
                                    <div>
                                        <div class="font-semibold text-slate-900 text-[0.8rem]">
                                            {{ $patientName }}
                                        </div>
                                        <div class="text-[0.7rem] text-slate-500">
                                            {{ \Illuminate\Support\Str::limit($appointment->reason_for_visit ?? 'No reason specified', 60) }}
                                        </div>
                                    </div>
                                    <div class="text-[0.7rem] text-slate-400 text-right whitespace-nowrap">
                                        <div>Today</div>
                                        <div>{{ $time }}</div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-[0.72rem] text-slate-400">No notifications for today.</p>
                    @endif
                </div>
            </div>
        </div>
    @else
        @php
            $title = $sectionTitles[$effectiveSectionKey] ?? 'Doctor workspace';
            $subtitle = $sectionSubtitles[$effectiveSectionKey] ?? 'Clinical workspace';
        @endphp

        <div>
            <h1 class="text-2xl font-semibold text-slate-900 mb-1">{{ $title }}</h1>
            <p class="text-sm text-slate-500">{{ $subtitle }}</p>
        </div>

        @if ($effectiveSectionKey === 'my-patients')
            @include('dashviews.doctor.doctor_my_patients')
        @elseif ($effectiveSectionKey === 'appointments')
            @include('dashviews.doctor.doctor_appointments')
        @elseif ($effectiveSectionKey === 'queue')
            @include('dashviews.doctor.doctor_queue')
        @elseif ($effectiveSectionKey === 'visits')
            @include('dashviews.doctor.doctor_visits')
        @elseif ($effectiveSectionKey === 'prescriptions')
            @include('dashviews.doctor.doctor_prescriptions')
        @elseif ($effectiveSectionKey === 'my-activity')
            @include('dashviews.doctor.doctor_my_activity')
        @elseif ($effectiveSectionKey === 'consultation')
            @include('dashviews.doctor.doctor_consultation')
        @elseif ($effectiveSectionKey === 'settings-doctor')
            @include('dashviews.doctor.doctor_settings')
        @endif
    @endif
</div>
