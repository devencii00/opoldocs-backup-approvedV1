<div class="bg-white border border-slate-200 rounded-[18px] p-5 shadow-[0_2px_10px_rgba(15,23,42,0.04)]">
    <div class="flex items-center justify-between mb-3">
        <div>
            <h2 class="text-sm font-semibold text-slate-900">Consultation</h2>
            <p class="text-xs text-slate-500">
                Select a patient, review their details, and record diagnosis and treatment notes.
            </p>
        </div>
        <span class="text-[0.7rem] text-slate-400 uppercase tracking-widest">Clinical</span>
    </div>

    <div class="grid gap-4 md:grid-cols-5 mb-4">
        <div class="md:col-span-2 space-y-3">
            <div>
                <label for="consult_appointment" class="block text-[0.7rem] text-slate-600 mb-1">Patient / appointment</label>
                <select id="consult_appointment" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                    <option value="">Select today’s appointment</option>
                    @foreach (($doctorRecentAppointments ?? []) as $appointment)
                        @php
                            $patientName = optional(optional($appointment->patient)->personalInformation)->full_name ?? 'Patient #' . $appointment->patient_id;
                            $labelDate = $appointment->appointment_date ?? optional($appointment->appointment_datetime)->format('Y-m-d');
                            $labelTime = $appointment->appointment_time ?? optional($appointment->appointment_datetime)->format('H:i');
                        @endphp
                        <option value="{{ $appointment->appointment_id }}"
                            data-patient-name="{{ $patientName }}"
                            data-date="{{ $labelDate }}"
                            data-time="{{ $labelTime }}">
                            {{ $patientName }} — {{ $labelDate }} {{ $labelTime }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="border border-slate-100 rounded-xl bg-slate-50 p-3">
                <div class="flex items-center justify-between mb-2">
                    <div class="text-[0.7rem] font-semibold text-slate-700">Patient info</div>
                    <button type="button" id="consultViewChild" class="inline-flex items-center gap-1 rounded-lg border border-slate-200 bg-white px-2 py-0.5 text-[0.7rem] text-slate-700 hover:bg-slate-50">
                        👶 View child
                    </button>
                </div>
                <dl class="grid grid-cols-2 gap-x-4 gap-y-1 text-[0.7rem] text-slate-600" id="consultPatientInfo">
                    <div>
                        <dt class="text-slate-400">Name</dt>
                        <dd class="font-medium text-slate-800">—</dd>
                    </div>
                    <div>
                        <dt class="text-slate-400">Date</dt>
                        <dd class="font-medium text-slate-800">—</dd>
                    </div>
                    <div>
                        <dt class="text-slate-400">Time</dt>
                        <dd class="font-medium text-slate-800">—</dd>
                    </div>
                    <div>
                        <dt class="text-slate-400">Notes</dt>
                        <dd class="font-medium text-slate-800">Select an appointment</dd>
                    </div>
                </dl>
            </div>
        </div>

        <div class="md:col-span-3 space-y-3">
            <div>
                <label for="consult_diagnosis" class="block text-[0.7rem] text-slate-600 mb-1">Diagnosis</label>
                <textarea id="consult_diagnosis" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none min-h-[80px]" placeholder="Enter clinical diagnosis"></textarea>
            </div>
            <div>
                <label for="consult_treatment" class="block text-[0.7rem] text-slate-600 mb-1">Treatment notes</label>
                <textarea id="consult_treatment" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none min-h-[120px]" placeholder="Enter treatment plan, follow-up instructions, and other notes"></textarea>
            </div>
            <div class="flex flex-wrap items-center justify-between gap-2">
                <div class="text-[0.7rem] text-slate-500">
                    Diagnosis and treatment notes will be saved to the clinical record once integrated with backend.
                </div>
                <div class="flex gap-2">
                    <button type="button" id="consultClear" class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-3 py-1.5 text-[0.78rem] font-semibold text-slate-700 hover:bg-slate-50">
                        Clear
                    </button>
                    <button type="button" id="consultSaveDraft" class="inline-flex items-center justify-center rounded-xl bg-cyan-600 px-3 py-1.5 text-[0.78rem] font-semibold text-white hover:bg-cyan-700">
                        Save consultation (draft)
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var selectEl = document.getElementById('consult_appointment')
        var infoEl = document.getElementById('consultPatientInfo')
        var diagnosisEl = document.getElementById('consult_diagnosis')
        var treatmentEl = document.getElementById('consult_treatment')
        var clearBtn = document.getElementById('consultClear')
        var saveBtn = document.getElementById('consultSaveDraft')
        var childBtn = document.getElementById('consultViewChild')

        function updatePatientInfo() {
            if (!selectEl || !infoEl) return
            var option = selectEl.options[selectEl.selectedIndex]
            var name = option ? option.getAttribute('data-patient-name') || '—' : '—'
            var date = option ? option.getAttribute('data-date') || '—' : '—'
            var time = option ? option.getAttribute('data-time') || '—' : '—'

            var blocks = infoEl.querySelectorAll('dd')
            if (blocks.length >= 4) {
                blocks[0].textContent = name
                blocks[1].textContent = date
                blocks[2].textContent = time
                blocks[3].textContent = option && option.value ? 'Ready for consultation' : 'Select an appointment'
            }
        }

        if (selectEl) {
            selectEl.addEventListener('change', updatePatientInfo)
        }

        if (clearBtn) {
            clearBtn.addEventListener('click', function () {
                if (diagnosisEl) diagnosisEl.value = ''
                if (treatmentEl) treatmentEl.value = ''
            })
        }

        if (saveBtn) {
            saveBtn.addEventListener('click', function () {
                alert('Consultation saved as draft in this view. Backend persistence can be wired to visits/transactions.')
            })
        }

        if (childBtn) {
            childBtn.addEventListener('click', function () {
                alert('Child/dependent view is not yet linked to a data source. This button is a placeholder for future integration.')
            })
        }

        updatePatientInfo()
    })
</script>

