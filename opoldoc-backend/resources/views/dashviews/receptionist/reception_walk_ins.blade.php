<div class="bg-white border border-slate-200 rounded-[18px] p-5 shadow-[0_2px_10px_rgba(15,23,42,0.04)]">
    <div class="flex items-center justify-between mb-3">
        <div>
            <h2 class="text-sm font-semibold text-slate-900">Create walk-in</h2>
            <p class="text-xs text-slate-500">Register a walk-in based on personal information or an existing patient.</p>
        </div>
        <span class="text-[0.7rem] text-slate-400 uppercase tracking-widest">Walk-ins</span>
    </div>

    <div id="receptionWalkInError" class="hidden mb-3 rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-[0.75rem] text-red-700"></div>
    <div id="receptionWalkInSuccess" class="hidden mb-3 rounded-lg border border-emerald-200 bg-emerald-50 px-3 py-2 text-[0.75rem] text-emerald-700"></div>

    <form id="receptionWalkInForm" class="grid gap-3 grid-cols-1 md:grid-cols-4 items-end mb-4">
        <div>
            <label for="reception_walkin_patient_id" class="block text-[0.7rem] text-slate-600 mb-1">Patient ID</label>
            <input id="reception_walkin_patient_id" type="number" min="1" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Patient ID" required>
        </div>
        <div>
            <label for="reception_walkin_doctor_id" class="block text-[0.7rem] text-slate-600 mb-1">Doctor ID</label>
            <input id="reception_walkin_doctor_id" type="number" min="1" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Doctor ID" required>
        </div>
        <div>
            <label for="reception_walkin_datetime" class="block text-[0.7rem] text-slate-600 mb-1">Visit date &amp; time</label>
            <input id="reception_walkin_datetime" type="datetime-local" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
        </div>
        <div>
            <label for="reception_walkin_priority_level" class="block text-[0.7rem] text-slate-600 mb-1">Priority level (optional)</label>
            <input id="reception_walkin_priority_level" type="number" min="0" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="e.g. 1">
        </div>
        <div class="md:col-span-3">
            <label for="reception_walkin_reason" class="block text-[0.7rem] text-slate-600 mb-1">Reason (optional)</label>
            <input id="reception_walkin_reason" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Reason for visit">
        </div>
        <div class="flex items-center gap-2 md:col-span-3">
            <label class="inline-flex items-center gap-2 text-[0.75rem] text-slate-600">
                <input id="reception_walkin_auto_queue" type="checkbox" class="rounded border-slate-300 text-cyan-600 focus:ring-cyan-500">
                Auto add to queue
            </label>
            <span class="text-[0.7rem] text-slate-400">Queue entry will be created right after the walk-in appointment.</span>
        </div>
        <div class="flex items-end md:col-span-1">
            <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-cyan-600 text-white text-[0.78rem] font-semibold hover:bg-cyan-700 transition-colors">
                Create walk-in
            </button>
        </div>
    </form>

    <p class="text-[0.7rem] text-slate-400">
        Walk-ins are stored as appointments with type <span class="font-semibold">walk_in</span>. Use patient and doctor IDs from the system.
    </p>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var form = document.getElementById('receptionWalkInForm')
        var errorBox = document.getElementById('receptionWalkInError')
        var successBox = document.getElementById('receptionWalkInSuccess')

        function showWalkInError(message) {
            if (!errorBox) return
            errorBox.textContent = message || ''
            if (message) {
                errorBox.classList.remove('hidden')
            } else {
                errorBox.classList.add('hidden')
            }
        }

        function showWalkInSuccess(message) {
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

                showWalkInError('')
                showWalkInSuccess('')

                var patientInput = document.getElementById('reception_walkin_patient_id')
                var doctorInput = document.getElementById('reception_walkin_doctor_id')
                var datetimeInput = document.getElementById('reception_walkin_datetime')
                var priorityInput = document.getElementById('reception_walkin_priority_level')
                var reasonInput = document.getElementById('reception_walkin_reason')
                var autoQueueInput = document.getElementById('reception_walkin_auto_queue')

                var patientId = patientInput ? parseInt(patientInput.value, 10) : 0
                var doctorId = doctorInput ? parseInt(doctorInput.value, 10) : 0
                var datetime = datetimeInput ? datetimeInput.value : ''
                var priorityLevel = priorityInput && priorityInput.value ? parseInt(priorityInput.value, 10) : null
                var reason = reasonInput ? reasonInput.value : ''
                var autoQueue = autoQueueInput ? !!autoQueueInput.checked : false

                if (!patientId || !doctorId) {
                    showWalkInError('Patient and doctor are required.')
                    return
                }

                if (typeof apiFetch !== 'function') {
                    showWalkInError('API client is not available.')
                    return
                }

                var body = {
                    patient_id: patientId,
                    doctor_id: doctorId
                }

                if (datetime) {
                    body.appointment_datetime = datetime
                }
                if (priorityLevel !== null && !isNaN(priorityLevel)) {
                    body.priority_level = priorityLevel
                }
                if (reason) {
                    body.reason_for_visit = reason
                }

                apiFetch("{{ url('/api/walk-ins') }}", {
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
                            if (result.data && result.data.message) {
                                message = result.data.message
                            }
                            showWalkInError(message)
                            return
                        }

                        var createdAppointment = result.data || {}

                        function handleAfterQueue() {
                            showWalkInSuccess('Walk-in has been created successfully.' + (autoQueue ? ' Queue entry created.' : ''))
                            if (patientInput) patientInput.value = ''
                            if (doctorInput) doctorInput.value = ''
                            if (datetimeInput) datetimeInput.value = ''
                            if (priorityInput) priorityInput.value = ''
                            if (reasonInput) reasonInput.value = ''
                            if (autoQueueInput) autoQueueInput.checked = false
                        }

                        if (autoQueue && createdAppointment && createdAppointment.appointment_id) {
                            apiFetch("{{ url('/api/queues') }}", {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    appointment_id: createdAppointment.appointment_id
                                })
                            })
                                .then(function (resp) {
                                    return resp.json().then(function (data) {
                                        return { ok: resp.ok, status: resp.status, data: data }
                                    }).catch(function () {
                                        return { ok: resp.ok, status: resp.status, data: null }
                                    })
                                })
                                .then(function (queueResult) {
                                    if (!queueResult.ok) {
                                        handleAfterQueue()
                                        return
                                    }
                                    handleAfterQueue()
                                })
                                .catch(function () {
                                    handleAfterQueue()
                                })
                        } else {
                            handleAfterQueue()
                        }
                    })
                    .catch(function () {
                        showWalkInError('Network error while creating walk-in.')
                    })
            })
        }
    })
</script>
