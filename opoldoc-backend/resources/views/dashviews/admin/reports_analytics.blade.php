<div class="bg-white border border-slate-200 rounded-[18px] p-5 shadow-[0_2px_10px_rgba(15,23,42,0.04)]">
    <div class="flex items-center justify-between mb-3">
        <h2 class="text-sm font-semibold text-slate-900">Reports & analytics</h2>
        <span class="text-[0.7rem] text-slate-400 uppercase tracking-widest">Summary</span>
    </div>
    <p class="text-xs text-slate-500 mb-3">
        High-level KPIs derived from live data. Detailed drill-downs can be added later on top of this foundation.
    </p>

    @php
        $metrics = $adminMetrics ?? [];
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

    <div class="grid gap-3 grid-cols-1 sm:grid-cols-2">
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
