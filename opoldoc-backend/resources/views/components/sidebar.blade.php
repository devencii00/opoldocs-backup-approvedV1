@props(['role' => 'admin'])

@php
    $roleKey = strtolower($role ?? 'admin');

    $roleNames = [
        'admin' => 'Admin',
        'doctor' => 'Doctor',
        'receptionist' => 'Receptionist',
        'patient' => 'Patient',
    ];

    $roleTaglines = [
        'admin' => 'System Control & Oversight',
        'doctor' => 'Consultations & Prescriptions',
        'receptionist' => 'Front Desk Operations',
        'patient' => 'Patient Portal',
    ];

    $displayName = $roleNames[$roleKey] ?? ucfirst($roleKey);
    $tagline = $roleTaglines[$roleKey] ?? 'User Workspace';
    $initial = strtoupper(substr($displayName, 0, 1));

    $currentSection = request()->query('section');
    $currentSection = $currentSection ?: 'overview';

    $navBase = 'flex items-center gap-2.5 p-2 rounded-xl text-[0.87rem] font-medium mb-1';
    $navInactive = 'text-slate-600 hover:bg-slate-50 hover:text-slate-900';
    $navActive = 'bg-gradient-to-br from-cyan-50/20 to-cyan-100/10 text-cyan-700 relative';
@endphp

