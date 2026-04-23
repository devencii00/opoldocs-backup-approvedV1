<div class="bg-white border border-slate-200 rounded-[18px] p-5 shadow-[0_2px_10px_rgba(15,23,42,0.04)]">
    <div class="flex items-center justify-between mb-3">
        <div>
            <h2 class="text-sm font-semibold text-slate-900">Register patient</h2>
            <p class="text-xs text-slate-500">Link an existing personal information record to the patient registry.</p>
        </div>
        <span class="text-[0.7rem] text-slate-400 uppercase tracking-widest">Patients</span>
    </div>

    <div id="receptionRegisterPatientError" class="hidden mb-3 rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-[0.75rem] text-red-700"></div>
    <div id="receptionRegisterPatientSuccess" class="hidden mb-3 rounded-lg border border-emerald-200 bg-emerald-50 px-3 py-2 text-[0.75rem] text-emerald-700"></div>

    <form id="receptionRegisterPatientForm" class="grid gap-3 grid-cols-1 md:grid-cols-3 items-end mb-4">
        <div class="md:col-span-2">
            <label for="reception_pi_id" class="block text-[0.7rem] text-slate-600 mb-1">Personal information ID (pi_id)</label>
            <input id="reception_pi_id" type="number" min="1" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Existing personal information ID" required>
        </div>
        <div>
            <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-cyan-600 text-white text-[0.78rem] font-semibold hover:bg-cyan-700 transition-colors">
                Register patient
            </button>
        </div>
    </form>

    <p class="text-[0.7rem] text-slate-400">
        This action creates a patient record linked to an existing personal information entry. Personal details can be managed in the main system.
    </p>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var form = document.getElementById('receptionRegisterPatientForm')
        var errorBox = document.getElementById('receptionRegisterPatientError')
        var successBox = document.getElementById('receptionRegisterPatientSuccess')

        function showRegisterPatientError(message) {
            if (!errorBox) return
            errorBox.textContent = message || ''
            if (message) {
                errorBox.classList.remove('hidden')
            } else {
                errorBox.classList.add('hidden')
            }
        }

        function showRegisterPatientSuccess(message) {
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

                showRegisterPatientError('')
                showRegisterPatientSuccess('')

                var piInput = document.getElementById('reception_pi_id')
                var piId = piInput ? parseInt(piInput.value, 10) : 0

                if (!piId || piId <= 0) {
                    showRegisterPatientError('Personal information ID is required.')
                    return
                }

                if (typeof apiFetch !== 'function') {
                    showRegisterPatientError('API client is not available.')
                    return
                }

                apiFetch("{{ url('/api/patients') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ pi_id: piId })
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
                            var message = 'Failed to register patient.'
                            if (result.data && result.data.message) {
                                message = result.data.message
                            }
                            showRegisterPatientError(message)
                            return
                        }

                        showRegisterPatientSuccess('Patient has been registered successfully.')
                        if (piInput) {
                            piInput.value = ''
                        }
                    })
                    .catch(function () {
                        showRegisterPatientError('Network error while registering patient.')
                    })
            })
        }
    })
</script>

