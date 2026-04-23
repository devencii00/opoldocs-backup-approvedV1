@php
    $queueItems = collect($receptionQueue ?? []);
    $serving = $queueItems->first();
    $nextItems = $queueItems->slice(1, 4);
@endphp

<div class="space-y-4">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-sm font-semibold text-slate-900">Queue management</h2>
            <p class="text-xs text-slate-500">View and monitor today&apos;s queue. Use the display view for TV or lobby screens.</p>
        </div>
        <button id="receptionDisplayQueueButton" type="button" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-cyan-600 text-white text-[0.8rem] font-semibold hover:bg-cyan-700 transition-colors">
            <span class="material-symbols-outlined text-[18px] leading-none">tv</span>
            Display queue
        </button>
    </div>

    <div class="bg-white border border-slate-200 rounded-[18px] p-5 shadow-[0_2px_10px_rgba(15,23,42,0.04)]">
        <div class="flex items-center justify-between mb-3">
            <h3 class="text-sm font-semibold text-slate-900">Today&apos;s queue</h3>
            <span class="text-[0.7rem] text-slate-400 uppercase tracking-widest">Front desk</span>
        </div>

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
                        <th class="py-2 pr-4 font-semibold">Date</th>
                        <th class="py-2 pr-4 font-semibold">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($queueItems as $queue)
                        @php
                            $patientName = optional(optional(optional($queue->source)->appointment)->patient)->personalInformation->full_name ?? '';
                            $doctorName = optional(optional($queue->doctor)->employee)->personalInformation->full_name ?? '';
                            $statusName = optional($queue->status)->status_name ?? '';
                            $dateKey = $queue->queue_date ?? '';
                        @endphp
                        <tr class="border-b border-slate-50 last:border-0 reception-queue-row"
                            data-queue-number="{{ $queue->queue_number }}"
                            data-patient="{{ strtolower($patientName) }}"
                            data-doctor="{{ strtolower($doctorName) }}"
                            data-date="{{ $dateKey }}">
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
                            <td class="py-2 pr-4 text-[0.78rem] text-slate-500">
                                {{ $queue->queue_date }}
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
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-4 text-center text-[0.78rem] text-slate-400">
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
                            $servingPatient = optional(optional(optional($serving->source)->appointment)->patient)->personalInformation->full_name ?? 'Patient';
                            $servingDoctor = optional(optional($serving->doctor)->employee)->personalInformation->full_name ?? null;
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
                        $patientName = optional(optional(optional($queue->source)->appointment)->patient)->personalInformation->full_name ?? 'Patient';
                        $doctorName = optional(optional($queue->doctor)->employee)->personalInformation->full_name ?? null;
                        $statusName = optional($queue->status)->status_name ?? '';
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

        if (searchInput) {
            searchInput.addEventListener('input', applyReceptionQueueFilters)
        }
        if (sortSelect) {
            sortSelect.addEventListener('change', applyReceptionQueueSort)
        }

        applyReceptionQueueFilters()

        function buildQueueDisplay(items) {
            var today = new Date().toISOString().slice(0, 10)

            var todays = items.filter(function (item) {
                return item.queue_date === today
            })

            todays.sort(function (a, b) {
                var na = parseInt(a.queue_number || 0, 10)
                var nb = parseInt(b.queue_number || 0, 10)
                if (na < nb) return -1
                if (na > nb) return 1
                return 0
            })

            var servingItem = todays.length ? todays[0] : null
            var nextItems = todays.slice(1, 5)

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
                    var patientName = ''
                    var doctorName = ''
                    if (servingItem.source && servingItem.source.appointment && servingItem.source.appointment.patient && servingItem.source.appointment.patient.personal_information) {
                        var pi = servingItem.source.appointment.patient.personal_information
                        var first = pi.firstname || pi.first_name || ''
                        var last = pi.lastname || pi.last_name || ''
                        patientName = (first + ' ' + last).trim()
                    }
                    if (!patientName) {
                        patientName = 'Patient'
                    }
                    if (servingItem.doctor && servingItem.doctor.employee && servingItem.doctor.employee.personal_information) {
                        var dpi = servingItem.doctor.employee.personal_information
                        var df = dpi.firstname || dpi.first_name || ''
                        var dl = dpi.lastname || dpi.last_name || ''
                        doctorName = (df + ' ' + dl).trim()
                    }

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
                    var patientName = ''
                    var doctorName = ''

                    if (queue.source && queue.source.appointment && queue.source.appointment.patient && queue.source.appointment.patient.personal_information) {
                        var pi = queue.source.appointment.patient.personal_information
                        var first = pi.firstname || pi.first_name || ''
                        var last = pi.lastname || pi.last_name || ''
                        patientName = (first + ' ' + last).trim() || 'Patient'
                    } else {
                        patientName = 'Patient'
                    }

                    if (queue.doctor && queue.doctor.employee && queue.doctor.employee.personal_information) {
                        var dpi = queue.doctor.employee.personal_information
                        var df = dpi.firstname || dpi.first_name || ''
                        var dl = dpi.lastname || dpi.last_name || ''
                        doctorName = (df + ' ' + dl).trim()
                    }

                    var statusName = queue.status && queue.status.status_name ? String(queue.status.status_name) : ''

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

            apiFetch("{{ url('/api/queues') }}", {
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