<aside class="w-[248px] flex-shrink-0 bg-white flex flex-col fixed top-0 left-0 bottom-0 z-40 shadow-[4px_0_24px_rgba(15,23,42,0.05)] border-r border-slate-200">
    <div class="flex items-center gap-3 p-6 border-b border-slate-100">
        <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0 bg-gradient-to-br from-cyan-500 to-cyan-700 shadow-[0_4px_10px_rgba(6,182,212,0.3)]">
            <span class="material-symbols-outlined text-white text-[18px] leading-none">monitor_heart</span>
        </div>
        <div>
            <div class="font-serif font-bold text-slate-900 text-sm leading-[1.2]">Opol Clinic</div>
            <div class="text-slate-400 font-medium text-[0.68rem] uppercase tracking-widest">{{ $displayName }}</div>
        </div>
    </div>

    <nav class="flex-1 px-3 py-2 overflow-y-auto scrollbar-hidden">
        <div class="text-slate-400 text-[0.67rem] font-semibold uppercase tracking-widest pt-4 pb-1">Main Menu</div>

        @php
            $isDashboardActive = $currentSection === 'overview';
        @endphp

        <a href="{{ route('dashboard', ['role' => $roleKey]) }}" class="{{ $navBase }} {{ $isDashboardActive ? $navActive : $navInactive }}">
            <span class="material-symbols-outlined flex-shrink-0 text-[18px] leading-none {{ $isDashboardActive ? 'text-cyan-600' : '' }}">dashboard</span>
            Dashboard
            @if ($isDashboardActive)
                <span class="absolute left-0 top-[25%] bottom-[25%] w-1.5 rounded-r bg-cyan-500"></span>
            @endif
        </a>

        @if ($roleKey === 'admin')
            <div class="text-slate-400 text-[0.67rem] font-semibold uppercase tracking-widest mt-4 mb-1">Admin Panel</div>
            @php
                $isUserManagement = $currentSection === 'user-management';
                $isDoctorManagement = $currentSection === 'doctor-management';
                $isServicesManagement = $currentSection === 'services-management';
                $isMedicinesManagement = $currentSection === 'medicines-management';
                $isMedicalBackgroundViewer = $currentSection === 'medical-background-viewer';
                $isAppointments = $currentSection === 'appointments';
                $isReports = $currentSection === 'reports';
                $isChatbotManagement = $currentSection === 'chatbot-management';
                $isLogs = $currentSection === 'logs';
                $isSettings = $currentSection === 'settings';
            @endphp

            <a href="{{ route('dashboard', ['role' => $roleKey, 'section' => 'user-management']) }}" class="{{ $navBase }} {{ $isUserManagement ? $navActive : $navInactive }}">
                <span class="material-symbols-outlined text-[18px] leading-none {{ $isUserManagement ? 'text-cyan-600' : '' }}">group</span>
                Users
                @if ($isUserManagement)
                    <span class="absolute left-0 top-[25%] bottom-[25%] w-1.5 rounded-r bg-cyan-500"></span>
                @endif
            </a>

            <a href="{{ route('dashboard', ['role' => $roleKey, 'section' => 'doctor-management']) }}" class="{{ $navBase }} {{ $isDoctorManagement ? $navActive : $navInactive }}">
                <span class="material-symbols-outlined text-[18px] leading-none {{ $isDoctorManagement ? 'text-cyan-600' : '' }}">stethoscope</span>
                Doctors
                @if ($isDoctorManagement)
                    <span class="absolute left-0 top-[25%] bottom-[25%] w-1.5 rounded-r bg-cyan-500"></span>
                @endif
            </a>

            <a href="{{ route('dashboard', ['role' => $roleKey, 'section' => 'services-management']) }}" class="{{ $navBase }} {{ $isServicesManagement ? $navActive : $navInactive }}">
                <span class="material-symbols-outlined text-[18px] leading-none {{ $isServicesManagement ? 'text-cyan-600' : '' }}">medical_services</span>
                Services
                @if ($isServicesManagement)
                    <span class="absolute left-0 top-[25%] bottom-[25%] w-1.5 rounded-r bg-cyan-500"></span>
                @endif
            </a>

            <a href="{{ route('dashboard', ['role' => $roleKey, 'section' => 'medicines-management']) }}" class="{{ $navBase }} {{ $isMedicinesManagement ? $navActive : $navInactive }}">
                <span class="material-symbols-outlined text-[18px] leading-none {{ $isMedicinesManagement ? 'text-cyan-600' : '' }}">vaccines</span>
                Medicines
                @if ($isMedicinesManagement)
                    <span class="absolute left-0 top-[25%] bottom-[25%] w-1.5 rounded-r bg-cyan-500"></span>
                @endif
            </a>

            <a href="{{ route('dashboard', ['role' => $roleKey, 'section' => 'medical-background-viewer']) }}" class="{{ $navBase }} {{ $isMedicalBackgroundViewer ? $navActive : $navInactive }}">
                <span class="material-symbols-outlined text-[18px] leading-none {{ $isMedicalBackgroundViewer ? 'text-cyan-600' : '' }}">assignment</span>
                Medical Background
                @if ($isMedicalBackgroundViewer)
                    <span class="absolute left-0 top-[25%] bottom-[25%] w-1.5 rounded-r bg-cyan-500"></span>
                @endif
            </a>

            <a href="{{ route('dashboard', ['role' => $roleKey, 'section' => 'appointments']) }}" class="{{ $navBase }} {{ $isAppointments ? $navActive : $navInactive }}">
                <span class="material-symbols-outlined text-[18px] leading-none {{ $isAppointments ? 'text-cyan-600' : '' }}">event</span>
                Appointments
                @if ($isAppointments)
                    <span class="absolute left-0 top-[25%] bottom-[25%] w-1.5 rounded-r bg-cyan-500"></span>
                @endif
            </a>

            <a href="{{ route('dashboard', ['role' => $roleKey, 'section' => 'reports']) }}" class="{{ $navBase }} {{ $isReports ? $navActive : $navInactive }}">
                <span class="material-symbols-outlined text-[18px] leading-none {{ $isReports ? 'text-cyan-600' : '' }}">insights</span>
                Reports
                @if ($isReports)
                    <span class="absolute left-0 top-[25%] bottom-[25%] w-1.5 rounded-r bg-cyan-500"></span>
                @endif
            </a>

            <a href="{{ route('dashboard', ['role' => $roleKey, 'section' => 'chatbot-management']) }}" class="{{ $navBase }} {{ $isChatbotManagement ? $navActive : $navInactive }}">
                <span class="material-symbols-outlined text-[18px] leading-none {{ $isChatbotManagement ? 'text-cyan-600' : '' }}">smart_toy</span>
                Chatbot
                @if ($isChatbotManagement)
                    <span class="absolute left-0 top-[25%] bottom-[25%] w-1.5 rounded-r bg-cyan-500"></span>
                @endif
            </a>

            <a href="{{ route('dashboard', ['role' => $roleKey, 'section' => 'logs']) }}" class="{{ $navBase }} {{ $isLogs ? $navActive : $navInactive }}">
                <span class="material-symbols-outlined text-[18px] leading-none {{ $isLogs ? 'text-cyan-600' : '' }}">rule_folder</span>
                Logs
                @if ($isLogs)
                    <span class="absolute left-0 top-[25%] bottom-[25%] w-1.5 rounded-r bg-cyan-500"></span>
                @endif
            </a>

            <a href="{{ route('dashboard', ['role' => $roleKey, 'section' => 'settings']) }}" class="{{ $navBase }} {{ $isSettings ? $navActive : $navInactive }}">
                <span class="material-symbols-outlined text-[18px] leading-none {{ $isSettings ? 'text-cyan-600' : '' }}">settings</span>
                Settings
                @if ($isSettings)
                    <span class="absolute left-0 top-[25%] bottom-[25%] w-1.5 rounded-r bg-cyan-500"></span>
                @endif
            </a>
        @elseif ($roleKey === 'receptionist')
            @php
                $isReceptionRegister = $currentSection === 'register-patient';
                $isReceptionAppointments = $currentSection === 'book-appointment';
                $isReceptionWalkIns = $currentSection === 'walk-ins';
                $isReceptionQueue = $currentSection === 'queue-management';
                $isReceptionRecordPayments = $currentSection === 'record-payment';
            @endphp

            <div class="text-slate-400 text-[0.67rem] font-semibold uppercase tracking-widest mt-4 mb-1">Patients & Appointments</div>

            <a href="{{ route('dashboard', ['role' => $roleKey, 'section' => 'register-patient']) }}" class="{{ $navBase }} {{ $isReceptionRegister ? $navActive : $navInactive }}">
                <span class="material-symbols-outlined text-[18px] leading-none {{ $isReceptionRegister ? 'text-cyan-600' : '' }}">person_add</span>
                Register patient
                @if ($isReceptionRegister)
                    <span class="absolute left-0 top-[25%] bottom-[25%] w-1.5 rounded-r bg-cyan-500"></span>
                @endif
            </a>

            <a href="{{ route('dashboard', ['role' => $roleKey, 'section' => 'book-appointment']) }}" class="{{ $navBase }} {{ $isReceptionAppointments ? $navActive : $navInactive }}">
                <span class="material-symbols-outlined text-[18px] leading-none {{ $isReceptionAppointments ? 'text-cyan-600' : '' }}">event</span>
                Appointments
                @if ($isReceptionAppointments)
                    <span class="absolute left-0 top-[25%] bottom-[25%] w-1.5 rounded-r bg-cyan-500"></span>
                @endif
            </a>

            <a href="{{ route('dashboard', ['role' => $roleKey, 'section' => 'walk-ins']) }}" class="{{ $navBase }} {{ $isReceptionWalkIns ? $navActive : $navInactive }}">
                <span class="material-symbols-outlined text-[18px] leading-none {{ $isReceptionWalkIns ? 'text-cyan-600' : '' }}">how_to_reg</span>
                Walk-ins
                @if ($isReceptionWalkIns)
                    <span class="absolute left-0 top-[25%] bottom-[25%] w-1.5 rounded-r bg-cyan-500"></span>
                @endif
            </a>

            <a href="{{ route('dashboard', ['role' => $roleKey, 'section' => 'queue-management']) }}" class="{{ $navBase }} {{ $isReceptionQueue ? $navActive : $navInactive }} mb-3">
                <span class="material-symbols-outlined text-[18px] leading-none {{ $isReceptionQueue ? 'text-cyan-600' : '' }}">view_list</span>
                Queue management
                @if ($isReceptionQueue)
                    <span class="absolute left-0 top-[25%] bottom-[25%] w-1.5 rounded-r bg-cyan-500"></span>
                @endif
            </a>

            <div class="text-slate-400 text-[0.67rem] font-semibold uppercase tracking-widest mt-2 mb-1">Billing</div>

            <a href="{{ route('dashboard', ['role' => $roleKey, 'section' => 'record-payment']) }}" class="{{ $navBase }} {{ $isReceptionRecordPayments ? $navActive : $navInactive }}">
                <span class="material-symbols-outlined text-[18px] leading-none {{ $isReceptionRecordPayments ? 'text-cyan-600' : '' }}">payments</span>
                Record payments
                @if ($isReceptionRecordPayments)
                    <span class="absolute left-0 top-[25%] bottom-[25%] w-1.5 rounded-r bg-cyan-500"></span>
                @endif
            </a>
        @elseif ($roleKey === 'doctor')
            @php
                $isDoctorSchedule = $currentSection === 'my-schedule';
                $isDoctorQueue = $currentSection === 'queue';
                $isDoctorConsultation = $currentSection === 'consultation';
                $isDoctorPrescription = $currentSection === 'prescriptions';
                $isDoctorHistory = $currentSection === 'history';
                $isDoctorSettings = $currentSection === 'settings-doctor';
            @endphp

            <div class="text-slate-400 text-[0.67rem] font-semibold uppercase tracking-widest mt-4 mb-1">Work</div>

            <a href="{{ route('dashboard', ['role' => $roleKey, 'section' => 'my-schedule']) }}" class="{{ $navBase }} {{ $isDoctorSchedule ? $navActive : $navInactive }}">
                <span class="material-symbols-outlined text-[18px] leading-none {{ $isDoctorSchedule ? 'text-cyan-600' : '' }}">event_note</span>
                My Schedule
                @if ($isDoctorSchedule)
                    <span class="absolute left-0 top-[25%] bottom-[25%] w-1.5 rounded-r bg-cyan-500"></span>
                @endif
            </a>

            <a href="{{ route('dashboard', ['role' => $roleKey, 'section' => 'queue']) }}" class="{{ $navBase }} {{ $isDoctorQueue ? $navActive : $navInactive }}">
                <span class="material-symbols-outlined text-[18px] leading-none {{ $isDoctorQueue ? 'text-cyan-600' : '' }}">lists</span>
                Queue
                @if ($isDoctorQueue)
                    <span class="absolute left-0 top-[25%] bottom-[25%] w-1.5 rounded-r bg-cyan-500"></span>
                @endif
            </a>

            <a href="{{ route('dashboard', ['role' => $roleKey, 'section' => 'consultation']) }}" class="{{ $navBase }} {{ $isDoctorConsultation ? $navActive : $navInactive }}">
                <span class="material-symbols-outlined text-[18px] leading-none {{ $isDoctorConsultation ? 'text-cyan-600' : '' }}">clinical_notes</span>
                Consultation
                @if ($isDoctorConsultation)
                    <span class="absolute left-0 top-[25%] bottom-[25%] w-1.5 rounded-r bg-cyan-500"></span>
                @endif
            </a>

            <a href="{{ route('dashboard', ['role' => $roleKey, 'section' => 'prescriptions']) }}" class="{{ $navBase }} {{ $isDoctorPrescription ? $navActive : $navInactive }}">
                <span class="material-symbols-outlined text-[18px] leading-none {{ $isDoctorPrescription ? 'text-cyan-600' : '' }}">prescriptions</span>
                Prescription
                @if ($isDoctorPrescription)
                    <span class="absolute left-0 top-[25%] bottom-[25%] w-1.5 rounded-r bg-cyan-500"></span>
                @endif
            </a>

            <a href="{{ route('dashboard', ['role' => $roleKey, 'section' => 'history']) }}" class="{{ $navBase }} {{ $isDoctorHistory ? $navActive : $navInactive }} mb-3">
                <span class="material-symbols-outlined text-[18px] leading-none {{ $isDoctorHistory ? 'text-cyan-600' : '' }}">history</span>
                History
                @if ($isDoctorHistory)
                    <span class="absolute left-0 top-[25%] bottom-[25%] w-1.5 rounded-r bg-cyan-500"></span>
                @endif
            </a>

            <div class="text-slate-400 text-[0.67rem] font-semibold uppercase tracking-widest mt-2 mb-1">Settings</div>

            <a href="{{ route('dashboard', ['role' => $roleKey, 'section' => 'settings-doctor']) }}" class="{{ $navBase }} {{ $isDoctorSettings ? $navActive : $navInactive }}">
                <span class="material-symbols-outlined text-[18px] leading-none {{ $isDoctorSettings ? 'text-cyan-600' : '' }}">settings</span>
                Doctor Settings
                @if ($isDoctorSettings)
                    <span class="absolute left-0 top-[25%] bottom-[25%] w-1.5 rounded-r bg-cyan-500"></span>
                @endif
            </a>
        @endif
    </nav>

    <div class="px-3 py-4 border-t border-slate-100">
        <div class="flex items-center gap-2.5 p-2 rounded-xl bg-slate-50 mb-2">
            <div class="w-8 h-8 rounded-full flex items-center justify-center bg-gradient-to-br from-cyan-400 to-cyan-700 text-white font-bold text-xs">
                {{ $initial }}
            </div>
            <div>
                <div class="text-slate-800 font-semibold text-[0.83rem] leading-tight">{{ $displayName }}</div>
                <div class="text-slate-400 text-[0.7rem]">{{ $tagline }}</div>
            </div>
        </div>
        <button type="button" onclick="if(confirm('Are you sure you want to log out?')) { window.location.href='{{ route('webadmin.login') }}'; }" class="w-full flex items-center justify-center gap-2.5 p-2 rounded-xl border border-red-400/25 bg-red-50 text-red-600 text-[0.83rem] font-semibold hover:bg-red-100 hover:border-red-400/40">
            <span class="material-symbols-outlined text-[16px] leading-none">logout</span>
            Sign Out
        </button>
    </div>
</aside>
