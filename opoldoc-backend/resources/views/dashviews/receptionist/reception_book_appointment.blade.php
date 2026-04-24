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
            <label for="reception_appointment_doctor_id" class="block text-[0.7rem] text-slate-600 mb-1">Doctor ID</label>
            <input id="reception_appointment_doctor_id" type="number" min="1" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Doctor ID" required>
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
            <label for="reception_appointment_time" class="block text-[0.7rem] text-slate-600 mb-1">Time</label>
            <input id="reception_appointment_time" type="time" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" required>
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
            <button type="submit" class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-cyan-600 text-white text-[0.78rem] font-semibold hover:bg-cyan-700 transition-colors">
                Book appointment
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
                <button type="submit" class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-slate-900 text-white text-[0.78rem] font-semibold hover:bg-slate-800 transition-colors w-full">
                    Apply
                </button>
            </div>
        </form>

        <pre id="receptionManageAppointmentResult" class="hidden text-[0.68rem] text-slate-600 bg-slate-50 border border-slate-100 rounded-xl px-3 py-2 overflow-x-auto"></pre>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var form = document.getElementById('receptionBookAppointmentForm')
        var errorBox = document.getElementById('receptionBookAppointmentError')
        var successBox = document.getElementById('receptionBookAppointmentSuccess')

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

        if (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault()

                showBookAppointmentError('')
                showBookAppointmentSuccess('')

                var patientInput = document.getElementById('reception_appointment_patient_id')
                var doctorInput = document.getElementById('reception_appointment_doctor_id')
                var statusInput = document.getElementById('reception_appointment_status')
                var dateInput = document.getElementById('reception_appointment_date')
                var timeInput = document.getElementById('reception_appointment_time')
                var typeInput = document.getElementById('reception_appointment_type')
                var priorityInput = document.getElementById('reception_appointment_priority')
                var reasonInput = document.getElementById('reception_appointment_reason')

                var patientId = patientInput ? parseInt(patientInput.value, 10) : 0
                var doctorId = doctorInput ? parseInt(doctorInput.value, 10) : 0
                var status = statusInput ? statusInput.value : ''
                var date = dateInput ? dateInput.value : ''
                var time = timeInput ? timeInput.value : ''
                var type = typeInput && typeInput.value ? typeInput.value : 'scheduled'
                var priority = priorityInput && priorityInput.value ? parseInt(priorityInput.value, 10) : null
                var reason = reasonInput ? reasonInput.value : ''

                if (!patientId || !doctorId || !date || !time) {
                    showBookAppointmentError('Patient, doctor, date, and time are required.')
                    return
                }

                if (typeof apiFetch !== 'function') {
                    showBookAppointmentError('API client is not available.')
                    return
                }

                var appointmentDateTime = date + ' ' + time

                var body = {
                    patient_id: patientId,
                    doctor_id: doctorId,
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
                        if (doctorInput) doctorInput.value = ''
                        if (statusInput) statusInput.value = ''
                        if (dateInput) dateInput.value = ''
                        if (timeInput) timeInput.value = ''
                        if (typeInput) typeInput.value = 'scheduled'
                        if (priorityInput) priorityInput.value = ''
                        if (reasonInput) reasonInput.value = ''
                    })
                    .catch(function () {
                        showBookAppointmentError('Network error while booking appointment.')
                    })
            })
        }

        var manageForm = document.getElementById('receptionManageAppointmentForm')
        var manageError = document.getElementById('receptionManageAppointmentError')
        var manageSuccess = document.getElementById('receptionManageAppointmentSuccess')
        var manageResult = document.getElementById('receptionManageAppointmentResult')

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

                var idInput = document.getElementById('reception_manage_appointment_id')
                var actionInput = document.getElementById('reception_manage_action')
                var statusInput = document.getElementById('reception_manage_status')

                var appointmentId = idInput ? parseInt(idInput.value, 10) : 0
                var action = actionInput ? actionInput.value : 'fetch'
                var status = statusInput ? statusInput.value : ''

                if (!appointmentId) {
                    showManageError('Appointment ID is required.')
                    return
                }

                if (typeof apiFetch !== 'function') {
                    showManageError('API client is not available.')
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

                apiFetch(url, {
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
        }
    })
</script>
