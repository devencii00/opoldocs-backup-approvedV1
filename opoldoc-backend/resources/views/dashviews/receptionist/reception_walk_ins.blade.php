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
            <label for="reception_walkin_pi_id" class="block text-[0.7rem] text-slate-600 mb-1">Personal information ID (optional)</label>
            <input id="reception_walkin_pi_id" type="number" min="1" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="pi_id">
        </div>
        <div>
            <label for="reception_walkin_patient_id" class="block text-[0.7rem] text-slate-600 mb-1">Patient ID (optional)</label>
            <input id="reception_walkin_patient_id" type="number" min="1" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="patient_id">
        </div>
        <div>
            <label for="reception_walkin_priority_type_id" class="block text-[0.7rem] text-slate-600 mb-1">Priority type ID</label>
            <input id="reception_walkin_priority_type_id" type="number" min="1" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="priority_type_id" required>
        </div>
        <div class="flex items-end">
            <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-cyan-600 text-white text-[0.78rem] font-semibold hover:bg-cyan-700 transition-colors">
                Create walk-in
            </button>
        </div>
    </form>

    <p class="text-[0.7rem] text-slate-400">
        At least one of personal information ID or patient ID should typically be provided. Priority types are defined in the system configuration.
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

                var piInput = document.getElementById('reception_walkin_pi_id')
                var patientInput = document.getElementById('reception_walkin_patient_id')
                var priorityInput = document.getElementById('reception_walkin_priority_type_id')

                var piId = piInput && piInput.value ? parseInt(piInput.value, 10) : null
                var patientId = patientInput && patientInput.value ? parseInt(patientInput.value, 10) : null
                var priorityTypeId = priorityInput ? parseInt(priorityInput.value, 10) : 0

                if (!priorityTypeId || priorityTypeId <= 0) {
                    showWalkInError('Priority type ID is required.')
                    return
                }

                if (typeof apiFetch !== 'function') {
                    showWalkInError('API client is not available.')
                    return
                }

                var body = {
                    priority_type_id: priorityTypeId
                }

                if (piId && piId > 0) {
                    body.pi_id = piId
                }
                if (patientId && patientId > 0) {
                    body.patient_id = patientId
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

                        showWalkInSuccess('Walk-in has been created successfully.')
                        if (piInput) piInput.value = ''
                        if (patientInput) patientInput.value = ''
                        if (priorityInput) priorityInput.value = ''
                    })
                    .catch(function () {
                        showWalkInError('Network error while creating walk-in.')
                    })
            })
        }
    })
</script>

