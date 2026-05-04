<div class="bg-white border border-slate-200 rounded-[18px] p-5 shadow-[0_2px_10px_rgba(15,23,42,0.04)]">
    <div class="flex items-center justify-between mb-3">
        <div>
            <h2 class="text-sm font-semibold text-slate-900">Book appointment</h2>
            <p class="text-xs text-slate-500">Create a new appointment for a patient and doctor.</p>
        </div>
        <span class="text-[0.7rem] text-slate-400 uppercase tracking-widest">Appointments</span>
    </div>

    <div id="receptionBookAppointmentError" class="hidden mb-3 rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-[0.75rem] text-red-700"></div>
    <div id="receptionBookAppointmentSuccess" class="hidden mb-3 rounded-lg border border-emerald-200 bg-emerald-50 px-3 py-2 text-[0.75rem] text-emerald-700"></div>

    <form id="receptionBookAppointmentForm" class="grid gap-3 grid-cols-1 md:grid-cols-3 items-start mb-4">
        <div class="min-w-0">
            <label for="reception_appointment_patient_id" class="block text-[0.7rem] text-slate-600 mb-1">Patient</label>
            <div class="relative">
                <input id="reception_patient_search" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Type to search patient">
                <input id="reception_appointment_patient_id" type="hidden" required>
                <div id="receptionPatientResults" class="hidden mt-1 w-full rounded-lg border border-slate-200 bg-white shadow-sm max-h-64 overflow-y-auto overscroll-contain"></div>
            </div>
            <div id="receptionPatientPreview" class="hidden mt-2 rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-[0.78rem] text-slate-700 break-words"></div>
        </div>
        <div class="min-w-0">
            <label for="reception_appointment_service_id" class="block text-[0.7rem] text-slate-600 mb-1">Service</label>
            <div class="relative">
                <input id="reception_service_search" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Type to search service">
                <input id="reception_appointment_service_id" type="hidden" required>
                <div id="receptionServiceResults" class="hidden mt-1 w-full rounded-lg border border-slate-200 bg-white shadow-sm max-h-64 overflow-y-auto overscroll-contain"></div>
            </div>
            <div id="receptionServicePreview" class="hidden mt-2 rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-[0.78rem] text-slate-700 break-words"></div>
        </div>
        <div class="min-w-0">
            <label for="reception_appointment_doctor_id" class="block text-[0.7rem] text-slate-600 mb-1">Doctor</label>
            <div class="relative">
                <input id="reception_doctor_search" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Type to search doctor" disabled>
                <input id="reception_appointment_doctor_id" type="hidden" required>
                <div id="receptionDoctorResults" class="hidden mt-1 w-full rounded-lg border border-slate-200 bg-white shadow-sm max-h-64 overflow-y-auto overscroll-contain"></div>
            </div>
            <div id="receptionDoctorPreview" class="hidden mt-2 rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-[0.78rem] text-slate-700 break-words"></div>
        </div>
        <div id="receptionAppointmentDateWrap" class="self-start">
            <label for="reception_appointment_date" class="block text-[0.7rem] text-slate-600 mb-1">Date</label>
            <select id="reception_appointment_date_select" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" required disabled>
                <option value="">Select a doctor first</option>
            </select>
            <div class="mt-1 flex items-center justify-between">
                <button type="button" id="reception_appointment_date_load_more" class="hidden text-[0.72rem] font-semibold text-cyan-700 hover:text-cyan-800">Load more dates</button>
                <div id="reception_appointment_date_range_hint" class="hidden text-[0.7rem] text-slate-400"></div>
            </div>
            <input id="reception_appointment_date" type="date" class="hidden" tabindex="-1">
        </div>
        <div id="receptionAppointmentTimeWrap" class="self-start">
            <label class="block text-[0.7rem] text-slate-600 mb-1">Time slot</label>
            <input id="reception_appointment_time" type="hidden" required>
            <div id="reception_available_days" class="mb-1 text-[0.7rem] text-slate-500"></div>
            <div id="reception_time_slots" class="flex flex-wrap gap-2"></div>
        </div>
        <input id="reception_appointment_type" type="hidden" value="scheduled">
        <div class="md:col-span-3">
            <label for="reception_appointment_reason" class="block text-[0.7rem] text-slate-600 mb-1">Reason (optional)</label>
            <input id="reception_appointment_reason" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Reason for visit">
        </div>
        <div class="md:col-span-3 flex justify-end">
            <button id="receptionBookAppointmentSubmit" type="submit" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-cyan-600 text-white text-[0.78rem] font-semibold hover:bg-cyan-700 transition-colors disabled:opacity-60 disabled:hover:bg-cyan-600">
                <span id="receptionBookAppointmentSpinner" class="hidden w-3.5 h-3.5 border-2 border-white/40 border-t-white rounded-full animate-spin"></span>
                <span id="receptionBookAppointmentSubmitLabel">Book appointment</span>
            </button>
        </div>
    </form>

    <p class="text-[0.7rem] text-slate-400">
        Appointments booked by reception are confirmed by default.
    </p>

    <div class="mt-6 border-t border-slate-100 pt-4">
        <div class="flex items-center justify-between mb-3">
            <div>
                <h3 class="text-sm font-semibold text-slate-900">Manage appointment</h3>
                <p class="text-xs text-slate-500">Search, update status, or mark check-in for an existing appointment.</p>
            </div>
        </div>

        <div id="receptionManageAppointmentError" class="hidden mb-3 rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-[0.75rem] text-red-700"></div>
        <div id="receptionManageAppointmentSuccess" class="hidden mb-3 rounded-lg border border-emerald-200 bg-emerald-50 px-3 py-2 text-[0.75rem] text-emerald-700"></div>

        <form id="receptionManageAppointmentForm" class="grid gap-3 grid-cols-1 md:grid-cols-4 items-start mb-3">
            <div>
                <label for="reception_manage_appointment_id" class="block text-[0.7rem] text-slate-600 mb-1">Appointment</label>
                <input id="reception_manage_appointment_search" type="text" class="mb-1 w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Search appointment">
                <select id="reception_manage_appointment_id" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" required>
                    <option value="">Select an appointment</option>
                </select>
            </div>
            <div>
                <label for="reception_manage_action" class="block text-[0.7rem] text-slate-600 mb-1">Action</label>
                <select id="reception_manage_action" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                    <option value="fetch">🔍 Fetch details</option>
                    <option value="check_in">✅ Mark check-in (now)</option>
                    <option value="cancel">❌ Cancel appointment</option>
                    <option value="complete">✅ Mark completed</option>
                </select>
            </div>
            <div>
                <label for="reception_manage_status" class="block text-[0.7rem] text-slate-600 mb-1">New status (optional)</label>
                <select id="reception_manage_status" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                    <option value="">Use action default</option>
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                    <option value="no_show">No show</option>
                </select>
            </div>
            <div class="flex justify-end">
                <button id="receptionManageAppointmentSubmit" type="submit" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-slate-900 text-white text-[0.78rem] font-semibold hover:bg-slate-800 transition-colors w-full disabled:opacity-60 disabled:hover:bg-slate-900">
                    <span id="receptionManageAppointmentSpinner" class="hidden w-3.5 h-3.5 border-2 border-white/40 border-t-white rounded-full animate-spin"></span>
                    <span id="receptionManageAppointmentSubmitLabel">Apply</span>
                </button>
            </div>
        </form>

        <pre id="receptionManageAppointmentResult" class="hidden text-[0.68rem] text-slate-600 bg-slate-50 border border-slate-100 rounded-xl px-3 py-2 overflow-x-auto"></pre>
    </div>
</div>

