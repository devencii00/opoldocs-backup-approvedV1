<div class="bg-white border border-slate-200 rounded-[18px] p-5 shadow-[0_2px_10px_rgba(15,23,42,0.04)]">
    <div class="flex items-center justify-between mb-3">
        <div>
            <h2 class="text-sm font-semibold text-slate-900">Create walk-in</h2>
            <p class="text-xs text-slate-500">Register a walk-in based on personal information or an existing patient.</p>
        </div>
        <span class="text-[0.7rem] text-slate-400 uppercase tracking-widest">Walk-ins</span>
    </div>

    <div class="mb-4 rounded-2xl border border-slate-100 bg-slate-50 p-4">
        <div class="flex items-center justify-between mb-2">
            <div>
                <h3 class="text-xs font-semibold text-slate-900">Walk-in without account</h3>
                <p class="text-[0.72rem] text-slate-500">Creates a patient account + walk-in appointment + queue entry.</p>
            </div>
            <span class="text-[0.68rem] text-slate-400 uppercase tracking-widest">Guest</span>
        </div>

        <div id="receptionGuestWalkInError" class="hidden mb-2 rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-[0.75rem] text-red-700"></div>
        <div id="receptionGuestWalkInSuccess" class="hidden mb-2 rounded-lg border border-emerald-200 bg-emerald-50 px-3 py-2 text-[0.75rem] text-emerald-700"></div>
        <div id="receptionGuestWalkInCreds" class="hidden mb-2 rounded-lg border border-slate-200 bg-white px-3 py-2 text-[0.75rem] text-slate-700"></div>

        <form id="receptionGuestWalkInForm" class="grid gap-3 grid-cols-1 md:grid-cols-4 items-end">
            <div>
                <label for="reception_guest_firstname" class="block text-[0.7rem] text-slate-600 mb-1">First name (optional)</label>
                <input id="reception_guest_firstname" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="First name">
            </div>
            <div>
                <label for="reception_guest_lastname" class="block text-[0.7rem] text-slate-600 mb-1">Last name (optional)</label>
                <input id="reception_guest_lastname" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Last name">
            </div>
            <div>
                <label for="reception_guest_contact" class="block text-[0.7rem] text-slate-600 mb-1">Contact number (optional)</label>
                <input id="reception_guest_contact" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Mobile number">
            </div>
            <div>
                <label for="reception_guest_doctor_id" class="block text-[0.7rem] text-slate-600 mb-1">Doctor ID</label>
                <input id="reception_guest_doctor_id" type="number" min="1" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Doctor ID" required>
            </div>
            <div class="md:col-span-2">
                <label for="reception_guest_reason" class="block text-[0.7rem] text-slate-600 mb-1">Reason (optional)</label>
                <input id="reception_guest_reason" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Reason for visit">
            </div>
            <div>
                <label for="reception_guest_priority_level" class="block text-[0.7rem] text-slate-600 mb-1">Priority level (optional)</label>
                <input id="reception_guest_priority_level" type="number" min="0" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="e.g. 1">
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-slate-900 text-white text-[0.78rem] font-semibold hover:bg-slate-800 transition-colors">
                    Create guest walk-in
                </button>
            </div>
        </form>

        <p class="mt-2 text-[0.7rem] text-slate-400">
            Patient credentials are generated as <span class="font-semibold">patient{id}@mail.com</span> with an auto password.
        </p>
    </div>

    <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">
        <div class="flex items-center justify-between mb-2">
            <div>
                <h3 class="text-xs font-semibold text-slate-900">Walk-in with account</h3>
                <p class="text-[0.72rem] text-slate-500">Create a walk-in (or scheduled) visit for an existing patient.</p>
            </div>
            <span class="text-[0.68rem] text-slate-400 uppercase tracking-widest">Account</span>
        </div>

        <div id="receptionBookAppointmentError" class="hidden mb-3 rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-[0.75rem] text-red-700"></div>
        <div id="receptionBookAppointmentSuccess" class="hidden mb-3 rounded-lg border border-emerald-200 bg-emerald-50 px-3 py-2 text-[0.75rem] text-emerald-700"></div>

        <form id="receptionBookAppointmentForm" class="grid gap-3 grid-cols-1 md:grid-cols-3 items-start">
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
            <div>
                <label for="reception_appointment_priority" class="block text-[0.7rem] text-slate-600 mb-1">Priority level (optional)</label>
                <input id="reception_appointment_priority" type="number" min="0" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="e.g. 1">
            </div>
            <div class="md:col-span-3">
                <label for="reception_appointment_reason" class="block text-[0.7rem] text-slate-600 mb-1">Reason (optional)</label>
                <input id="reception_appointment_reason" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Reason for visit">
            </div>

            <input id="reception_appointment_type" type="hidden" value="walk_in">

            <div class="md:col-span-3 flex items-center gap-2">
                <label class="inline-flex items-center gap-2 text-[0.75rem] text-slate-600">
                    <input id="reception_walkin_auto_queue" type="checkbox" class="rounded border-slate-300 text-cyan-600 focus:ring-cyan-500">
                    Auto add to queue
                </label>
                <span class="text-[0.7rem] text-slate-400">Queue entry will be created right after the visit is created.</span>
            </div>

            <div class="md:col-span-3 flex justify-end">
                <button id="receptionBookAppointmentSubmit" type="submit" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-cyan-600 text-white text-[0.78rem] font-semibold hover:bg-cyan-700 transition-colors disabled:opacity-60 disabled:hover:bg-cyan-600">
                    <span id="receptionBookAppointmentSpinner" class="hidden w-3.5 h-3.5 border-2 border-white/40 border-t-white rounded-full animate-spin"></span>
                    <span id="receptionBookAppointmentSubmitLabel">Create walk-in</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var guestForm = document.getElementById('receptionGuestWalkInForm')
        var guestErrorBox = document.getElementById('receptionGuestWalkInError')
        var guestSuccessBox = document.getElementById('receptionGuestWalkInSuccess')
        var guestCredsBox = document.getElementById('receptionGuestWalkInCreds')

        function showGuestError(message) {
            if (!guestErrorBox) return
            guestErrorBox.textContent = message || ''
            if (message) {
                guestErrorBox.classList.remove('hidden')
            } else {
                guestErrorBox.classList.add('hidden')
            }
        }

        function showGuestSuccess(message) {
            if (!guestSuccessBox) return
            guestSuccessBox.textContent = message || ''
            if (message) {
                guestSuccessBox.classList.remove('hidden')
            } else {
                guestSuccessBox.classList.add('hidden')
            }
        }

        function showGuestCreds(message) {
            if (!guestCredsBox) return
            guestCredsBox.textContent = message || ''
            if (message) {
                guestCredsBox.classList.remove('hidden')
            } else {
                guestCredsBox.classList.add('hidden')
            }
        }

        if (guestForm) {
            guestForm.addEventListener('submit', function (e) {
                e.preventDefault()

                showGuestError('')
                showGuestSuccess('')
                showGuestCreds('')

                var firstNameInput = document.getElementById('reception_guest_firstname')
                var lastNameInput = document.getElementById('reception_guest_lastname')
                var contactInput = document.getElementById('reception_guest_contact')
                var doctorInput = document.getElementById('reception_guest_doctor_id')
                var reasonInput = document.getElementById('reception_guest_reason')
                var priorityInput = document.getElementById('reception_guest_priority_level')

                var doctorId = doctorInput ? parseInt(doctorInput.value, 10) : 0
                if (!doctorId) {
                    showGuestError('Doctor is required.')
                    return
                }

                if (typeof apiFetch !== 'function') {
                    showGuestError('API client is not available.')
                    return
                }

                var body = {
                    doctor_id: doctorId
                }

                var firstName = firstNameInput ? String(firstNameInput.value || '').trim() : ''
                var lastName = lastNameInput ? String(lastNameInput.value || '').trim() : ''
                var contact = contactInput ? String(contactInput.value || '').trim() : ''
                var reason = reasonInput ? String(reasonInput.value || '').trim() : ''
                var priorityLevel = priorityInput && priorityInput.value ? parseInt(priorityInput.value, 10) : null

                if (firstName) body.firstname = firstName
                if (lastName) body.lastname = lastName
                if (contact) body.contact_number = contact
                if (reason) body.reason_for_visit = reason
                if (priorityLevel !== null && !isNaN(priorityLevel)) body.priority_level = priorityLevel

                apiFetch("{{ url('/api/walk-ins/guest') }}", {
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
                            var message = 'Failed to create guest walk-in.'
                            if (result.data && result.data.message) {
                                message = result.data.message
                            }
                            showGuestError(message)
                            return
                        }

                        var queueNumber = result.data && result.data.queue ? result.data.queue.queue_number : null
                        var appointmentId = result.data && result.data.appointment ? result.data.appointment.appointment_id : null
                        var creds = result.data && result.data.credentials ? result.data.credentials : null

                        showGuestSuccess('Guest walk-in created.' + (appointmentId ? ' Appointment #' + appointmentId + '.' : '') + (queueNumber ? ' Queue #' + queueNumber + '.' : ''))

                        if (creds && creds.email && creds.password) {
                            showGuestCreds('Credentials: ' + String(creds.email) + ' / ' + String(creds.password))
                        }

                        if (firstNameInput) firstNameInput.value = ''
                        if (lastNameInput) lastNameInput.value = ''
                        if (contactInput) contactInput.value = ''
                        if (doctorInput) doctorInput.value = ''
                        if (reasonInput) reasonInput.value = ''
                        if (priorityInput) priorityInput.value = ''
                    })
                    .catch(function () {
                        showGuestError('Network error while creating guest walk-in.')
                    })
            })
        }
    })
