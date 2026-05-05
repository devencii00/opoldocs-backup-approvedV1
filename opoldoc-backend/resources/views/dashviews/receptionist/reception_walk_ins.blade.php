<div class="bg-white border border-slate-200 rounded-[18px] shadow-[0_2px_10px_rgba(15,23,42,0.04)] overflow-hidden">
    <div class="grid grid-cols-2 border-b border-slate-200">
      <button id="receptionWalkInTabAccount" type="button" class="px-4 py-3 text-xs font-semibold text-white bg-cyan-500 border-b-2 border-cyan-600">
    Walk-in
</button>
<button id="receptionWalkInTabGuest" type="button" class="px-4 py-3 text-xs font-semibold text-slate-900 bg-white hover:bg-slate-50 border-l border-slate-200">
    Guest walk-in
</button>
    </div>

    <div class="p-5 pb-0">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-sm font-semibold text-slate-900">Create walk-in</h2>
                <p class="text-xs text-slate-500">Register a walk-in based on personal information or an existing patient.</p>
            </div>
            <span class="text-[0.7rem] text-slate-400 uppercase tracking-widest">Walk-ins</span>
        </div>
    </div>

    <div id="receptionWalkInPanelGuest" class="hidden p-5 pt-4">
    <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">
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
    </div>

    <div id="receptionWalkInPanelAccount" class="p-5 pt-4">
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
                    <div id="receptionPatientResults" class="hidden absolute left-0 right-0 top-full mt-1 w-full rounded-lg border border-slate-200 bg-white shadow-sm max-h-64 overflow-y-auto overscroll-contain z-50"></div>
                </div>
                <div id="receptionPatientPreview" class="hidden mt-2 rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-[0.78rem] text-slate-700 break-words"></div>
            </div>
            <div class="min-w-0">
                <label for="reception_appointment_service_ids" class="block text-[0.7rem] text-slate-600 mb-1">Services</label>
                <div class="relative">
                    <input id="reception_service_search" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Type to search service">
                    <input id="reception_appointment_service_ids" type="hidden">
                    <div id="receptionServiceResults" class="hidden absolute left-0 right-0 top-full mt-1 w-full rounded-lg border border-slate-200 bg-white shadow-sm max-h-64 overflow-y-auto overscroll-contain z-50"></div>
                </div>
                <div id="receptionSelectedServices" class="mt-2 rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-[0.78rem] text-slate-700 max-h-24 overflow-y-auto overscroll-contain"></div>
            </div>
            <div class="min-w-0">
                <label for="reception_appointment_doctor_id" class="block text-[0.7rem] text-slate-600 mb-1">Doctor</label>
                <div class="relative">
                    <input id="reception_doctor_search" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Type to search doctor" disabled>
                    <input id="reception_appointment_doctor_id" type="hidden" required>
                    <div id="receptionDoctorResults" class="hidden absolute left-0 right-0 top-full mt-1 w-full rounded-lg border border-slate-200 bg-white shadow-sm max-h-64 overflow-y-auto overscroll-contain z-50"></div>
                </div>
                <div id="receptionDoctorPreview" class="hidden mt-2 rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-[0.78rem] text-slate-700 break-words"></div>
            </div>
            <div id="receptionAppointmentDateWrap" class="self-start relative">
                <label for="reception_appointment_date" class="block text-[0.7rem] text-slate-600 mb-1">Date</label>
                <button id="receptionAppointmentDateTrigger" type="button" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 text-left focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none disabled:opacity-60" disabled>
                    Select a doctor first
                </button>
                <div id="receptionAppointmentDateOverlay" class="hidden absolute left-0 right-0 top-full mt-1 z-50 rounded-xl border border-slate-200 bg-white shadow-[0_12px_30px_rgba(15,23,42,0.12)]">
                    <div class="flex items-center justify-between px-3 py-2 border-b border-slate-100">
                        <button id="receptionDatePrev" type="button" class="px-2 py-1 rounded-lg border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 text-xs font-semibold">‹</button>
                        <div id="receptionDateMonthLabel" class="text-[0.78rem] font-semibold text-slate-800"></div>
                        <button id="receptionDateNext" type="button" class="px-2 py-1 rounded-lg border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 text-xs font-semibold">›</button>
                    </div>
                    <div class="p-3">
                        <div class="grid grid-cols-7 gap-1 text-[0.68rem] text-slate-400 mb-2">
                            <div class="text-center">Sun</div><div class="text-center">Mon</div><div class="text-center">Tue</div><div class="text-center">Wed</div><div class="text-center">Thu</div><div class="text-center">Fri</div><div class="text-center">Sat</div>
                        </div>
                        <div id="receptionAppointmentDateGrid" class="grid grid-cols-7 gap-1"></div>
                    </div>
                </div>
                <select id="reception_appointment_date_select" class="hidden" required disabled>
                    <option value="">Select a doctor first</option>
                </select>
                <div class="mb-1 text-[0.7rem] text-slate-500">&nbsp;</div>
                <div class="mt-1 flex items-center justify-between">
                    <button type="button" id="reception_appointment_date_load_more" class="hidden text-[0.72rem] font-semibold text-cyan-700 hover:text-cyan-800">Load more dates</button>
                    <div id="reception_appointment_date_range_hint" class="hidden text-[0.7rem] text-slate-400"></div>
                </div>
                <input id="reception_appointment_date" type="date" class="hidden" tabindex="-1">
            </div>
            <div id="receptionAppointmentTimeWrap" class="self-start relative">
                <label class="block text-[0.7rem] text-slate-600 mb-1">Time slot</label>
                <input id="reception_appointment_time" type="hidden" required>
                <div id="reception_available_days" class="mb-1 text-[0.7rem] text-slate-500"></div>
                <button id="receptionTimeSlotTrigger" type="button" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 text-left focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none disabled:opacity-60" disabled>
                    Select a date first
                </button>
                <div id="receptionTimeSlotOverlay" class="hidden absolute left-0 right-0 top-full mt-1 z-50 rounded-xl border border-slate-200 bg-white shadow-[0_12px_30px_rgba(15,23,42,0.12)]">
                    <div id="reception_time_slots" class="max-h-44 overflow-y-auto overscroll-contain flex flex-col gap-2 p-2"></div>
                </div>
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

            <div class="md:col-span-3 flex justify-end">
                <button id="receptionBookAppointmentSubmit" type="submit" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-cyan-600 text-white text-[0.78rem] font-semibold hover:bg-cyan-700 transition-colors disabled:opacity-60 disabled:hover:bg-cyan-600">
                    <span id="receptionBookAppointmentSpinner" class="hidden w-3.5 h-3.5 border-2 border-white/40 border-t-white rounded-full animate-spin"></span>
                    <span id="receptionBookAppointmentSubmitLabel">Create walk-in</span>
                </button>
            </div>
        </form>
    </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var tabAccountBtn = document.getElementById('receptionWalkInTabAccount')
        var tabGuestBtn = document.getElementById('receptionWalkInTabGuest')
        var panelAccount = document.getElementById('receptionWalkInPanelAccount')
        var panelGuest = document.getElementById('receptionWalkInPanelGuest')
