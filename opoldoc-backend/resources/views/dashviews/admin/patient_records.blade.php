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
            <label for="admin_pr_patients_search" class="block text-[0.7rem] text-slate-600 mb-1">Search patient</label>
            <input id="admin_pr_patients_search" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Name, email, or address">
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
                <button type="button" id="adminPrPanelTabBackground" class="px-3 py-2 rounded-xl text-[0.78rem] font-semibold border border-slate-200 bg-slate-900 text-white">Medical background</button>
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
                'bg-slate-900',
                'text-white',
                'border-slate-900',
                'bg-white',
                'text-slate-700',
                'border-slate-200',
                'hover:bg-slate-50'
            )
            if (isActive) {
                btn.classList.add('bg-slate-900', 'text-white', 'border-slate-900')
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

            apiFetch("{{ url('/api/patients') }}?per_page=100", { method: 'GET' })
                .then(function (response) {
                    return response.json().then(function (data) {
                        return { ok: response.ok, data: data }
                    }).catch(function () {
                        return { ok: response.ok, data: null }
                    })
                })
                .then(function (result) {
                    if (!result.ok || !result.data) {
                        patientsRows = []
                        showInlineBox(patientsError, 'Failed to load patients.')
                        renderPatients()
                        return
                    }
                    patientsRows = Array.isArray(result.data.data) ? result.data.data : (Array.isArray(result.data) ? result.data : [])
                    renderPatients()
                })
                .catch(function () {
                    patientsRows = []
                    showInlineBox(patientsError, 'Network error while loading patients.')
                    renderPatients()
                })
        }

        function renderPatients() {
            if (!patientsTableBody) return
            var query = patientsSearch ? String(patientsSearch.value || '').toLowerCase().trim() : ''
            var filtered = (patientsRows || []).slice()

            if (query) {
                filtered = filtered.filter(function (p) {
                    var name = fullName(p, '').toLowerCase()
                    var email = p && p.email ? String(p.email).toLowerCase() : ''
                    var address = p && p.address ? String(p.address).toLowerCase() : ''
                    return name.indexOf(query) !== -1 || email.indexOf(query) !== -1 || address.indexOf(query) !== -1
                })
            }

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

        loadPatients()
    })
</script>
