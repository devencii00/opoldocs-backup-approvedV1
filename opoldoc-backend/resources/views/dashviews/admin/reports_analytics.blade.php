<div class="bg-white border border-slate-200 rounded-[18px] p-5 shadow-[0_2px_10px_rgba(15,23,42,0.04)]">
    <div class="flex items-center justify-between mb-3">
        <h2 class="text-sm font-semibold text-slate-900">Reports & analytics</h2>
        <span class="text-[0.7rem] text-slate-400 uppercase tracking-widest">Summary</span>
    </div>
    <p class="text-xs text-slate-500 mb-3">
        Transactions, revenue, appointment analytics, and basic no-show tracking for the clinic.
    </p>

    @php
        $metrics = $adminMetrics ?? [];
        $reports = $adminReports ?? [];
        $recentTransactions = $adminRecentTransactions ?? collect();
    @endphp

    <div class="mb-3 flex flex-col gap-2 md:flex-row md:items-end">
        <div class="flex-1">
            <label for="admin_analytics_focus" class="block text-[0.7rem] text-slate-600 mb-1">Focus</label>
            <select id="admin_analytics_focus" class="w-full md:w-56 rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                <option value="all">All metrics</option>
                <option value="patients">Patients</option>
                <option value="staff">Staff</option>
                <option value="compliance">Compliance</option>
            </select>
        </div>
    </div>

    <div class="grid gap-3 grid-cols-1 sm:grid-cols-2 mb-4">
        <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100 admin-analytics-card" data-group="patients">
            <div class="flex items-center justify-between mb-1">
                <span class="text-[0.78rem] text-slate-500">Total patients</span>
                <span class="material-symbols-outlined text-[17px] text-cyan-600 leading-none">groups</span>
            </div>
            <div class="font-serif font-bold text-xl text-slate-900">
                {{ number_format((int) ($metrics['patientCount'] ?? 0)) }}
            </div>
        </div>

        <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100 admin-analytics-card" data-group="staff">
            <div class="flex items-center justify-between mb-1">
                <span class="text-[0.78rem] text-slate-500">Active doctors</span>
                <span class="material-symbols-outlined text-[17px] text-cyan-600 leading-none">stethoscope</span>
            </div>
            <div class="font-serif font-bold text-xl text-slate-900">
                {{ number_format((int) ($metrics['doctorCount'] ?? 0)) }}
            </div>
        </div>

        <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100 admin-analytics-card" data-group="compliance">
            <div class="flex items-center justify-between mb-1">
                <span class="text-[0.78rem] text-slate-500">Pending verifications</span>
                <span class="material-symbols-outlined text-[17px] text-amber-500 leading-none">verified</span>
            </div>
            <div class="font-serif font-bold text-xl text-slate-900">
                {{ number_format((int) ($metrics['pendingVerificationsCount'] ?? 0)) }}
            </div>
        </div>

        <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100 admin-analytics-card" data-group="compliance">
            <div class="flex items-center justify-between mb-1">
                <span class="text-[0.78rem] text-slate-500">Total audit entries</span>
                <span class="material-symbols-outlined text-[17px] text-slate-600 leading-none">rule_folder</span>
            </div>
            <div class="font-serif font-bold text-xl text-slate-900">
                {{ number_format((int) ($metrics['recentLogsCount'] ?? 0)) }}
            </div>
        </div>
    </div>

    <div class="grid gap-4 grid-cols-1 lg:grid-cols-[minmax(0,1.4fr)_minmax(0,1fr)]">
        <div class="border border-slate-100 rounded-2xl p-4 bg-slate-50/60">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-xs font-semibold text-slate-900">Transactions</h3>
                <span class="text-[0.68rem] text-slate-400 uppercase tracking-widest">Recent</span>
            </div>
            <p class="text-[0.72rem] text-slate-500 mb-2">
                Latest payments recorded by the system.
            </p>
            <div class="overflow-x-auto scrollbar-hidden">
                <table class="min-w-full text-left text-xs text-slate-600">
                    <thead>
                        <tr class="border-b border-slate-100 text-[0.68rem] uppercase tracking-widest text-slate-400">
                            <th class="py-2 pr-4 font-semibold">When</th>
                            <th class="py-2 pr-4 font-semibold">Amount</th>
                            <th class="py-2 pr-4 font-semibold">Mode</th>
                            <th class="py-2 pr-4 font-semibold">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentTransactions as $txn)
                            <tr class="border-b border-slate-50 last:border-0">
                                <td class="py-2 pr-4 text-[0.78rem] text-slate-500">
                                    {{ optional($txn->transaction_datetime)->format('Y-m-d H:i') ?? '—' }}
                                </td>
                                <td class="py-2 pr-4 text-[0.78rem] text-slate-700">
                                    ₱{{ number_format((float) ($txn->amount ?? 0), 2) }}
                                </td>
                                <td class="py-2 pr-4 text-[0.78rem] text-slate-500">
                                    {{ $txn->payment_mode ?? '—' }}
                                </td>
                                <td class="py-2 pr-4 text-[0.78rem]">
                                    @php
                                        $status = strtolower($txn->payment_status ?? '');
                                        $statusLabel = $txn->payment_status ?? '—';
                                        $statusClasses = 'inline-flex items-center rounded-full px-2.5 py-0.5 text-[0.68rem] font-semibold ';
                                        if ($status === 'paid') {
                                            $statusClasses .= 'bg-emerald-50 text-emerald-700 border border-emerald-100';
                                        } elseif ($status === 'pending') {
                                            $statusClasses .= 'bg-amber-50 text-amber-700 border border-amber-100';
                                        } elseif ($status === 'failed') {
                                            $statusClasses .= 'bg-rose-50 text-rose-700 border border-rose-100';
                                        } else {
                                            $statusClasses .= 'bg-slate-50 text-slate-600 border border-slate-100';
                                        }
                                    @endphp
                                    <span class="{{ $statusClasses }}">
                                        {{ $statusLabel }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-4 text-center text-[0.78rem] text-slate-400">
                                    No transactions recorded yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="border border-slate-100 rounded-2xl p-4 bg-slate-50/60">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-xs font-semibold text-slate-900">Revenue</h3>
                <span class="text-[0.68rem] text-slate-400 uppercase tracking-widest">Summary</span>
            </div>
            <p class="text-[0.72rem] text-slate-500 mb-3">
                Daily and month-to-date revenue based on paid transactions.
            </p>
            <div class="space-y-3">
                <div class="flex items-center justify-between rounded-xl bg-white border border-slate-100 px-3 py-2.5">
                    <div>
                        <p class="text-[0.7rem] text-slate-500 mb-0.5">Today</p>
                        <p class="font-serif font-bold text-lg text-slate-900">
                            ₱{{ number_format((float) ($metrics['revenueToday'] ?? 0), 2) }}
                        </p>
                    </div>
                    <span class="material-symbols-outlined text-[20px] text-cyan-600 leading-none">calendar_today</span>
                </div>
                <div class="flex items-center justify-between rounded-xl bg-white border border-slate-100 px-3 py-2.5">
                    <div>
                        <p class="text-[0.7rem] text-slate-500 mb-0.5">This month</p>
                        <p class="font-serif font-bold text-lg text-slate-900">
                            ₱{{ number_format((float) ($metrics['revenueThisMonth'] ?? 0), 2) }}
                        </p>
                    </div>
                    <span class="material-symbols-outlined text-[20px] text-emerald-600 leading-none">bar_chart</span>
                </div>
            </div>
        </div>
    </div>

    <div class="grid gap-4 grid-cols-1 lg:grid-cols-2 mt-4">
        <div class="border border-slate-100 rounded-2xl p-4 bg-slate-50/60">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-xs font-semibold text-slate-900">Appointment analytics</h3>
                <span class="text-[0.68rem] text-slate-400 uppercase tracking-widest">Today</span>
            </div>
            <p class="text-[0.72rem] text-slate-500 mb-2">
                Breakdown of today’s appointments by status.
            </p>
            <div class="overflow-x-auto scrollbar-hidden">
                <table class="min-w-full text-left text-xs text-slate-600">
                    <thead>
                        <tr class="border-b border-slate-100 text-[0.68rem] uppercase tracking-widest text-slate-400">
                            <th class="py-2 pr-4 font-semibold">Status</th>
                            <th class="py-2 pr-4 font-semibold">Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $statusRows = $reports['appointmentsByStatusToday'] ?? collect();
                        @endphp
                        @forelse ($statusRows as $row)
                            @php
                                $status = $row->status ?? 'unknown';
                            @endphp
                            <tr class="border-b border-slate-50 last:border-0">
                                <td class="py-2 pr-4 text-[0.78rem] text-slate-700">
                                    {{ ucfirst(str_replace('_', ' ', $status)) }}
                                </td>
                                <td class="py-2 pr-4 text-[0.78rem] text-slate-900">
                                    {{ (int) ($row->total_count ?? 0) }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="py-4 text-center text-[0.78rem] text-slate-400">
                                    No appointments recorded for today.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="border border-slate-100 rounded-2xl p-4 bg-slate-50/60">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-xs font-semibold text-slate-900">No-show tracking</h3>
                <span class="text-[0.68rem] text-slate-400 uppercase tracking-widest">Today</span>
            </div>
            <p class="text-[0.72rem] text-slate-500 mb-3">
                Count of appointments marked as no-show for today.
            </p>
            @php
                $noShowToday = (int) ($reports['noShowToday'] ?? 0);
            @endphp
            <div class="flex items-center justify-between rounded-2xl bg-white border border-slate-100 px-4 py-3">
                <div>
                    <p class="text-[0.7rem] text-slate-500 mb-0.5">No-shows today</p>
                    <p class="font-serif font-bold text-2xl text-slate-900">
                        {{ $noShowToday }}
                    </p>
                </div>
                <span class="material-symbols-outlined text-[26px] text-amber-500 leading-none">event_busy</span>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var focusSelect = document.getElementById('admin_analytics_focus')
        var cards = Array.prototype.slice.call(document.querySelectorAll('.admin-analytics-card'))

        function applyAnalyticsFilter() {
            var value = focusSelect ? focusSelect.value : 'all'
            cards.forEach(function (card) {
                var group = card.getAttribute('data-group') || ''
                if (value === 'all') {
                    card.style.display = ''
                } else {
                    card.style.display = group === value ? '' : 'none'
                }
            })
        }

        if (focusSelect) {
            focusSelect.addEventListener('change', applyAnalyticsFilter)
        }

        applyAnalyticsFilter()
    })
</script>