function setWalkInTab(tab) {
    var isAccount = tab === 'account'
    if (panelAccount) panelAccount.classList.toggle('hidden', !isAccount)
    if (panelGuest) panelGuest.classList.toggle('hidden', isAccount)

    if (tabAccountBtn) {
        // Active tab (Account)
        tabAccountBtn.classList.toggle('bg-cyan-500', isAccount)      // Cyan background
        tabAccountBtn.classList.toggle('text-white', isAccount)       // White text
        tabAccountBtn.classList.toggle('border-b-2', isAccount)       // Bottom border indicator
        tabAccountBtn.classList.toggle('border-cyan-600', isAccount)  // Darker cyan border
        // Inactive tab
        tabAccountBtn.classList.toggle('bg-white', !isAccount)        // White background
        tabAccountBtn.classList.toggle('text-slate-900', !isAccount)  // Dark text
        tabAccountBtn.classList.toggle('hover:bg-slate-50', !isAccount) // Hover effect
        tabAccountBtn.classList.toggle('border-b-0', !isAccount)      // No border when inactive
        tabAccountBtn.classList.toggle('border-l', !isAccount)        // Left border separator
        tabAccountBtn.classList.toggle('border-slate-200', !isAccount) // Border color
    }
    if (tabGuestBtn) {
        // Active tab (Guest)
        tabGuestBtn.classList.toggle('bg-cyan-500', !isAccount)       // Cyan background
        tabGuestBtn.classList.toggle('text-white', !isAccount)        // White text
        tabGuestBtn.classList.toggle('border-b-2', !isAccount)        // Bottom border indicator
        tabGuestBtn.classList.toggle('border-cyan-600', !isAccount)   // Darker cyan border
        // Inactive tab
        tabGuestBtn.classList.toggle('bg-white', isAccount)           // White background
        tabGuestBtn.classList.toggle('text-slate-900', isAccount)     // Dark text
        tabGuestBtn.classList.toggle('hover:bg-slate-50', isAccount)  // Hover effect
        tabGuestBtn.classList.toggle('border-b-0', isAccount)         // No border when inactive
        tabGuestBtn.classList.toggle('border-l', isAccount)           // Left border separator
        tabGuestBtn.classList.toggle('border-slate-200', isAccount)   // Border color
    }
}
        if (tabAccountBtn) tabAccountBtn.addEventListener('click', function () { setWalkInTab('account') })
        if (tabGuestBtn) tabGuestBtn.addEventListener('click', function () { setWalkInTab('guest') })
        setWalkInTab('account')
    })
