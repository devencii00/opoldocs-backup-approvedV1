<div class="bg-white border border-slate-200 rounded-[18px] p-5 shadow-[0_2px_10px_rgba(15,23,42,0.04)]">
    <div class="flex items-center justify-between mb-3">
        <h2 class="text-sm font-semibold text-slate-900">Audit logs</h2>
        <span class="text-[0.7rem] text-slate-400 uppercase tracking-widest">Security</span>
    </div>
    <p class="text-xs text-slate-500 mb-3">
        Recent system actions such as record changes or administrative updates.
    </p>

    <div class="mb-3 flex flex-col gap-2 md:flex-row md:items-end">
        <div class="flex-1">
            <label for="admin_audit_search" class="block text-[0.7rem] text-slate-600 mb-1">Search audit logs</label>
            <input id="admin_audit_search" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="User, table or action">
        </div>
        <div class="w-full md:w-40">
            <label for="admin_audit_sort" class="block text-[0.7rem] text-slate-600 mb-1">Sort</label>
            <select id="admin_audit_sort" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                <option value="date_desc">Newest first</option>
                <option value="date_asc">Oldest first</option>
            </select>
        </div>
    </div>

    <div class="overflow-x-auto scrollbar-hidden mb-4">
        <table class="min-w-full text-left text-xs text-slate-600">
            <thead>
                <tr class="border-b border-slate-100 text-[0.68rem] uppercase tracking-widest text-slate-400">
                    <th class="py-2 pr-4 font-semibold">When</th>
                    <th class="py-2 pr-4 font-semibold">User</th>
                    <th class="py-2 pr-4 font-semibold">Action</th>
                    <th class="py-2 pr-4 font-semibold">Record</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($adminRecentAuditLogs ?? [] as $log)
                    <tr class="border-b border-slate-50 last:border-0 admin-audit-row"
                        data-user="{{ strtolower($log->user ? $log->user->email : '') }}"
                        data-table="{{ strtolower($log->table_name ?? '') }}"
                        data-action="{{ strtolower($log->action ?? '') }}"
                        data-date="{{ optional($log->created_at)->format('Y-m-d H:i') ?? '' }}">
                        <td class="py-2 pr-4 text-[0.78rem] text-slate-500">
                            {{ optional($log->created_at)->format('Y-m-d H:i') ?? '—' }}
                        </td>
                        <td class="py-2 pr-4 text-[0.78rem] text-slate-700">
                            @if ($log->user)
                                {{ $log->user->email }}
                            @else
                                <span class="text-slate-400">System</span>
                            @endif
                        </td>
                        <td class="py-2 pr-4 text-[0.78rem] text-slate-500">
                            {{ $log->action ?? 'Action' }}
                        </td>
                        <td class="py-2 pr-4 text-[0.78rem] text-slate-500">
                            {{ $log->table_name }} #{{ $log->record_id }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-4 text-center text-[0.78rem] text-slate-400">
                            No audit logs recorded yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <div class="flex items-center justify-between mb-2">
            <h3 class="text-xs font-semibold text-slate-900">Record access logs</h3>
            <span class="text-[0.68rem] text-slate-400 uppercase tracking-widest">Views</span>
        </div>
        <div class="mb-3 flex flex-col gap-2 md:flex-row md:items-end">
            <div class="flex-1">
                <label for="admin_access_search" class="block text-[0.7rem] text-slate-600 mb-1">Search record access</label>
                <input id="admin_access_search" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="User, table or record ID">
            </div>
            <div class="w-full md:w-40">
                <label for="admin_access_sort" class="block text-[0.7rem] text-slate-600 mb-1">Sort</label>
                <select id="admin_access_sort" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                    <option value="date_desc">Newest first</option>
                    <option value="date_asc">Oldest first</option>
                </select>
            </div>
        </div>
        <div class="overflow-x-auto scrollbar-hidden">
            <table class="min-w-full text-left text-xs text-slate-600">
                <thead>
                    <tr class="border-b border-slate-100 text-[0.68rem] uppercase tracking-widest text-slate-400">
                        <th class="py-2 pr-4 font-semibold">When</th>
                        <th class="py-2 pr-4 font-semibold">User</th>
                        <th class="py-2 pr-4 font-semibold">Record</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($adminRecentAccessLogs ?? [] as $access)
                        <tr class="border-b border-slate-50 last:border-0 admin-access-row"
                            data-user="{{ strtolower($access->user ? $access->user->email : '') }}"
                            data-table="{{ strtolower($access->table_name ?? '') }}"
                            data-record="{{ $access->record_id }}"
                            data-date="{{ optional($access->accessed_at)->format('Y-m-d H:i') ?? '' }}">
                            <td class="py-2 pr-4 text-[0.78rem] text-slate-500">
                                {{ optional($access->accessed_at)->format('Y-m-d H:i') ?? '—' }}
                            </td>
                            <td class="py-2 pr-4 text-[0.78rem] text-slate-700">
                                @if ($access->user)
                                    {{ $access->user->email }}
                                @else
                                    <span class="text-slate-400">System</span>
                                @endif
                            </td>
                            <td class="py-2 pr-4 text-[0.78rem] text-slate-500">
                                {{ $access->table_name }} #{{ $access->record_id }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-4 text-center text-[0.78rem] text-slate-400">
                                No record access logs recorded yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var auditSearch = document.getElementById('admin_audit_search')
        var auditSort = document.getElementById('admin_audit_sort')
        var auditRows = Array.prototype.slice.call(document.querySelectorAll('.admin-audit-row'))

        function applyAuditFilters() {
            var query = auditSearch ? auditSearch.value.toLowerCase().trim() : ''

            auditRows.forEach(function (row) {
                var user = row.getAttribute('data-user') || ''
                var table = row.getAttribute('data-table') || ''
                var action = row.getAttribute('data-action') || ''

                var matches = true
                if (query) {
                    matches =
                        user.indexOf(query) !== -1 ||
                        table.indexOf(query) !== -1 ||
                        action.indexOf(query) !== -1
                }

                row.style.display = matches ? '' : 'none'
            })

            applyAuditSort()
        }

        function applyAuditSort() {
            if (!auditSort) {
                return
            }
            var value = auditSort.value
            var tbody = auditRows.length ? auditRows[0].parentNode : null
            if (!tbody) {
                return
            }

            var visibleRows = auditRows.filter(function (row) {
                return row.style.display !== 'none'
            })

            visibleRows.sort(function (a, b) {
                var da = a.getAttribute('data-date') || ''
                var db = b.getAttribute('data-date') || ''

                if (da < db) return value === 'date_asc' ? -1 : 1
                if (da > db) return value === 'date_asc' ? 1 : -1
                return 0
            })

            visibleRows.forEach(function (row) {
                tbody.appendChild(row)
            })
        }

        if (auditSearch) {
            auditSearch.addEventListener('input', applyAuditFilters)
        }
        if (auditSort) {
            auditSort.addEventListener('change', applyAuditSort)
        }

        applyAuditFilters()

        var accessSearch = document.getElementById('admin_access_search')
        var accessSort = document.getElementById('admin_access_sort')
        var accessRows = Array.prototype.slice.call(document.querySelectorAll('.admin-access-row'))

        function applyAccessFilters() {
            var query = accessSearch ? accessSearch.value.toLowerCase().trim() : ''

            accessRows.forEach(function (row) {
                var user = row.getAttribute('data-user') || ''
                var table = row.getAttribute('data-table') || ''
                var record = row.getAttribute('data-record') || ''

                var matches = true
                if (query) {
                    matches =
                        user.indexOf(query) !== -1 ||
                        table.indexOf(query) !== -1 ||
                        ('#' + record).indexOf(query) !== -1
                }

                row.style.display = matches ? '' : 'none'
            })

            applyAccessSort()
        }

        function applyAccessSort() {
            if (!accessSort) {
                return
            }
            var value = accessSort.value
            var tbody = accessRows.length ? accessRows[0].parentNode : null
            if (!tbody) {
                return
            }

            var visibleRows = accessRows.filter(function (row) {
                return row.style.display !== 'none'
            })

            visibleRows.sort(function (a, b) {
                var da = a.getAttribute('data-date') || ''
                var db = b.getAttribute('data-date') || ''

                if (da < db) return value === 'date_asc' ? -1 : 1
                if (da > db) return value === 'date_asc' ? 1 : -1
                return 0
            })

            visibleRows.forEach(function (row) {
                tbody.appendChild(row)
            })
        }

        if (accessSearch) {
            accessSearch.addEventListener('input', applyAccessFilters)
        }
        if (accessSort) {
            accessSort.addEventListener('change', applyAccessSort)
        }

        applyAccessFilters()
    })
</script>