<div id="receptionConfirmOverlay" class="hidden fixed inset-0 z-50 bg-slate-900/40 items-center justify-center p-4">
    <div class="w-full max-w-sm rounded-2xl bg-white border border-slate-200 shadow-[0_12px_30px_rgba(15,23,42,0.24)] p-4">
        <div class="flex items-start gap-3">
            <div class="w-9 h-9 rounded-xl bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-700">
                <span class="material-symbols-outlined text-[18px] leading-none">help</span>
            </div>
            <div class="flex-1">
                <div class="text-sm font-semibold text-slate-900">Confirm</div>
                <div id="receptionConfirmMessage" class="text-[0.78rem] text-slate-600 mt-0.5">Are you sure?</div>
            </div>
        </div>
        <div class="mt-4 flex items-center justify-end gap-2">
            <button type="button" id="receptionConfirmCancel" class="px-3 py-2 rounded-xl border border-slate-200 bg-white text-[0.78rem] font-semibold text-slate-700 hover:bg-slate-50">Cancel</button>
            <button type="button" id="receptionConfirmOk" class="px-3 py-2 rounded-xl bg-slate-900 text-white text-[0.78rem] font-semibold hover:bg-slate-800">Confirm</button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var form = document.getElementById('receptionBookAppointmentForm')
        var errorBox = document.getElementById('receptionBookAppointmentError')
        var successBox = document.getElementById('receptionBookAppointmentSuccess')
        var submitBtn = document.getElementById('receptionBookAppointmentSubmit')
        var submitSpinner = document.getElementById('receptionBookAppointmentSpinner')
        var submitLabel = document.getElementById('receptionBookAppointmentSubmitLabel')
        var patientSearch = document.getElementById('reception_patient_search')
        var patientSelect = document.getElementById('reception_appointment_patient_id')
        var patientResults = document.getElementById('receptionPatientResults')
        var patientPreview = document.getElementById('receptionPatientPreview')
        var serviceSearch = document.getElementById('reception_service_search')
        var serviceSelect = document.getElementById('reception_appointment_service_id')
        var serviceResults = document.getElementById('receptionServiceResults')
        var servicePreview = document.getElementById('receptionServicePreview')
        var doctorSearch = document.getElementById('reception_doctor_search')
        var doctorSelect = document.getElementById('reception_appointment_doctor_id')
        var doctorResults = document.getElementById('receptionDoctorResults')
        var doctorPreview = document.getElementById('receptionDoctorPreview')
        var dateSelect = document.getElementById('reception_appointment_date_select')
        var dateInput = document.getElementById('reception_appointment_date')
        var dateLoadMore = document.getElementById('reception_appointment_date_load_more')
        var dateRangeHint = document.getElementById('reception_appointment_date_range_hint')
        var dateWrap = document.getElementById('receptionAppointmentDateWrap')
        var timeInput = document.getElementById('reception_appointment_time')
        var timeWrap = document.getElementById('receptionAppointmentTimeWrap')
        var availableDaysEl = document.getElementById('reception_available_days')
        var timeSlotsEl = document.getElementById('reception_time_slots')
        var services = []
        var doctors = []
        var servicesLoaded = false
        var servicesLoading = false
        var doctorsLoaded = false
        var doctorsLoading = false
        var doctorSchedules = []
        var doctorAvailableDaySet = {}
        var doctorAppointments = []
        var selectedSlotStart = null
        var slotMinutes = 90
        var patientSearchTimer = null
        var selectedPatient = null
        var selectedService = null
        var selectedDoctor = null

        function setBookSubmitting(isSubmitting) {
            if (submitBtn) submitBtn.disabled = !!isSubmitting
            if (submitSpinner) submitSpinner.classList.toggle('hidden', !isSubmitting)
            if (submitLabel) submitLabel.textContent = isSubmitting ? 'Booking…' : 'Book appointment'
        }

        function showBookAppointmentError(message) {
            if (!errorBox) return
            errorBox.textContent = message || ''
            if (message) {
                errorBox.classList.remove('hidden')
            } else {
                errorBox.classList.add('hidden')
            }
        }

        function showBookAppointmentSuccess(message) {
            if (!successBox) return
            successBox.textContent = message || ''
            if (message) {
                successBox.classList.remove('hidden')
            } else {
                successBox.classList.add('hidden')
            }
        }

        function normalizeText(value) {
            return String(value || '').trim().toLowerCase()
        }

        function extractServiceCategory(serviceName) {
            var s = String(serviceName || '').trim()
            if (!s) return ''
            var parts = s.split(':')
            return normalizeText(parts[0] || s)
        }

        function specializationMatches(serviceCategory, doctorSpecialization) {
            var a = normalizeText(serviceCategory)
            var b = normalizeText(doctorSpecialization)
            if (!a || !b) return false
            return b.indexOf(a) !== -1 || a.indexOf(b) !== -1
        }

        function escapeHtml(input) {
            var s = String(input == null ? '' : input)
            return s
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;')
        }

        function patientLabel(p) {
            var id = p && (p.user_id != null ? p.user_id : p.id)
            var parts = [p && p.firstname, p && p.middlename, p && p.lastname].filter(function (v) { return String(v || '').trim() !== '' })
            var name = parts.join(' ').trim()
            if (!name) name = 'Patient'
            return '#' + id + ' — ' + name
        }

        function patientDisplayName(patient) {
            if (!patient) return ''
            var name = [patient.firstname, patient.middlename, patient.lastname]
                .filter(function (v) { return String(v || '').trim() !== '' })
                .join(' ')
                .trim()
            if (!name) name = 'User #' + (patient.user_id != null ? patient.user_id : '')
            return name
        }

        function setPatientSelection(patient) {
            selectedPatient = patient || null
            if (patientSelect) patientSelect.value = patient && patient.user_id ? String(patient.user_id) : ''

            if (patientPreview) {
                if (!patient) {
                    patientPreview.textContent = ''
                    patientPreview.classList.add('hidden')
                } else {
                    var parts = []
                    var name = [patient.firstname, patient.middlename, patient.lastname].filter(function (v) { return String(v || '').trim() !== '' }).join(' ').trim()
                    if (!name) name = 'User #' + patient.user_id
                    parts.push('Name: ' + name)
                    if (patient.birthdate) parts.push('Birthdate: ' + String(patient.birthdate).slice(0, 10))
                    if (patient.contact_number) parts.push('Contact: ' + patient.contact_number)
                    if (patient.address) parts.push('Address: ' + patient.address)
                    patientPreview.textContent = parts.join(' • ')
                    patientPreview.classList.remove('hidden')
                }
            }

            if (patientResults) {
                patientResults.innerHTML = ''
                patientResults.classList.add('hidden')
            }
        }

        function renderPatientResults(items) {
            if (!patientResults) return
            var list = Array.isArray(items) ? items : []
            if (!list.length) {
                patientResults.innerHTML = '<div class="px-3 py-2 text-[0.75rem] text-slate-500">No patients found.</div>'
                patientResults.classList.remove('hidden')
                return
            }

            var html = ''
            list.forEach(function (p) {
                var name = [p.firstname, p.middlename, p.lastname].filter(function (v) { return String(v || '').trim() !== '' }).join(' ').trim()
                if (!name) name = 'User #' + p.user_id
                var meta = [p.email, p.contact_number].filter(Boolean).join(' • ')
                html += '<button type="button" class="w-full text-left px-3 py-2 hover:bg-slate-50 border-b border-slate-100 last:border-0">' +
                    '<div class="text-[0.78rem] text-slate-800 font-semibold">' + escapeHtml(name) + '</div>' +
                    '<div class="text-[0.72rem] text-slate-500">' + (meta ? escapeHtml(meta) : '—') + '</div>' +
                '</button>'
            })
            patientResults.innerHTML = html
            patientResults.classList.remove('hidden')

            var buttons = patientResults.querySelectorAll('button')
            Array.prototype.forEach.call(buttons, function (btn, idx) {
                btn.addEventListener('click', function () {
                    var chosen = list[idx]
                    setPatientSelection(chosen)
                    if (patientSearch) {
                        patientSearch.value = patientDisplayName(chosen)
                    }
                })
            })
        }

        var patientInitialList = []
        var patientInitialLoaded = false
        var patientInitialLoading = false

        function searchPatients(query) {
            if (typeof apiFetch !== 'function') return
            apiFetch("{{ url('/api/patients') }}?per_page=10&sort=desc&search=" + encodeURIComponent(query), { method: 'GET' })
                .then(function (response) {
                    return response.json().then(function (data) {
                        return { ok: response.ok, data: data }
                    }).catch(function () {
                        return { ok: response.ok, data: null }
                    })
                })
                .then(function (result) {
                    if (!result.ok) {
                        renderPatientResults([])
                        return
                    }
                    var list = []
                    if (result.data && Array.isArray(result.data.data)) {
                        list = result.data.data
                    } else if (Array.isArray(result.data)) {
                        list = result.data
                    }
                    renderPatientResults(list)
                })
                .catch(function () {
                    renderPatientResults([])
                })
        }

        function loadInitialPatients() {
            if (patientInitialLoaded || patientInitialLoading || typeof apiFetch !== 'function') return
            patientInitialLoading = true
            apiFetch("{{ url('/api/patients') }}?per_page=10&sort=desc", { method: 'GET' })
                .then(function (response) {
                    return response.json().then(function (data) {
                        return { ok: response.ok, data: data }
                    }).catch(function () {
                        return { ok: response.ok, data: null }
                    })
                })
                .then(function (result) {
                    if (!result.ok) return
                    var list = []
                    if (result.data && Array.isArray(result.data.data)) {
                        list = result.data.data
                    } else if (Array.isArray(result.data)) {
                        list = result.data
                    }
                    patientInitialList = Array.isArray(list) ? list : []
                    patientInitialLoaded = true
                })
                .catch(function () {})
                .finally(function () {
                    patientInitialLoading = false
                })
        }

        function dayKeyFromDate(dateStr) {
            if (!dateStr) return ''
            var d = new Date(dateStr + 'T00:00:00')
            if (isNaN(d.getTime())) return ''
            var keys = ['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat']
            return keys[d.getDay()] || ''
        }

        function minutesFromHHMM(timeStr) {
            var t = String(timeStr || '').slice(0, 5)
            if (!/^\d{2}:\d{2}$/.test(t)) return NaN
            var parts = t.split(':')
            return (parseInt(parts[0], 10) * 60) + parseInt(parts[1], 10)
        }

        function formatTime12h(hhmmss) {
            var t = String(hhmmss || '').slice(0, 5)
            if (!/^\d{2}:\d{2}$/.test(t)) return t
            var parts = t.split(':')
            var h24 = parseInt(parts[0], 10)
            var m = parts[1]
            var ap = h24 >= 12 ? 'PM' : 'AM'
            var h12 = h24 % 12
            if (h12 === 0) h12 = 12
            return h12 + ':' + m + ' ' + ap
        }

        function readResponse(response) {
            return response.text().then(function (text) {
                var data = null
                try {
                    data = text ? JSON.parse(text) : null
                } catch (e) {
                    data = null
                }
                return { ok: response.ok, status: response.status, data: data, raw: text }
            })
        }

        function clearAvailability() {
            doctorSchedules = []
            doctorAvailableDaySet = {}
            doctorAppointments = []
            selectedSlotStart = null
            if (timeInput) timeInput.value = ''
            if (dateSelect) {
                if (selectedDoctor && selectedDoctor.user_id) {
                    dateSelect.innerHTML = '<option value="">Loading available dates…</option>'
                    dateSelect.disabled = false
                } else {
                    dateSelect.innerHTML = '<option value="">Select a doctor first</option>'
                    dateSelect.disabled = true
                }
            }
            if (dateLoadMore) dateLoadMore.classList.add('hidden')
            if (dateRangeHint) {
                dateRangeHint.textContent = ''
                dateRangeHint.classList.add('hidden')
            }
            if (dateInput) dateInput.value = ''
            if (availableDaysEl) availableDaysEl.textContent = ''
            if (timeSlotsEl) timeSlotsEl.innerHTML = ''
        }

        function setServiceSelection(service) {
            selectedService = service || null
            if (serviceSelect) serviceSelect.value = service && service.service_id ? String(service.service_id) : ''

            if (servicePreview) {
                if (!service) {
                    servicePreview.textContent = ''
                    servicePreview.classList.add('hidden')
                } else {
                    var parts = []
                    parts.push('Service: ' + (service.service_name || ('Service #' + service.service_id)))
                    if (service.description) parts.push('Description: ' + service.description)
                    servicePreview.textContent = parts.join(' • ')
                    servicePreview.classList.remove('hidden')
                }
            }

            if (serviceResults) {
                serviceResults.innerHTML = ''
                serviceResults.classList.add('hidden')
            }

            if (doctorSearch) {
                doctorSearch.disabled = !service
                if (!service) doctorSearch.value = ''
            }

            setDoctorSelection(null)
        }

        function renderServiceResults() {
            if (!serviceResults) return
            var q = serviceSearch ? normalizeText(serviceSearch.value) : ''
            var list = (services || []).slice()
            if (q) {
                list = list.filter(function (s) {
                    var name = normalizeText(s && s.service_name ? s.service_name : '')
                    var desc = normalizeText(s && s.description ? s.description : '')
                    return name.indexOf(q) !== -1 || desc.indexOf(q) !== -1
                })
            }
            list.sort(function (a, b) {
                var ai = a && a.service_id != null ? parseInt(a.service_id, 10) : 0
                var bi = b && b.service_id != null ? parseInt(b.service_id, 10) : 0
                return (isNaN(bi) ? 0 : bi) - (isNaN(ai) ? 0 : ai)
            })
            list = list.slice(0, 10)
            if (!list.length) {
                serviceResults.innerHTML = '<div class="px-3 py-2 text-[0.75rem] text-slate-500">No services found.</div>'
                serviceResults.classList.remove('hidden')
                return
            }
            var html = ''
            list.forEach(function (s) {
                var title = s.service_name || ('Service #' + s.service_id)
                var sub = s.description ? String(s.description) : ''
                html += '<button type="button" class="w-full text-left px-3 py-2 hover:bg-slate-50 border-b border-slate-100 last:border-0">' +
                    '<div class="text-[0.78rem] text-slate-800 font-semibold">' + escapeHtml(title) + '</div>' +
                    '<div class="text-[0.72rem] text-slate-500">' + (sub ? escapeHtml(sub) : '—') + '</div>' +
                '</button>'
            })
            serviceResults.innerHTML = html
            serviceResults.classList.remove('hidden')

            var buttons = serviceResults.querySelectorAll('button')
            Array.prototype.forEach.call(buttons, function (btn, idx) {
                btn.addEventListener('click', function () {
                    var chosen = list[idx]
                    setServiceSelection(chosen)
                    if (serviceSearch) serviceSearch.value = chosen.service_name || ('Service #' + chosen.service_id)
                })
            })
        }

        function doctorLabel(d) {
            if (!d) return ''
            var name = [d.firstname, d.middlename, d.lastname].filter(function (v) { return String(v || '').trim() !== '' }).join(' ').trim()
            if (!name) name = 'Doctor #' + (d.user_id || '')
            return name + (d.specialization ? ' — ' + d.specialization : '')
        }

        function setDoctorSelection(doctor) {
            selectedDoctor = doctor || null
            if (doctorSelect) doctorSelect.value = doctor && doctor.user_id ? String(doctor.user_id) : ''

            if (doctorPreview) {
                if (!doctor) {
                    doctorPreview.textContent = ''
                    doctorPreview.classList.add('hidden')
                } else {
                    var parts = []
                    parts.push('Doctor: ' + doctorLabel(doctor))
                    doctorPreview.textContent = parts.join(' • ')
                    doctorPreview.classList.remove('hidden')
                }
            }

            if (doctorResults) {
                doctorResults.innerHTML = ''
                doctorResults.classList.add('hidden')
            }

            clearAvailability()

            if (doctor && doctor.user_id) {
                var embedded = doctor.doctor_schedules
                if (Array.isArray(embedded) && embedded.length) {
                    doctorSchedules = embedded.slice()
                    renderAvailableDays()
                    populateAllowedDates()
                    if (dateSelect) dateSelect.disabled = false
                }
                loadDoctorSchedulesAndAvailability(doctor.user_id, dateInput ? dateInput.value : '')
                applyAppointmentTypeUI()
            }
        }

        function renderDoctorResults() {
            if (!doctorResults) return
            var q = doctorSearch ? normalizeText(doctorSearch.value) : ''

            var category = extractServiceCategory(selectedService ? selectedService.service_name : '')
            var list = []
            if (category) {
                list = (doctors || []).filter(function (d) {
                    return specializationMatches(category, d.specialization)
                })
            }

            if (q) {
                list = list.filter(function (d) {
                    return normalizeText(doctorLabel(d)).indexOf(q) !== -1
                })
            }

            list.sort(function (a, b) {
                var ai = a && a.user_id != null ? parseInt(a.user_id, 10) : 0
                var bi = b && b.user_id != null ? parseInt(b.user_id, 10) : 0
                return (isNaN(bi) ? 0 : bi) - (isNaN(ai) ? 0 : ai)
            })
            list = list.slice(0, 8)

            if (!category) {
                doctorResults.innerHTML = '<div class="px-3 py-2 text-[0.75rem] text-slate-500">Select a service first.</div>'
                doctorResults.classList.remove('hidden')
                return
            }

            if (!list.length) {
                doctorResults.innerHTML = '<div class="px-3 py-2 text-[0.75rem] text-slate-500">No doctors found.</div>'
                doctorResults.classList.remove('hidden')
                return
            }

            var html = ''
            list.forEach(function (d) {
                html += '<button type="button" class="w-full text-left px-3 py-2 hover:bg-slate-50 border-b border-slate-100 last:border-0">' +
                    '<div class="text-[0.78rem] text-slate-800 font-semibold">' + escapeHtml([d.firstname, d.middlename, d.lastname].filter(function (v) { return String(v || '').trim() !== '' }).join(' ').trim() || ('Doctor #' + d.user_id)) + '</div>' +
                    '<div class="text-[0.72rem] text-slate-500">' + escapeHtml(d.specialization || '—') + '</div>' +
                '</button>'
            })
            doctorResults.innerHTML = html
            doctorResults.classList.remove('hidden')

            var buttons = doctorResults.querySelectorAll('button')
            Array.prototype.forEach.call(buttons, function (btn, idx) {
                btn.addEventListener('click', function () {
                    var chosen = list[idx]
                    setDoctorSelection(chosen)
                    if (doctorSearch) doctorSearch.value = [chosen.firstname, chosen.middlename, chosen.lastname].filter(function (v) { return String(v || '').trim() !== '' }).join(' ').trim() || ('Doctor #' + chosen.user_id)
                })
            })
        }

        function renderAvailableDays() {
            if (!availableDaysEl) return
            if (!doctorSchedules.length) {
                availableDaysEl.textContent = ''
                return
            }
            doctorAvailableDaySet = {}
            doctorSchedules.forEach(function (s) {
                if (s && s.is_available === false) return
                var dayKey = s && s.day_of_week ? String(s.day_of_week).toLowerCase() : ''
                if (dayKey) doctorAvailableDaySet[dayKey] = true
            })
            var order = ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun']
            var keys = Object.keys(doctorAvailableDaySet).sort(function (a, b) { return order.indexOf(a) - order.indexOf(b) })
            availableDaysEl.textContent = keys.length ? ('Available days: ' + keys.join(', ')) : ''
        }

        function formatDateIso(d) {
            var yyyy = String(d.getFullYear())
            var mm = String(d.getMonth() + 1).padStart(2, '0')
            var dd = String(d.getDate()).padStart(2, '0')
            return yyyy + '-' + mm + '-' + dd
        }

        function formatDateLabel(d) {
            var keys = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
            return formatDateIso(d) + ' (' + (keys[d.getDay()] || '') + ')'
        }

        var dateCursor = null
        var dateCursorFirstIso = null
        var dateCursorLastIso = null

        function resetDateCursor() {
            var today = new Date()
            today.setHours(0, 0, 0, 0)
            dateCursor = today
            dateCursorFirstIso = null
            dateCursorLastIso = null
        }

        function appendAllowedDates(batchSize) {
            if (!dateSelect) return
            var allowedKeys = doctorAvailableDaySet && Object.keys(doctorAvailableDaySet).length ? doctorAvailableDaySet : null
            if (!allowedKeys) return
            if (!dateCursor) resetDateCursor()

            var added = 0
            var scanned = 0
            var maxScan = 365
            while (added < batchSize && scanned < maxScan) {
                var iso = formatDateIso(dateCursor)
                var dayKey = dayKeyFromDate(iso)
                if (dayKey && allowedKeys[dayKey]) {
                    var option = document.createElement('option')
                    option.value = iso
                    option.textContent = formatDateLabel(dateCursor)
                    dateSelect.appendChild(option)
                    added++
                    if (!dateCursorFirstIso) dateCursorFirstIso = iso
                    dateCursorLastIso = iso
                }
                dateCursor = new Date(dateCursor.getTime())
                dateCursor.setDate(dateCursor.getDate() + 1)
                scanned++
            }

            if (dateRangeHint) {
                if (dateCursorFirstIso && dateCursorLastIso) {
                    dateRangeHint.textContent = 'Loaded: ' + dateCursorFirstIso + ' → ' + dateCursorLastIso
                    dateRangeHint.classList.remove('hidden')
                } else {
                    dateRangeHint.textContent = ''
                    dateRangeHint.classList.add('hidden')
                }
            }

            if (dateLoadMore) {
                dateLoadMore.classList.toggle('hidden', !allowedKeys)
                dateLoadMore.disabled = scanned >= maxScan
                dateLoadMore.classList.toggle('opacity-60', dateLoadMore.disabled)
                dateLoadMore.classList.toggle('cursor-not-allowed', dateLoadMore.disabled)
            }
        }

        function populateAllowedDates() {
            if (!dateSelect) return
            dateSelect.innerHTML = ''

            var placeholder = document.createElement('option')
            placeholder.value = ''
            placeholder.textContent = 'Select a date'
            dateSelect.appendChild(placeholder)

            resetDateCursor()

            var allowedKeys = doctorAvailableDaySet && Object.keys(doctorAvailableDaySet).length ? doctorAvailableDaySet : null
            if (!allowedKeys) {
                var opt = document.createElement('option')
                opt.value = ''
                opt.textContent = 'No available schedule days'
                dateSelect.appendChild(opt)
                dateSelect.disabled = false
                if (dateLoadMore) dateLoadMore.classList.add('hidden')
                if (dateRangeHint) {
                    dateRangeHint.textContent = ''
                    dateRangeHint.classList.add('hidden')
                }
                return
            }

            appendAllowedDates(60)

            if (dateSelect) dateSelect.disabled = false
            if (dateSelect && dateSelect.options && dateSelect.options.length <= 1) {
                var none = document.createElement('option')
                none.value = ''
                none.textContent = 'No available dates in range'
                dateSelect.appendChild(none)
            }
        }

        function hhmmFromMinutes(mins) {
            var m = parseInt(mins, 10)
            if (isNaN(m)) return ''
            var hh = Math.floor(m / 60)
            var mm = m % 60
            var hhStr = String(hh).padStart(2, '0')
            var mmStr = String(mm).padStart(2, '0')
            return hhStr + ':' + mmStr
        }

        function renderTimeSlots() {
            if (!timeSlotsEl) return
            timeSlotsEl.innerHTML = ''

            if (!doctorSelect || !doctorSelect.value) {
                timeSlotsEl.innerHTML = '<div class="text-[0.7rem] text-slate-400">Select a doctor to load time slots.</div>'
                return
            }
            if (!dateInput || !dateInput.value) {
                timeSlotsEl.innerHTML = '<div class="text-[0.7rem] text-slate-400">Select a date to load time slots.</div>'
                return
            }
            if (!doctorSchedules.length) {
                timeSlotsEl.innerHTML = '<div class="text-[0.7rem] text-slate-400">No schedules found for this doctor.</div>'
                return
            }

            var dayKey = dayKeyFromDate(dateInput.value)
            if (!dayKey) {
                timeSlotsEl.innerHTML = '<div class="text-[0.7rem] text-slate-400">Invalid date selected.</div>'
                return
            }
            if (doctorAvailableDaySet && Object.keys(doctorAvailableDaySet).length && !doctorAvailableDaySet[dayKey]) {
                timeSlotsEl.innerHTML = '<div class="text-[0.7rem] text-slate-400">Doctor is not available on this day.</div>'
                return
            }

            var daySchedules = doctorSchedules.filter(function (s) {
                return String(s.day_of_week || '').toLowerCase() === dayKey && s.is_available !== false
            })

            if (!daySchedules.length) {
                timeSlotsEl.innerHTML = '<div class="text-[0.7rem] text-slate-400">Doctor has no available slots on this day.</div>'
                return
            }

            daySchedules.sort(function (a, b) {
                var sa = minutesFromHHMM(String(a.start_time || ''))
                var sb = minutesFromHHMM(String(b.start_time || ''))
                if (isNaN(sa) || isNaN(sb)) return 0
                return sa - sb
            })

            var intervals = []
            daySchedules.forEach(function (s) {
                var st = minutesFromHHMM(String(s.start_time || ''))
                var en = minutesFromHHMM(String(s.end_time || ''))
                if (isNaN(st) || isNaN(en) || en <= st) return
                intervals.push({ start: st, end: en })
            })
            intervals.sort(function (a, b) { return a.start - b.start })
            var merged = []
            intervals.forEach(function (i) {
                var last = merged.length ? merged[merged.length - 1] : null
                if (!last) {
                    merged.push({ start: i.start, end: i.end })
                    return
                }
                if (i.start <= last.end) {
                    last.end = Math.max(last.end, i.end)
                    return
                }
                merged.push({ start: i.start, end: i.end })
            })

            var appts = Array.isArray(doctorAppointments) ? doctorAppointments : []
            var bookedSet = {}
            appts.forEach(function (a) {
                if (!a || !a.appointment_datetime) return
                if (String(a.status || '').toLowerCase() === 'cancelled') return
                if (a.appointment_type && String(a.appointment_type) !== 'scheduled') return
                var dt = String(a.appointment_datetime).replace('T', ' ').slice(0, 16)
                if (!/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}$/.test(dt)) return
                var datePart = dt.slice(0, 10)
                var timePart = dt.slice(11, 16)
                if (datePart !== dateInput.value) return
                bookedSet[timePart] = true
            })

            var slots = []
            merged.forEach(function (block) {
                for (var m = block.start; m + slotMinutes <= block.end; m += slotMinutes) {
                    slots.push({ start: m, end: m + slotMinutes })
                }
            })

            if (!slots.length) {
                timeSlotsEl.innerHTML = '<div class="text-[0.7rem] text-slate-400">No time slots available for this day.</div>'
                return
            }

            slots.forEach(function (slot) {
                var startHHMM = hhmmFromMinutes(slot.start)
                var endHHMM = hhmmFromMinutes(slot.end)
                var isBooked = !!bookedSet[startHHMM]
                var isSelected = String(selectedSlotStart || '') === startHHMM
                var label = formatTime12h(startHHMM) + '–' + formatTime12h(endHHMM)

                var btn = document.createElement('button')
                btn.type = 'button'
                btn.className =
                    'px-3 py-2 rounded-xl text-[0.75rem] font-semibold border transition-colors ' +
                    (isBooked
                        ? 'border-slate-200 bg-slate-100 text-slate-400 cursor-not-allowed'
                        : (isSelected
                            ? 'border-cyan-600 bg-cyan-600 text-white'
                            : 'border-slate-200 bg-white text-slate-700 hover:bg-slate-50'))
                btn.disabled = !!isBooked
                btn.textContent = label + (isBooked ? ' · Booked' : '')
                btn.addEventListener('click', function () {
                    selectedSlotStart = startHHMM
                    if (timeInput) timeInput.value = startHHMM
                    renderTimeSlots()
                })
                timeSlotsEl.appendChild(btn)
            })
        }

        function loadDoctorSchedulesAndAvailability(doctorId, dateStr) {
            if (!doctorId || typeof apiFetch !== 'function') return
            clearAvailability()
            apiFetch("{{ url('/api/doctor-schedules') }}?doctor_id=" + encodeURIComponent(doctorId) + "&per_page=100", { method: 'GET' })
                .then(function (response) { return readResponse(response) })
                .then(function (result) {
                    if (!result.ok) {
                        var msg = (result.data && result.data.message) ? String(result.data.message) : 'Failed to load doctor schedules.'
                        if (result.status === 401) msg = 'Session expired. Please log in again.'
                        if (result.status === 403) msg = 'Forbidden (403). Your account does not have permission to view this doctor’s schedules.'
                        showBookAppointmentError(msg)
                        if ((!doctorSchedules || !doctorSchedules.length) && dateSelect) {
                            dateSelect.innerHTML = '<option value=\"\">Failed to load schedules</option>'
                            dateSelect.disabled = false
                        }
                        renderAvailableDays()
                        populateAllowedDates()
                        renderTimeSlots()
                        return
                    }

                    var raw = result.data && Array.isArray(result.data.data) ? result.data.data : (Array.isArray(result.data) ? result.data : [])
                    doctorSchedules = raw || []
                    renderAvailableDays()
                    populateAllowedDates()
                    if (dateSelect) dateSelect.disabled = false
                    if (dateStr) {
                        loadDoctorAppointments(doctorId, dateStr)
                    } else {
                        renderTimeSlots()
                    }
                })
                .catch(function () {
                    showBookAppointmentError('Network error while loading doctor schedules.')
                    if ((!doctorSchedules || !doctorSchedules.length) && dateSelect) {
                        dateSelect.innerHTML = '<option value=\"\">Network error loading schedules</option>'
                        dateSelect.disabled = false
                    }
                    renderAvailableDays()
                    populateAllowedDates()
                    renderTimeSlots()
                })
        }

        function loadDoctorAppointments(doctorId, dateStr) {
            if (!doctorId || !dateStr || typeof apiFetch !== 'function') return
            apiFetch("{{ url('/api/appointments') }}?doctor_id=" + encodeURIComponent(doctorId) + "&start_date=" + encodeURIComponent(dateStr) + "&end_date=" + encodeURIComponent(dateStr) + "&per_page=200", { method: 'GET' })
                .then(function (response) { return readResponse(response) })
                .then(function (result) {
                    var raw = result.data && Array.isArray(result.data.data) ? result.data.data : (Array.isArray(result.data) ? result.data : [])
                    doctorAppointments = raw || []
                    renderTimeSlots()
                })
                .catch(function () {
                    doctorAppointments = []
                    renderTimeSlots()
                })
        }

        function loadServicesAndDoctors() {
            if (typeof apiFetch !== 'function') return

            servicesLoading = true
            apiFetch("{{ url('/api/services') }}?per_page=100", { method: 'GET' })
                .then(function (response) {
                    return response.json().then(function (data) {
                        return { ok: response.ok, data: data }
                    }).catch(function () {
                        return { ok: response.ok, data: null }
                    })
                })
                .then(function (result) {
                    var raw = result.data && Array.isArray(result.data.data) ? result.data.data : (Array.isArray(result.data) ? result.data : [])
                    var allowedServiceNames = [
                        'obsterician - gynecologist',
                        'obstetrician - gynecologist',
                        'general surgeon'
                    ]
                    services = (raw || []).filter(function (s) {
                        var name = normalizeText(s && s.service_name ? s.service_name : '')
                        return allowedServiceNames.indexOf(name) !== -1
                    })
                    servicesLoaded = true
                    if (serviceSearch && serviceSearch.value) {
                        renderServiceResults()
                    }
                })
                .catch(function () {})
                .finally(function () {
                    servicesLoading = false
                })

            doctorsLoading = true
            apiFetch("{{ url('/api/doctors') }}?per_page=200", { method: 'GET' })
                .then(function (response) {
                    return response.json().then(function (data) {
                        return { ok: response.ok, data: data }
                    }).catch(function () {
                        return { ok: response.ok, data: null }
                    })
                })
                .then(function (result) {
                    var raw = result.data && Array.isArray(result.data.data) ? result.data.data : (Array.isArray(result.data) ? result.data : [])
                    doctors = raw || []
                    doctorsLoaded = true
                    if (doctorSearch && doctorSearch.value) {
                        renderDoctorResults()
                    }
                })
                .catch(function () {})
                .finally(function () {
                    doctorsLoading = false
                })
        }

        if (patientSearch) {
            loadInitialPatients()

            patientSearch.addEventListener('focus', function () {
                showBookAppointmentError('')
                showBookAppointmentSuccess('')
                var q = String(patientSearch.value || '').trim()
                if (!q) {
                    if (!patientInitialLoaded && !patientInitialLoading) {
                        loadInitialPatients()
                    }
                    if (!patientInitialLoaded && patientInitialLoading) {
                        renderPatientResults([])
                        if (patientResults) {
                            patientResults.innerHTML = '<div class="px-3 py-2 text-[0.75rem] text-slate-500">Loading patients…</div>'
                            patientResults.classList.remove('hidden')
                        }
                        return
                    }
                    renderPatientResults(patientInitialList)
                    return
                }
                searchPatients(q)
            })

            patientSearch.addEventListener('input', function () {
                var q = String(patientSearch.value || '').trim()

                if (selectedPatient) {
                    var currentName = patientDisplayName(selectedPatient)
                    if (normalizeText(q) !== normalizeText(currentName)) {
                        setPatientSelection(null)
                    }
                }

                if (patientSearchTimer) clearTimeout(patientSearchTimer)
                if (!q) {
                    renderPatientResults(patientInitialList)
                    return
                }
                patientSearchTimer = setTimeout(function () {
                    searchPatients(q)
                }, 250)
            })
        }

        if (serviceSearch) {
            serviceSearch.addEventListener('focus', function () {
                showBookAppointmentError('')
                showBookAppointmentSuccess('')

                if (!servicesLoaded && servicesLoading) {
                    if (serviceResults) {
                        serviceResults.innerHTML = '<div class="px-3 py-2 text-[0.75rem] text-slate-500">Loading services…</div>'
                        serviceResults.classList.remove('hidden')
                    }
                    return
                }

                renderServiceResults()
            })

            serviceSearch.addEventListener('input', function () {
                showBookAppointmentError('')
                showBookAppointmentSuccess('')

                var q = String(serviceSearch.value || '').trim()
                if (selectedService) {
                    var currentName = String(selectedService.service_name || ('Service #' + selectedService.service_id)).trim()
                    if (normalizeText(q) !== normalizeText(currentName)) {
                        setServiceSelection(null)
                    }
                }
                renderServiceResults()
            })
        }
        if (doctorSearch) {
            doctorSearch.addEventListener('focus', function () {
                showBookAppointmentError('')
                showBookAppointmentSuccess('')

                if (doctorSearch.disabled) {
                    if (doctorResults) doctorResults.classList.add('hidden')
                    return
                }

                if (!doctorsLoaded && doctorsLoading) {
                    if (doctorResults) {
                        doctorResults.innerHTML = '<div class="px-3 py-2 text-[0.75rem] text-slate-500">Loading doctors…</div>'
                        doctorResults.classList.remove('hidden')
                    }
                    return
                }

                renderDoctorResults()
            })

            doctorSearch.addEventListener('input', function () {
                showBookAppointmentError('')
                showBookAppointmentSuccess('')

                var q = String(doctorSearch.value || '').trim()
                if (selectedDoctor) {
                    var currentName = [selectedDoctor.firstname, selectedDoctor.middlename, selectedDoctor.lastname].filter(function (v) { return String(v || '').trim() !== '' }).join(' ').trim() || ('Doctor #' + selectedDoctor.user_id)
                    if (normalizeText(q) !== normalizeText(currentName)) {
                        setDoctorSelection(null)
                    }
                }
                renderDoctorResults()
            })
        }

        function onDateChanged() {
            showBookAppointmentError('')
            showBookAppointmentSuccess('')
            selectedSlotStart = null
            if (timeInput) timeInput.value = ''
            var doctorId = doctorSelect ? doctorSelect.value : ''
            var dateStr = dateSelect ? dateSelect.value : (dateInput ? dateInput.value : '')
            if (dateInput) dateInput.value = dateStr || ''
            if (!doctorId || !dateStr) {
                renderTimeSlots()
                return
            }
            loadDoctorAppointments(doctorId, dateStr)
        }

        if (dateSelect) {
            dateSelect.addEventListener('change', onDateChanged)
            if (dateLoadMore) {
                dateLoadMore.addEventListener('click', function () {
                    if (dateLoadMore.disabled) return
                    appendAllowedDates(60)
                })
            }
        } else if (dateInput) {
            dateInput.addEventListener('change', function () {
                showBookAppointmentError('')
                showBookAppointmentSuccess('')
                selectedSlotStart = null
                if (timeInput) timeInput.value = ''
                var doctorId = doctorSelect ? doctorSelect.value : ''
                var dateStr = dateInput.value
                if (!doctorId || !dateStr) {
                    renderTimeSlots()
                    return
                }
                var dayKey = dayKeyFromDate(dateStr)
                if (dayKey && doctorAvailableDaySet && Object.keys(doctorAvailableDaySet).length && !doctorAvailableDaySet[dayKey]) {
                    showBookAppointmentError('Doctor is not available on the selected date.')
                    dateInput.value = ''
                    renderTimeSlots()
                    return
                }
                loadDoctorAppointments(doctorId, dateStr)
            })
        }

        var typeInput = document.getElementById('reception_appointment_type')
        var typeScheduledBtn = document.getElementById('receptionApptTypeScheduledBtn')
        var typeWalkInBtn = document.getElementById('receptionApptTypeWalkInBtn')

        function setTypeButtonState(btn, isActive) {
            if (!btn) return
            btn.classList.toggle('bg-white', isActive)
            btn.classList.toggle('text-slate-900', isActive)
            btn.classList.toggle('shadow-sm', isActive)
            btn.classList.toggle('border', isActive)
            btn.classList.toggle('border-slate-200', isActive)
            btn.classList.toggle('bg-transparent', !isActive)
            btn.classList.toggle('text-slate-600', !isActive)
        }

        function syncTypeToggleUI() {
            if (typeScheduledBtn) typeScheduledBtn.textContent = 'Scheduled'
            if (typeWalkInBtn) typeWalkInBtn.textContent = 'Walk-in'
            var type = typeInput && typeInput.value ? typeInput.value : 'scheduled'
            setTypeButtonState(typeScheduledBtn, type === 'scheduled')
            setTypeButtonState(typeWalkInBtn, type === 'walk_in')
        }

        function setAppointmentType(nextType) {
            var type = nextType === 'walk_in' ? 'walk_in' : 'scheduled'
            if (typeInput) typeInput.value = type
            showBookAppointmentError('')
            showBookAppointmentSuccess('')
            applyAppointmentTypeUI()
            syncTypeToggleUI()
        }

        function applyAppointmentTypeUI() {
            if (typeInput) typeInput.value = 'scheduled'
            var isWalkIn = false
            if (dateWrap) dateWrap.classList.toggle('hidden', isWalkIn)
            if (timeWrap) timeWrap.classList.toggle('hidden', isWalkIn)
            if (dateSelect) {
                dateSelect.required = !isWalkIn
                dateSelect.disabled = isWalkIn || !doctorSelect || !doctorSelect.value
            }
            if (dateLoadMore) {
                var canShowMore = !isWalkIn && !!(doctorSelect && doctorSelect.value) && !!(doctorAvailableDaySet && Object.keys(doctorAvailableDaySet).length)
                dateLoadMore.classList.toggle('hidden', !canShowMore)
            }
            if (dateRangeHint) {
                var canShowHint = !isWalkIn && !!(doctorSelect && doctorSelect.value) && !!(dateCursorFirstIso && dateCursorLastIso)
                dateRangeHint.classList.toggle('hidden', !canShowHint)
            }
            if (dateInput) dateInput.required = false
            if (timeInput) timeInput.required = !isWalkIn
            if (isWalkIn) {
                if (dateSelect) dateSelect.value = ''
                if (dateInput) dateInput.value = ''
                if (timeInput) timeInput.value = ''
                selectedSlotStart = null
                renderTimeSlots()
            }
        }
        if (typeScheduledBtn) {
            typeScheduledBtn.addEventListener('click', function () { setAppointmentType('scheduled') })
        }
        if (typeWalkInBtn) {
            typeWalkInBtn.addEventListener('click', function () { setAppointmentType('walk_in') })
        }

        document.addEventListener('click', function (e) {
            var target = e && e.target ? e.target : null

            if (patientResults && !patientResults.classList.contains('hidden')) {
                if (!(patientResults.contains(target) || (patientSearch && patientSearch.contains(target)))) {
                    patientResults.classList.add('hidden')
                }
            }
            if (serviceResults && !serviceResults.classList.contains('hidden')) {
                if (!(serviceResults.contains(target) || (serviceSearch && serviceSearch.contains(target)))) {
                    serviceResults.classList.add('hidden')
                }
            }
            if (doctorResults && !doctorResults.classList.contains('hidden')) {
                if (!(doctorResults.contains(target) || (doctorSearch && doctorSearch.contains(target)))) {
                    doctorResults.classList.add('hidden')
                }
            }
        })

        loadServicesAndDoctors()
        if (dateInput) {
            var today = new Date()
            var yyyy = String(today.getFullYear())
            var mm = String(today.getMonth() + 1).padStart(2, '0')
            var dd = String(today.getDate()).padStart(2, '0')
            dateInput.min = yyyy + '-' + mm + '-' + dd
        }
        if (typeInput && !typeInput.value) typeInput.value = 'scheduled'
        applyAppointmentTypeUI()
        syncTypeToggleUI()
        renderTimeSlots()

        if (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault()

                showBookAppointmentError('')
                showBookAppointmentSuccess('')
                setBookSubmitting(true)

                var patientInput = document.getElementById('reception_appointment_patient_id')
                var doctorInput = document.getElementById('reception_appointment_doctor_id')
                var serviceInput = document.getElementById('reception_appointment_service_id')
                var dateSelect = document.getElementById('reception_appointment_date_select')
                var dateInput = document.getElementById('reception_appointment_date')
                var timeInput = document.getElementById('reception_appointment_time')
                var typeInput = document.getElementById('reception_appointment_type')
                var reasonInput = document.getElementById('reception_appointment_reason')

                var patientId = patientInput ? parseInt(patientInput.value, 10) : 0
                var doctorId = doctorInput ? parseInt(doctorInput.value, 10) : 0
                var serviceId = serviceInput ? parseInt(serviceInput.value, 10) : 0
                var date = dateSelect && dateSelect.value ? dateSelect.value : (dateInput ? dateInput.value : '')
                var time = timeInput ? timeInput.value : ''
                var type = 'scheduled'
                var reason = reasonInput ? reasonInput.value : ''

                if (!patientId || !serviceId || !doctorId) {
                    showBookAppointmentError('Patient, service, and doctor are required.')
                    setBookSubmitting(false)
                    return
                }

                if (type !== 'walk_in') {
                    if (!date || !time) {
                        showBookAppointmentError('Date and time are required for scheduled appointments.')
                        setBookSubmitting(false)
                        return
                    }
                }

                if (typeof apiFetch !== 'function') {
                    showBookAppointmentError('API client is not available.')
                    setBookSubmitting(false)
                    return
                }

                var body = {
                    patient_id: patientId,
                    doctor_id: doctorId,
                    service_id: serviceId,
                    appointment_type: type,
                    status: 'confirmed'
                }

                if (type !== 'walk_in') {
                    body.appointment_datetime = date + ' ' + time
                }
                if (reason) {
                    body.reason_for_visit = reason
                }

                apiFetch("{{ url('/api/appointments') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(body)
                })
                    .then(function (response) {
                        return response.json().then(function (data) {
                            return { ok: response.ok, status: response.status, data: data }
                        }).catch(function () {
                            return { ok: response.ok, status: response.status, data: null }
                        })
                    })
                    .then(function (result) {
                        if (!result.ok) {
                            var message = 'Failed to book appointment.'
                            if (result.data && result.data.message) {
                                message = result.data.message
                            }
                            showBookAppointmentError(message)
                            return
                        }

                        showBookAppointmentSuccess('Appointment has been created successfully.')
                        if (patientSearch) patientSearch.value = ''
                        if (serviceSearch) serviceSearch.value = ''
                        if (doctorSearch) doctorSearch.value = ''
                        setPatientSelection(null)
                        setServiceSelection(null)
                        setDoctorSelection(null)
                        if (dateInput) dateInput.value = ''
                        if (timeInput) timeInput.value = ''
                        if (typeInput) typeInput.value = 'scheduled'
                        if (reasonInput) reasonInput.value = ''
                        applyAppointmentTypeUI()
                        syncTypeToggleUI()
                    })
                    .catch(function () {
                        showBookAppointmentError('Network error while booking appointment.')
                    })
                    .finally(function () {
                        setBookSubmitting(false)
                    })
            })
        }

        var manageForm = document.getElementById('receptionManageAppointmentForm')
        var manageError = document.getElementById('receptionManageAppointmentError')
        var manageSuccess = document.getElementById('receptionManageAppointmentSuccess')
        var manageResult = document.getElementById('receptionManageAppointmentResult')
        var manageSubmit = document.getElementById('receptionManageAppointmentSubmit')
        var manageSpinner = document.getElementById('receptionManageAppointmentSpinner')
        var manageLabel = document.getElementById('receptionManageAppointmentSubmitLabel')
        var manageSearchInput = document.getElementById('reception_manage_appointment_search')
        var manageIdSelect = document.getElementById('reception_manage_appointment_id')
        var manageSearchTimer = null

        var confirmOverlay = document.getElementById('receptionConfirmOverlay')
        var confirmMessage = document.getElementById('receptionConfirmMessage')
        var confirmOk = document.getElementById('receptionConfirmOk')
        var confirmCancel = document.getElementById('receptionConfirmCancel')
        var confirmResolver = null

        function setManageSubmitting(isSubmitting) {
            if (manageSubmit) manageSubmit.disabled = !!isSubmitting
            if (manageSpinner) manageSpinner.classList.toggle('hidden', !isSubmitting)
            if (manageLabel) manageLabel.textContent = isSubmitting ? 'Applying…' : 'Apply'
        }

        function confirmAction(message) {
            return new Promise(function (resolve) {
                if (!confirmOverlay || !confirmMessage || !confirmOk || !confirmCancel) {
                    resolve(window.confirm(message || 'Are you sure?'))
                    return
                }
                confirmMessage.textContent = message || 'Are you sure?'
                confirmResolver = resolve
                confirmOverlay.classList.remove('hidden')
                confirmOverlay.classList.add('flex')
            })
        }

        function closeConfirm(result) {
            if (confirmOverlay) {
                confirmOverlay.classList.add('hidden')
                confirmOverlay.classList.remove('flex')
            }
            var resolver = confirmResolver
            confirmResolver = null
            if (typeof resolver === 'function') {
                resolver(!!result)
            }
        }

        if (confirmOk) confirmOk.addEventListener('click', function () { closeConfirm(true) })
        if (confirmCancel) confirmCancel.addEventListener('click', function () { closeConfirm(false) })
        if (confirmOverlay) {
            confirmOverlay.addEventListener('click', function (e) {
                if (e.target === confirmOverlay) closeConfirm(false)
            })
        }

        function showManageError(message) {
            if (!manageError) return
            manageError.textContent = message || ''
            if (message) {
                manageError.classList.remove('hidden')
            } else {
                manageError.classList.add('hidden')
            }
        }

        function showManageSuccess(message) {
            if (!manageSuccess) return
            manageSuccess.textContent = message || ''
            if (message) {
                manageSuccess.classList.remove('hidden')
            } else {
                manageSuccess.classList.add('hidden')
            }
        }

        function showManageResult(data) {
            if (!manageResult) return
            if (!data) {
                manageResult.classList.add('hidden')
                manageResult.textContent = ''
                return
            }
            try {
                manageResult.textContent = JSON.stringify(data, null, 2)
            } catch (e) {
                manageResult.textContent = String(data)
            }
            manageResult.classList.remove('hidden')
        }

        function appointmentLabel(appt) {
            if (!appt) return ''
            var id = appt.appointment_id != null ? appt.appointment_id : ''
            var patient = appt.patient || null
            var doctor = appt.doctor || null
            var pName = patient ? [patient.firstname, patient.middlename, patient.lastname].filter(function (v) { return String(v || '').trim() !== '' }).join(' ').trim() : ''
            var dName = doctor ? [doctor.firstname, doctor.middlename, doctor.lastname].filter(function (v) { return String(v || '').trim() !== '' }).join(' ').trim() : ''
            var when = appt.appointment_datetime ? String(appt.appointment_datetime).replace('T', ' ').slice(0, 16) : 'Queue request'
            return '#' + id + ' — ' + (pName || 'Patient') + ' · ' + (dName || 'Doctor') + ' · ' + when
        }

        function renderManageAppointmentOptions(list) {
            if (!manageIdSelect) return
            var current = manageIdSelect.value
            manageIdSelect.innerHTML = '<option value="">Select an appointment</option>' + (list || []).slice(0, 50).map(function (a) {
                return '<option value="' + escapeHtml(a.appointment_id) + '">' + escapeHtml(appointmentLabel(a)) + '</option>'
            }).join('')
            if (current) manageIdSelect.value = current
        }

        function loadManageAppointmentOptions(search) {
            if (typeof apiFetch !== 'function') return
            var url = "{{ url('/api/appointments') }}" + '?per_page=50'
            if (search) {
                url += '&search=' + encodeURIComponent(search)
            }
            apiFetch(url, { method: 'GET' })
                .then(function (response) { return readResponse(response) })
                .then(function (result) {
                    if (!result.ok) return
                    var raw = result.data && Array.isArray(result.data.data) ? result.data.data : (Array.isArray(result.data) ? result.data : [])
                    renderManageAppointmentOptions(raw || [])
                })
                .catch(function () {})
        }

        if (manageSearchInput) {
            manageSearchInput.addEventListener('input', function () {
                if (manageSearchTimer) clearTimeout(manageSearchTimer)
                manageSearchTimer = setTimeout(function () {
                    loadManageAppointmentOptions(normalizeText(manageSearchInput.value))
                }, 250)
            })
        }

        loadManageAppointmentOptions('')

        if (manageForm) {
            manageForm.addEventListener('submit', function (e) {
                e.preventDefault()

                showManageError('')
                showManageSuccess('')
                showManageResult(null)
                setManageSubmitting(true)

                var idInput = document.getElementById('reception_manage_appointment_id')
                var actionInput = document.getElementById('reception_manage_action')
                var statusInput = document.getElementById('reception_manage_status')

                var appointmentId = idInput ? parseInt(idInput.value, 10) : 0
                var action = actionInput ? actionInput.value : 'fetch'
                var status = statusInput ? statusInput.value : ''

                if (!appointmentId) {
                    showManageError('Appointment ID is required.')
                    setManageSubmitting(false)
                    return
                }

                if (typeof apiFetch !== 'function') {
                    showManageError('API client is not available.')
                    setManageSubmitting(false)
                    return
                }

                var url = "{{ url('/api/appointments') }}/" + encodeURIComponent(appointmentId)

                if (action === 'fetch') {
                    apiFetch(url, { method: 'GET' })
                        .then(function (response) {
                            return response.json().then(function (data) {
                                return { ok: response.ok, status: response.status, data: data }
                            }).catch(function () {
                                return { ok: response.ok, status: response.status, data: null }
                            })
                        })
                        .then(function (result) {
                            if (!result.ok) {
                                var message = 'Failed to fetch appointment.'
                                if (result.data && result.data.message) {
                                    message = result.data.message
                                }
                                showManageError(message)
                                return
                            }

                            showManageSuccess('Appointment details loaded.')
                            showManageResult(result.data)
                        })
                        .catch(function () {
                            showManageError('Network error while fetching appointment.')
                        })
                        .finally(function () {
                            setManageSubmitting(false)
                        })

                    return
                }

                var body = {}

                if (action === 'check_in') {
                    body.check_in_time = new Date().toISOString()
                    if (status) {
                        body.status = status
                    }
                } else if (action === 'cancel') {
                    body.status = status || 'cancelled'
                } else if (action === 'complete') {
                    body.status = status || 'completed'
                }

                var confirmMessageText = 'Apply this action?'
                if (action === 'cancel') confirmMessageText = 'Cancel this appointment?'
                if (action === 'complete') confirmMessageText = 'Mark this appointment as completed?'
                if (action === 'check_in') confirmMessageText = 'Mark this appointment as checked-in now?'

                confirmAction(confirmMessageText)
                    .then(function (confirmed) {
                        if (!confirmed) return
                        return apiFetch(url, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify(body)
                        })
                            .then(function (response) {
                                return response.json().then(function (data) {
                                    return { ok: response.ok, status: response.status, data: data }
                                }).catch(function () {
                                    return { ok: response.ok, status: response.status, data: null }
                                })
                            })
                            .then(function (result) {
                                if (!result.ok) {
                                    var message = 'Failed to update appointment.'
                                    if (result.data && result.data.message) {
                                        message = result.data.message
                                    }
                                    showManageError(message)
                                    return
                                }

                                showManageSuccess('Appointment has been updated.')
                                showManageResult(result.data)
                            })
                            .catch(function () {
                                showManageError('Network error while updating appointment.')
                            })
                    })
                    .finally(function () {
                        setManageSubmitting(false)
                    })
            })
        }
    })
</script>
