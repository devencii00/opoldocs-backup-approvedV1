@php
    $metrics = $receptionMetrics ?? [];
    $sectionKey = $section ?? 'overview';

    $newRegistrationsToday = (int) ($metrics['newRegistrationsToday'] ?? 0);
    $appointmentsToday = (int) ($metrics['appointmentsToday'] ?? 0);
    $waitingInQueue = (int) ($metrics['waitingCount'] ?? 0);
@endphp

<div class="space-y-6">
    @if ($sectionKey === 'overview')
        <div>
            <h1 class="text-2xl font-semibold text-slate-900 mb-1">Receptionist workspace</h1>
            <p class="text-sm text-slate-500">Handle registrations, appointments, and the live queue at the front desk.</p>
        </div>

        <div class="grid gap-4 grid-cols-1 lg:grid-cols-3">
            <div class="bg-white border border-slate-200 rounded-[18px] p-5 lg:col-span-2 shadow-[0_2px_10px_rgba(15,23,42,0.04)]">
                <div class="flex items-center justify-between mb-3">
                    <h2 class="text-sm font-semibold text-slate-900">Today at a glance</h2>
                    <span class="text-[0.7rem] text-slate-400 uppercase tracking-widest">Front desk</span>
                </div>
                <div class="grid gap-3 grid-cols-1 sm:grid-cols-3 text-sm text-slate-600">
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                        <div class="text-xs text-slate-500 mb-1">New registrations</div>
                        <div class="font-serif font-bold text-xl text-slate-900">{{ number_format($newRegistrationsToday) }}</div>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                        <div class="text-xs text-slate-500 mb-1">Appointments booked</div>
                        <div class="font-serif font-bold text-xl text-slate-900">{{ number_format($appointmentsToday) }}</div>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                        <div class="text-xs text-slate-500 mb-1">Waiting in queue</div>
                        <div class="font-serif font-bold text-xl text-slate-900">{{ number_format($waitingInQueue) }}</div>
                    </div>
                </div>

                <div class="mt-5 grid gap-3 grid-cols-1 md:grid-cols-2">
                    <div class="p-3.5 rounded-xl border border-slate-100 bg-slate-50">
                        <div class="text-xs font-semibold text-slate-700 mb-1">Upcoming appointments</div>
                        <p class="text-xs text-slate-500">Quick overview of who is scheduled next, by doctor and time slot.</p>
                    </div>
                    <div class="p-3.5 rounded-xl border border-slate-100 bg-slate-50">
                        <div class="text-xs font-semibold text-slate-700 mb-1">Queue status</div>
                        <p class="text-xs text-slate-500">Track who is waiting, being prepared, or already in consultation.</p>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-slate-200 rounded-[18px] p-5 shadow-[0_2px_10px_rgba(15,23,42,0.04)]">
                <h2 class="text-sm font-semibold text-slate-900 mb-3">Quick actions</h2>
                <div class="space-y-2">
                    <a href="{{ route('dashboard', ['role' => 'receptionist', 'section' => 'register-patient']) }}" class="block w-full px-3 py-2.5 rounded-xl bg-slate-50 text-slate-800 text-[0.85rem] font-semibold hover:bg-slate-100 border border-slate-200 transition-colors">
                        Register new patient
                    </a>
                    <a href="{{ route('dashboard', ['role' => 'receptionist', 'section' => 'book-appointment']) }}" class="block w-full px-3 py-2.5 rounded-xl bg-slate-50 text-slate-800 text-[0.85rem] font-semibold hover:bg-slate-100 border border-slate-200 transition-colors">
                        Book appointment
                    </a>
                    <a href="{{ route('dashboard', ['role' => 'receptionist', 'section' => 'walk-ins']) }}" class="block w-full px-3 py-2.5 rounded-xl bg-slate-50 text-slate-800 text-[0.85rem] font-semibold hover:bg-slate-100 border border-slate-200 transition-colors">
                        Create walk-in
                    </a>
                    <a href="{{ route('dashboard', ['role' => 'receptionist', 'section' => 'queue-management']) }}" class="block w-full px-3 py-2.5 rounded-xl bg-slate-50 text-slate-800 text-[0.85rem] font-semibold hover:bg-slate-100 border border-slate-200 transition-colors">
                        Manage queue
                    </a>
                    <a href="{{ route('dashboard', ['role' => 'receptionist', 'section' => 'record-payment']) }}" class="block w-full px-3 py-2.5 rounded-xl bg-slate-50 text-slate-800 text-[0.85rem] font-semibold hover:bg-slate-100 border border-slate-200 transition-colors">
                        Record payment
                    </a>
                </div>
            </div>
        </div>
    @else
        <div>
            <h1 class="text-2xl font-semibold text-slate-900 mb-1">Receptionist workspace</h1>
            <p class="text-sm text-slate-500">Front desk tools for queue, registrations, appointments, and billing.</p>
        </div>

        @if ($sectionKey === 'queue-management')
            @include('dashviews.receptionist.reception_queue_management')
        @elseif ($sectionKey === 'register-patient')
            @include('dashviews.receptionist.reception_register_patient')
        @elseif ($sectionKey === 'book-appointment')
            @include('dashviews.receptionist.reception_book_appointment')
        @elseif ($sectionKey === 'walk-ins')
            @include('dashviews.receptionist.reception_walk_ins')
        @elseif ($sectionKey === 'record-payment')
            @include('dashviews.receptionist.reception_record_payment')
        @endif
    @endif
</div>