</script>

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
        var serviceIdsInput = document.getElementById('reception_appointment_service_ids')
        var serviceResults = document.getElementById('receptionServiceResults')
        var selectedServicesEl = document.getElementById('receptionSelectedServices')
        var doctorSearch = document.getElementById('reception_doctor_search')
        var doctorSelect = document.getElementById('reception_appointment_doctor_id')
        var doctorResults = document.getElementById('receptionDoctorResults')
        var doctorPreview = document.getElementById('receptionDoctorPreview')
        var dateSelect = document.getElementById('reception_appointment_date_select')
        var dateInput = document.getElementById('reception_appointment_date')
        var dateLoadMore = document.getElementById('reception_appointment_date_load_more')
        var dateRangeHint = document.getElementById('reception_appointment_date_range_hint')
        var dateWrap = document.getElementById('receptionAppointmentDateWrap')
        var dateTrigger = document.getElementById('receptionAppointmentDateTrigger')
        var dateOverlay = document.getElementById('receptionAppointmentDateOverlay')
        var dateGrid = document.getElementById('receptionAppointmentDateGrid')
        var datePrevBtn = document.getElementById('receptionDatePrev')
        var dateNextBtn = document.getElementById('receptionDateNext')
        var dateMonthLabel = document.getElementById('receptionDateMonthLabel')
        var timeInput = document.getElementById('reception_appointment_time')
        var timeWrap = document.getElementById('receptionAppointmentTimeWrap')
        var timeTrigger = document.getElementById('receptionTimeSlotTrigger')
        var timeOverlay = document.getElementById('receptionTimeSlotOverlay')
        var availableDaysEl = document.getElementById('reception_available_days')
        var timeSlotsEl = document.getElementById('reception_time_slots')
        var previousDoctorId = 0
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
        var slotMinutes = 60
        var patientSearchTimer = null
        var selectedPatient = null
        var selectedServices = []
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

        function wordPrefixMatch(value, query) {
            var v = normalizeText(value || '')
            var q = normalizeText(query || '')
            if (!q) return true
            if (!v) return false
            if (v.indexOf(q) === 0) return true
            return v.split(/\s+/).some(function (part) { return part.indexOf(q) === 0 })
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
            previousDoctorId = 0

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

            if (patient && patient.user_id) {
                loadPreviousProvider(String(patient.user_id))
            }
        }

        function loadPreviousProvider(patientId) {
            if (!patientId || typeof apiFetch !== 'function') return
            apiFetch("{{ url('/api/appointments') }}?patient_id=" + encodeURIComponent(patientId) + "&per_page=1&order=latest", { method: 'GET' })
                .then(function (r) { return readResponse(r) })
                .then(function (res) {
                    if (!res.ok) return
                    var list = res.data && Array.isArray(res.data.data) ? res.data.data : (Array.isArray(res.data) ? res.data : [])
                    var last = list && list.length ? list[0] : null
                    var docId = last && last.doctor_id != null ? parseInt(last.doctor_id, 10) : 0
                    if (!docId || isNaN(docId)) return
                    previousDoctorId = docId
                    if (doctorSearch && doctorResults && !doctorResults.classList.contains('hidden')) {
                        searchDoctors(String(doctorSearch.value || '').trim())
                    }
                })
                .catch(function () {})
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

        function serviceKey(service) {
            if (!service || service.service_id == null) return ''
            return String(service.service_id)
        }

        function serviceGroup(service) {
            if (!service) return ''
            var name = String(service.service_name || '').trim()
            if (!name) return ''
            var parts = name.split(':')
            var group = String(parts[0] || name).trim().toLowerCase()
            return group
        }

        function selectedServiceIds() {
            return (selectedServices || [])
                .map(function (s) { return parseInt(s && s.service_id != null ? s.service_id : 0, 10) })
                .filter(function (id) { return !!id && !isNaN(id) })
        }

        function syncServiceHiddenInput() {
            if (!serviceIdsInput) return
            var ids = selectedServiceIds()
            serviceIdsInput.value = ids.join(',')
        }

        function renderSelectedServices() {
            if (!selectedServicesEl) return
            var list = Array.isArray(selectedServices) ? selectedServices : []
            if (!list.length) {
                selectedServicesEl.innerHTML = '<div class="text-[0.75rem] text-slate-500">No services selected.</div>'
                return
            }

            selectedServicesEl.innerHTML = list.map(function (s) {
                var id = parseInt(s && s.service_id != null ? s.service_id : 0, 10)
                var name = String(s && s.service_name ? s.service_name : '').trim() || 'Service'
                var meta = []
                if (s && s.duration_minutes != null) meta.push(String(s.duration_minutes) + ' min')
                if (s && s.price != null) meta.push('₱' + String(s.price))
                return '' +
                    '<div class="flex items-center justify-between gap-2 py-1.5 border-b border-slate-200 last:border-0">' +
                        '<div class="min-w-0">' +
                            '<div class="text-[0.78rem] text-slate-800 font-semibold truncate">' + escapeHtml(name) + '</div>' +
                            '<div class="text-[0.72rem] text-slate-500">#' + escapeHtml(id) + (meta.length ? ' • ' + escapeHtml(meta.join(' • ')) : '') + '</div>' +
                        '</div>' +
                        '<button type="button" class="reception-remove-service inline-flex items-center justify-center w-7 h-7 rounded-lg border border-slate-200 text-slate-600 hover:bg-white" data-service-id="' + escapeHtml(id) + '">' +
                            '<span class="material-symbols-outlined text-[18px] leading-none">close</span>' +
                        '</button>' +
                    '</div>'
            }).join('')

            var buttons = selectedServicesEl.querySelectorAll('.reception-remove-service')
            Array.prototype.forEach.call(buttons, function (btn) {
                btn.addEventListener('click', function () {
                    var id = parseInt(btn.getAttribute('data-service-id') || '0', 10)
                    if (!id) return
                    selectedServices = (selectedServices || []).filter(function (s) {
                        return parseInt(s && s.service_id != null ? s.service_id : 0, 10) !== id
                    })
                    syncServiceHiddenInput()
                    renderSelectedServices()
                    filterDoctorsByService()
                    searchServices(String(serviceSearch && serviceSearch.value ? serviceSearch.value : '').trim())
                })
            })
        }

        function addService(service) {
            if (!service || service.service_id == null) return
            var key = serviceKey(service)
            if (!key) return
            var exists = (selectedServices || []).some(function (s) { return serviceKey(s) === key })
            if (exists) return

            selectedServices = (selectedServices || []).concat([service])
            syncServiceHiddenInput()
            renderSelectedServices()

            if (serviceResults) {
                serviceResults.innerHTML = ''
                serviceResults.classList.add('hidden')
            }
            if (serviceSearch) serviceSearch.value = ''
        }

        function renderServiceResults(items) {
            if (!serviceResults) return
            var list = Array.isArray(items) ? items : []

            if (selectedServices && selectedServices.length) {
                var base = serviceGroup(selectedServices[0])
                if (base) {
                    list = list.filter(function (s) {
                        return serviceGroup(s) === base
                    })
                }
            }
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
                    addService(chosen)
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
                return wordPrefixMatch(name, q)
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
                    var typeEl = document.getElementById('reception_appointment_type')
                    var type = typeEl && typeEl.value ? String(typeEl.value) : 'walk_in'
                    var dateStr = type === 'walk_in'
                        ? new Date().toISOString().slice(0, 10)
                        : ((dateSelect && dateSelect.value) ? String(dateSelect.value) : new Date().toISOString().slice(0, 10))
                    var dayKey = dayKeyFromDate(dateStr)
                    var checkTime = type === 'walk_in'
                        ? new Date().toTimeString().slice(0, 5)
                        : (selectedSlotStart ? String(selectedSlotStart).slice(0, 5) : '')
                    var hasSchedule = !!dayKey && hasScheduleAtTime(doctor, dayKey, dateStr, checkTime)
                    var categories = (selectedServices || [])
                        .map(function (s) { return extractServiceCategory(s && s.service_name ? s.service_name : '') })
                        .filter(function (c) { return !!c })
                    var spec = doctor && doctor.specialization ? doctor.specialization : ''
                    var matchesService = !categories.length || categories.every(function (c) { return specializationMatches(c, spec) })

                    parts.push('Name: ' + name)
                    if (doctor.specialization) parts.push('Specialization: ' + doctor.specialization)
                    if (previousDoctorId && parseInt(doctor.user_id, 10) === previousDoctorId) parts.push('Previous Provider')
                    parts.push('Availability: ' + ((doctor.is_available !== false && hasSchedule) ? 'Available' : 'Unavailable'))
                    if (categories.length) parts.push('Service match: ' + (matchesService ? 'Yes' : 'No'))
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

        function doctorSchedulesForDay(doctor, dayKey, dateStr) {
            var list = doctor && doctor.doctor_schedules && Array.isArray(doctor.doctor_schedules) ? doctor.doctor_schedules : []
            var isToday = false
            if (dateStr) {
                var today = new Date().toISOString().slice(0, 10)
                isToday = String(dateStr) === today
            }
            return list.filter(function (s) {
                if (!s) return false
                if (String(s.day_of_week || '').toLowerCase() !== String(dayKey || '').toLowerCase()) return false
                if (isToday && s.is_available === false) return false
                return true
            })
        }

        function hasScheduleAtTime(doctor, dayKey, dateStr, hhmm) {
            var slots = doctorSchedulesForDay(doctor, dayKey, dateStr)
            if (!hhmm) return slots.length > 0
            var t = minutesFromHHMM(String(hhmm || '').slice(0, 5))
            if (isNaN(t)) return slots.length > 0
            return slots.some(function (s) {
                var st = minutesFromHHMM(String(s.start_time || '').slice(0, 5))
                var en = minutesFromHHMM(String(s.end_time || '').slice(0, 5))
                if (isNaN(st) || isNaN(en)) return false
                return t >= st && t < en
            })
        }

        function renderDoctorResults(items) {
            if (!doctorResults) return
            var list = Array.isArray(items) ? items : []
            if (!list.length) {
                doctorResults.innerHTML = '<div class="px-3 py-2 text-[0.75rem] text-slate-500">No doctors found.</div>'
                doctorResults.classList.remove('hidden')
                return
            }
            var typeEl = document.getElementById('reception_appointment_type')
            var type = typeEl && typeEl.value ? String(typeEl.value) : 'walk_in'
            var dateStr = ''
            if (type === 'walk_in') {
                dateStr = new Date().toISOString().slice(0, 10)
            } else {
                dateStr = (dateSelect && dateSelect.value) ? String(dateSelect.value) : new Date().toISOString().slice(0, 10)
            }
            var dayKey = dayKeyFromDate(dateStr)
            var checkTime = ''
            if (type === 'walk_in') {
                checkTime = new Date().toTimeString().slice(0, 5)
            } else if (selectedSlotStart) {
                checkTime = String(selectedSlotStart).slice(0, 5)
            }

            var enriched = list.map(function (d) {
                var name = [d.firstname, d.middlename, d.lastname].filter(function (v) { return String(v || '').trim() !== '' }).join(' ').trim()
                if (!name) name = 'Doctor #' + d.user_id
                var spec = d && d.specialization ? String(d.specialization) : ''
                var isDoctorAvailable = d && d.is_available !== false
                var hasSchedule = !!dayKey && hasScheduleAtTime(d, dayKey, dateStr, checkTime)
                var isSelectable = isDoctorAvailable && hasSchedule
                var tag = ''
                if (!isSelectable) tag = 'Unavailable'
                else if (previousDoctorId && parseInt(d.user_id, 10) === previousDoctorId) tag = 'Previous Provider'
                return {
                    d: d,
                    name: name,
                    spec: spec,
                    isSelectable: isSelectable,
                    tag: tag,
                }
            })

            enriched.sort(function (a, b) {
                if (a.isSelectable !== b.isSelectable) return a.isSelectable ? -1 : 1
                if ((a.tag === 'Previous Provider') !== (b.tag === 'Previous Provider')) return a.tag === 'Previous Provider' ? -1 : 1
                return normalizeText(a.name).localeCompare(normalizeText(b.name))
            })

            var html = ''
            enriched.forEach(function (x) {
                var d = x.d
                var meta = [x.spec].filter(Boolean).join(' • ')
                html += '<button type="button" class="w-full text-left px-3 py-2 border-b border-slate-100 last:border-0 flex items-start justify-between gap-3 ' + (x.isSelectable ? 'hover:bg-slate-50' : 'bg-slate-50/60 cursor-not-allowed') + '" ' + (x.isSelectable ? '' : 'disabled') + '>' +
                    '<div class="min-w-0">' +
                        '<div class="text-[0.78rem] text-slate-800 font-semibold">' + escapeHtml('Dr. ' + x.name) + '</div>' +
                        '<div class="text-[0.72rem] text-slate-500">#' + escapeHtml(d.user_id) + (meta ? ' • ' + escapeHtml(meta) : '') + '</div>' +
                    '</div>' +
                    (x.tag
                        ? '<span class="inline-flex items-center rounded-full px-2 py-0.5 text-[0.65rem] font-semibold ' + (x.tag === 'Unavailable' ? 'bg-slate-100 text-slate-500 border border-slate-200' : 'bg-cyan-500/10 text-cyan-700 border border-cyan-200') + '">' + escapeHtml(x.tag) + '</span>'
                        : '') +
                '</button>'
            })
            doctorResults.innerHTML = html
            doctorResults.classList.remove('hidden')

            var buttons = doctorResults.querySelectorAll('button')
            Array.prototype.forEach.call(buttons, function (btn, idx) {
                btn.addEventListener('click', function () {
                    var chosen = enriched[idx] ? enriched[idx].d : null
                    if (!chosen) return
                    setDoctorSelection(chosen)
                    if (doctorSearch) doctorSearch.value = doctorDisplayName(chosen)
                })
            })
        }

        function filterDoctorsByService() {
            var list = Array.isArray(doctors) ? doctors : []
            if (!selectedServices || !selectedServices.length) {
                if (doctorSearch) doctorSearch.disabled = true
                setDoctorSelection(null)
                if (doctorSearch) doctorSearch.value = ''
                if (doctorResults) doctorResults.classList.add('hidden')
                return
            }
            var categories = (selectedServices || [])
                .map(function (s) { return extractServiceCategory(s && s.service_name ? s.service_name : '') })
                .filter(function (c) { return !!c })

            var filtered = list.filter(function (d) {
                var spec = d && d.specialization ? d.specialization : ''
                return categories.every(function (c) { return specializationMatches(c, spec) })
            })
            if (doctorSearch) doctorSearch.disabled = false
            if (filtered.length === 1) {
                var candidate = filtered[0]
                var typeEl = document.getElementById('reception_appointment_type')
                var type = typeEl && typeEl.value ? String(typeEl.value) : 'walk_in'
                var dateStr = type === 'walk_in'
                    ? new Date().toISOString().slice(0, 10)
                    : ((dateSelect && dateSelect.value) ? String(dateSelect.value) : new Date().toISOString().slice(0, 10))
                var dayKey = dayKeyFromDate(dateStr)
                var checkTime = type === 'walk_in' ? new Date().toTimeString().slice(0, 5) : (selectedSlotStart ? String(selectedSlotStart).slice(0, 5) : '')
                var isSelectable = candidate && candidate.is_available !== false && !!dayKey && hasScheduleAtTime(candidate, dayKey, dateStr, checkTime)
                if (isSelectable) {
                    setDoctorSelection(candidate)
                    if (doctorSearch) doctorSearch.value = doctorDisplayName(candidate)
                } else {
                    setDoctorSelection(null)
                    if (doctorSearch) doctorSearch.value = ''
                }
            } else {
                if (selectedDoctor) {
                    var stillOk = filtered.some(function (d) { return String(d.user_id) === String(selectedDoctor.user_id) })
                    if (!stillOk) {
                        setDoctorSelection(null)
                        if (doctorSearch) doctorSearch.value = ''
                    }
                }
            }
        }

        function searchDoctors(query) {
            var q = normalizeText(query)
            var list = Array.isArray(doctors) ? doctors : []
            if (selectedServices && selectedServices.length) {
                var categories = (selectedServices || [])
                    .map(function (s) { return extractServiceCategory(s && s.service_name ? s.service_name : '') })
                    .filter(function (c) { return !!c })
                list = list.filter(function (d) {
                    var spec = d && d.specialization ? d.specialization : ''
                    return categories.every(function (c) { return specializationMatches(c, spec) })
                })
            }
            if (!q) {
                renderDoctorResults(list.slice(0, 30))
                return
            }
            var filtered = list.filter(function (d) {
                var name = normalizeText([d.firstname, d.middlename, d.lastname].filter(function (v) { return String(v || '').trim() !== '' }).join(' '))
                var spec = normalizeText(d && d.specialization ? d.specialization : '')
                return wordPrefixMatch(name, q) || wordPrefixMatch(spec, q)
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

            syncDateRollerFromSelect()
        }

        function friendlyDateLabelFromIso(iso) {
            var datePart = String(iso || '').slice(0, 10)
            if (!/^\d{4}-\d{2}-\d{2}$/.test(datePart)) return datePart || 'Select a date'
            var d = new Date(datePart + 'T00:00:00')
            if (isNaN(d.getTime())) return datePart
            var parts = d.toLocaleDateString(undefined, { weekday: 'short', month: 'short', day: '2-digit' })
            return parts + ' · ' + datePart
        }

        function closeDateOverlay() {
            if (dateOverlay) dateOverlay.classList.add('hidden')
        }

        function closeTimeOverlay() {
            if (timeOverlay) timeOverlay.classList.add('hidden')
        }

        function syncDateRollerFromSelect() {
            if (!dateSelect || !dateTrigger) return
            dateTrigger.disabled = !!dateSelect.disabled

            var selected = dateSelect.value ? String(dateSelect.value) : ''
            if (dateSelect.disabled) {
                dateTrigger.textContent = 'Select a doctor first'
            } else if (selected) {
                dateTrigger.textContent = friendlyDateLabelFromIso(selected)
            } else {
                dateTrigger.textContent = 'Select a date'
            }

            if (!dateList) return
            var html = ''
            var opts = Array.prototype.slice.call(dateSelect.options || [])
            var usable = opts.filter(function (o) { return o && o.value })
            if (!usable.length) {
                html = '<div class="px-3 py-2 text-[0.75rem] text-slate-500">No dates available.</div>'
            } else {
                html = usable.map(function (o) {
                    var isActive = selected && String(o.value) === selected
                    return (
                        '<button type="button" class="w-full text-left px-3 py-2 text-[0.78rem] snap-start ' +
                        (isActive ? 'bg-cyan-50 text-cyan-800 font-semibold' : 'text-slate-700 hover:bg-slate-50') +
                        '" data-date="' + escapeHtml(o.value) + '">' + escapeHtml(o.textContent || o.value) + '</button>'
                    )
                }).join('')
            }
            dateList.innerHTML = html
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
                syncDateRollerFromSelect()
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
            syncDateRollerFromSelect()
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
            syncDateRollerFromSelect()
            if (dateLoadMore) dateLoadMore.classList.add('hidden')
            if (dateRangeHint) {
                dateRangeHint.textContent = ''
                dateRangeHint.classList.add('hidden')
            }

            if (timeTrigger) {
                timeTrigger.disabled = true
                timeTrigger.textContent = 'Select a date first'
            }
            closeTimeOverlay()
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
                if (timeTrigger) {
                    timeTrigger.disabled = true
                    timeTrigger.textContent = 'Walk-in does not require a time slot'
                }
                closeTimeOverlay()
                timeSlotsEl.innerHTML = '<div class="text-[0.7rem] text-slate-400">Walk-in visits do not require a time slot.</div>'
                return
            }

            if (!doctorSelect || !doctorSelect.value) {
                if (timeTrigger) {
                    timeTrigger.disabled = true
                    timeTrigger.textContent = 'Select a doctor first'
                }
                closeTimeOverlay()
                timeSlotsEl.innerHTML = '<div class="text-[0.7rem] text-slate-400">Select a doctor to load time slots.</div>'
                return
            }
            if (!dateInput || !dateInput.value) {
                if (timeTrigger) {
                    timeTrigger.disabled = true
                    timeTrigger.textContent = 'Select a date first'
                }
                closeTimeOverlay()
                timeSlotsEl.innerHTML = '<div class="text-[0.7rem] text-slate-400">Select a date to load time slots.</div>'
                return
            }
            if (!doctorSchedules.length) {
                if (timeTrigger) {
                    timeTrigger.disabled = true
                    timeTrigger.textContent = 'No schedules found'
                }
                closeTimeOverlay()
                timeSlotsEl.innerHTML = '<div class="text-[0.7rem] text-slate-400">No schedules found for this doctor.</div>'
                return
            }

            var dayKey = dayKeyFromDate(dateInput.value)
            if (!dayKey) {
                if (timeTrigger) {
                    timeTrigger.disabled = true
                    timeTrigger.textContent = 'Invalid date'
                }
                closeTimeOverlay()
                timeSlotsEl.innerHTML = '<div class="text-[0.7rem] text-slate-400">Invalid date selected.</div>'
                return
            }
            if (doctorAvailableDaySet && Object.keys(doctorAvailableDaySet).length && !doctorAvailableDaySet[dayKey]) {
                if (timeTrigger) {
                    timeTrigger.disabled = true
                    timeTrigger.textContent = 'Doctor not available'
                }
                closeTimeOverlay()
                timeSlotsEl.innerHTML = '<div class="text-[0.7rem] text-slate-400">Doctor is not available on this day.</div>'
                return
            }

            var todayIso = new Date().toISOString().slice(0, 10)
            var isToday = String(dateInput.value) === todayIso
            var daySchedules = doctorSchedules.filter(function (s) {
                if (!s) return false
                if (String(s.day_of_week || '').toLowerCase() !== dayKey) return false
                if (isToday && s.is_available === false) return false
                return true
            })

            if (!daySchedules.length) {
                if (timeTrigger) {
                    timeTrigger.disabled = true
                    timeTrigger.textContent = 'No available slots'
                }
                closeTimeOverlay()
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
                if (timeTrigger) {
                    timeTrigger.disabled = true
                    timeTrigger.textContent = 'No time slots available'
                }
                closeTimeOverlay()
                timeSlotsEl.innerHTML = '<div class="text-[0.7rem] text-slate-400">No time slots available for this day.</div>'
                return
            }

            if (timeTrigger) {
                timeTrigger.disabled = false
                timeTrigger.textContent = selectedSlotStart ? ('Selected: ' + formatTime12h(selectedSlotStart)) : 'Select a time slot'
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
                    'w-full px-3 py-2 rounded-xl text-[0.75rem] font-semibold border transition-colors flex items-center justify-between ' +
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
                    closeTimeOverlay()
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
            syncDateRollerFromSelect()
            closeDateOverlay()
            closeTimeOverlay()
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
            var type = typeInput && typeInput.value ? String(typeInput.value) : 'walk_in'
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
            } else {
                if (doctorSelect && doctorSelect.value && (!doctorSchedules || !doctorSchedules.length)) {
                    clearAvailability()
                    loadDoctorSchedulesAndAvailability(String(doctorSelect.value), null)
                }
            }
            renderTimeSlots()
        }

        function setAppointmentType(nextType) {
            if (typeInput) typeInput.value = nextType === 'scheduled' ? 'scheduled' : 'walk_in'
            applyAppointmentTypeUI()
            syncTypeToggleUI()
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
            syncDateRollerFromSelect()
        }

        if (dateTrigger) {
            dateTrigger.addEventListener('click', function () {
                if (!dateSelect || dateSelect.disabled) return
                if (!dateOverlay) return
                syncDateRollerFromSelect()
                dateOverlay.classList.toggle('hidden')
            })
        }

        if (dateList) {
            dateList.addEventListener('click', function (e) {
                var btn = e.target && e.target.closest ? e.target.closest('button[data-date]') : null
                if (!btn || !dateSelect) return
                var iso = btn.getAttribute('data-date') || ''
                if (!iso) return
                dateSelect.value = iso
                dateSelect.dispatchEvent(new Event('change', { bubbles: true }))
            })
        }

        if (timeTrigger) {
            timeTrigger.addEventListener('click', function () {
                if (timeTrigger.disabled) return
                if (!timeOverlay) return
                renderTimeSlots()
                timeOverlay.classList.toggle('hidden')
            })
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
            if (dateOverlay && !dateOverlay.classList.contains('hidden')) {
                if (!dateWrap || (!dateWrap.contains(target) && !dateOverlay.contains(target))) {
                    closeDateOverlay()
                }
            }
            if (timeOverlay && !timeOverlay.classList.contains('hidden')) {
                if (!timeWrap || (!timeWrap.contains(target) && !timeOverlay.contains(target))) {
                    closeTimeOverlay()
                }
            }
        })

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeDateOverlay()
                closeTimeOverlay()
            }
        })

        loadServicesAndDoctors()
        syncServiceHiddenInput()
        renderSelectedServices()
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
                var dateSelect = document.getElementById('reception_appointment_date_select')
                var dateInput = document.getElementById('reception_appointment_date')
                var timeInput = document.getElementById('reception_appointment_time')
                var typeInput = document.getElementById('reception_appointment_type')
                var priorityInput = document.getElementById('reception_appointment_priority')
                var reasonInput = document.getElementById('reception_appointment_reason')

                var patientId = patientInput ? parseInt(patientInput.value, 10) : 0
                var doctorId = doctorInput ? parseInt(doctorInput.value, 10) : 0
                var serviceIds = selectedServiceIds()
                var date = dateSelect && dateSelect.value ? dateSelect.value : (dateInput ? dateInput.value : '')
                var time = timeInput ? timeInput.value : ''
                var type = typeInput && typeInput.value ? String(typeInput.value) : 'walk_in'
                var priority = priorityInput && priorityInput.value ? parseInt(priorityInput.value, 10) : null
                var reason = reasonInput ? reasonInput.value : ''
                var autoQueue = true

                if (!patientId || !serviceIds.length || !doctorId) {
                    showError('Patient, services, and doctor are required.')
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
                    service_ids: serviceIds,
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
                            var message = 'Failed to create appointment.'
                            if (result.data && result.data.message) message = result.data.message
                            showError(message)
                            return
                        }

                        var created = result.data || {}
                        function afterQueue() {
                            showSuccess((type === 'walk_in' ? 'Walk-in' : 'Appointment') + ' has been created successfully. Queue entry created.')
                            if (patientSearch) patientSearch.value = ''
                            if (serviceSearch) serviceSearch.value = ''
                            if (doctorSearch) doctorSearch.value = ''
                            setPatientSelection(null)
                            selectedServices = []
                            syncServiceHiddenInput()
                            renderSelectedServices()
                            setDoctorSelection(null)
                            if (dateInput) dateInput.value = ''
                            if (timeInput) timeInput.value = ''
                            if (priorityInput) priorityInput.value = ''
                            if (reasonInput) reasonInput.value = ''
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
                        showError('Network error while creating appointment.')
                    })
                    .finally(function () {
                        setSubmitting(false)
                    })
            })
        }
    })
</script>
