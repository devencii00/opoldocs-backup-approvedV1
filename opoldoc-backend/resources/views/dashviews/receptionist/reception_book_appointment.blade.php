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
            <label for="reception_appointment_status_id" class="block text-[0.7rem] text-slate-600 mb-1">Status ID</label>
            <input id="reception_appointment_status_id" type="number" min="1" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Status ID" required>
        </div>
        <div>
            <label for="reception_appointment_date" class="block text-[0.7rem] text-slate-600 mb-1">Date</label>
            <input id="reception_appointment_date" type="date" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" required>
        </div>
        <div>
            <label for="reception_appointment_time" class="block text-[0.7rem] text-slate-600 mb-1">Time</label>
            <input id="reception_appointment_time" type="time" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" required>
        </div>
        <div class="md:col-span-1">
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
        Use patient and doctor IDs from the system. Appointment status and types can be configured by the admin.
    </p>
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
                var statusInput = document.getElementById('reception_appointment_status_id')
                var dateInput = document.getElementById('reception_appointment_date')
                var timeInput = document.getElementById('reception_appointment_time')
                var reasonInput = document.getElementById('reception_appointment_reason')

                var patientId = patientInput ? parseInt(patientInput.value, 10) : 0
                var doctorId = doctorInput ? parseInt(doctorInput.value, 10) : 0
                var statusId = statusInput ? parseInt(statusInput.value, 10) : 0
                var date = dateInput ? dateInput.value : ''
                var time = timeInput ? timeInput.value : ''
                var reason = reasonInput ? reasonInput.value : ''

                if (!patientId || !doctorId || !statusId || !date || !time) {
                    showBookAppointmentError('Patient, doctor, status, date, and time are required.')
                    return
                }

                if (typeof apiFetch !== 'function') {
                    showBookAppointmentError('API client is not available.')
                    return
                }

                var body = {
                    patient_id: patientId,
                    doctor_id: doctorId,
                    appointment_date: date,
                    appointment_time: time,
                    status_id: statusId
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
                        if (patientInput) patientInput.value = ''
                        if (doctorInput) doctorInput.value = ''
                        if (statusInput) statusInput.value = ''
                        if (dateInput) dateInput.value = ''
                        if (timeInput) timeInput.value = ''
                        if (reasonInput) reasonInput.value = ''
                    })
                    .catch(function () {
                        showBookAppointmentError('Network error while booking appointment.')
                    })
            })
        }
    })
</script>

