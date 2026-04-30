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

    <form id="receptionBookAppointmentForm" class="grid gap-3 grid-cols-1 md:grid-cols-3 items-end mb-4">
        <div>
            <label for="reception_appointment_patient_id" class="block text-[0.7rem] text-slate-600 mb-1">Patient ID</label>
            <input id="reception_appointment_patient_id" type="number" min="1" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Patient ID" required>
        </div>
        <div>
            <label for="reception_appointment_service_id" class="block text-[0.7rem] text-slate-600 mb-1">Service</label>
            <input id="reception_service_search" type="text" class="mb-1 w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Search service">
            <select id="reception_appointment_service_id" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" required>
                <option value="">Select a service</option>
            </select>
        </div>
        <div>
            <label for="reception_appointment_doctor_id" class="block text-[0.7rem] text-slate-600 mb-1">Doctor</label>
            <input id="reception_doctor_search" type="text" class="mb-1 w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Search doctor">
            <select id="reception_appointment_doctor_id" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" required>
                <option value="">Select a doctor</option>
            </select>
        </div>
        <div>
            <label for="reception_appointment_status" class="block text-[0.7rem] text-slate-600 mb-1">Status</label>
            <select id="reception_appointment_status" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                <option value="">Default (pending)</option>
                <option value="pending">Pending</option>
                <option value="confirmed">Confirmed</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
                <option value="no_show">No show</option>
            </select>
        </div>
        <div>
            <label for="reception_appointment_date" class="block text-[0.7rem] text-slate-600 mb-1">Date</label>
            <input id="reception_appointment_date" type="date" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" required>
        </div>
        <div>
            <label class="block text-[0.7rem] text-slate-600 mb-1">Time slot</label>
            <input id="reception_appointment_time" type="hidden" required>
            <div id="reception_available_days" class="mb-1 text-[0.7rem] text-slate-500"></div>
            <div id="reception_time_slots" class="flex flex-wrap gap-2"></div>
        </div>
        <div>
            <label for="reception_appointment_type" class="block text-[0.7rem] text-slate-600 mb-1">Appointment type</label>
            <select id="reception_appointment_type" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                <option value="scheduled">Scheduled</option>
                <option value="walk_in">Walk-in</option>
            </select>
        </div>
        <div>
            <label for="reception_appointment_priority" class="block text-[0.7rem] text-slate-600 mb-1">Priority level (optional)</label>
            <input id="reception_appointment_priority" type="number" min="0" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="e.g. 1">
        </div>
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
        Use patient and doctor IDs from the system. Status and appointment types follow the clinic&apos;s configuration.
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

        <form id="receptionManageAppointmentForm" class="grid gap-3 grid-cols-1 md:grid-cols-4 items-end mb-3">
            <div>
                <label for="reception_manage_appointment_id" class="block text-[0.7rem] text-slate-600 mb-1">Appointment ID</label>
                <input id="reception_manage_appointment_id" type="number" min="1" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Appointment ID" required>
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
        var serviceSearch = document.getElementById('reception_service_search')
        var serviceSelect = document.getElementById('reception_appointment_service_id')
        var doctorSearch = document.getElementById('reception_doctor_search')
        var doctorSelect = document.getElementById('reception_appointment_doctor_id')
        var dateInput = document.getElementById('reception_appointment_date')
        var timeInput = document.getElementById('reception_appointment_time')
        var availableDaysEl = document.getElementById('reception_available_days')
        var timeSlotsEl = document.getElementById('reception_time_slots')
        var services = []
        var doctors = []
        var doctorSchedules = []
        var doctorAppointments = []
        var selectedScheduleId = null

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

        function renderServiceOptions() {
            if (!serviceSelect) return
            var q = serviceSearch ? normalizeText(serviceSearch.value) : ''
            var html = '<option value="">Select a service</option>'
            services.forEach(function (s) {
                var label = s.service_name || ('Service #' + s.service_id)
                if (q && normalizeText(label).indexOf(q) === -1) return
                html += '<option value="' + s.service_id + '">' + escapeHtml(label) + '</option>'
            })
            serviceSelect.innerHTML = html
        }

        function renderDoctorOptions() {
            if (!doctorSelect) return
            var selectedServiceId = serviceSelect ? serviceSelect.value : ''
            var selectedService = services.find(function (s) { return String(s.service_id) === String(selectedServiceId) })
            var category = extractServiceCategory(selectedService ? selectedService.service_name : '')
            var q = doctorSearch ? normalizeText(doctorSearch.value) : ''

            var filtered = doctors
            if (category) {
                filtered = doctors.filter(function (d) {
                    return specializationMatches(category, d.specialization)
                })
            } else {
                filtered = []
            }

            var html = '<option value="">' + (category ? 'Select a doctor' : 'Select a service first') + '</option>'
            filtered.forEach(function (d) {
                var name = (d.firstname || '') + ' ' + (d.lastname || '')
                name = name.trim() || ('Doctor #' + d.user_id)
                var full = name + (d.specialization ? ' — ' + d.specialization : '')
                if (q && normalizeText(full).indexOf(q) === -1) return
                html += '<option value="' + d.user_id + '">' + escapeHtml(full) + '</option>'
            })
            doctorSelect.innerHTML = html
        }

        function clearAvailability() {
            doctorSchedules = []
            doctorAppointments = []
            selectedScheduleId = null
            if (timeInput) timeInput.value = ''
            if (availableDaysEl) availableDaysEl.textContent = ''
            if (timeSlotsEl) timeSlotsEl.innerHTML = ''
        }

        function renderAvailableDays() {
            if (!availableDaysEl) return
            if (!doctorSchedules.length) {
                availableDaysEl.textContent = ''
                return
            }
            var set = {}
            doctorSchedules.forEach(function (s) {
                var days = Array.isArray(s.days) ? s.days : []
                days.forEach(function (d) {
                    if (d && d.day_of_week) set[String(d.day_of_week).toLowerCase()] = true
                })
            })
            var order = ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun']
            var keys = Object.keys(set).sort(function (a, b) { return order.indexOf(a) - order.indexOf(b) })
            availableDaysEl.textContent = keys.length ? ('Available days: ' + keys.join(', ')) : ''
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

            var daySchedules = doctorSchedules.filter(function (s) {
                var days = Array.isArray(s.days) ? s.days : []
                return days.some(function (d) { return String(d.day_of_week || '').toLowerCase() === dayKey })
            })

            if (!daySchedules.length) {
                timeSlotsEl.innerHTML = '<div class="text-[0.7rem] text-slate-400">Doctor is not available on this day.</div>'
                return
            }

            daySchedules.sort(function (a, b) {
                var sa = minutesFromHHMM(String(a.start_time || ''))
                var sb = minutesFromHHMM(String(b.start_time || ''))
                if (isNaN(sa) || isNaN(sb)) return 0
                return sa - sb
            })

            var appts = Array.isArray(doctorAppointments) ? doctorAppointments : []
            var apptTimes = appts
                .map(function (a) { return String(a.appointment_datetime || '').replace('T', ' ').slice(0, 16) })
                .filter(function (v) { return /^\d{4}-\d{2}-\d{2} \d{2}:\d{2}$/.test(v) })

            daySchedules.forEach(function (s) {
                var start = String(s.start_time || '').slice(0, 5)
                var end = String(s.end_time || '').slice(0, 5)
                var startMin = minutesFromHHMM(start)
                var endMin = minutesFromHHMM(end)

                var booked = 0
                apptTimes.forEach(function (dt) {
                    var timePart = dt.slice(11, 16)
                    var tmin = minutesFromHHMM(timePart)
                    if (isNaN(tmin) || isNaN(startMin) || isNaN(endMin)) return
                    if (tmin >= startMin && tmin < endMin) booked += 1
                })

                var cap = s.max_patients == null ? null : parseInt(s.max_patients, 10)
                var isFull = cap != null && !isNaN(cap) && booked >= cap
                var label = (formatTime12h(start) + '–' + formatTime12h(end))
                var suffix = cap != null && !isNaN(cap) ? (' · ' + Math.max(cap - booked, 0) + '/' + cap) : ''

                var btn = document.createElement('button')
                btn.type = 'button'
                btn.className =
                    'px-3 py-2 rounded-xl text-[0.75rem] font-semibold border transition-colors ' +
                    (isFull
                        ? 'border-slate-200 bg-slate-100 text-slate-400 cursor-not-allowed'
                        : (String(selectedScheduleId) === String(s.schedule_id)
                            ? 'border-cyan-600 bg-cyan-600 text-white'
                            : 'border-slate-200 bg-white text-slate-700 hover:bg-slate-50'))
                btn.disabled = !!isFull
                btn.textContent = label + (isFull ? ' · Full' : suffix)
                btn.addEventListener('click', function () {
                    selectedScheduleId = s.schedule_id
                    if (timeInput) timeInput.value = start
                    renderTimeSlots()
                })

                timeSlotsEl.appendChild(btn)
            })
        }

        function loadDoctorSchedulesAndAvailability(doctorId, dateStr) {
            if (!doctorId || typeof apiFetch !== 'function') return
            clearAvailability()
            apiFetch("{{ url('/api/doctor-schedules') }}?doctor_id=" + encodeURIComponent(doctorId) + "&per_page=200", { method: 'GET' })
                .then(function (response) { return readResponse(response) })
                .then(function (result) {
                    var raw = result.data && Array.isArray(result.data.data) ? result.data.data : (Array.isArray(result.data) ? result.data : [])
                    doctorSchedules = raw || []
                    renderAvailableDays()
                    if (dateStr) {
                        loadDoctorAppointments(doctorId, dateStr)
                    } else {
                        renderTimeSlots()
                    }
                })
                .catch(function () {})
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
                    services = raw || []
                    renderServiceOptions()
                    renderDoctorOptions()
                })
                .catch(function () {})

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
                    renderDoctorOptions()
                })
                .catch(function () {})
        }

        if (serviceSearch) {
            serviceSearch.addEventListener('input', function () {
                renderServiceOptions()
            })
        }
        if (doctorSearch) {
            doctorSearch.addEventListener('input', function () {
                renderDoctorOptions()
            })
        }

        if (serviceSelect) {
            serviceSelect.addEventListener('change', function () {
                showBookAppointmentError('')
                showBookAppointmentSuccess('')
                if (doctorSelect) doctorSelect.value = ''
                renderDoctorOptions()
                clearAvailability()
            })
        }

        if (doctorSelect) {
            doctorSelect.addEventListener('change', function () {
                showBookAppointmentError('')
                showBookAppointmentSuccess('')
                var doctorId = doctorSelect.value
                var dateStr = dateInput ? dateInput.value : ''
                if (!doctorId) {
                    clearAvailability()
                    return
                }
                loadDoctorSchedulesAndAvailability(doctorId, dateStr)
            })
        }

        if (dateInput) {
            dateInput.addEventListener('change', function () {
                showBookAppointmentError('')
                showBookAppointmentSuccess('')
                selectedScheduleId = null
                if (timeInput) timeInput.value = ''
                var doctorId = doctorSelect ? doctorSelect.value : ''
                var dateStr = dateInput.value
                if (!doctorId || !dateStr) {
                    renderTimeSlots()
                    return
                }
                loadDoctorAppointments(doctorId, dateStr)
            })
        }

        loadServicesAndDoctors()

        if (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault()

                showBookAppointmentError('')
                showBookAppointmentSuccess('')
                setBookSubmitting(true)

                var patientInput = document.getElementById('reception_appointment_patient_id')
                var doctorInput = document.getElementById('reception_appointment_doctor_id')
                var serviceInput = document.getElementById('reception_appointment_service_id')
                var statusInput = document.getElementById('reception_appointment_status')
                var dateInput = document.getElementById('reception_appointment_date')
                var timeInput = document.getElementById('reception_appointment_time')
                var typeInput = document.getElementById('reception_appointment_type')
                var priorityInput = document.getElementById('reception_appointment_priority')
                var reasonInput = document.getElementById('reception_appointment_reason')

                var patientId = patientInput ? parseInt(patientInput.value, 10) : 0
                var doctorId = doctorInput ? parseInt(doctorInput.value, 10) : 0
                var serviceId = serviceInput ? parseInt(serviceInput.value, 10) : 0
                var status = statusInput ? statusInput.value : ''
                var date = dateInput ? dateInput.value : ''
                var time = timeInput ? timeInput.value : ''
                var type = typeInput && typeInput.value ? typeInput.value : 'scheduled'
                var priority = priorityInput && priorityInput.value ? parseInt(priorityInput.value, 10) : null
                var reason = reasonInput ? reasonInput.value : ''

                if (!patientId || !serviceId || !doctorId || !date || !time) {
                    showBookAppointmentError('Patient, service, doctor, date, and time are required.')
                    setBookSubmitting(false)
                    return
                }

                if (typeof apiFetch !== 'function') {
                    showBookAppointmentError('API client is not available.')
                    setBookSubmitting(false)
                    return
                }

                var appointmentDateTime = date + ' ' + time

                var body = {
                    patient_id: patientId,
                    doctor_id: doctorId,
                    service_id: serviceId,
                    appointment_datetime: appointmentDateTime,
                    appointment_type: type
                }

                if (status) {
                    body.status = status
                }
                if (reason) {
                    body.reason_for_visit = reason
                }
                if (priority !== null && !isNaN(priority)) {
                    body.priority_level = priority
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
                        if (patientInput) patientInput.value = ''
                        if (serviceInput) serviceInput.value = ''
                        if (doctorInput) doctorInput.value = ''
                        if (statusInput) statusInput.value = ''
                        if (dateInput) dateInput.value = ''
                        if (timeInput) timeInput.value = ''
                        if (typeInput) typeInput.value = 'scheduled'
                        if (priorityInput) priorityInput.value = ''
                        if (reasonInput) reasonInput.value = ''
                        renderDoctorOptions()
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
