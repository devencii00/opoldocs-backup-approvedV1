@php
    $queueItems = collect($receptionQueue ?? []);
    $serving = $queueItems->firstWhere('status', 'serving');
    $waitingItems = $queueItems
        ->filter(function ($row) {
            return ($row->status ?? null) === 'waiting';
        })
        ->sortBy(function ($row) {
            $priority = (int) ($row->priority_level ?? 5);
            $number = (int) ($row->queue_number ?? 999999);
            return str_pad((string) $priority, 6, '0', STR_PAD_LEFT) . '-' . str_pad((string) $number, 6, '0', STR_PAD_LEFT);
        })
        ->values();
    $nextItems = $waitingItems->take(5);
@endphp

<div class="space-y-4">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-sm font-semibold text-slate-900">Queue management</h2>
            <p class="text-xs text-slate-500">Add patients to the queue, assign numbers, and monitor today&apos;s flow.</p>
        </div>
        <div class="flex items-center gap-2">
            <button id="receptionCallNextButton" type="button" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-900 text-white text-[0.8rem] font-semibold hover:bg-slate-800 transition-colors">
                <span class="material-symbols-outlined text-[18px] leading-none">campaign</span>
                Call next
            </button>
            <button id="receptionRefreshQueueButton" type="button" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-100 text-slate-800 text-[0.8rem] font-semibold hover:bg-slate-200 transition-colors border border-slate-200">
                <span class="material-symbols-outlined text-[18px] leading-none">refresh</span>
                Refresh
            </button>
            <button id="receptionPublicQueueLinkButton" type="button" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white text-slate-800 text-[0.8rem] font-semibold hover:bg-slate-50 transition-colors border border-slate-200">
                <span class="material-symbols-outlined text-[18px] leading-none">link</span>
                Public link
            </button>
            <button id="receptionDisplayQueueButton" type="button" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-cyan-600 text-white text-[0.8rem] font-semibold hover:bg-cyan-700 transition-colors">
                <span class="material-symbols-outlined text-[18px] leading-none">tv</span>
                Display queue
            </button>
        </div>
    </div>

    <div class="bg-white border border-slate-200 rounded-[18px] p-5 shadow-[0_2px_10px_rgba(15,23,42,0.04)]">
        <div class="flex items-center justify-between mb-3">
            <h3 class="text-sm font-semibold text-slate-900">Today&apos;s queue</h3>
            <span class="text-[0.7rem] text-slate-400 uppercase tracking-widest">Front desk</span>
        </div>

        <form id="receptionAddQueueForm" class="mb-4 grid gap-2 grid-cols-1 md:grid-cols-4 items-end">
            <div>
                <label for="reception_add_queue_appointment_id" class="block text-[0.7rem] text-slate-600 mb-1">Appointment</label>
                <input id="reception_queue_appointment_search" type="text" class="mb-1 w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Search appointment">
                <select id="reception_add_queue_appointment_id" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" required>
                    <option value="">Select an appointment</option>
                </select>
            </div>
            <div>
                <label for="reception_add_queue_number" class="block text-[0.7rem] text-slate-600 mb-1">Queue number (optional)</label>
                <input id="reception_add_queue_number" type="number" min="1" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Auto-generate if empty">
            </div>
            <div>
                <label for="reception_add_queue_datetime" class="block text-[0.7rem] text-slate-600 mb-1">Queue date &amp; time (optional)</label>
                <input id="reception_add_queue_datetime" type="datetime-local" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 rounded-xl bg-cyan-600 text-white text-[0.78rem] font-semibold hover:bg-cyan-700 transition-colors">
                    Add to queue
                </button>
            </div>
        </form>

        <div id="receptionQueueError" class="hidden mb-3 rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-[0.75rem] text-red-700"></div>
        <div id="receptionQueueSuccess" class="hidden mb-3 rounded-lg border border-emerald-200 bg-emerald-50 px-3 py-2 text-[0.75rem] text-emerald-700"></div>

        <div class="mb-3 flex flex-col gap-2 md:flex-row md:items-end">
            <div class="flex-1">
                <label for="reception_queue_search" class="block text-[0.7rem] text-slate-600 mb-1">Search queue</label>
                <input id="reception_queue_search" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Queue number, patient or doctor">
            </div>
            <div class="w-full md:w-40">
                <label for="reception_queue_sort" class="block text-[0.7rem] text-slate-600 mb-1">Sort</label>
                <select id="reception_queue_sort" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                    <option value="number_asc">Queue number asc</option>
                    <option value="number_desc">Queue number desc</option>
                    <option value="date_asc">Date asc</option>
                    <option value="date_desc">Date desc</option>
                </select>
            </div>
        </div>

        <div class="overflow-x-auto scrollbar-hidden">
            <table class="min-w-full text-left text-xs text-slate-600">
                <thead>
                    <tr class="border-b border-slate-100 text-[0.68rem] uppercase tracking-widest text-slate-400">
                        <th class="py-2 pr-4 font-semibold">Queue #</th>
                        <th class="py-2 pr-4 font-semibold">Patient</th>
                        <th class="py-2 pr-4 font-semibold">Doctor</th>
                        <th class="py-2 pr-4 font-semibold">Priority</th>
                        <th class="py-2 pr-4 font-semibold">Date</th>
                        <th class="py-2 pr-4 font-semibold">Status</th>
                        <th class="py-2 pr-4 font-semibold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($queueItems as $queue)
                        @php
                            $patientName = optional(optional($queue->appointment)->patient)->personalInformation->full_name ?? '';
                            $doctorName = optional(optional($queue->appointment)->doctor)->personalInformation->full_name ?? '';
                            $statusName = (string) ($queue->status ?? '');
                            $dateKey = $queue->queue_datetime ? $queue->queue_datetime->format('Y-m-d H:i') : '';
                            $queueId = $queue->queue_id ?? null;
                            $priority = (int) ($queue->priority_level ?? 5);
                        @endphp
                        <tr class="border-b border-slate-50 last:border-0 reception-queue-row"
                            data-queue-number="{{ $queue->queue_number }}"
                            data-patient="{{ strtolower($patientName) }}"
                            data-doctor="{{ strtolower($doctorName) }}"
                            data-date="{{ $dateKey }}"
                            data-status="{{ strtolower($statusName) }}"
                            data-priority="{{ $priority }}"
                            @if ($queueId)
                                data-queue-id="{{ $queueId }}"
                            @endif>
                            <td class="py-2 pr-4 text-[0.78rem] text-slate-500">{{ $queue->queue_number }}</td>
                            <td class="py-2 pr-4 text-[0.78rem] text-slate-700">
                                @if ($patientName)
                                    {{ $patientName }}
                                @else
                                    <span class="text-slate-400">Patient</span>
                                @endif
                            </td>
                            <td class="py-2 pr-4 text-[0.78rem] text-slate-500">
                                @if ($doctorName)
                                    {{ $doctorName }}
                                @else
                                    <span class="text-[0.7rem] text-slate-400">Doctor</span>
                                @endif
                            </td>
                            <td class="py-2 pr-4 text-[0.78rem] text-slate-500">{{ $priority }}</td>
                            <td class="py-2 pr-4 text-[0.78rem] text-slate-500">
                                {{ $dateKey }}
                            </td>
                            <td class="py-2 pr-4 text-[0.78rem] text-slate-500">
                                @if ($statusName)
                                    <span class="inline-flex items-center rounded-full px-2 py-0.5 text-[0.68rem] font-medium border bg-slate-50 border-slate-100 text-slate-700">
                                        {{ ucfirst($statusName) }}
                                    </span>
                                @else
                                    <span class="text-[0.7rem] text-slate-400">—</span>
                                @endif
                            </td>
                            <td class="py-2 pr-4 text-[0.78rem] text-right text-slate-500">
                                @if ($queueId ?? null)
                                    <div class="inline-flex items-center gap-1.5">
                                        @if (strtolower($statusName) !== 'serving')
                                            <button type="button" class="inline-flex items-center gap-1 rounded-lg border border-slate-200 px-2 py-1 text-[0.7rem] text-slate-600 hover:bg-slate-50 reception-queue-status" data-queue-id="{{ $queueId }}" data-status="serving">
                                                <span class="material-symbols-outlined text-[16px] leading-none">play_arrow</span>
                                                Serving
                                            </button>
                                        @else
                                            <button type="button" class="inline-flex items-center gap-1 rounded-lg border border-emerald-200 px-2 py-1 text-[0.7rem] text-emerald-700 hover:bg-emerald-50 reception-queue-status" data-queue-id="{{ $queueId }}" data-status="done">
                                                <span class="material-symbols-outlined text-[16px] leading-none">check</span>
                                                Done
                                            </button>
                                        @endif

                                        <button type="button" class="inline-flex items-center gap-1 rounded-lg border border-slate-200 px-2 py-1 text-[0.7rem] text-slate-600 hover:bg-red-50 hover:border-red-200 hover:text-red-700 reception-queue-remove" data-queue-id="{{ $queueId }}">
                                            <span class="material-symbols-outlined text-[16px] leading-none">close</span>
                                            Remove
                                        </button>
                                    </div>
                                @else
                                    <span class="text-[0.7rem] text-slate-400">—</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-4 text-center text-[0.78rem] text-slate-400">
                                No queue entries for today.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="queueDisplayOverlay" class="hidden fixed inset-0 z-50 bg-slate-900/95 flex flex-col">
    <div class="flex items-center justify-between px-8 py-4 border-b border-slate-700">
        <div>
            <div class="text-[0.8rem] text-slate-400 uppercase tracking-widest">Opol Clinic</div>
            <div class="text-lg font-semibold text-white">Queue display</div>
        </div>
        <div class="flex items-center gap-2">
            <button id="queueDisplayFullscreenButton" type="button" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-slate-800 text-slate-100 text-[0.78rem] font-semibold hover:bg-slate-700">
                <span class="material-symbols-outlined text-[18px] leading-none">fullscreen</span>
                Full screen
            </button>
            <button id="queueDisplayCloseButton" type="button" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-slate-700 text-slate-100 text-[0.78rem] font-semibold hover:bg-slate-600">
                <span class="material-symbols-outlined text-[18px] leading-none">close</span>
                Close
            </button>
        </div>
    </div>

    <div class="flex-1 flex flex-col lg:flex-row">
        <div class="flex-1 flex items-center justify-center p-6">
            <div class="w-full max-w-xl" id="queueDisplayNowServing">
                <div class="text-[0.85rem] text-cyan-300 uppercase tracking-[0.3em] mb-3">Now serving</div>
                @if ($serving)
                    <div class="rounded-3xl bg-slate-800/80 border border-slate-600/80 px-6 py-6 shadow-[0_0_40px_rgba(8,47,73,0.9)]">
                        <div class="text-[0.9rem] text-slate-300 mb-2">Queue number</div>
                        <div class="text-6xl md:text-7xl font-serif font-bold text-white tracking-[0.25em]">
                            {{ str_pad($serving->queue_number, 3, '0', STR_PAD_LEFT) }}
                        </div>
                        @php
                            $servingPatient = optional(optional($serving->appointment)->patient)->personalInformation->full_name ?? 'Patient';
                            $servingDoctor = optional(optional($serving->appointment)->doctor)->personalInformation->full_name ?? null;
                        @endphp
                        <div class="mt-4 text-[0.95rem] text-slate-100 font-semibold">
                            {{ $servingPatient }}
                        </div>
                        <div class="mt-1 text-[0.8rem] text-slate-400">
                            @if ($servingDoctor)
                                Doctor: {{ $servingDoctor }}
                            @else
                                Waiting for doctor assignment
                            @endif
                        </div>
                    </div>
                @else
                    <div class="rounded-3xl bg-slate-800/80 border border-slate-600/80 px-6 py-8 text-center text-slate-300">
                        No queue is currently being served.
                    </div>
                @endif
            </div>
        </div>

        <div class="w-full lg:w-[420px] border-t lg:border-t-0 lg:border-l border-slate-700 bg-slate-950/70 p-6">
            <div class="flex items-center justify-between mb-3">
                <div class="text-[0.8rem] text-slate-400 uppercase tracking-[0.25em]">Next in line</div>
                <div class="text-[0.75rem] text-slate-500" id="queueDisplayNextCount">{{ $nextItems->count() }} shown</div>
            </div>
            <div class="space-y-3 max-h-full overflow-y-auto scrollbar-hidden" id="queueDisplayNextList">
                @forelse ($nextItems as $queue)
                    @php
                        $patientName = optional(optional($queue->appointment)->patient)->personalInformation->full_name ?? 'Patient';
                        $doctorName = optional(optional($queue->appointment)->doctor)->personalInformation->full_name ?? null;
                        $statusName = (string) ($queue->status ?? '');
                    @endphp
                    <div class="rounded-2xl bg-slate-800/60 border border-slate-600/70 px-4 py-3 flex items-center justify-between">
                        <div>
                            <div class="text-[0.75rem] text-slate-400 mb-1">Queue #{{ $queue->queue_number }}</div>
                            <div class="text-[0.9rem] text-slate-100 font-semibold">{{ $patientName }}</div>
                            <div class="text-[0.75rem] text-slate-400">
                                @if ($doctorName)
                                    Doctor: {{ $doctorName }}
                                @else
                                    Doctor not assigned
                                @endif
                            </div>
                        </div>
                        <div class="text-right">
                            @if ($statusName)
                                <div class="inline-flex items-center rounded-full px-2 py-0.5 text-[0.65rem] font-semibold bg-cyan-500/10 text-cyan-300 border border-cyan-500/40">
                                    {{ strtoupper($statusName) }}
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-[0.8rem] text-slate-400">
                        No additional queue entries.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var searchInput = document.getElementById('reception_queue_search')
        var sortSelect = document.getElementById('reception_queue_sort')
        var rows = Array.prototype.slice.call(document.querySelectorAll('.reception-queue-row'))
        var addQueueForm = document.getElementById('receptionAddQueueForm')
        var queueErrorBox = document.getElementById('receptionQueueError')
        var queueSuccessBox = document.getElementById('receptionQueueSuccess')
        var appointmentSearch = document.getElementById('reception_queue_appointment_search')
        var appointmentSelect = document.getElementById('reception_add_queue_appointment_id')
        var appointmentSearchTimer = null

        function escapeHtml(input) {
            return String(input == null ? '' : input)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;')
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

        function renderAppointmentOptions(list) {
            if (!appointmentSelect) return
            var current = appointmentSelect.value
            appointmentSelect.innerHTML = '<option value="">Select an appointment</option>' + (list || []).slice(0, 50).map(function (a) {
                return '<option value="' + escapeHtml(a.appointment_id) + '">' + escapeHtml(appointmentLabel(a)) + '</option>'
            }).join('')
            if (current) appointmentSelect.value = current
        }

        function loadAppointmentOptions(search) {
            if (typeof apiFetch !== 'function') return
            var url = "{{ url('/api/appointments') }}" + '?per_page=50'
            if (search) {
                url += '&search=' + encodeURIComponent(search)
            }
            apiFetch(url, { method: 'GET' })
                .then(function (response) {
                    return response.json().then(function (data) {
                        return { ok: response.ok, data: data }
                    }).catch(function () {
                        return { ok: response.ok, data: null }
                    })
                })
                .then(function (result) {
                    if (!result.ok || !result.data) return
                    var raw = result.data && Array.isArray(result.data.data) ? result.data.data : (Array.isArray(result.data) ? result.data : [])
                    renderAppointmentOptions(raw || [])
                })
                .catch(function () {})
        }

        if (appointmentSearch) {
            appointmentSearch.addEventListener('input', function () {
                if (appointmentSearchTimer) clearTimeout(appointmentSearchTimer)
                appointmentSearchTimer = setTimeout(function () {
                    loadAppointmentOptions((appointmentSearch.value || '').trim())
                }, 250)
            })
        }

        loadAppointmentOptions('')

        function applyReceptionQueueFilters() {
            var query = searchInput ? searchInput.value.toLowerCase().trim() : ''

            rows.forEach(function (row) {
                var number = row.getAttribute('data-queue-number') || ''
                var patient = row.getAttribute('data-patient') || ''
                var doctor = row.getAttribute('data-doctor') || ''
                var date = row.getAttribute('data-date') || ''

                var matches = true
                if (query) {
                    matches =
                        ('#' + number).indexOf(query) !== -1 ||
                        patient.indexOf(query) !== -1 ||
                        doctor.indexOf(query) !== -1 ||
                        date.indexOf(query) !== -1
                }

                row.style.display = matches ? '' : 'none'
            })

            applyReceptionQueueSort()
        }

        function applyReceptionQueueSort() {
            if (!sortSelect) {
                return
            }
            var value = sortSelect.value
            var tbody = rows.length ? rows[0].parentNode : null
            if (!tbody) {
                return
            }

            var visibleRows = rows.filter(function (row) {
                return row.style.display !== 'none'
            })

            visibleRows.sort(function (a, b) {
                var na = parseInt(a.getAttribute('data-queue-number') || '0', 10)
                var nb = parseInt(b.getAttribute('data-queue-number') || '0', 10)
                var da = a.getAttribute('data-date') || ''
                var db = b.getAttribute('data-date') || ''

                if (value === 'number_asc' || value === 'number_desc') {
                    if (na < nb) return value === 'number_asc' ? -1 : 1
                    if (na > nb) return value === 'number_asc' ? 1 : -1
                    return 0
                }

                if (da < db) return value === 'date_asc' ? -1 : 1
                if (da > db) return value === 'date_asc' ? 1 : -1
                return 0
            })

            visibleRows.forEach(function (row) {
                tbody.appendChild(row)
            })
        }

        function showQueueError(message) {
            if (!queueErrorBox) return
            queueErrorBox.textContent = message || ''
            if (message) {
                queueErrorBox.classList.remove('hidden')
            } else {
                queueErrorBox.classList.add('hidden')
            }
        }

        function showQueueSuccess(message) {
            if (!queueSuccessBox) return
            queueSuccessBox.textContent = message || ''
            if (message) {
                queueSuccessBox.classList.remove('hidden')
            } else {
                queueSuccessBox.classList.add('hidden')
            }
        }

        if (searchInput) {
            searchInput.addEventListener('input', applyReceptionQueueFilters)
        }
        if (sortSelect) {
            sortSelect.addEventListener('change', applyReceptionQueueSort)
        }

        applyReceptionQueueFilters()

        if (addQueueForm) {
            addQueueForm.addEventListener('submit', function (e) {
                e.preventDefault()

                showQueueError('')
                showQueueSuccess('')

                var appointmentInput = document.getElementById('reception_add_queue_appointment_id')
                var numberInput = document.getElementById('reception_add_queue_number')
                var datetimeInput = document.getElementById('reception_add_queue_datetime')

                var appointmentId = appointmentInput ? parseInt(appointmentInput.value, 10) : 0
                var queueNumber = numberInput && numberInput.value ? parseInt(numberInput.value, 10) : null
                var queueDatetime = datetimeInput ? datetimeInput.value : ''

                if (!appointmentId) {
                    showQueueError('Appointment ID is required to add to queue.')
                    return
                }

                if (typeof apiFetch !== 'function') {
                    showQueueError('API client is not available.')
                    return
                }

                var body = {
                    appointment_id: appointmentId
                }

                if (queueNumber !== null && !isNaN(queueNumber)) {
                    body.queue_number = queueNumber
                }
                if (queueDatetime) {
                    body.queue_datetime = queueDatetime
                }

                apiFetch("{{ url('/api/queues') }}", {
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
                            var message = 'Failed to add appointment to queue.'
                            if (result.data && result.data.message) {
                                message = result.data.message
                            }
                            showQueueError(message)
                            return
                        }

                        showQueueSuccess('Appointment added to queue.')
                        if (appointmentInput) appointmentInput.value = ''
                        if (numberInput) numberInput.value = ''
                        if (datetimeInput) datetimeInput.value = ''
                    })
                    .catch(function () {
                        showQueueError('Network error while adding to queue.')
                    })
            })
        }

        document.querySelectorAll('.reception-queue-remove').forEach(function (button) {
            button.addEventListener('click', function () {
                var queueId = button.getAttribute('data-queue-id')
                if (!queueId) {
                    return
                }

                showQueueError('')
                showQueueSuccess('')

                if (typeof apiFetch !== 'function') {
                    showQueueError('API client is not available.')
                    return
                }

                var url = "{{ url('/api/queues') }}/" + encodeURIComponent(queueId)

                apiFetch(url, { method: 'DELETE' })
                    .then(function (response) {
                        if (!response.ok) {
                            return response.json().then(function (data) {
                                return { ok: false, data: data }
                            }).catch(function () {
                                return { ok: false, data: null }
                            })
                        }
                        return { ok: true, data: null }
                    })
                    .then(function (result) {
                        if (!result.ok) {
                            var message = 'Failed to remove queue entry.'
                            if (result.data && result.data.message) {
                                message = result.data.message
                            }
                            showQueueError(message)
                            return
                        }

                        var row = button.closest('tr')
                        if (row) {
                            row.parentNode.removeChild(row)
                            rows = Array.prototype.slice.call(document.querySelectorAll('.reception-queue-row'))
                        }

                        showQueueSuccess('Queue entry removed.')
                    })
                    .catch(function () {
                        showQueueError('Network error while removing queue entry.')
                    })
            })
        })

        function updateQueueStatus(queueId, status, successMessage) {
            if (!queueId) {
                return
            }

            showQueueError('')
            showQueueSuccess('')

            if (typeof apiFetch !== 'function') {
                showQueueError('API client is not available.')
                return
            }

            var url = "{{ url('/api/queues') }}/" + encodeURIComponent(queueId)

            apiFetch(url, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ status: status })
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
                        var message = 'Failed to update queue.'
                        if (result.data && result.data.message) {
                            message = result.data.message
                        }
                        showQueueError(message)
                        return
                    }

                    showQueueSuccess(successMessage || 'Queue updated.')
                    window.location.reload()
                })
                .catch(function () {
                    showQueueError('Network error while updating queue.')
                })
        }

        document.querySelectorAll('.reception-queue-status').forEach(function (button) {
            button.addEventListener('click', function () {
                var queueId = button.getAttribute('data-queue-id')
                var status = button.getAttribute('data-status')
                if (!queueId || !status) {
                    return
                }
                updateQueueStatus(queueId, status, 'Queue status updated.')
            })
        })

        var refreshButton = document.getElementById('receptionRefreshQueueButton')
        if (refreshButton) {
            refreshButton.addEventListener('click', function () {
                window.location.reload()
            })
        }

        var callNextButton = document.getElementById('receptionCallNextButton')
        if (callNextButton) {
            callNextButton.addEventListener('click', function () {
                showQueueError('')
                showQueueSuccess('')

                rows = Array.prototype.slice.call(document.querySelectorAll('.reception-queue-row'))
                var candidates = rows
                    .filter(function (row) {
                        return (row.getAttribute('data-status') || '').toLowerCase() === 'waiting'
                    })
                    .map(function (row) {
                        return {
                            row: row,
                            queueId: row.getAttribute('data-queue-id') || '',
                            priority: parseInt(row.getAttribute('data-priority') || '5', 10),
                            number: parseInt(row.getAttribute('data-queue-number') || '0', 10)
                        }
                    })
                    .filter(function (item) {
                        return !!item.queueId
                    })

                if (!candidates.length) {
                    showQueueError('No waiting patients to call.')
                    return
                }

                candidates.sort(function (a, b) {
                    if (a.priority !== b.priority) {
                        return a.priority - b.priority
                    }
                    return a.number - b.number
                })

                updateQueueStatus(candidates[0].queueId, 'serving', 'Next patient is now serving.')
            })
        }

        var publicLinkButton = document.getElementById('receptionPublicQueueLinkButton')
        if (publicLinkButton) {
            publicLinkButton.addEventListener('click', function () {
                var today = new Date().toISOString().slice(0, 10)
                var link = "{{ route('queue.display') }}" + '?date=' + encodeURIComponent(today)

                try {
                    if (navigator.clipboard && navigator.clipboard.writeText) {
                        navigator.clipboard.writeText(link)
                    }
                } catch (_) {
                }

                try {
                    window.open(link, '_blank', 'noopener')
                } catch (_) {
                    window.location.href = link
                }
            })
        }

        function buildQueueDisplay(items) {
            var today = new Date().toISOString().slice(0, 10)

            function safeName(user, fallback) {
                if (user && user.personal_information && user.personal_information.full_name) {
                    return String(user.personal_information.full_name)
                }
                var first = user && user.firstname ? String(user.firstname) : ''
                var last = user && user.lastname ? String(user.lastname) : ''
                var name = (first + ' ' + last).trim()
                return name || (fallback || 'Patient')
            }

            var todays = items.filter(function (item) {
                var dt = item && item.queue_datetime ? String(item.queue_datetime) : ''
                return dt.slice(0, 10) === today
            })

            todays = todays.filter(function (item) {
                var status = item && item.status ? String(item.status).toLowerCase() : ''
                return status === 'waiting' || status === 'serving'
            })

            function sortKey(item) {
                var priority = parseInt(item && item.priority_level != null ? item.priority_level : 5, 10)
                var number = parseInt(item && item.queue_number != null ? item.queue_number : 0, 10)
                return { priority: isNaN(priority) ? 5 : priority, number: isNaN(number) ? 0 : number }
            }

            var servingItem = todays.find(function (item) {
                return String(item.status || '').toLowerCase() === 'serving'
            }) || null

            var waiting = todays.filter(function (item) {
                return String(item.status || '').toLowerCase() === 'waiting'
            })

            waiting.sort(function (a, b) {
                var ka = sortKey(a)
                var kb = sortKey(b)
                if (ka.priority !== kb.priority) return ka.priority - kb.priority
                return ka.number - kb.number
            })

            var nextItems = waiting.slice(0, 5)

            var servingContainer = document.getElementById('queueDisplayNowServing')
            var nextList = document.getElementById('queueDisplayNextList')
            var nextCount = document.getElementById('queueDisplayNextCount')

            if (servingContainer) {
                if (!servingItem) {
                    servingContainer.innerHTML =
                        '<div class="text-[0.85rem] text-cyan-300 uppercase tracking-[0.3em] mb-3">Now serving</div>' +
                        '<div class="rounded-3xl bg-slate-800/80 border border-slate-600/80 px-6 py-8 text-center text-slate-300">' +
                        'No queue is currently being served.' +
                        '</div>'
                } else {
                    var appt = servingItem.appointment || null
                    var patientName = appt && appt.patient ? safeName(appt.patient, 'Patient') : 'Patient'
                    var doctorName = appt && appt.doctor ? safeName(appt.doctor, '') : ''

                    var number = String(servingItem.queue_number || '')
                    if (number.length < 3) {
                        number = ('000' + number).slice(-3)
                    }

                    var html =
                        '<div class="text-[0.85rem] text-cyan-300 uppercase tracking-[0.3em] mb-3">Now serving</div>' +
                        '<div class="rounded-3xl bg-slate-800/80 border border-slate-600/80 px-6 py-6 shadow-[0_0_40px_rgba(8,47,73,0.9)]">' +
                        '<div class="text-[0.9rem] text-slate-300 mb-2">Queue number</div>' +
                        '<div class="text-6xl md:text-7xl font-serif font-bold text-white tracking-[0.25em]">' + number + '</div>' +
                        '<div class="mt-4 text-[0.95rem] text-slate-100 font-semibold">' + patientName + '</div>' +
                        '<div class="mt-1 text-[0.8rem] text-slate-400">' +
                        (doctorName ? 'Doctor: ' + doctorName : 'Waiting for doctor assignment') +
                        '</div>' +
                        '</div>'

                    servingContainer.innerHTML = html
                }
            }

            if (nextList) {
                var nextHtml = ''

                nextItems.forEach(function (queue) {
                    var appt = queue.appointment || null
                    var patientName = appt && appt.patient ? safeName(appt.patient, 'Patient') : 'Patient'
                    var doctorName = appt && appt.doctor ? safeName(appt.doctor, '') : ''
                    var statusName = queue.status ? String(queue.status) : ''

                    nextHtml +=
                        '<div class="rounded-2xl bg-slate-800/60 border border-slate-600/70 px-4 py-3 flex items-center justify-between">' +
                        '<div>' +
                        '<div class="text-[0.75rem] text-slate-400 mb-1">Queue #' + (queue.queue_number || '') + '</div>' +
                        '<div class="text-[0.9rem] text-slate-100 font-semibold">' + patientName + '</div>' +
                        '<div class="text-[0.75rem] text-slate-400">' +
                        (doctorName ? 'Doctor: ' + doctorName : 'Doctor not assigned') +
                        '</div>' +
                        '</div>' +
                        '<div class="text-right">' +
                        (statusName
                            ? '<div class="inline-flex items-center rounded-full px-2 py-0.5 text-[0.65rem] font-semibold bg-cyan-500/10 text-cyan-300 border border-cyan-500/40">' +
                                statusName.toUpperCase() +
                              '</div>'
                            : '') +
                        '</div>' +
                        '</div>'
                })

                if (!nextHtml) {
                    nextHtml = '<div class="text-[0.8rem] text-slate-400">No additional queue entries.</div>'
                }

                nextList.innerHTML = nextHtml
            }

            if (nextCount) {
                nextCount.textContent = nextItems.length + ' shown'
            }
        }

        function fetchQueueSnapshot() {
            if (typeof apiFetch !== 'function') {
                return
            }

            var today = new Date().toISOString().slice(0, 10)
            var url = "{{ url('/api/queues') }}" + '?per_page=100&date=' + encodeURIComponent(today)

            apiFetch(url, {
                method: 'GET'
            })
                .then(function (response) {
                    return response.json().then(function (data) {
                        return { ok: response.ok, status: response.status, data: data }
                    }).catch(function () {
                        return { ok: response.ok, status: response.status, data: null }
                    })
                })
                .then(function (result) {
                    if (!result.ok || !result.data) {
                        return
                    }

                    var payload = result.data
                    var items = []
                    if (Array.isArray(payload)) {
                        items = payload
                    } else if (Array.isArray(payload.data)) {
                        items = payload.data
                    }

                    if (!items.length) {
                        return
                    }

                    buildQueueDisplay(items)
                })
                .catch(function () {
                })
        }

        var displayButton = document.getElementById('receptionDisplayQueueButton')
        var overlay = document.getElementById('queueDisplayOverlay')
        var closeButton = document.getElementById('queueDisplayCloseButton')
        var fullscreenButton = document.getElementById('queueDisplayFullscreenButton')

        if (displayButton && overlay) {
            displayButton.addEventListener('click', function () {
                overlay.classList.remove('hidden')
            })
        }

        function closeOverlay() {
            if (!overlay) {
                return
            }
            overlay.classList.add('hidden')
            if (document.fullscreenElement && document.exitFullscreen) {
                document.exitFullscreen()
            }
        }

        if (closeButton && overlay) {
            closeButton.addEventListener('click', function () {
                closeOverlay()
            })
        }

        if (fullscreenButton && overlay) {
            fullscreenButton.addEventListener('click', function () {
                if (!document.fullscreenElement) {
                    if (overlay.requestFullscreen) {
                        overlay.requestFullscreen()
                    }
                } else {
                    if (document.exitFullscreen) {
                        document.exitFullscreen()
                    }
                }
            })
        }

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && overlay && !overlay.classList.contains('hidden')) {
                closeOverlay()
            }
        })

        fetchQueueSnapshot()
        setInterval(fetchQueueSnapshot, 5000)
    })
</script>
