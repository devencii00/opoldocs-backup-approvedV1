@php
    $metrics = $doctorMetrics ?? [];
    $appointmentsToday = (int) ($metrics['appointmentsToday'] ?? 0);
    $queueToday = (int) ($metrics['queueToday'] ?? 0);
    $completedToday = (int) ($metrics['completedToday'] ?? 0);
    $recentAppointments = $doctorRecentAppointments ?? [];
    $recentVisits = $doctorRecentVisits ?? [];
    $recentQueue = $doctorRecentQueue ?? [];

    $sectionKey = $section ?? 'overview';

    $sectionTitles = [
        'my-patients' => 'My patients',
        'appointments' => 'Appointments',
        'queue' => 'Queue',
        'visits' => 'Visits',
        'prescriptions' => 'Prescriptions',
        'my-activity' => 'My activity',
    ];

    $sectionSubtitles = [
        'my-patients' => 'Patients you are actively seeing or have seen recently.',
        'appointments' => 'Review upcoming and recent appointments.',
        'queue' => 'See today’s queue and recent queue entries.',
        'visits' => 'Browse recent visits for clinical context.',
        'prescriptions' => 'Review prescriptions you have issued.',
        'my-activity' => 'High-level view of your recent clinical activity.',
    ];
@endphp

<div class="space-y-6">
    @if ($sectionKey === 'overview')
        <div>
            <h1 class="text-2xl font-semibold text-slate-900 mb-1">Doctor workspace</h1>
            <p class="text-sm text-slate-500">Focus on consultations, diagnoses, and prescriptions for your assigned patients.</p>
        </div>

        <div class="grid gap-4 grid-cols-1 lg:grid-cols-3">
            <div class="bg-white border border-slate-200 rounded-[18px] p-5 lg:col-span-2 shadow-[0_2px_10px_rgba(15,23,42,0.04)]">
                <div class="flex items-center justify-between mb-3">
                    <h2 class="text-sm font-semibold text-slate-900">Today&apos;s schedule</h2>
                    <span class="text-[0.7rem] text-slate-400 uppercase tracking-widest">Consultations</span>
                </div>
                <div class="grid gap-3 grid-cols-1 sm:grid-cols-3 text-sm text-slate-600">
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                        <div class="text-xs text-slate-500 mb-1">Appointments</div>
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
                <h2 class="text-sm font-semibold text-slate-900 mb-3">Queue</h2>
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
    @else
        @php
            $title = $sectionTitles[$sectionKey] ?? 'Doctor workspace';
            $subtitle = $sectionSubtitles[$sectionKey] ?? 'Clinical workspace';
        @endphp

        <div>
            <h1 class="text-2xl font-semibold text-slate-900 mb-1">{{ $title }}</h1>
            <p class="text-sm text-slate-500">{{ $subtitle }}</p>
        </div>

        @if ($sectionKey === 'my-patients')
            @include('dashviews.doctor.doctor_my_patients')
        @elseif ($sectionKey === 'appointments')
            @include('dashviews.doctor.doctor_appointments')
        @elseif ($sectionKey === 'queue')
            @include('dashviews.doctor.doctor_queue')
        @elseif ($sectionKey === 'visits')
            @include('dashviews.doctor.doctor_visits')
        @elseif ($sectionKey === 'prescriptions')
            @include('dashviews.doctor.doctor_prescriptions')
        @elseif ($sectionKey === 'my-activity')
            @include('dashviews.doctor.doctor_my_activity')
        @endif
    @endif
</div>
