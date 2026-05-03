<div class="bg-white border border-slate-200 rounded-[18px] p-5 shadow-[0_2px_10px_rgba(15,23,42,0.04)]">
    <div class="flex items-center justify-between mb-3">
        <h2 class="text-sm font-semibold text-slate-900">Patient Records</h2>
        <span class="text-[0.7rem] text-slate-400 uppercase tracking-widest">Clinical</span>
    </div>
    <p class="text-xs text-slate-500 mb-4">
        Review patient medical backgrounds and visit history.
    </p>

    <div id="adminPrPatientsError" class="hidden mb-3 rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-[0.75rem] text-red-700"></div>

    <div class="mb-3 flex flex-col gap-2 md:flex-row md:items-end">
        <div class="flex-1">
            <label for="admin_pr_patients_search" class="block text-[0.7rem] text-slate-600 mb-1">Search patient name</label>
            <input id="admin_pr_patients_search" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Search by name (starts with)">
        </div>
    </div>

    <div class="mb-4">
        <div class="text-[0.7rem] text-slate-600 mb-1">Age filter</div>
        <div class="flex flex-wrap items-center gap-2">
            <button type="button" class="admin-pr-age-filter px-3 py-1.5 rounded-xl border border-slate-200 bg-cyan-600 text-white text-[0.72rem] font-semibold" data-age-filter="all">
                All
                <span id="adminPrAgeCountAll" class="ml-1 inline-flex items-center rounded-full bg-white/15 px-2 py-0.5 text-[0.68rem] font-semibold">0</span>
            </button>
            <button type="button" class="admin-pr-age-filter px-3 py-1.5 rounded-xl border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 text-[0.72rem] font-semibold" data-age-filter="1_5">
                1–5
                <span id="adminPrAgeCount1_5" class="ml-1 inline-flex items-center rounded-full bg-slate-100 px-2 py-0.5 text-[0.68rem] font-semibold text-slate-700">0</span>
            </button>
            <button type="button" class="admin-pr-age-filter px-3 py-1.5 rounded-xl border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 text-[0.72rem] font-semibold" data-age-filter="6_12">
                6–12
                <span id="adminPrAgeCount6_12" class="ml-1 inline-flex items-center rounded-full bg-slate-100 px-2 py-0.5 text-[0.68rem] font-semibold text-slate-700">0</span>
            </button>
            <button type="button" class="admin-pr-age-filter px-3 py-1.5 rounded-xl border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 text-[0.72rem] font-semibold" data-age-filter="13_18">
                13–18
                <span id="adminPrAgeCount13_18" class="ml-1 inline-flex items-center rounded-full bg-slate-100 px-2 py-0.5 text-[0.68rem] font-semibold text-slate-700">0</span>
            </button>
            <button type="button" class="admin-pr-age-filter px-3 py-1.5 rounded-xl border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 text-[0.72rem] font-semibold" data-age-filter="19_30">
                19–30
                <span id="adminPrAgeCount19_30" class="ml-1 inline-flex items-center rounded-full bg-slate-100 px-2 py-0.5 text-[0.68rem] font-semibold text-slate-700">0</span>
            </button>
            <button type="button" class="admin-pr-age-filter px-3 py-1.5 rounded-xl border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 text-[0.72rem] font-semibold" data-age-filter="31_up">
                31+
                <span id="adminPrAgeCount31Up" class="ml-1 inline-flex items-center rounded-full bg-slate-100 px-2 py-0.5 text-[0.68rem] font-semibold text-slate-700">0</span>
            </button>
        </div>
    </div>

    <div class="overflow-x-auto scrollbar-hidden">
        <table class="min-w-full text-left text-xs text-slate-600">
            <thead>
                <tr class="border-b border-slate-100 text-[0.68rem] uppercase tracking-widest text-slate-400">
                    <th class="py-2 pr-4 font-semibold">Patient</th>
                    <th class="py-2 pr-4 font-semibold">Address</th>
                    <th class="py-2 pr-4 font-semibold">Age</th>
                    <th class="py-2 pr-4 font-semibold">Action</th>
                </tr>
            </thead>
            <tbody id="admin_pr_patients_table_body">
                <tr>
                    <td colspan="4" class="py-4 text-center text-[0.78rem] text-slate-400">
                        Loading patients…
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div id="adminPrSlideoverOverlay" class="fixed inset-0 z-50 bg-black/30 opacity-0 pointer-events-none transition-opacity"></div>
<div id="adminPrSlideoverPanel" class="fixed top-0 right-0 z-50 h-full w-full max-w-[560px] bg-white border-l border-slate-200 shadow-2xl translate-x-full transition-transform">
    <div class="h-full flex flex-col">
        <div class="flex items-start justify-between gap-3 p-5 border-b border-slate-100">
            <div class="min-w-0">
                <div id="adminPrPanelPatientName" class="text-sm font-semibold text-slate-900 truncate">Patient</div>
                <div id="adminPrPanelPatientMeta" class="text-xs text-slate-500 mt-0.5 truncate"></div>
            </div>
            <button type="button" id="adminPrPanelClose" class="inline-flex items-center justify-center w-9 h-9 rounded-xl border border-slate-200 text-slate-500 hover:bg-slate-50 hover:text-slate-800">
                <span class="material-symbols-outlined text-[18px] leading-none">close</span>
            </button>
        </div>

        <div class="p-5 border-b border-slate-100">
            <div class="grid grid-cols-2 gap-3">
                <div class="rounded-xl border border-slate-200 bg-slate-50 px-3 py-2">
                    <div class="text-[0.68rem] uppercase tracking-widest text-slate-400">Verification status</div>
                    <div id="adminPrPanelVerificationStatus" class="text-[0.8rem] font-semibold text-slate-700 mt-1">—</div>
                </div>
                <div class="rounded-xl border border-slate-200 bg-slate-50 px-3 py-2">
                    <div class="text-[0.68rem] uppercase tracking-widest text-slate-400">Patient type</div>
                    <div id="adminPrPanelPatientType" class="text-[0.8rem] font-semibold text-slate-700 mt-1">—</div>
                </div>
            </div>
        </div>

        <div class="px-5 pt-4">
            <div class="flex items-center gap-2">
                <button type="button" id="adminPrPanelTabBackground" class="px-3 py-2 rounded-xl text-[0.78rem] font-semibold border border-slate-200 bg-cyan-600 text-white">Medical background</button>
                <button type="button" id="adminPrPanelTabVisits" class="px-3 py-2 rounded-xl text-[0.78rem] font-semibold border border-slate-200 bg-white text-slate-700 hover:bg-slate-50">Visit history</button>
            </div>
        </div>

        <div class="flex-1 overflow-y-auto scrollbar-hidden">
            <div id="adminPrPanelPanelBackground" class="p-5">
                <div id="adminPrPanelMedBgError" class="hidden mb-3 rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-[0.75rem] text-red-700"></div>
                <div class="overflow-x-auto scrollbar-hidden">
                    <table class="min-w-full text-left text-xs text-slate-600">
                        <thead>
                            <tr class="border-b border-slate-100 text-[0.68rem] uppercase tracking-widest text-slate-400">
                                <th class="py-2 pr-4 font-semibold">Category</th>
                                <th class="py-2 pr-4 font-semibold">Name</th>
                                <th class="py-2 pr-4 font-semibold">Notes</th>
                                <th class="py-2 pr-4 font-semibold">Created</th>
                            </tr>
                        </thead>
                        <tbody id="adminPrPanelMedBgTableBody">
                            <tr>
                                <td colspan="4" class="py-4 text-center text-[0.78rem] text-slate-400">
                                    Select a patient to view entries.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="adminPrPanelPanelVisits" class="p-5 hidden">
                <div id="adminPrPanelVisitsError" class="hidden mb-3 rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-[0.75rem] text-red-700"></div>
                <div class="overflow-x-auto scrollbar-hidden">
                    <table class="min-w-full text-left text-xs text-slate-600">
                        <thead>
                            <tr class="border-b border-slate-100 text-[0.68rem] uppercase tracking-widest text-slate-400">
                                <th class="py-2 pr-4 font-semibold">Transaction</th>
                                <th class="py-2 pr-4 font-semibold">Appointment</th>
                                <th class="py-2 pr-4 font-semibold">Doctor</th>
                                <th class="py-2 pr-4 font-semibold">Visit date</th>
                                <th class="py-2 pr-4 font-semibold">Amount</th>
                            </tr>
                        </thead>
                        <tbody id="adminPrPanelVisitsTableBody">
                            <tr>
                                <td colspan="5" class="py-4 text-center text-[0.78rem] text-slate-400">
                                    Select a patient to view visits.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var patientsError = document.getElementById('adminPrPatientsError')
        var patientsSearch = document.getElementById('admin_pr_patients_search')
        var patientsTableBody = document.getElementById('admin_pr_patients_table_body')
        var patientsRows = []

        var activeAgeFilter = 'all'
        var ageFilterButtons = Array.prototype.slice.call(document.querySelectorAll('.admin-pr-age-filter'))
        var ageCountAll = document.getElementById('adminPrAgeCountAll')
        var ageCount1_5 = document.getElementById('adminPrAgeCount1_5')
        var ageCount6_12 = document.getElementById('adminPrAgeCount6_12')
        var ageCount13_18 = document.getElementById('adminPrAgeCount13_18')
        var ageCount19_30 = document.getElementById('adminPrAgeCount19_30')
        var ageCount31Up = document.getElementById('adminPrAgeCount31Up')

        var overlay = document.getElementById('adminPrSlideoverOverlay')
        var panel = document.getElementById('adminPrSlideoverPanel')
        var panelClose = document.getElementById('adminPrPanelClose')
        var panelPatientName = document.getElementById('adminPrPanelPatientName')
        var panelPatientMeta = document.getElementById('adminPrPanelPatientMeta')
        var panelVerificationStatus = document.getElementById('adminPrPanelVerificationStatus')
        var panelPatientType = document.getElementById('adminPrPanelPatientType')

        var panelTabBackground = document.getElementById('adminPrPanelTabBackground')
        var panelTabVisits = document.getElementById('adminPrPanelTabVisits')
        var panelBackground = document.getElementById('adminPrPanelPanelBackground')
        var panelVisits = document.getElementById('adminPrPanelPanelVisits')

        var panelMedBgError = document.getElementById('adminPrPanelMedBgError')
        var panelMedBgTableBody = document.getElementById('adminPrPanelMedBgTableBody')

        var panelVisitsError = document.getElementById('adminPrPanelVisitsError')
        var panelVisitsTableBody = document.getElementById('adminPrPanelVisitsTableBody')

        var currentPatientId = null

        function escapeHtml(text) {
            return String(text || '')
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;')
        }

        function showInlineBox(el, message) {
            if (!el) return
            el.textContent = message || ''
            el.classList.toggle('hidden', !message)
        }

        function categoryLabel(key) {
            var k = String(key || '')
            if (k === 'allergy_food') return 'Food'
            if (k === 'allergy_drug') return 'Drug'
            if (k === 'condition') return 'Condition'
            return k || '—'
        }

        function fullName(p, fallback) {
            if (!p) return fallback || '—'
            var parts = []
            if (p.firstname) parts.push(String(p.firstname))
            if (p.middlename) parts.push(String(p.middlename))
            if (p.lastname) parts.push(String(p.lastname))
            var name = parts.join(' ').trim()
            if (name) return name
            if (p.email) return String(p.email)
            return fallback || ('#' + (p.user_id || ''))
        }

        function nameOnly(p) {
            if (!p) return ''
            var parts = []
            if (p.firstname) parts.push(String(p.firstname))
            if (p.middlename) parts.push(String(p.middlename))
            if (p.lastname) parts.push(String(p.lastname))
            return parts.join(' ').trim()
        }

        function ageFromBirthdate(birthdate) {
            if (!birthdate) return null
            var d = new Date(String(birthdate))
            if (isNaN(d.getTime())) return null
            var today = new Date()
            var age = today.getFullYear() - d.getFullYear()
            var m = today.getMonth() - d.getMonth()
            if (m < 0 || (m === 0 && today.getDate() < d.getDate())) {
                age--
            }
            if (age < 0) return null
            return age
        }

        function matchesAgeFilter(age, filterKey) {
            if (filterKey === 'all') return true
            if (age == null) return false
            if (filterKey === '1_5') return age >= 1 && age <= 5
            if (filterKey === '6_12') return age >= 6 && age <= 12
            if (filterKey === '13_18') return age >= 13 && age <= 18
            if (filterKey === '19_30') return age >= 19 && age <= 30
            if (filterKey === '31_up') return age >= 31
            return true
        }

        function setAgeFilterActiveStyles() {
            ageFilterButtons.forEach(function (btn) {
                var key = btn.getAttribute('data-age-filter') || ''
                var isActive = key === activeAgeFilter
                btn.classList.remove(
                    'bg-cyan-600',
                    'text-white',
                    'bg-cyan-600',
                    'bg-white',
                    'text-slate-700',
                    'border-slate-200',
                    'hover:bg-slate-50'
                )
                if (isActive) {
                    btn.classList.add('bg-cyan-600', 'text-white', 'border-cyan-600')
                } else {
                    btn.classList.add('bg-white', 'text-slate-700', 'border-slate-200', 'hover:bg-slate-50')
                }
            })
        }

        function setText(el, text) {
            if (!el) return
            el.textContent = text == null ? '' : String(text)
        }

        function openPanel() {
            if (overlay) {
                overlay.classList.remove('opacity-0', 'pointer-events-none')
                overlay.classList.add('opacity-100', 'pointer-events-auto')
            }
            if (panel) {
                panel.classList.remove('translate-x-full')
                panel.classList.add('translate-x-0')
            }
        }

        function closePanel() {
            currentPatientId = null
            if (overlay) {
                overlay.classList.add('opacity-0', 'pointer-events-none')
                overlay.classList.remove('opacity-100', 'pointer-events-auto')
            }
            if (panel) {
                panel.classList.add('translate-x-full')
                panel.classList.remove('translate-x-0')
            }
        }

        function setTabButtonActive(btn, isActive) {
            if (!btn) return
            btn.classList.remove(
                'bg-cyan-600',
                'text-white',
                'border-cyan-600',
                'bg-white',
                'text-slate-700',
                'border-slate-200',
                'hover:bg-slate-50'
            )
            if (isActive) {
                btn.classList.add('bg-cyan-600', 'text-white', 'border-cyan-600')
            } else {
                btn.classList.add('bg-white', 'text-slate-700', 'border-slate-200', 'hover:bg-slate-50')
            }
        }

        function setPanelTab(key) {
            var isBackground = key !== 'visits'
            if (panelBackground) panelBackground.classList.toggle('hidden', !isBackground)
            if (panelVisits) panelVisits.classList.toggle('hidden', isBackground)
            setTabButtonActive(panelTabBackground, isBackground)
            setTabButtonActive(panelTabVisits, !isBackground)
        }

        function loadPatients() {
            if (!patientsTableBody) return
            patientsTableBody.innerHTML = '<tr><td colspan="4" class="py-4 text-center text-[0.78rem] text-slate-400">Loading patients…</td></tr>'
            showInlineBox(patientsError, '')

            var perPage = 100
            var all = []

            function fetchPage(page) {
                return apiFetch("{{ url('/api/patients') }}?per_page=" + perPage + "&page=" + encodeURIComponent(page), { method: 'GET' })
                    .then(function (response) {
                        return response.json().then(function (data) {
                            return { ok: response.ok, data: data }
                        }).catch(function () {
                            return { ok: response.ok, data: null }
                        })
                    })
                    .then(function (result) {
                        if (!result.ok || !result.data) {
                            throw new Error('LOAD_FAILED')
                        }

                        var pageRows = Array.isArray(result.data.data)
                            ? result.data.data
                            : (Array.isArray(result.data) ? result.data : [])

                        all = all.concat(pageRows)

                        var currentPage = (result.data && result.data.current_page) ? parseInt(result.data.current_page, 10) : page
                        var lastPage = (result.data && result.data.last_page) ? parseInt(result.data.last_page, 10) : currentPage

                        if (currentPage < lastPage) {
                            return fetchPage(currentPage + 1)
                        }
                        return all
                    })
            }

            fetchPage(1)
                .then(function (rows) {
                    patientsRows = Array.isArray(rows) ? rows : []
                    renderPatients()
                })
                .catch(function () {
                    patientsRows = []
                    showInlineBox(patientsError, 'Failed to load patients.')
                    renderPatients()
                })
        }

        function renderPatients() {
            if (!patientsTableBody) return
            var query = patientsSearch ? String(patientsSearch.value || '').toLowerCase().trim() : ''
            var base = (patientsRows || []).slice()

            if (query) {
                base = base.filter(function (p) {
                    var name = nameOnly(p).toLowerCase()
                    return name !== '' && name.indexOf(query) === 0
                })
            }

            var counts = {
                all: 0,
                '1_5': 0,
                '6_12': 0,
                '13_18': 0,
                '19_30': 0,
                '31_up': 0
            }

            base.forEach(function (p) {
                var age = ageFromBirthdate(p && p.birthdate ? String(p.birthdate) : null)
                counts.all++
                if (matchesAgeFilter(age, '1_5')) counts['1_5']++
                if (matchesAgeFilter(age, '6_12')) counts['6_12']++
                if (matchesAgeFilter(age, '13_18')) counts['13_18']++
                if (matchesAgeFilter(age, '19_30')) counts['19_30']++
                if (matchesAgeFilter(age, '31_up')) counts['31_up']++
            })

            setText(ageCountAll, counts.all)
            setText(ageCount1_5, counts['1_5'])
            setText(ageCount6_12, counts['6_12'])
            setText(ageCount13_18, counts['13_18'])
            setText(ageCount19_30, counts['19_30'])
            setText(ageCount31Up, counts['31_up'])

            var filtered = base.filter(function (p) {
                var age = ageFromBirthdate(p && p.birthdate ? String(p.birthdate) : null)
                return matchesAgeFilter(age, activeAgeFilter)
            })

            filtered.sort(function (a, b) {
                var na = nameOnly(a).toLowerCase()
                var nb = nameOnly(b).toLowerCase()
                if (na < nb) return -1
                if (na > nb) return 1
                var ia = a && a.user_id != null ? parseInt(a.user_id, 10) : 0
                var ib = b && b.user_id != null ? parseInt(b.user_id, 10) : 0
                if (ia < ib) return -1
                if (ia > ib) return 1
                return 0
            })

            if (!filtered.length) {
                patientsTableBody.innerHTML = '<tr><td colspan="4" class="py-4 text-center text-[0.78rem] text-slate-400">No patients found.</td></tr>'
                return
            }

            var html = ''
            filtered.forEach(function (p) {
                var pid = p && p.user_id != null ? String(p.user_id) : ''
                var name = fullName(p, 'Patient')
                var address = p && p.address ? String(p.address) : ''
                var age = ageFromBirthdate(p && p.birthdate ? String(p.birthdate) : null)
                html += '<tr class="border-b border-slate-50 last:border-0">' +
                    '<td class="py-2 pr-4 text-[0.78rem] text-slate-700">' + escapeHtml(name) + '</td>' +
                    '<td class="py-2 pr-4 text-[0.78rem] text-slate-500">' + (address ? escapeHtml(address) : '<span class="text-slate-400">—</span>') + '</td>' +
                    '<td class="py-2 pr-4 text-[0.78rem] text-slate-500">' + (age != null ? escapeHtml(age) : '<span class="text-slate-400">—</span>') + '</td>' +
                    '<td class="py-2 pr-4">' +
                        '<button type="button" class="admin-pr-open-panel inline-flex items-center gap-2 px-3 py-2 rounded-xl border border-slate-200 bg-white text-slate-700 text-[0.78rem] font-semibold hover:bg-slate-50" data-patient-id="' + escapeHtml(pid) + '">' +
                            'View background and visit history' +
                        '</button>' +
                    '</td>' +
                '</tr>'
            })
            patientsTableBody.innerHTML = html
        }

        function findPatientById(patientId) {
            var pid = String(patientId || '')
            for (var i = 0; i < (patientsRows || []).length; i++) {
                var p = patientsRows[i]
                if (p && String(p.user_id) === pid) {
                    return p
                }
            }
            return null
        }

        function renderPanelMedicalBackground(entries) {
            if (!panelMedBgTableBody) return
            if (!entries || !entries.length) {
                panelMedBgTableBody.innerHTML = '<tr><td colspan="4" class="py-4 text-center text-[0.78rem] text-slate-400">No medical background entries found.</td></tr>'
                return
            }
            var html = ''
            entries.forEach(function (r) {
                var created = r && r.created_at ? String(r.created_at).slice(0, 10) : '—'
                html += '<tr class="border-b border-slate-50 last:border-0">' +
                    '<td class="py-2 pr-4 text-[0.78rem] text-slate-500">' + escapeHtml(categoryLabel(r.category)) + '</td>' +
                    '<td class="py-2 pr-4 text-[0.78rem] text-slate-700">' + escapeHtml(r && r.name ? String(r.name) : '—') + '</td>' +
                    '<td class="py-2 pr-4 text-[0.78rem] text-slate-500">' + (r && r.notes ? escapeHtml(String(r.notes)) : '<span class="text-slate-400">—</span>') + '</td>' +
                    '<td class="py-2 pr-4 text-[0.78rem] text-slate-500">' + escapeHtml(created) + '</td>' +
                '</tr>'
            })
            panelMedBgTableBody.innerHTML = html
        }

        function renderPanelVisits(rows) {
            if (!panelVisitsTableBody) return
            if (!rows || !rows.length) {
                panelVisitsTableBody.innerHTML = '<tr><td colspan="5" class="py-4 text-center text-[0.78rem] text-slate-400">No visits found.</td></tr>'
                return
            }
            var html = ''
            rows.forEach(function (v) {
                var txnId = v && v.transaction_id != null ? String(v.transaction_id) : ''
                var apptId = v && v.appointment_id != null ? String(v.appointment_id) : ''
                var appt = v && v.appointment ? v.appointment : null
                var doctor = appt && appt.doctor ? appt.doctor : null
                var dateRaw = v && (v.visit_datetime || v.transaction_datetime) ? String(v.visit_datetime || v.transaction_datetime) : ''
                var dateText = dateRaw ? dateRaw.replace('T', ' ').slice(0, 16) : '—'
                var amount = v && v.amount != null ? ('₱' + parseFloat(v.amount || 0).toFixed(2)) : '—'

                html += '<tr class="border-b border-slate-50 last:border-0">' +
                    '<td class="py-2 pr-4 text-[0.78rem] text-slate-700">#' + escapeHtml(txnId || '—') + '</td>' +
                    '<td class="py-2 pr-4 text-[0.78rem] text-slate-500">' + (apptId ? ('#' + escapeHtml(apptId)) : '<span class="text-slate-400">—</span>') + '</td>' +
                    '<td class="py-2 pr-4 text-[0.78rem] text-slate-700">' + escapeHtml(fullName(doctor, 'Doctor')) + '</td>' +
                    '<td class="py-2 pr-4 text-[0.78rem] text-slate-500">' + escapeHtml(dateText) + '</td>' +
                    '<td class="py-2 pr-4 text-[0.78rem] text-slate-700">' + escapeHtml(amount) + '</td>' +
                '</tr>'
            })
            panelVisitsTableBody.innerHTML = html
        }

        function loadPatientPanelData(patientId) {
            currentPatientId = String(patientId || '')
            showInlineBox(panelMedBgError, '')
            showInlineBox(panelVisitsError, '')

            if (panelVerificationStatus) panelVerificationStatus.textContent = '—'
            if (panelPatientType) panelPatientType.textContent = '—'

            if (panelMedBgTableBody) {
                panelMedBgTableBody.innerHTML = '<tr><td colspan="4" class="py-4 text-center text-[0.78rem] text-slate-400">Loading entries…</td></tr>'
            }
            if (panelVisitsTableBody) {
                panelVisitsTableBody.innerHTML = '<tr><td colspan="5" class="py-4 text-center text-[0.78rem] text-slate-400">Loading visits…</td></tr>'
            }

            var medBgReq = apiFetch("{{ url('/api/medical-backgrounds') }}?per_page=100&patient_id=" + encodeURIComponent(currentPatientId), { method: 'GET' })
                .then(function (response) {
                    return response.json().then(function (data) {
                        return { ok: response.ok, data: data }
                    }).catch(function () {
                        return { ok: response.ok, data: null }
                    })
                })

            var visitsReq = apiFetch("{{ url('/api/visits') }}?per_page=100&patient_id=" + encodeURIComponent(currentPatientId), { method: 'GET' })
                .then(function (response) {
                    return response.json().then(function (data) {
                        return { ok: response.ok, data: data }
                    }).catch(function () {
                        return { ok: response.ok, data: null }
                    })
                })

            var verificationReq = apiFetch("{{ url('/api/patient-verifications') }}?per_page=1&patient_id=" + encodeURIComponent(currentPatientId), { method: 'GET' })
                .then(function (response) {
                    return response.json().then(function (data) {
                        return { ok: response.ok, data: data }
                    }).catch(function () {
                        return { ok: response.ok, data: null }
                    })
                })

            Promise.all([medBgReq, visitsReq, verificationReq])
                .then(function (results) {
                    if (String(patientId || '') !== currentPatientId) {
                        return
                    }

                    var medBgRes = results[0]
                    if (!medBgRes || !medBgRes.ok || !medBgRes.data) {
                        showInlineBox(panelMedBgError, 'Failed to load medical background entries.')
                        renderPanelMedicalBackground([])
                    } else {
                        var medBgRows = Array.isArray(medBgRes.data.data) ? medBgRes.data.data : (Array.isArray(medBgRes.data) ? medBgRes.data : [])
                        renderPanelMedicalBackground(medBgRows)
                    }

                    var visitsRes = results[1]
                    if (!visitsRes || !visitsRes.ok || !visitsRes.data) {
                        showInlineBox(panelVisitsError, 'Failed to load visits.')
                        renderPanelVisits([])
                    } else {
                        var visitRows = Array.isArray(visitsRes.data.data) ? visitsRes.data.data : (Array.isArray(visitsRes.data) ? visitsRes.data : [])
                        renderPanelVisits(visitRows)
                    }

                    var verRes = results[2]
                    if (!verRes || !verRes.ok || !verRes.data) {
                        if (panelVerificationStatus) panelVerificationStatus.textContent = '—'
                        if (panelPatientType) panelPatientType.textContent = '—'
                    } else {
                        var verRows = Array.isArray(verRes.data.data) ? verRes.data.data : (Array.isArray(verRes.data) ? verRes.data : [])
                        var latest = verRows && verRows.length ? verRows[0] : null
                        if (panelVerificationStatus) {
                            panelVerificationStatus.textContent = latest && latest.status ? String(latest.status) : 'Not submitted'
                        }
                        if (panelPatientType) {
                            panelPatientType.textContent = latest && latest.type ? String(latest.type) : '—'
                        }
                    }
                })
                .catch(function () {
                    if (String(patientId || '') !== currentPatientId) {
                        return
                    }
                    showInlineBox(panelMedBgError, 'Network error while loading medical background entries.')
                    showInlineBox(panelVisitsError, 'Network error while loading visits.')
                    renderPanelMedicalBackground([])
                    renderPanelVisits([])
                })
        }

        if (patientsSearch) patientsSearch.addEventListener('input', renderPatients)

        if (ageFilterButtons && ageFilterButtons.length) {
            ageFilterButtons.forEach(function (btn) {
                btn.addEventListener('click', function () {
                    var next = this.getAttribute('data-age-filter') || 'all'
                    activeAgeFilter = next
                    setAgeFilterActiveStyles()
                    renderPatients()
                })
            })
        }

        if (patientsTableBody) {
            patientsTableBody.addEventListener('click', function (e) {
                var target = e && e.target ? e.target : null
                var btn = target && target.closest ? target.closest('.admin-pr-open-panel') : null
                if (!btn) return

                var patientId = btn.getAttribute('data-patient-id')
                if (!patientId) return

                var patient = findPatientById(patientId)
                var name = fullName(patient, 'Patient')
                var address = patient && patient.address ? String(patient.address) : ''
                var age = ageFromBirthdate(patient && patient.birthdate ? String(patient.birthdate) : null)

                if (panelPatientName) panelPatientName.textContent = name
                var metaParts = []
                if (address) metaParts.push(address)
                if (age != null) metaParts.push('Age ' + String(age))
                if (panelPatientMeta) panelPatientMeta.textContent = metaParts.join(' • ')

                setPanelTab('background')
                openPanel()
                loadPatientPanelData(patientId)
            })
        }

        closePanel()

        if (panelClose) panelClose.addEventListener('click', closePanel)
        if (overlay) overlay.addEventListener('click', closePanel)

        if (panelTabBackground) panelTabBackground.addEventListener('click', function () { setPanelTab('background') })
        if (panelTabVisits) panelTabVisits.addEventListener('click', function () { setPanelTab('visits') })

        setAgeFilterActiveStyles()
        renderPatients()
        loadPatients()
    })
</script>