</script>

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
        var autoQueueInput = document.getElementById('reception_walkin_auto_queue')
        var services = []
        var doctors = []
        var servicesLoaded = false
        var servicesLoading = false
        var popularServices = []
        var popularServicesLoaded = false
        var popularServicesLoading = false
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
        var dateCursorFirstIso = null
        var dateCursorLastIso = null
        var dateCursorIndex = 0

        function setSubmitting(isSubmitting) {
            if (submitBtn) submitBtn.disabled = !!isSubmitting
            if (submitSpinner) submitSpinner.classList.toggle('hidden', !isSubmitting)
            if (submitLabel) submitLabel.textContent = isSubmitting ? 'Creating…' : 'Create walk-in'
        }

        function showError(message) {
            if (!errorBox) return
            errorBox.textContent = message || ''
            errorBox.classList.toggle('hidden', !message)
        }

        function showSuccess(message) {
            if (!successBox) return
            successBox.textContent = message || ''
            successBox.classList.toggle('hidden', !message)
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
                    if (patientSearch) patientSearch.value = patientDisplayName(chosen)
                })
            })
        }

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

        function serviceDisplayName(service) {
            if (!service) return ''
            return String(service.service_name || service.name || '').trim()
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
                    parts.push('Service: ' + String(service.service_name || ''))
                    if (service.price != null) parts.push('Price: ₱' + String(service.price))
                    if (service.duration_minutes != null) parts.push('Duration: ' + String(service.duration_minutes) + ' min')
                    servicePreview.textContent = parts.join(' • ')
                    servicePreview.classList.remove('hidden')
                }
            }

            if (serviceResults) {
                serviceResults.innerHTML = ''
                serviceResults.classList.add('hidden')
            }
        }

        function renderServiceResults(items) {
            if (!serviceResults) return
            var list = Array.isArray(items) ? items : []
            if (!list.length) {
                serviceResults.innerHTML = '<div class="px-3 py-2 text-[0.75rem] text-slate-500">No services found.</div>'
                serviceResults.classList.remove('hidden')
                return
            }
            var html = ''
            list.forEach(function (s) {
                var name = String(s.service_name || '').trim() || 'Service'
                var meta = []
                if (s.duration_minutes != null) meta.push(String(s.duration_minutes) + ' min')
                if (s.price != null) meta.push('₱' + String(s.price))
                html += '<button type="button" class="w-full text-left px-3 py-2 hover:bg-slate-50 border-b border-slate-100 last:border-0">' +
                    '<div class="text-[0.78rem] text-slate-800 font-semibold">' + escapeHtml(name) + '</div>' +
                    '<div class="text-[0.72rem] text-slate-500">#' + escapeHtml(s.service_id) + (meta.length ? ' • ' + escapeHtml(meta.join(' • ')) : '') + '</div>' +
                '</button>'
            })
            serviceResults.innerHTML = html
            serviceResults.classList.remove('hidden')

            var buttons = serviceResults.querySelectorAll('button')
            Array.prototype.forEach.call(buttons, function (btn, idx) {
                btn.addEventListener('click', function () {
                    var chosen = list[idx]
                    setServiceSelection(chosen)
                    if (serviceSearch) serviceSearch.value = serviceDisplayName(chosen)
                    filterDoctorsByService()
                })
            })
        }

        function searchServices(query) {
            var q = normalizeText(query)
            var list = Array.isArray(services) ? services : []
            if (!q) {
                if (!popularServicesLoaded) {
                    if (serviceResults) {
                        serviceResults.innerHTML = '<div class="px-3 py-2 text-[0.75rem] text-slate-500">Loading services…</div>'
                        serviceResults.classList.remove('hidden')
                    }
                    return
                }
                renderServiceResults((popularServices || []).slice(0, 10))
                return
            }
            var filtered = list.filter(function (s) {
                var name = normalizeText(s && s.service_name ? s.service_name : '')
                return name.indexOf(q) !== -1
            })
            renderServiceResults(filtered.slice(0, 10))
        }

        function doctorDisplayName(doctor) {
            if (!doctor) return ''
            var parts = [doctor.firstname, doctor.middlename, doctor.lastname].filter(function (v) { return String(v || '').trim() !== '' })
            var name = parts.join(' ').trim()
            if (!name) name = 'Doctor #' + (doctor.user_id != null ? doctor.user_id : '')
            return name
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
                    var name = [doctor.firstname, doctor.middlename, doctor.lastname].filter(function (v) { return String(v || '').trim() !== '' }).join(' ').trim()
                    if (!name) name = 'Doctor #' + doctor.user_id
                    parts.push('Name: ' + name)
                    if (doctor.specialization) parts.push('Specialization: ' + doctor.specialization)
                    doctorPreview.textContent = parts.join(' • ')
                    doctorPreview.classList.remove('hidden')
                }
            }

            if (doctorResults) {
                doctorResults.innerHTML = ''
                doctorResults.classList.add('hidden')
            }

            var typeInput = document.getElementById('reception_appointment_type')
            var type = typeInput && typeInput.value ? typeInput.value : 'walk_in'
            if (type !== 'walk_in') {
                clearAvailability()
                if (doctor && doctor.user_id) {
                    loadDoctorSchedulesAndAvailability(String(doctor.user_id), null)
                } else {
                    renderTimeSlots()
                }
            } else {
                renderTimeSlots()
            }
        }

        function renderDoctorResults(items) {
            if (!doctorResults) return
            var list = Array.isArray(items) ? items : []
            if (!list.length) {
                doctorResults.innerHTML = '<div class="px-3 py-2 text-[0.75rem] text-slate-500">No doctors found.</div>'
                doctorResults.classList.remove('hidden')
                return
            }
            var html = ''
            list.forEach(function (d) {
                var name = [d.firstname, d.middlename, d.lastname].filter(function (v) { return String(v || '').trim() !== '' }).join(' ').trim()
                if (!name) name = 'Doctor #' + d.user_id
                var meta = [d.specialization].filter(Boolean).join(' • ')
                html += '<button type="button" class="w-full text-left px-3 py-2 hover:bg-slate-50 border-b border-slate-100 last:border-0">' +
                    '<div class="text-[0.78rem] text-slate-800 font-semibold">' + escapeHtml(name) + '</div>' +
                    '<div class="text-[0.72rem] text-slate-500">#' + escapeHtml(d.user_id) + (meta ? ' • ' + escapeHtml(meta) : '') + '</div>' +
                '</button>'
            })
            doctorResults.innerHTML = html
            doctorResults.classList.remove('hidden')

            var buttons = doctorResults.querySelectorAll('button')
            Array.prototype.forEach.call(buttons, function (btn, idx) {
                btn.addEventListener('click', function () {
                    var chosen = list[idx]
                    setDoctorSelection(chosen)
                    if (doctorSearch) doctorSearch.value = doctorDisplayName(chosen)
                })
            })
        }

        function filterDoctorsByService() {
            var list = Array.isArray(doctors) ? doctors : []
            if (!selectedService) {
                if (doctorSearch) doctorSearch.disabled = true
                setDoctorSelection(null)
                if (doctorSearch) doctorSearch.value = ''
                if (doctorResults) doctorResults.classList.add('hidden')
                return
            }
            var category = extractServiceCategory(selectedService && selectedService.service_name ? selectedService.service_name : '')
            var filtered = list.filter(function (d) {
                var spec = d && d.specialization ? d.specialization : ''
                return specializationMatches(category, spec)
            })
            if (doctorSearch) doctorSearch.disabled = false
            if (filtered.length === 1) {
                setDoctorSelection(filtered[0])
                if (doctorSearch) doctorSearch.value = doctorDisplayName(filtered[0])
            } else {
                setDoctorSelection(null)
                if (doctorSearch) doctorSearch.value = ''
            }
        }

        function searchDoctors(query) {
            var q = normalizeText(query)
            var list = Array.isArray(doctors) ? doctors : []
            if (selectedService) {
                var category = extractServiceCategory(selectedService && selectedService.service_name ? selectedService.service_name : '')
                list = list.filter(function (d) {
                    var spec = d && d.specialization ? d.specialization : ''
                    return specializationMatches(category, spec)
                })
            }
            if (!q) {
                renderDoctorResults(list.slice(0, 30))
                return
            }
            var filtered = list.filter(function (d) {
                var name = normalizeText([d.firstname, d.middlename, d.lastname].filter(function (v) { return String(v || '').trim() !== '' }).join(' '))
                var spec = normalizeText(d && d.specialization ? d.specialization : '')
                return name.indexOf(q) !== -1 || spec.indexOf(q) !== -1
            })
            renderDoctorResults(filtered.slice(0, 30))
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

        function isoDate(d) {
            var yr = d.getFullYear()
            var mo = String(d.getMonth() + 1).padStart(2, '0')
            var da = String(d.getDate()).padStart(2, '0')
            return yr + '-' + mo + '-' + da
        }

        function resetDateCursor() {
            var now = new Date()
            dateCursorFirstIso = isoDate(now)
            var end = new Date(now.getTime() + (1000 * 60 * 60 * 24 * 365))
            dateCursorLastIso = isoDate(end)
            dateCursorIndex = 0
        }

        function appendAllowedDates(daysToAdd) {
            if (!dateSelect) return
            var allowedKeys = doctorAvailableDaySet && Object.keys(doctorAvailableDaySet).length ? doctorAvailableDaySet : null
            if (!allowedKeys) return
            var start = new Date(dateCursorFirstIso + 'T00:00:00')
            if (isNaN(start.getTime())) return
            var added = 0
            var limit = parseInt(daysToAdd || 0, 10)
            if (isNaN(limit) || limit <= 0) limit = 60

            for (var i = 0; i < limit * 3 && added < limit; i++) {
                var d = new Date(start.getTime() + (1000 * 60 * 60 * 24 * (dateCursorIndex + i)))
                if (d.getTime() > new Date(dateCursorLastIso + 'T00:00:00').getTime()) break
                var key = ['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'][d.getDay()] || ''
                if (!key || !allowedKeys[key]) continue
                var value = isoDate(d)
                if (dateSelect.querySelector('option[value="' + value + '"]')) continue
                var opt = document.createElement('option')
                opt.value = value
                opt.textContent = value
                dateSelect.appendChild(opt)
                added += 1
            }

            dateCursorIndex += limit
            if (dateLoadMore) dateLoadMore.classList.toggle('hidden', dateSelect.options.length <= 1)
            if (dateRangeHint) {
                dateRangeHint.textContent = dateCursorFirstIso + ' → ' + dateCursorLastIso
                dateRangeHint.classList.remove('hidden')
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
            dateSelect.disabled = false
            if (dateSelect.options && dateSelect.options.length <= 1) {
                var none = document.createElement('option')
                none.value = ''
                none.textContent = 'No available dates in range'
                dateSelect.appendChild(none)
            }
        }

        function renderAvailableDays() {
            if (!availableDaysEl) return
            if (!doctorSchedules || !doctorSchedules.length) {
                availableDaysEl.textContent = ''
                return
            }
            var days = {}
            doctorSchedules.forEach(function (s) {
                if (!s) return
                if (s.is_available === false) return
                var k = String(s.day_of_week || '').toLowerCase()
                if (!k) return
                days[k] = true
            })
            doctorAvailableDaySet = days
            var order = ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun']
            var labels = { mon: 'Mon', tue: 'Tue', wed: 'Wed', thu: 'Thu', fri: 'Fri', sat: 'Sat', sun: 'Sun' }
            var list = order.filter(function (k) { return !!days[k] }).map(function (k) { return labels[k] || k })
            availableDaysEl.textContent = list.length ? ('Available: ' + list.join(', ')) : ''
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

            var typeInput = document.getElementById('reception_appointment_type')
            var apptType = typeInput && typeInput.value ? typeInput.value : 'walk_in'
            if (apptType === 'walk_in') {
                timeSlotsEl.innerHTML = '<div class="text-[0.7rem] text-slate-400">Walk-in visits do not require a time slot.</div>'
                return
            }

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
                        showError(msg)
                        if ((!doctorSchedules || !doctorSchedules.length) && dateSelect) {
                            dateSelect.innerHTML = '<option value="">Failed to load schedules</option>'
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
                    showError('Network error while loading doctor schedules.')
                    if ((!doctorSchedules || !doctorSchedules.length) && dateSelect) {
                        dateSelect.innerHTML = '<option value="">Network error loading schedules</option>'
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
                .catch(function () { renderTimeSlots() })
        }

        function onDateChanged() {
            showError('')
            showSuccess('')
            selectedSlotStart = null
            if (timeInput) timeInput.value = ''
            if (!doctorSelect || !doctorSelect.value) {
                renderTimeSlots()
                return
            }
            var dateStr = dateSelect && dateSelect.value ? dateSelect.value : ''
            if (!dateStr) {
                if (dateInput) dateInput.value = ''
                renderTimeSlots()
                return
            }
            if (dateInput) dateInput.value = dateStr
            loadDoctorAppointments(doctorSelect.value, dateStr)
        }

        function loadServicesAndDoctors() {
            if (typeof apiFetch !== 'function') return
            if (!servicesLoaded && !servicesLoading) {
                servicesLoading = true
                apiFetch("{{ url('/api/services') }}?per_page=100", { method: 'GET' })
                    .then(function (r) { return readResponse(r) })
                    .then(function (res) {
                        if (res.ok) {
                            services = res.data && Array.isArray(res.data.data) ? res.data.data : (Array.isArray(res.data) ? res.data : [])
                            servicesLoaded = true
                            if (serviceSearch && document.activeElement === serviceSearch) {
                                searchServices(String(serviceSearch.value || '').trim())
                            }
                        }
                    })
                    .finally(function () { servicesLoading = false })
            }
            if (!popularServicesLoaded && !popularServicesLoading) {
                popularServicesLoading = true
                apiFetch("{{ url('/api/services-popular') }}?limit=10", { method: 'GET' })
                    .then(function (r) { return readResponse(r) })
                    .then(function (res) {
                        if (res.ok) {
                            popularServices = Array.isArray(res.data) ? res.data : (res.data && Array.isArray(res.data.data) ? res.data.data : [])
                            popularServicesLoaded = true
                        }
                    })
                    .finally(function () { popularServicesLoading = false })
            }
            if (!doctorsLoaded && !doctorsLoading) {
                doctorsLoading = true
                apiFetch("{{ url('/api/doctors') }}?per_page=100", { method: 'GET' })
                    .then(function (r) { return readResponse(r) })
                    .then(function (res) {
                        if (res.ok) {
                            doctors = res.data && Array.isArray(res.data.data) ? res.data.data : (Array.isArray(res.data) ? res.data : [])
                            doctorsLoaded = true
                            filterDoctorsByService()
                            if (doctorSearch && document.activeElement === doctorSearch) {
                                searchDoctors(String(doctorSearch.value || '').trim())
                            }
                        }
                    })
                    .finally(function () { doctorsLoading = false })
            }
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
            var type = typeInput && typeInput.value ? typeInput.value : 'walk_in'
            setTypeButtonState(typeScheduledBtn, type === 'scheduled')
            setTypeButtonState(typeWalkInBtn, type === 'walk_in')
        }

        function applyAppointmentTypeUI() {
            if (typeInput) typeInput.value = 'walk_in'
            var type = 'walk_in'
            var isWalkIn = type === 'walk_in'
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
            }
            renderTimeSlots()
        }

        function setAppointmentType(nextType) {
            if (typeInput) typeInput.value = 'walk_in'
            applyAppointmentTypeUI()
        }

        if (typeScheduledBtn) typeScheduledBtn.addEventListener('click', function () { setAppointmentType('scheduled') })
        if (typeWalkInBtn) typeWalkInBtn.addEventListener('click', function () { setAppointmentType('walk_in') })

        if (patientSearch) {
            patientSearch.addEventListener('input', function () {
                var q = String(patientSearch.value || '').trim()
                if (selectedPatient) setPatientSelection(null)
                if (patientSearchTimer) clearTimeout(patientSearchTimer)
                patientSearchTimer = setTimeout(function () {
                    searchPatients(q)
                }, 250)
            })
            patientSearch.addEventListener('focus', function () {
                var q = String(patientSearch.value || '').trim()
                if (q) {
                    searchPatients(q)
                } else {
                    searchPatients('')
                }
            })
        }

        if (serviceSearch) {
            serviceSearch.addEventListener('input', function () {
                var q = String(serviceSearch.value || '').trim()
                if (selectedService) {
                    setServiceSelection(null)
                    filterDoctorsByService()
                }
                searchServices(q)
            })
            serviceSearch.addEventListener('focus', function () {
                var q = String(serviceSearch.value || '').trim()
                searchServices(q)
            })
        }

        if (doctorSearch) {
            doctorSearch.addEventListener('input', function () {
                var q = String(doctorSearch.value || '').trim()
                if (selectedDoctor) setDoctorSelection(null)
                searchDoctors(q)
            })
            doctorSearch.addEventListener('focus', function () {
                var q = String(doctorSearch.value || '').trim()
                searchDoctors(q)
            })
        }

        if (dateSelect) {
            dateSelect.addEventListener('change', onDateChanged)
            if (dateLoadMore) {
                dateLoadMore.addEventListener('click', function () {
                    if (dateLoadMore.disabled) return
                    appendAllowedDates(60)
                })
            }
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
        if (typeInput && !typeInput.value) typeInput.value = 'walk_in'
        syncTypeToggleUI()
        applyAppointmentTypeUI()

        if (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault()

                showError('')
                showSuccess('')
                setSubmitting(true)

                var patientInput = document.getElementById('reception_appointment_patient_id')
                var doctorInput = document.getElementById('reception_appointment_doctor_id')
                var serviceInput = document.getElementById('reception_appointment_service_id')
                var dateSelect = document.getElementById('reception_appointment_date_select')
                var dateInput = document.getElementById('reception_appointment_date')
                var timeInput = document.getElementById('reception_appointment_time')
                var typeInput = document.getElementById('reception_appointment_type')
                var priorityInput = document.getElementById('reception_appointment_priority')
                var reasonInput = document.getElementById('reception_appointment_reason')

                var patientId = patientInput ? parseInt(patientInput.value, 10) : 0
                var doctorId = doctorInput ? parseInt(doctorInput.value, 10) : 0
                var serviceId = serviceInput ? parseInt(serviceInput.value, 10) : 0
                var date = dateSelect && dateSelect.value ? dateSelect.value : (dateInput ? dateInput.value : '')
                var time = timeInput ? timeInput.value : ''
                var type = 'walk_in'
                var priority = priorityInput && priorityInput.value ? parseInt(priorityInput.value, 10) : null
                var reason = reasonInput ? reasonInput.value : ''
                var autoQueue = autoQueueInput ? !!autoQueueInput.checked : false

                if (!patientId || !serviceId || !doctorId) {
                    showError('Patient, service, and doctor are required.')
                    setSubmitting(false)
                    return
                }

                if (type !== 'walk_in') {
                    if (!date || !time) {
                        showError('Date and time are required for scheduled visits.')
                        setSubmitting(false)
                        return
                    }
                }

                if (typeof apiFetch !== 'function') {
                    showError('API client is not available.')
                    setSubmitting(false)
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
                if (reason) body.reason_for_visit = reason
                if (priority !== null && !isNaN(priority)) body.priority_level = priority

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
                            var message = 'Failed to create walk-in.'
                            if (result.data && result.data.message) message = result.data.message
                            showError(message)
                            return
                        }

                        var created = result.data || {}
                        function afterQueue() {
                            showSuccess('Walk-in has been created successfully.' + (autoQueue ? ' Queue entry created.' : ''))
                            if (patientSearch) patientSearch.value = ''
                            if (serviceSearch) serviceSearch.value = ''
                            if (doctorSearch) doctorSearch.value = ''
                            setPatientSelection(null)
                            setServiceSelection(null)
                            setDoctorSelection(null)
                            if (dateInput) dateInput.value = ''
                            if (timeInput) timeInput.value = ''
                            if (priorityInput) priorityInput.value = ''
                            if (reasonInput) reasonInput.value = ''
                            if (autoQueueInput) autoQueueInput.checked = false
                            if (typeInput) typeInput.value = 'walk_in'
                            syncTypeToggleUI()
                            applyAppointmentTypeUI()
                        }

                        if (autoQueue && created && created.appointment_id) {
                            apiFetch("{{ url('/api/queues') }}", {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({ appointment_id: created.appointment_id })
                            })
                                .then(function () { afterQueue() })
                                .catch(function () { afterQueue() })
                        } else {
                            afterQueue()
                        }
                    })
                    .catch(function () {
                        showError('Network error while creating walk-in.')
                    })
                    .finally(function () {
                        setSubmitting(false)
                    })
            })
        }
    })
</script>
