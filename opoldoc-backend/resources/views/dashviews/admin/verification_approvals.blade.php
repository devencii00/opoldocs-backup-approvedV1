<div class="bg-white border border-slate-200 rounded-[18px] p-5 shadow-[0_2px_10px_rgba(15,23,42,0.04)]">
    <div class="flex items-center justify-between mb-3">
        <h2 class="text-sm font-semibold text-slate-900">PWD / Senior verification</h2>
        <span class="text-[0.7rem] text-slate-400 uppercase tracking-widest">Discounts</span>
    </div>
    <p class="text-xs text-slate-500 mb-3">
        Latest verification requests for PWD and Senior discounts, with quick approve or reject actions.
    </p>

    <div class="mb-3 flex flex-col gap-2 md:flex-row md:items-end">
        <div class="flex-1">
            <label for="admin_verif_search" class="block text-[0.7rem] text-slate-600 mb-1">Search verifications</label>
            <input id="admin_verif_search" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Patient name or ID">
        </div>
        <div class="w-full md:w-40">
            <label for="admin_verif_status_filter" class="block text-[0.7rem] text-slate-600 mb-1">Status</label>
            <select id="admin_verif_status_filter" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                <option value="">All</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
        <div class="w-full md:w-40">
            <label for="admin_verif_sort" class="block text-[0.7rem] text-slate-600 mb-1">Sort</label>
            <select id="admin_verif_sort" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                <option value="date_desc">Newest first</option>
                <option value="date_asc">Oldest first</option>
            </select>
        </div>
    </div>

    <div class="overflow-x-auto scrollbar-hidden">
        <table class="min-w-full text-left text-xs text-slate-600">
            <thead>
                <tr class="border-b border-slate-100 text-[0.68rem] uppercase tracking-widest text-slate-400">
                    <th class="py-2 pr-4 font-semibold">ID</th>
                    <th class="py-2 pr-4 font-semibold">Patient</th>
                    <th class="py-2 pr-4 font-semibold">Type</th>
                    <th class="py-2 pr-4 font-semibold">Status</th>
                    <th class="py-2 pr-4 font-semibold">Uploaded</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($adminRecentVerifications ?? [] as $verification)
                    @php
                        $patient = $verification->patient;
                        $name = $patient ? trim(($patient->firstname ?? '') . ' ' . ($patient->lastname ?? '')) : '';
                    @endphp
                    <tr class="border-b border-slate-50 last:border-0 admin-verif-row"
                        data-id="{{ $verification->verification_id }}"
                        data-name="{{ strtolower($name) }}"
                        data-status="{{ strtolower($verification->status ?? '') }}"
                        data-date="{{ optional($verification->created_at)->format('Y-m-d') ?? '' }}">
                        <td class="py-2 pr-4 text-[0.78rem] text-slate-500">#{{ $verification->verification_id }}</td>
                        <td class="py-2 pr-4 text-[0.78rem] text-slate-700">
                            @if ($name)
                                {{ $name }}
                            @else
                                <span class="text-slate-400">Unknown</span>
                            @endif
                        </td>
                        <td class="py-2 pr-4 text-[0.78rem] text-slate-500">
                            {{ $verification->type ?? '—' }}
                        </td>
                        <td class="py-2 pr-4 text-[0.78rem]">
                            @php
                                $statusName = $verification->status;
                                $statusColors = [
                                    'active' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                                    'inactive' => 'bg-slate-50 text-slate-600 border-slate-100',
                                ];
                                $key = $statusName ? strtolower($statusName) : null;
                                $class = $statusColors[$key] ?? 'bg-slate-50 text-slate-600 border-slate-100';
                            @endphp
                            <span class="inline-flex items-center rounded-full px-2 py-0.5 text-[0.68rem] font-medium border {{ $class }}">
                                {{ ucfirst($statusName ?? 'Unknown') }}
                            </span>
                        </td>
                        <td class="py-2 pr-4 text-[0.78rem] text-slate-500">
                            {{ optional($verification->created_at)->format('Y-m-d') ?? '—' }}
                            @if ($statusName === 'active')
                                <div class="mt-1 flex gap-1">
                                    <button type="button" class="admin-verification-status inline-flex items-center rounded-full bg-slate-50 px-2 py-0.5 text-[0.68rem] font-semibold text-slate-700 border border-slate-200" data-id="{{ $verification->verification_id }}" data-status="inactive">
                                        Deactivate
                                    </button>
                                    <button type="button" class="admin-verification-status inline-flex items-center rounded-full bg-emerald-50 px-2 py-0.5 text-[0.68rem] font-semibold text-emerald-700 border border-emerald-100" data-id="{{ $verification->verification_id }}" data-status="active">
                                        Activate
                                    </button>
                                </div>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-4 text-center text-[0.78rem] text-slate-400">
                            No verification records found yet.
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
        var buttons = document.querySelectorAll('.admin-verification-status')
        buttons.forEach(function (button) {
            button.addEventListener('click', function () {
                var id = this.getAttribute('data-id')
                var status = this.getAttribute('data-status')
                if (!id || !status) {
                    return
                }

                apiFetch("{{ url('/api/patient-verifications') }}/" + id, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ status: status })
                })
                    .then(function (response) {
                        return response.json().then(function (data) {
                            return { ok: response.ok, data: data }
                        })
                    })
                    .then(function (result) {
                        if (!result.ok) {
                            return
                        }
                        window.location.reload()
                    })
                    .catch(function () {
                    })
            })
        })

        var searchInput = document.getElementById('admin_verif_search')
        var statusFilter = document.getElementById('admin_verif_status_filter')
        var sortSelect = document.getElementById('admin_verif_sort')
        var rows = Array.prototype.slice.call(document.querySelectorAll('.admin-verif-row'))

        function applyVerifFilters() {
            var query = searchInput ? searchInput.value.toLowerCase().trim() : ''
            var status = statusFilter ? statusFilter.value.toLowerCase() : ''

            rows.forEach(function (row) {
                var id = row.getAttribute('data-id') || ''
                var name = row.getAttribute('data-name') || ''
                var rowStatus = row.getAttribute('data-status') || ''

                var matchesSearch = true
                if (query) {
                    matchesSearch =
                        ('#' + id).indexOf(query) !== -1 ||
                        name.indexOf(query) !== -1
                }

                var matchesStatus = true
                if (status) {
                    matchesStatus = rowStatus === status
                }

                row.style.display = matchesSearch && matchesStatus ? '' : 'none'
            })

            applyVerifSort()
        }

        function applyVerifSort() {
            if (!sortSelect) {
                return
            }
            var value = sortSelect.value
            var tbody = rows.length ? rows[0].parentNode : null
            if (!tbody) {
                return
            }

            var visibleRows = rows.filter(function (row) {
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

        if (searchInput) {
            searchInput.addEventListener('input', applyVerifFilters)
        }
        if (statusFilter) {
            statusFilter.addEventListener('change', applyVerifFilters)
        }
        if (sortSelect) {
            sortSelect.addEventListener('change', applyVerifSort)
        }

        applyVerifFilters()
    })
</script>
