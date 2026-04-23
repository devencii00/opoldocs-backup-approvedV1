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
            Dashboard overview
            @if ($isDashboardActive)
                <span class="absolute left-0 top-[25%] bottom-[25%] w-1.5 rounded-r bg-cyan-500"></span>
            @endif
        </a>

        @if ($roleKey === 'admin')
            <div class="text-slate-400 text-[0.67rem] font-semibold uppercase tracking-widest mt-4 mb-1">Users & Roles</div>
            @php
                $isManageUsers = $currentSection === 'manage-users';
                $isRolesAssignments = $currentSection === 'roles-assignments';
            @endphp

            <a href="{{ route('dashboard', ['role' => $roleKey, 'section' => 'manage-users']) }}" class="{{ $navBase }} {{ $isManageUsers ? $navActive : $navInactive }}">
                <span class="material-symbols-outlined text-[18px] leading-none {{ $isManageUsers ? 'text-cyan-600' : '' }}">group</span>
                Manage users
                @if ($isManageUsers)
                    <span class="absolute left-0 top-[25%] bottom-[25%] w-1.5 rounded-r bg-cyan-500"></span>
                @endif
            </a>

            <a href="{{ route('dashboard', ['role' => $roleKey, 'section' => 'roles-assignments']) }}" class="{{ $navBase }} {{ $isRolesAssignments ? $navActive : $navInactive }} mb-3">
                <span class="material-symbols-outlined text-[18px] leading-none {{ $isRolesAssignments ? 'text-cyan-600' : '' }}">badge</span>
                Roles & assignments
                @if ($isRolesAssignments)
                    <span class="absolute left-0 top-[25%] bottom-[25%] w-1.5 rounded-r bg-cyan-500"></span>
                @endif
            </a>

            <div class="text-slate-400 text-[0.67rem] font-semibold uppercase tracking-widest mt-2 mb-1">Records & Verification</div>

            @php
                $isPatientRecords = $currentSection === 'patient-records';
                $isVerification = $currentSection === 'verification-approvals';
                $isVisitRecords = $currentSection === 'visit-records';
            @endphp

            <a href="{{ route('dashboard', ['role' => $roleKey, 'section' => 'patient-records']) }}" class="{{ $navBase }} {{ $isPatientRecords ? $navActive : $navInactive }}">
                <span class="material-symbols-outlined text-[18px] leading-none {{ $isPatientRecords ? 'text-cyan-600' : '' }}">folder_shared</span>
                Patient records
            </a>

            <a href="{{ route('dashboard', ['role' => $roleKey, 'section' => 'verification-approvals']) }}" class="{{ $navBase }} {{ $isVerification ? $navActive : $navInactive }}">
                <span class="material-symbols-outlined text-[18px] leading-none {{ $isVerification ? 'text-cyan-600' : '' }}">verified</span>
                PWD / Senior verification
            </a>

            <a href="{{ route('dashboard', ['role' => $roleKey, 'section' => 'visit-records']) }}" class="{{ $navBase }} {{ $isVisitRecords ? $navActive : $navInactive }} mb-3">
                <span class="material-symbols-outlined text-[18px] leading-none {{ $isVisitRecords ? 'text-cyan-600' : '' }}">history_edu</span>
                Visit and prescription records
            </a>

            <div class="text-slate-400 text-[0.67rem] font-semibold uppercase tracking-widest mt-2 mb-1">Logs & Reports</div>

            @php
                $isAuditLogs = $currentSection === 'audit-logs';
                $isReportsAnalytics = $currentSection === 'reports-analytics';
                $isTransactions = $currentSection === 'transactions-records';
            @endphp

            <a href="{{ route('dashboard', ['role' => $roleKey, 'section' => 'audit-logs']) }}" class="{{ $navBase }} {{ $isAuditLogs ? $navActive : $navInactive }}">
                <span class="material-symbols-outlined text-[18px] leading-none {{ $isAuditLogs ? 'text-cyan-600' : '' }}">rule_folder</span>
                Audit logs
            </a>

            <a href="{{ route('dashboard', ['role' => $roleKey, 'section' => 'reports-analytics']) }}" class="{{ $navBase }} {{ $isReportsAnalytics ? $navActive : $navInactive }}">
                <span class="material-symbols-outlined text-[18px] leading-none {{ $isReportsAnalytics ? 'text-cyan-600' : '' }}">insights</span>
                Reports & analytics
            </a>

            <a href="{{ route('dashboard', ['role' => $roleKey, 'section' => 'transactions-records']) }}" class="{{ $navBase }} {{ $isTransactions ? $navActive : $navInactive }} mb-3">
                <span class="material-symbols-outlined text-[18px] leading-none {{ $isTransactions ? 'text-cyan-600' : '' }}">payments</span>
                Transactions
            </a>

            <div class="text-slate-400 text-[0.67rem] font-semibold uppercase tracking-widest mt-2 mb-1">Configuration</div>

            @php
                $isSystemSettings = $currentSection === 'system-settings';
                $isDoctorsSpecs = $currentSection === 'doctors-specializations';
            @endphp

            <a href="{{ route('dashboard', ['role' => $roleKey, 'section' => 'system-settings']) }}" class="{{ $navBase }} {{ $isSystemSettings ? $navActive : $navInactive }}">
                <span class="material-symbols-outlined text-[18px] leading-none {{ $isSystemSettings ? 'text-cyan-600' : '' }}">tune</span>
                System settings
            </a>

            <a href="{{ route('dashboard', ['role' => $roleKey, 'section' => 'doctors-specializations']) }}" class="{{ $navBase }} {{ $isDoctorsSpecs ? $navActive : $navInactive }}">
                <span class="material-symbols-outlined text-[18px] leading-none {{ $isDoctorsSpecs ? 'text-cyan-600' : '' }}">stethoscope</span>
                Doctors & specializations
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
                $isMyPatients = $currentSection === 'my-patients';
                $isDoctorAppointments = $currentSection === 'appointments';
                $isDoctorQueue = $currentSection === 'queue';
                $isDoctorVisits = $currentSection === 'visits';
                $isDoctorPrescriptions = $currentSection === 'prescriptions';
                $isDoctorActivity = $currentSection === 'my-activity';
            @endphp

            <div class="text-slate-400 text-[0.67rem] font-semibold uppercase tracking-widest mt-4 mb-1">Patients</div>

            <a href="{{ route('dashboard', ['role' => $roleKey, 'section' => 'my-patients']) }}" class="{{ $navBase }} {{ $isMyPatients ? $navActive : $navInactive }}">
                <span class="material-symbols-outlined text-[18px] leading-none {{ $isMyPatients ? 'text-cyan-600' : '' }}">groups</span>
                My patients
                @if ($isMyPatients)
                    <span class="absolute left-0 top-[25%] bottom-[25%] w-1.5 rounded-r bg-cyan-500"></span>
                @endif
            </a>

            <a href="{{ route('dashboard', ['role' => $roleKey, 'section' => 'appointments']) }}" class="{{ $navBase }} {{ $isDoctorAppointments ? $navActive : $navInactive }}">
                <span class="material-symbols-outlined text-[18px] leading-none {{ $isDoctorAppointments ? 'text-cyan-600' : '' }}">event_note</span>
                Appointments
                @if ($isDoctorAppointments)
                    <span class="absolute left-0 top-[25%] bottom-[25%] w-1.5 rounded-r bg-cyan-500"></span>
                @endif
            </a>

            <a href="{{ route('dashboard', ['role' => $roleKey, 'section' => 'queue']) }}" class="{{ $navBase }} {{ $isDoctorQueue ? $navActive : $navInactive }} mb-3">
                <span class="material-symbols-outlined text-[18px] leading-none {{ $isDoctorQueue ? 'text-cyan-600' : '' }}">lists</span>
                Queue
                @if ($isDoctorQueue)
                    <span class="absolute left-0 top-[25%] bottom-[25%] w-1.5 rounded-r bg-cyan-500"></span>
                @endif
            </a>

            <div class="text-slate-400 text-[0.67rem] font-semibold uppercase tracking-widest mt-2 mb-1">Clinical</div>

            <a href="{{ route('dashboard', ['role' => $roleKey, 'section' => 'visits']) }}" class="{{ $navBase }} {{ $isDoctorVisits ? $navActive : $navInactive }}">
                <span class="material-symbols-outlined text-[18px] leading-none {{ $isDoctorVisits ? 'text-cyan-600' : '' }}">note</span>
                Visits
                @if ($isDoctorVisits)
                    <span class="absolute left-0 top-[25%] bottom-[25%] w-1.5 rounded-r bg-cyan-500"></span>
                @endif
            </a>

            <a href="{{ route('dashboard', ['role' => $roleKey, 'section' => 'prescriptions']) }}" class="{{ $navBase }} {{ $isDoctorPrescriptions ? $navActive : $navInactive }} mb-3">
                <span class="material-symbols-outlined text-[18px] leading-none {{ $isDoctorPrescriptions ? 'text-cyan-600' : '' }}">prescriptions</span>
                Prescriptions
                @if ($isDoctorPrescriptions)
                    <span class="absolute left-0 top-[25%] bottom-[25%] w-1.5 rounded-r bg-cyan-500"></span>
                @endif
            </a>

            <div class="text-slate-400 text-[0.67rem] font-semibold uppercase tracking-widest mt-2 mb-1">Reports</div>

            <a href="{{ route('dashboard', ['role' => $roleKey, 'section' => 'my-activity']) }}" class="{{ $navBase }} {{ $isDoctorActivity ? $navActive : $navInactive }}">
                <span class="material-symbols-outlined text-[18px] leading-none {{ $isDoctorActivity ? 'text-cyan-600' : '' }}">monitoring</span>
                My activity
                @if ($isDoctorActivity)
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
