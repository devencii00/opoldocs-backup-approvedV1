<div class="space-y-6">
    @php
        $metrics = $adminMetrics ?? [];
        $sectionKey = $section ?? 'overview';

        $sectionTitles = [
            'manage-users' => 'Manage users',
            'roles-assignments' => 'Roles & assignments',
            'patient-records' => 'Patient records',
            'verification-approvals' => 'PWD / Senior verification',
            'visit-records' => 'Visit and prescription records',
            'audit-logs' => 'Audit logs',
            'reports-analytics' => 'Reports & analytics',
            'system-settings' => 'System settings',
            'doctors-specializations' => 'Doctors & specializations',
            'transactions-records' => 'Transactions records',
        ];

        $sectionSubtitles = [
            'manage-users' => 'Create and manage staff accounts.',
            'roles-assignments' => 'Control which users have access to each role.',
            'patient-records' => 'Browse and review registered patients.',
            'verification-approvals' => 'Approve or reject senior / PWD verification requests.',
            'visit-records' => 'Review visits that drive billing and prescriptions.',
            'audit-logs' => 'Track system changes and record access.',
            'reports-analytics' => 'High-level KPIs for the clinic.',
            'system-settings' => 'Configure global system behaviour.',
            'doctors-specializations' => 'Manage doctors and their specializations.',
            'transactions-records' => 'Monitor billing transactions across visits.',
        ];
    @endphp

    @if ($sectionKey === 'overview')
        <div>
            <h1 class="text-2xl font-semibold text-slate-900 mb-1">Admin overview</h1>
            <p class="text-sm text-slate-500">Snapshot of key figures and sections across the clinic system.</p>
        </div>

        <div class="grid gap-4 grid-cols-1 sm:grid-cols-2 lg:grid-cols-4">
            <div class="bg-white border border-slate-200 rounded-[18px] p-5 shadow-[0_2px_10px_rgba(15,23,42,0.04)]">
                <div class="font-serif font-bold text-[1.6rem] text-slate-900 mb-1">
                    {{ number_format((int) ($metrics['patientCount'] ?? 0)) }}
                </div>
                <div class="text-[0.8rem] text-slate-500">Registered patients</div>
            </div>
            <div class="bg-white border border-slate-200 rounded-[18px] p-5 shadow-[0_2px_10px_rgba(15,23,42,0.04)]">
                <div class="font-serif font-bold text-[1.6rem] text-slate-900 mb-1">
                    {{ number_format((int) ($metrics['doctorCount'] ?? 0)) }}
                </div>
                <div class="text-[0.8rem] text-slate-500">Active doctors</div>
            </div>
            <div class="bg-white border border-slate-200 rounded-[18px] p-5 shadow-[0_2px_10px_rgba(15,23,42,0.04)]">
                <div class="font-serif font-bold text-[1.6rem] text-slate-900 mb-1">
                    {{ number_format((int) ($metrics['pendingVerificationsCount'] ?? 0)) }}
                </div>
                <div class="text-[0.8rem] text-slate-500">Pending verifications</div>
            </div>
            <div class="bg-white border border-slate-200 rounded-[18px] p-5 shadow-[0_2px_10px_rgba(15,23,42,0.04)]">
                <div class="font-serif font-bold text-[1.6rem] text-slate-900 mb-1">
                    {{ number_format((int) ($metrics['recentLogsCount'] ?? 0)) }}
                </div>
                <div class="text-[0.8rem] text-slate-500">Total audit entries</div>
            </div>
        </div>

        <div class="grid gap-4 grid-cols-1 md:grid-cols-2 xl:grid-cols-3">
            <a href="{{ route('dashboard', ['role' => 'admin', 'section' => 'manage-users']) }}" class="group bg-white border border-slate-200 rounded-[18px] p-4 shadow-[0_2px_10px_rgba(15,23,42,0.04)] flex flex-col justify-between hover:border-cyan-400 hover:shadow-[0_4px_18px_rgba(8,145,178,0.18)] transition">
                <div class="flex items-center justify-between mb-2">
                    <div>
                        <p class="text-[0.7rem] text-slate-400 uppercase tracking-widest">Users</p>
                        <p class="text-sm font-semibold text-slate-900">Manage users</p>
                    </div>
                    <span class="material-symbols-outlined text-[20px] text-cyan-600 leading-none">group</span>
                </div>
                <div class="mt-1 flex items-baseline gap-1">
                    <span class="font-serif font-bold text-[1.4rem] text-slate-900">{{ count($adminRecentUsers ?? []) }}</span>
                    <span class="text-[0.72rem] text-slate-500">recent staff accounts</span>
                </div>
                <p class="mt-2 text-[0.72rem] text-slate-500">Create and review staff logins, then drill down for full details.</p>
            </a>

            <a href="{{ route('dashboard', ['role' => 'admin', 'section' => 'roles-assignments']) }}" class="group bg-white border border-slate-200 rounded-[18px] p-4 shadow-[0_2px_10px_rgba(15,23,42,0.04)] flex flex-col justify-between hover:border-cyan-400 hover:shadow-[0_4px_18px_rgba(8,145,178,0.18)] transition">
                <div class="flex items-center justify-between mb-2">
                    <div>
                        <p class="text-[0.7rem] text-slate-400 uppercase tracking-widest">Access</p>
                        <p class="text-sm font-semibold text-slate-900">Roles & assignments</p>
                    </div>
                    <span class="material-symbols-outlined text-[20px] text-cyan-600 leading-none">badge</span>
                </div>
                <div class="mt-1 flex items-baseline gap-1">
                    <span class="font-serif font-bold text-[1.4rem] text-slate-900">{{ count($adminUserRoleCounts ?? []) }}</span>
                    <span class="text-[0.72rem] text-slate-500">defined roles</span>
                </div>
                <p class="mt-2 text-[0.72rem] text-slate-500">Control primary and secondary roles for staff accounts.</p>
            </a>

            <a href="{{ route('dashboard', ['role' => 'admin', 'section' => 'patient-records']) }}" class="group bg-white border border-slate-200 rounded-[18px] p-4 shadow-[0_2px_10px_rgba(15,23,42,0.04)] flex flex-col justify-between hover:border-cyan-400 hover:shadow-[0_4px_18px_rgba(15,118,110,0.18)] transition">
                <div class="flex items-center justify-between mb-2">
                    <div>
                        <p class="text-[0.7rem] text-slate-400 uppercase tracking-widest">Patients</p>
                        <p class="text-sm font-semibold text-slate-900">Patient records</p>
                    </div>
                    <span class="material-symbols-outlined text-[20px] text-cyan-600 leading-none">folder_shared</span>
                </div>
                <div class="mt-1 flex items-baseline gap-1">
                    <span class="font-serif font-bold text-[1.4rem] text-slate-900">{{ count($adminRecentPatients ?? []) }}</span>
                    <span class="text-[0.72rem] text-slate-500">recent patients</span>
                </div>
                <p class="mt-2 text-[0.72rem] text-slate-500">Review core demographics and verification status.</p>
            </a>

            <a href="{{ route('dashboard', ['role' => 'admin', 'section' => 'verification-approvals']) }}" class="group bg-white border border-slate-200 rounded-[18px] p-4 shadow-[0_2px_10px_rgba(15,23,42,0.04)] flex flex-col justify-between hover:border-cyan-400 hover:shadow-[0_4px_18px_rgba(250,204,21,0.25)] transition">
                <div class="flex items-center justify-between mb-2">
                    <div>
                        <p class="text-[0.7rem] text-slate-400 uppercase tracking-widest">Discounts</p>
                        <p class="text-sm font-semibold text-slate-900">PWD / Senior verification</p>
                    </div>
                    <span class="material-symbols-outlined text-[20px] text-amber-500 leading-none">verified</span>
                </div>
                <div class="mt-1 flex items-baseline gap-1">
                    <span class="font-serif font-bold text-[1.4rem] text-slate-900">{{ count($adminRecentVerifications ?? []) }}</span>
                    <span class="text-[0.72rem] text-slate-500">recent requests</span>
                </div>
                <p class="mt-2 text-[0.72rem] text-slate-500">Approve or reject discount eligibility with full context.</p>
            </a>

            <a href="{{ route('dashboard', ['role' => 'admin', 'section' => 'visit-records']) }}" class="group bg-white border border-slate-200 rounded-[18px] p-4 shadow-[0_2px_10px_rgba(15,23,42,0.04)] flex flex-col justify-between hover:border-cyan-400 hover:shadow-[0_4px_18px_rgba(37,99,235,0.18)] transition">
                <div class="flex items-center justify-between mb-2">
                    <div>
                        <p class="text-[0.7rem] text-slate-400 uppercase tracking-widest">Clinical</p>
                        <p class="text-sm font-semibold text-slate-900">Visit & prescriptions</p>
                    </div>
                    <span class="material-symbols-outlined text-[20px] text-cyan-600 leading-none">history_edu</span>
                </div>
                <div class="mt-1 flex items-baseline gap-1">
                    <span class="font-serif font-bold text-[1.4rem] text-slate-900">{{ count($adminRecentTransactions ?? []) }}</span>
                    <span class="text-[0.72rem] text-slate-500">recent billed visits</span>
                </div>
                <p class="mt-2 text-[0.72rem] text-slate-500">Trace visits that drive billing and prescriptions.</p>
            </a>

            <a href="{{ route('dashboard', ['role' => 'admin', 'section' => 'audit-logs']) }}" class="group bg-white border border-slate-200 rounded-[18px] p-4 shadow-[0_2px_10px_rgba(15,23,42,0.04)] flex flex-col justify-between hover:border-cyan-400 hover:shadow-[0_4px_18px_rgba(15,23,42,0.18)] transition">
                <div class="flex items-center justify-between mb-2">
                    <div>
                        <p class="text-[0.7rem] text-slate-400 uppercase tracking-widest">Security</p>
                        <p class="text-sm font-semibold text-slate-900">Audit & access logs</p>
                    </div>
                    <span class="material-symbols-outlined text-[20px] text-slate-700 leading-none">rule_folder</span>
                </div>
                <div class="mt-1 flex items-baseline gap-1">
                    <span class="font-serif font-bold text-[1.4rem] text-slate-900">{{ number_format((int) ($metrics['recentLogsCount'] ?? 0)) }}</span>
                    <span class="text-[0.72rem] text-slate-500">total audit entries</span>
                </div>
                <p class="mt-2 text-[0.72rem] text-slate-500">Quickly see who changed what and when.</p>
            </a>

            <a href="{{ route('dashboard', ['role' => 'admin', 'section' => 'reports-analytics']) }}" class="group bg-white border border-slate-200 rounded-[18px] p-4 shadow-[0_2px_10px_rgba(15,23,42,0.04)] flex flex-col justify-between hover:border-cyan-400 hover:shadow-[0_4px_18px_rgba(56,189,248,0.22)] transition">
                <div class="flex items-center justify-between mb-2">
                    <div>
                        <p class="text-[0.7rem] text-slate-400 uppercase tracking-widest">Insights</p>
                        <p class="text-sm font-semibold text-slate-900">Reports & analytics</p>
                    </div>
                    <span class="material-symbols-outlined text-[20px] text-cyan-600 leading-none">insights</span>
                </div>
                <p class="mt-2 text-[0.72rem] text-slate-500">View aggregated KPIs for patients, staff, and compliance.</p>
            </a>

            <a href="{{ route('dashboard', ['role' => 'admin', 'section' => 'transactions-records']) }}" class="group bg-white border border-slate-200 rounded-[18px] p-4 shadow-[0_2px_10px_rgba(15,23,42,0.04)] flex flex-col justify-between hover:border-cyan-400 hover:shadow-[0_4px_18px_rgba(22,163,74,0.22)] transition">
                <div class="flex items-center justify-between mb-2">
                    <div>
                        <p class="text-[0.7rem] text-slate-400 uppercase tracking-widest">Billing</p>
                        <p class="text-sm font-semibold text-slate-900">Transactions</p>
                    </div>
                    <span class="material-symbols-outlined text-[20px] text-emerald-600 leading-none">payments</span>
                </div>
                <div class="mt-1 flex items-baseline gap-1">
                    <span class="font-serif font-bold text-[1.4rem] text-slate-900">{{ count($adminRecentTransactions ?? []) }}</span>
                    <span class="text-[0.72rem] text-slate-500">recent payments</span>
                </div>
                <p class="mt-2 text-[0.72rem] text-slate-500">Monitor incoming payments from recent clinical activity.</p>
            </a>

            <a href="{{ route('dashboard', ['role' => 'admin', 'section' => 'system-settings']) }}" class="group bg-white border border-slate-200 rounded-[18px] p-4 shadow-[0_2px_10px_rgba(15,23,42,0.04)] flex flex-col justify-between hover:border-cyan-400 hover:shadow-[0_4px_18px_rgba(37,99,235,0.18)] transition">
                <div class="flex items-center justify-between mb-2">
                    <div>
                        <p class="text-[0.7rem] text-slate-400 uppercase tracking-widest">Configuration</p>
                        <p class="text-sm font-semibold text-slate-900">System settings</p>
                    </div>
                    <span class="material-symbols-outlined text-[20px] text-slate-700 leading-none">tune</span>
                </div>
                <p class="mt-2 text-[0.72rem] text-slate-500">Configure chatbot questions and recovery flows.</p>
            </a>
        </div>
    @else
        @php
            $title = $sectionTitles[$sectionKey] ?? 'Admin';
            $subtitle = $sectionSubtitles[$sectionKey] ?? 'Administrative workspace';
        @endphp

        <div>
            <h1 class="text-2xl font-semibold text-slate-900 mb-1">{{ $title }}</h1>
            <p class="text-sm text-slate-500">{{ $subtitle }}</p>
        </div>

        @if ($sectionKey === 'manage-users')
            @include('dashviews.admin.manage_user')
        @elseif ($sectionKey === 'roles-assignments')
            @include('dashviews.admin.roles_assignments')
        @elseif ($sectionKey === 'patient-records')
            @include('dashviews.admin.patient_records')
        @elseif ($sectionKey === 'verification-approvals')
            @include('dashviews.admin.verification_approvals')
        @elseif ($sectionKey === 'visit-records')
            @include('dashviews.admin.visit_prescription_records')
        @elseif ($sectionKey === 'audit-logs')
            @include('dashviews.admin.audit_logs')
        @elseif ($sectionKey === 'reports-analytics')
            @include('dashviews.admin.reports_analytics')
        @elseif ($sectionKey === 'system-settings')
            @include('dashviews.admin.system_settings')
        @elseif ($sectionKey === 'doctors-specializations')
            @include('dashviews.admin.doctors_specializations')
        @elseif ($sectionKey === 'transactions-records')
            @include('dashviews.admin.transactions_records')
        @endif
    @endif
</div>
