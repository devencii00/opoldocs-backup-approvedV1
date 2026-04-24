<div class="bg-white border border-slate-200 rounded-[18px] p-5 shadow-[0_2px_10px_rgba(15,23,42,0.04)]">
    <div class="flex items-center justify-between mb-3">
        <h2 class="text-sm font-semibold text-slate-900">Doctor Management</h2>
        <span class="text-[0.7rem] text-slate-400 uppercase tracking-widest">Doctors</span>
    </div>
    <p class="text-xs text-slate-500 mb-4">
        Manage doctor profiles and schedules. Doctor accounts are created in the Users module by assigning the Doctor role.
    </p>

    <div id="adminDoctorError" class="hidden mb-3 rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-[0.75rem] text-red-700"></div>

    <div class="mb-3 flex flex-col gap-2 md:flex-row md:items-end">
        <div class="flex-1">
            <label for="admin_doctor_search" class="block text-[0.7rem] text-slate-600 mb-1">Search doctors</label>
            <input id="admin_doctor_search" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Search by name or email">
        </div>
        <div class="w-full md:w-40">
            <label for="admin_doctor_sort" class="block text-[0.7rem] text-slate-600 mb-1">Sort</label>
            <select id="admin_doctor_sort" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                <option value="created_desc">Newest first</option>
                <option value="created_asc">Oldest first</option>
                <option value="name_asc">Name A–Z</option>
                <option value="name_desc">Name Z–A</option>
            </select>
        </div>
    </div>

    <div class="overflow-x-auto scrollbar-hidden">
        <table class="min-w-full text-left text-xs text-slate-600">
            <thead>
                <tr class="border-b border-slate-100 text-[0.68rem] uppercase tracking-widest text-slate-400">
                    <th class="py-2 pr-4 font-semibold">Name</th>
                    <th class="py-2 pr-4 font-semibold">Specialization</th>
                    <th class="py-2 pr-4 font-semibold">Schedule summary</th>
                    <th class="py-2 pr-4 font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody id="admin_doctor_table_body">
                <tr>
                    <td colspan="4" class="py-4 text-center text-[0.78rem] text-slate-400">
                        Loading doctors…
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div id="adminDoctorSchedulePanel" class="mt-4 hidden border border-slate-100 rounded-2xl bg-slate-50/60 p-4">
        <div class="flex items-center justify-between mb-2">
            <div>
                <h3 class="text-xs font-semibold text-slate-900" id="adminDoctorScheduleTitle">Manage Schedule</h3>
                <p class="text-[0.7rem] text-slate-500">Add time slots, assign days, and view doctor schedules.</p>
            </div>
            <button type="button" id="adminDoctorScheduleClose" class="text-[0.72rem] text-slate-500 hover:text-slate-700 font-semibold">
                Close
            </button>
        </div>

        <form id="adminDoctorScheduleForm" class="mb-3 grid gap-2 grid-cols-1 md:grid-cols-5 items-end">
            <div>
                <label for="admin_schedule_start" class="block text-[0.7rem] text-slate-600 mb-1">Start time</label>
                <input id="admin_schedule_start" type="time" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
            </div>
            <div>
                <label for="admin_schedule_end" class="block text-[0.7rem] text-slate-600 mb-1">End time</label>
                <input id="admin_schedule_end" type="time" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
            </div>
            <div>
                <label for="admin_schedule_max" class="block text-[0.7rem] text-slate-600 mb-1">Max patients</label>
                <input id="admin_schedule_max" type="number" min="1" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Optional">
            </div>
            <div>
                <label class="block text-[0.7rem] text-slate-600 mb-1">Days</label>
                <div class="flex flex-wrap gap-1 text-[0.68rem]">
                    <label class="inline-flex items-center gap-1">
                        <input type="checkbox" value="mon" class="rounded border-slate-300 text-cyan-600 focus:ring-cyan-500"> Mon
                    </label>
                    <label class="inline-flex items-center gap-1">
                        <input type="checkbox" value="tue" class="rounded border-slate-300 text-cyan-600 focus:ring-cyan-500"> Tue
                    </label>
                    <label class="inline-flex items-center gap-1">
                        <input type="checkbox" value="wed" class="rounded border-slate-300 text-cyan-600 focus:ring-cyan-500"> Wed
                    </label>
                    <label class="inline-flex items-center gap-1">
                        <input type="checkbox" value="thu" class="rounded border-slate-300 text-cyan-600 focus:ring-cyan-500"> Thu
                    </label>
                    <label class="inline-flex items-center gap-1">
                        <input type="checkbox" value="fri" class="rounded border-slate-300 text-cyan-600 focus:ring-cyan-500"> Fri
                    </label>
                    <label class="inline-flex items-center gap-1">
                        <input type="checkbox" value="sat" class="rounded border-slate-300 text-cyan-600 focus:ring-cyan-500"> Sat
                    </label>
                    <label class="inline-flex items-center gap-1">
                        <input type="checkbox" value="sun" class="rounded border-slate-300 text-cyan-600 focus:ring-cyan-500"> Sun
                    </label>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 rounded-xl bg-cyan-600 text-white text-[0.78rem] font-semibold hover:bg-cyan-700 transition-colors w-full">
                    Add schedule
                </button>
            </div>
        </form>

        <div class="text-[0.78rem] text-slate-700">
            <h4 class="text-xs font-semibold text-slate-900 mb-2">Existing schedules</h4>
            <div id="adminDoctorScheduleList" class="space-y-2 text-[0.78rem] text-slate-700">
            </div>
            <div class="mt-4">
                <h4 class="text-xs font-semibold text-slate-900 mb-2">Weekly grid</h4>
                <div id="adminDoctorScheduleGrid" class="grid grid-cols-7 gap-2 text-[0.72rem]"></div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var errorBox = document.getElementById('adminDoctorError')
        var searchInput = document.getElementById('admin_doctor_search')
        var sortSelect = document.getElementById('admin_doctor_sort')
        var tableBody = document.getElementById('admin_doctor_table_body')

        var schedulePanel = document.getElementById('adminDoctorSchedulePanel')
        var scheduleTitle = document.getElementById('adminDoctorScheduleTitle')
        var scheduleClose = document.getElementById('adminDoctorScheduleClose')
        var scheduleForm = document.getElementById('adminDoctorScheduleForm')
        var scheduleStart = document.getElementById('admin_schedule_start')
        var scheduleEnd = document.getElementById('admin_schedule_end')
        var scheduleMax = document.getElementById('admin_schedule_max')
        var scheduleList = document.getElementById('adminDoctorScheduleList')
        var scheduleGrid = document.getElementById('adminDoctorScheduleGrid')

        var currentDoctorIdForSchedule = null
        var currentScheduleId = null
        var loadedSchedules = []
        var doctors = []

        function showDoctorError(message) {
            if (!errorBox) return
            errorBox.textContent = message || ''
            if (message) {
                errorBox.classList.remove('hidden')
            } else {
                errorBox.classList.add('hidden')
            }
        }

        function loadDoctors() {
            if (!tableBody) return
            tableBody.innerHTML = '<tr><td colspan="4" class="py-4 text-center text-[0.78rem] text-slate-400">Loading doctors…</td></tr>'

            apiFetch("{{ url('/api/doctors') }}", {
                method: 'GET'
            })
                .then(function (response) {
                    return response.json().then(function (data) {
                        return { ok: response.ok, data: data }
                    })
                })
                .then(function (result) {
                    if (!result.ok) {
                        tableBody.innerHTML = '<tr><td colspan="6" class="py-4 text-center text-[0.78rem] text-red-500">Failed to load doctors.</td></tr>'
                        return
                    }
                    var payload = result.data
                    doctors = Array.isArray(payload.data) ? payload.data : payload
                    renderDoctors()
                })
                .catch(function () {
                    tableBody.innerHTML = '<tr><td colspan="6" class="py-4 text-center text-[0.78rem] text-red-500">Network error while loading doctors.</td></tr>'
                })
        }

        function renderDoctors() {
            if (!tableBody) return

            var query = searchInput ? searchInput.value.toLowerCase().trim() : ''
            var sort = sortSelect ? sortSelect.value : 'created_desc'

            var filtered = doctors.slice().filter(function (doctor) {
                var name = ((doctor.firstname || '') + ' ' + (doctor.lastname || '')).toLowerCase().trim()
                var email = (doctor.email || '').toLowerCase()
                if (!query) return true
                return name.indexOf(query) !== -1 || email.indexOf(query) !== -1
            })

            filtered.sort(function (a, b) {
                if (sort === 'name_asc' || sort === 'name_desc') {
                    var na = ((a.firstname || '') + ' ' + (a.lastname || '')).toLowerCase().trim()
                    var nb = ((b.firstname || '') + ' ' + (b.lastname || '')).toLowerCase().trim()
                    if (na < nb) return sort === 'name_asc' ? -1 : 1
                    if (na > nb) return sort === 'name_asc' ? 1 : -1
                    return 0
                }
                var da = a.created_at || ''
                var db = b.created_at || ''
                if (da < db) return sort === 'created_asc' ? -1 : 1
                if (da > db) return sort === 'created_asc' ? 1 : -1
                return 0
            })

            if (!filtered.length) {
                tableBody.innerHTML = '<tr><td colspan="4" class="py-4 text-center text-[0.78rem] text-slate-400">No doctors found.</td></tr>'
                return
            }

            tableBody.innerHTML = ''

            filtered.forEach(function (doctor) {
                var tr = document.createElement('tr')
                tr.className = 'border-b border-slate-50 last:border-0'

                var fullName = ((doctor.firstname || '') + ' ' + (doctor.lastname || '')).trim()
                if (!fullName) {
                    fullName = 'Doctor #' + doctor.user_id
                }
                var specialization = (doctor.specialization || '').trim()
                var schedules = Array.isArray(doctor.doctor_schedules) ? doctor.doctor_schedules : []
                var scheduleCount = schedules.length
                var daySet = {}
                schedules.forEach(function (s) {
                    var days = Array.isArray(s.days) ? s.days : []
                    days.forEach(function (d) {
                        if (d && d.day_of_week) {
                            daySet[String(d.day_of_week).toLowerCase()] = true
                        }
                    })
                })
                var dayKeys = Object.keys(daySet)
                var dayOrder = ['mon','tue','wed','thu','fri','sat','sun']
                dayKeys.sort(function (a, b) {
                    return dayOrder.indexOf(a) - dayOrder.indexOf(b)
                })
                var scheduleSummary = scheduleCount ? (scheduleCount + ' slot' + (scheduleCount === 1 ? '' : 's') + (dayKeys.length ? (' · ' + dayKeys.join(', ')) : '')) : 'No schedules'

                tr.innerHTML =
                    '<td class="py-2 pr-4 text-[0.78rem] text-slate-700">' + fullName + '</td>' +
                    '<td class="py-2 pr-4 text-[0.78rem] text-slate-500">' + (specialization ? specialization : '<span class="text-slate-400">—</span>') + '</td>' +
                    '<td class="py-2 pr-4 text-[0.78rem] text-slate-500">' + scheduleSummary + '</td>' +
                    '<td class="py-2 pr-4 text-[0.78rem]">' +
                        '<div class="flex items-center gap-2">' +
                            '<button type="button" class="text-[0.72rem] text-cyan-700 hover:text-cyan-800 font-semibold admin-doctor-edit" data-doctor-id="' + doctor.user_id + '">Edit</button>' +
                            '<button type="button" class="text-[0.72rem] text-slate-700 hover:text-slate-900 font-semibold admin-doctor-schedule" data-doctor-id="' + doctor.user_id + '" data-doctor-name="' + fullName.replace(/"/g, '&quot;') + '">Manage schedule</button>' +
                        '</div>' +
                    '</td>'

                tableBody.appendChild(tr)
            })

            var editButtons = tableBody.querySelectorAll('.admin-doctor-edit')
            editButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    var id = this.getAttribute('data-doctor-id')
                    var doctor = doctors.find(function (d) { return String(d.user_id) === String(id) })
                    if (!doctor) return

                    var newFirstname = window.prompt('First name', doctor.firstname || '') || ''
                    var newLastname = window.prompt('Last name', doctor.lastname || '') || ''
                    var newSpecialization = window.prompt('Specialization', doctor.specialization || '') || ''

                    apiFetch("{{ url('/api/doctors') }}/" + id, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            firstname: newFirstname,
                            lastname: newLastname,
                            specialization: newSpecialization
                        })
                    })
                        .then(function (response) {
                            return response.json().then(function (data) {
                                return { ok: response.ok, data: data }
                            })
                        })
                        .then(function (result) {
                            if (!result.ok) {
                                showDoctorError('Failed to update doctor.')
                                return
                            }
                            loadDoctors()
                        })
                        .catch(function () {
                            showDoctorError('Network error while updating doctor.')
                        })
                })
            })

            var scheduleButtons = tableBody.querySelectorAll('.admin-doctor-schedule')
            scheduleButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    var id = this.getAttribute('data-doctor-id')
                    var name = this.getAttribute('data-doctor-name') || ''
                    currentDoctorIdForSchedule = id
                    currentScheduleId = null
                    if (scheduleStart) scheduleStart.value = ''
                    if (scheduleEnd) scheduleEnd.value = ''
                    if (scheduleMax) scheduleMax.value = ''
                    if (scheduleForm) {
                        var inputs = scheduleForm.querySelectorAll('input[type="checkbox"][value]')
                        inputs.forEach(function (input) {
                            input.checked = false
                        })
                    }
                    if (scheduleTitle) {
                        scheduleTitle.textContent = 'Manage Schedule — ' + name
                    }
                    if (schedulePanel) {
                        schedulePanel.classList.remove('hidden')
                    }
                    loadSchedulesForDoctor(id)
                })
            })
        }

        function loadSchedulesForDoctor(doctorId) {
            if (!scheduleList || !doctorId) return
            scheduleList.innerHTML = 'Loading schedules…'
            if (scheduleGrid) {
                scheduleGrid.innerHTML = ''
            }
            currentScheduleId = null

            apiFetch("{{ url('/api/doctor-schedules') }}?doctor_id=" + encodeURIComponent(doctorId), {
                method: 'GET'
            })
                .then(function (response) {
                    return response.json().then(function (data) {
                        return { ok: response.ok, data: data }
                    })
                })
                .then(function (result) {
                    if (!result.ok) {
                        scheduleList.textContent = 'Failed to load schedules.'
                        return
                    }
                    var payload = result.data
                    loadedSchedules = Array.isArray(payload.data) ? payload.data : payload
                    if (!loadedSchedules.length) {
                        scheduleList.textContent = 'No schedules defined yet for this doctor.'
                        if (scheduleGrid) {
                            scheduleGrid.innerHTML = ''
                        }
                        return
                    }

                    var html = ''
                    loadedSchedules.forEach(function (s) {
                        var days = Array.isArray(s.days) ? s.days.map(function (d) { return d.day_of_week }).join(', ') : ''
                        html += '<div class="flex items-center justify-between rounded-lg border border-slate-200 bg-white px-3 py-2">' +
                            '<div class="text-[0.78rem] text-slate-700">' +
                            '<div><span class="font-semibold">Time:</span> ' + (s.start_time || '') + '–' + (s.end_time || '') + '</div>' +
                            '<div><span class="font-semibold">Days:</span> ' + (days || 'None') + '</div>' +
                            '<div><span class="font-semibold">Max patients:</span> ' + (s.max_patients || '—') + '</div>' +
                            '</div>' +
                            '<div class="flex items-center gap-2">' +
                                '<button type="button" class="text-[0.72rem] text-cyan-700 hover:text-cyan-800 font-semibold admin-schedule-edit" data-schedule-id="' + s.schedule_id + '">Edit</button>' +
                                '<button type="button" class="text-[0.72rem] text-rose-600 hover:text-rose-700 font-semibold admin-schedule-delete" data-schedule-id="' + s.schedule_id + '">Delete</button>' +
                            '</div>' +
                            '</div>'
                    })
                    scheduleList.innerHTML = html

                    renderScheduleGrid(loadedSchedules)

                    var editButtons = scheduleList.querySelectorAll('.admin-schedule-edit')
                    editButtons.forEach(function (button) {
                        button.addEventListener('click', function () {
                            var scheduleId = this.getAttribute('data-schedule-id')
                            var schedule = loadedSchedules.find(function (s) { return String(s.schedule_id) === String(scheduleId) })
                            if (!schedule) return
                            currentScheduleId = schedule.schedule_id
                            if (scheduleStart) scheduleStart.value = (schedule.start_time || '').slice(0, 5)
                            if (scheduleEnd) scheduleEnd.value = (schedule.end_time || '').slice(0, 5)
                            if (scheduleMax) scheduleMax.value = schedule.max_patients || ''
                            var inputs = scheduleForm ? scheduleForm.querySelectorAll('input[type="checkbox"][value]') : []
                            inputs.forEach(function (input) {
                                input.checked = false
                            })
                            var days = Array.isArray(schedule.days) ? schedule.days : []
                            days.forEach(function (d) {
                                var val = d.day_of_week
                                var input = scheduleForm ? scheduleForm.querySelector('input[type="checkbox"][value="' + val + '"]') : null
                                if (input) input.checked = true
                            })
                        })
                    })

                    var deleteButtons = scheduleList.querySelectorAll('.admin-schedule-delete')
                    deleteButtons.forEach(function (button) {
                        button.addEventListener('click', function () {
                            var scheduleId = this.getAttribute('data-schedule-id')
                            if (!scheduleId) return
                            if (!window.confirm('Delete this schedule?')) return

                            apiFetch("{{ url('/api/doctor-schedules') }}/" + scheduleId, {
                                method: 'DELETE'
                            })
                                .then(function (response) {
                                    return response.json().then(function (data) {
                                        return { ok: response.ok, data: data }
                                    })
                                })
                                .then(function (result) {
                                    if (!result.ok) {
                                        showDoctorError('Failed to delete schedule.')
                                        return
                                    }
                                    loadSchedulesForDoctor(doctorId)
                                })
                                .catch(function () {
                                    showDoctorError('Network error while deleting schedule.')
                                })
                        })
                    })
                })
                .catch(function () {
                    scheduleList.textContent = 'Network error while loading schedules.'
                })
        }

        if (searchInput) {
            searchInput.addEventListener('input', function () {
                renderDoctors()
            })
        }
        if (sortSelect) {
            sortSelect.addEventListener('change', function () {
                renderDoctors()
            })
        }

        if (scheduleClose && schedulePanel) {
            scheduleClose.addEventListener('click', function () {
                schedulePanel.classList.add('hidden')
                currentDoctorIdForSchedule = null
                currentScheduleId = null
                if (scheduleStart) scheduleStart.value = ''
                if (scheduleEnd) scheduleEnd.value = ''
                if (scheduleMax) scheduleMax.value = ''
                if (scheduleForm) {
                    var inputs = scheduleForm.querySelectorAll('input[type="checkbox"][value]')
                    inputs.forEach(function (input) {
                        input.checked = false
                    })
                }
            })
        }

        if (scheduleForm) {
            scheduleForm.addEventListener('submit', function (e) {
                e.preventDefault()
                if (!currentDoctorIdForSchedule) {
                    showDoctorError('Select a doctor to manage schedules.')
                    return
                }
                var start = scheduleStart ? scheduleStart.value : ''
                var end = scheduleEnd ? scheduleEnd.value : ''
                var maxPatients = scheduleMax ? scheduleMax.value : ''

                var dayInputs = scheduleForm.querySelectorAll('input[type="checkbox"][value]')
                var days = []
                dayInputs.forEach(function (input) {
                    if (input.checked) {
                        days.push(String(input.value))
                    }
                })

                if (!start || !end || !days.length) {
                    showDoctorError('Start time, end time, and at least one day are required.')
                    return
                }

                var body = {
                    start_time: start,
                    end_time: end,
                    days: days
                }
                if (maxPatients) {
                    body.max_patients = parseInt(maxPatients, 10)
                }

                var url = "{{ url('/api/doctor-schedules') }}"
                var method = 'POST'
                if (currentScheduleId) {
                    url = url + '/' + currentScheduleId
                    method = 'PUT'
                } else {
                    body.doctor_id = currentDoctorIdForSchedule
                }

                apiFetch(url, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(body)
                })
                    .then(function (response) {
                        return response.json().then(function (data) {
                            return { ok: response.ok, data: data }
                        })
                    })
                    .then(function (result) {
                        if (!result.ok) {
                            showDoctorError('Failed to save schedule.')
                            return
                        }
                        if (scheduleStart) scheduleStart.value = ''
                        if (scheduleEnd) scheduleEnd.value = ''
                        if (scheduleMax) scheduleMax.value = ''
                        currentScheduleId = null
                        var inputs = scheduleForm.querySelectorAll('input[type="checkbox"][value]')
                        inputs.forEach(function (input) {
                            input.checked = false
                        })
                        loadSchedulesForDoctor(currentDoctorIdForSchedule)
                    })
                    .catch(function () {
                        showDoctorError('Network error while saving schedule.')
                    })
            })
        }

        function renderScheduleGrid(schedules) {
            if (!scheduleGrid) return
            var dayOrder = [
                { key: 'mon', label: 'Mon' },
                { key: 'tue', label: 'Tue' },
                { key: 'wed', label: 'Wed' },
                { key: 'thu', label: 'Thu' },
                { key: 'fri', label: 'Fri' },
                { key: 'sat', label: 'Sat' },
                { key: 'sun', label: 'Sun' }
            ]

            var slotsByDay = {}
            dayOrder.forEach(function (d) { slotsByDay[d.key] = [] })

            (schedules || []).forEach(function (s) {
                var days = Array.isArray(s.days) ? s.days : []
                days.forEach(function (d) {
                    var key = d && d.day_of_week ? String(d.day_of_week).toLowerCase() : null
                    if (!key || !slotsByDay[key]) return
                    slotsByDay[key].push({
                        start: (s.start_time || '').slice(0, 5),
                        end: (s.end_time || '').slice(0, 5),
                        max: s.max_patients || null
                    })
                })
            })

            dayOrder.forEach(function (d) {
                slotsByDay[d.key].sort(function (a, b) {
                    if (a.start < b.start) return -1
                    if (a.start > b.start) return 1
                    return 0
                })
            })

            scheduleGrid.innerHTML = ''
            dayOrder.forEach(function (d) {
                var col = document.createElement('div')
                col.className = 'rounded-xl border border-slate-200 bg-white p-2'
                var header = '<div class="text-[0.68rem] font-semibold uppercase tracking-widest text-slate-400 mb-2">' + d.label + '</div>'
                var items = slotsByDay[d.key].map(function (s) {
                    return '<div class="rounded-lg bg-slate-50 px-2 py-1 border border-slate-200/70 mb-1">' +
                        '<div class="text-[0.74rem] font-semibold text-slate-700">' + s.start + '–' + s.end + '</div>' +
                        '<div class="text-[0.68rem] text-slate-500">Max: ' + (s.max ? s.max : '—') + '</div>' +
                        '</div>'
                }).join('')
                if (!items) {
                    items = '<div class="text-[0.72rem] text-slate-400">—</div>'
                }
                col.innerHTML = header + items
                scheduleGrid.appendChild(col)
            })
        }

        loadDoctors()
    })
</script>
