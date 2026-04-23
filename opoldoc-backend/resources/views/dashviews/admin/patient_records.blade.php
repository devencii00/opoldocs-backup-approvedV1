<div class="bg-white border border-slate-200 rounded-[18px] p-5 shadow-[0_2px_10px_rgba(15,23,42,0.04)]">
    <div class="flex items-center justify-between mb-3">
        <h2 class="text-sm font-semibold text-slate-900">Patient records</h2>
        <span class="text-[0.7rem] text-slate-400 uppercase tracking-widest">Registry</span>
    </div>
    <p class="text-xs text-slate-500 mb-3">
        Recently registered patients with basic identifying information.
    </p>

    <div class="mb-3 flex flex-col gap-2 md:flex-row md:items-end">
        <div class="flex-1">
            <label for="admin_patient_search" class="block text-[0.7rem] text-slate-600 mb-1">Search patients</label>
            <input id="admin_patient_search" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Name, ID or contact">
        </div>
        <div class="w-full md:w-40">
            <label for="admin_patient_sort" class="block text-[0.7rem] text-slate-600 mb-1">Sort</label>
            <select id="admin_patient_sort" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                <option value="created_desc">Newest first</option>
                <option value="created_asc">Oldest first</option>
                <option value="name_asc">Name A–Z</option>
                <option value="name_desc">Name Z–A</option>
            </select>
        </div>
    </div>

    <div class="overflow-x-auto scrollbar-hidden">
        <table class="min-w-full text-left text-xs text-slate-600">
            <thead>
                <tr class="border-b border-slate-100 text-[0.68rem] uppercase tracking-widest text-slate-400">
                    <th class="py-2 pr-4 font-semibold">ID</th>
                    <th class="py-2 pr-4 font-semibold">Name</th>
                    <th class="py-2 pr-4 font-semibold">Contact</th>
                    <th class="py-2 pr-4 font-semibold">Verification status</th>
                    <th class="py-2 pr-4 font-semibold">Created</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($adminRecentPatients ?? [] as $patient)
                    @php
                        $name = trim(($patient->firstname ?? '') . ' ' . ($patient->lastname ?? ''));
                        $contact = $patient->contact_number ?? '';
                        $verification = \App\Models\PatientVerification::where('patient_id', $patient->user_id)->latest('verification_id')->first();
                        $statusName = $verification ? $verification->status : null;
                        $statusKey = $statusName ? strtolower($statusName) : null;
                        $statusColors = [
                            'active' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                            'inactive' => 'bg-slate-50 text-slate-600 border-slate-100',
                        ];
                        $statusClass = $statusColors[$statusKey] ?? 'bg-slate-50 text-slate-600 border-slate-100';
                    @endphp
                    <tr class="border-b border-slate-50 last:border-0 admin-patient-row"
                        data-patient-id="{{ $patient->user_id }}"
                        data-name="{{ strtolower($name) }}"
                        data-contact="{{ strtolower($contact) }}"
                        data-created="{{ optional($patient->created_at)->format('Y-m-d') ?? '' }}">
                        <td class="py-2 pr-4 text-[0.78rem] text-slate-500">#{{ $patient->user_id }}</td>
                        <td class="py-2 pr-4 text-[0.78rem] text-slate-700">
                            @if ($name)
                                {{ $name }}
                            @else
                                <span class="text-slate-400">Unknown</span>
                            @endif
                        </td>
                        <td class="py-2 pr-4 text-[0.78rem] text-slate-500">
                            @if ($contact)
                                {{ $contact }}
                            @else
                                <span class="text-slate-400">—</span>
                            @endif
                        </td>
                        <td class="py-2 pr-4 text-[0.78rem] text-slate-500">
                            @if ($statusName)
                                <span class="inline-flex items-center rounded-full px-2 py-0.5 text-[0.68rem] font-medium border {{ $statusClass }}">
                                    {{ ucfirst($statusName) }}
                                </span>
                            @else
                                <span class="text-slate-400 text-[0.7rem]">No record</span>
                            @endif
                        </td>
                        <td class="py-2 pr-4 text-[0.78rem] text-slate-500">
                            {{ optional($patient->created_at)->format('Y-m-d') ?? '—' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-4 text-center text-[0.78rem] text-slate-400">
                            No patients found yet.
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
        var searchInput = document.getElementById('admin_patient_search')
        var sortSelect = document.getElementById('admin_patient_sort')
        var rows = Array.prototype.slice.call(document.querySelectorAll('.admin-patient-row'))

        function applyPatientFilters() {
            var query = searchInput ? searchInput.value.toLowerCase().trim() : ''

            rows.forEach(function (row) {
                var id = row.getAttribute('data-patient-id') || ''
                var name = row.getAttribute('data-name') || ''
                var contact = row.getAttribute('data-contact') || ''

                var matches = true
                if (query) {
                    matches =
                        ('#' + id).indexOf(query) !== -1 ||
                        name.indexOf(query) !== -1 ||
                        contact.indexOf(query) !== -1
                }

                row.style.display = matches ? '' : 'none'
            })

            applyPatientSort()
        }

        function applyPatientSort() {
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
                var na = a.getAttribute('data-name') || ''
                var nb = b.getAttribute('data-name') || ''
                var ca = a.getAttribute('data-created') || ''
                var cb = b.getAttribute('data-created') || ''

                if (value === 'name_asc' || value === 'name_desc') {
                    if (na < nb) return value === 'name_asc' ? -1 : 1
                    if (na > nb) return value === 'name_asc' ? 1 : -1
                    return 0
                }

                if (ca < cb) return value === 'created_asc' ? -1 : 1
                if (ca > cb) return value === 'created_asc' ? 1 : -1
                return 0
            })

            visibleRows.forEach(function (row) {
                tbody.appendChild(row)
            })
        }

        if (searchInput) {
            searchInput.addEventListener('input', applyPatientFilters)
        }
        if (sortSelect) {
            sortSelect.addEventListener('change', applyPatientSort)
        }

        applyPatientFilters()
    })
</script>
