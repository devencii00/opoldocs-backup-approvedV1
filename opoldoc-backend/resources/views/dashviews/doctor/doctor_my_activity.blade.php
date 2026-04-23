@php
    $activity = $doctorActivitySummary ?? [];
    $totalAppointments = (int) ($activity['totalAppointments'] ?? 0);
    $totalVisits = (int) ($activity['totalVisits'] ?? 0);
    $totalPrescriptions = (int) ($activity['totalPrescriptions'] ?? 0);
    $totalQueueEntries = (int) ($activity['totalQueueEntries'] ?? 0);
@endphp

<div class="space-y-5">
    <div class="grid gap-4 grid-cols-1 sm:grid-cols-2 lg:grid-cols-4">
        <div class="bg-white border border-slate-200 rounded-[18px] p-4 shadow-[0_2px_10px_rgba(15,23,42,0.04)]">
            <div class="text-[0.7rem] text-slate-500 mb-1">Appointments (all time)</div>
            <div class="font-serif font-bold text-[1.5rem] text-slate-900">
                {{ number_format($totalAppointments) }}
            </div>
        </div>
        <div class="bg-white border border-slate-200 rounded-[18px] p-4 shadow-[0_2px_10px_rgba(15,23,42,0.04)]">
            <div class="text-[0.7rem] text-slate-500 mb-1">Visits (all time)</div>
            <div class="font-serif font-bold text-[1.5rem] text-slate-900">
                {{ number_format($totalVisits) }}
            </div>
        </div>
        <div class="bg-white border border-slate-200 rounded-[18px] p-4 shadow-[0_2px_10px_rgba(15,23,42,0.04)]">
            <div class="text-[0.7rem] text-slate-500 mb-1">Prescriptions (all time)</div>
            <div class="font-serif font-bold text-[1.5rem] text-slate-900">
                {{ number_format($totalPrescriptions) }}
            </div>
        </div>
        <div class="bg-white border border-slate-200 rounded-[18px] p-4 shadow-[0_2px_10px_rgba(15,23,42,0.04)]">
            <div class="text-[0.7rem] text-slate-500 mb-1">Queue entries (all time)</div>
            <div class="font-serif font-bold text-[1.5rem] text-slate-900">
                {{ number_format($totalQueueEntries) }}
            </div>
        </div>
    </div>

    <div class="bg-white border border-slate-200 rounded-[18px] p-5 shadow-[0_2px_10px_rgba(15,23,42,0.04)]">
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-sm font-semibold text-slate-900">Recent clinical activity</h2>
            <span class="text-[0.7rem] text-slate-400 uppercase tracking-widest">Overview</span>
        </div>
        <p class="text-xs text-slate-500 mb-3">
            High-level list of recent appointments, visits, queue entries, and prescriptions based on the latest data.
        </p>

        <div class="grid gap-3 grid-cols-1 lg:grid-cols-3">
            <div class="border border-slate-100 rounded-xl p-3.5 bg-slate-50">
                <div class="text-[0.7rem] font-semibold text-slate-700 mb-1">Recent appointments</div>
                <div class="max-h-52 overflow-y-auto scrollbar-hidden">
                    @if (count($doctorRecentAppointments ?? []))
                        <ul class="space-y-2 text-xs text-slate-600">
                            @foreach (($doctorRecentAppointments ?? []) as $appointment)
                                <li class="flex items-start justify-between gap-2">
                                    <div>
                                        <div class="font-semibold text-slate-900 text-[0.8rem]">
                                            {{ optional(optional($appointment->patient)->personalInformation)->full_name ?? 'Patient #' . $appointment->patient_id }}
                                        </div>
                                        <div class="text-[0.7rem] text-slate-500">
                                            {{ \Illuminate\Support\Str::limit($appointment->reason_for_visit ?? 'No reason specified', 60) }}
                                        </div>
                                    </div>
                                    <div class="text-[0.7rem] text-slate-400 text-right whitespace-nowrap">
                                        <div>{{ $appointment->appointment_date }}</div>
                                        <div>{{ $appointment->appointment_time }}</div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-[0.72rem] text-slate-400">No appointments yet.</p>
                    @endif
                </div>
            </div>

            <div class="border border-slate-100 rounded-xl p-3.5 bg-slate-50">
                <div class="text-[0.7rem] font-semibold text-slate-700 mb-1">Recent visits</div>
                <div class="max-h-52 overflow-y-auto scrollbar-hidden">
                    @if (count($doctorRecentVisits ?? []))
                        <ul class="space-y-2 text-xs text-slate-600">
                            @foreach (($doctorRecentVisits ?? []) as $visit)
                                <li class="flex items-start justify-between gap-2">
                                    <div>
                                        <div class="font-semibold text-slate-900 text-[0.8rem]">
                                            {{ optional(optional($visit->patient)->personalInformation)->full_name ?? 'Patient #' . $visit->patient_id }}
                                        </div>
                                        <div class="text-[0.7rem] text-slate-500">
                                            {{ \Illuminate\Support\Str::limit($visit->diagnosis ?? $visit->reason_for_visit ?? 'No details yet', 60) }}
                                        </div>
                                    </div>
                                    <div class="text-[0.7rem] text-slate-400 whitespace-nowrap">
                                        {{ optional($visit->visit_date)->format('Y-m-d') ?? $visit->visit_date }}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-[0.72rem] text-slate-400">No visits yet.</p>
                    @endif
                </div>
            </div>

            <div class="border border-slate-100 rounded-xl p-3.5 bg-slate-50">
                <div class="text-[0.7rem] font-semibold text-slate-700 mb-1">Recent prescriptions</div>
                <div class="max-h-52 overflow-y-auto scrollbar-hidden">
                    @if (count($doctorRecentPrescriptions ?? []))
                        <ul class="space-y-2 text-xs text-slate-600">
                            @foreach (($doctorRecentPrescriptions ?? []) as $prescription)
                                @php
                                    $patientName = optional(optional(optional($prescription->visit)->patient)->personalInformation)->full_name ?? '';
                                    $dateKey = optional($prescription->prescribed_date)->format('Y-m-d') ?? $prescription->prescribed_date ?? '';
                                @endphp
                                <li class="flex items-start justify-between gap-2">
                                    <div>
                                        <div class="font-semibold text-slate-900 text-[0.8rem]">
                                            {{ $patientName ?: 'Patient' }}
                                        </div>
                                        <div class="text-[0.7rem] text-slate-500">
                                            {{ \Illuminate\Support\Str::limit($prescription->notes ?? 'No notes', 60) }}
                                        </div>
                                    </div>
                                    <div class="text-[0.7rem] text-slate-400 whitespace-nowrap">
                                        {{ $dateKey }}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-[0.72rem] text-slate-400">No prescriptions yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

