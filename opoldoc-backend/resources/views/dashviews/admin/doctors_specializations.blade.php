<div class="bg-white border border-slate-200 rounded-[18px] p-5 shadow-[0_2px_10px_rgba(15,23,42,0.04)]">
    <div class="flex items-center justify-between mb-3">
        <h2 class="text-sm font-semibold text-slate-900">Doctor Management</h2>
        <span class="text-[0.7rem] text-slate-400 uppercase tracking-widest">Doctors</span>
    </div>
    <p class="text-xs text-slate-500 mb-4">
        Add doctors, edit their information, and manage schedules (time slots and assigned days).
    </p>

    <div id="adminDoctorError" class="hidden mb-3 rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-[0.75rem] text-red-700"></div>

    <form id="adminAddDoctorForm" class="mb-4 grid gap-2 grid-cols-1 md:grid-cols-4 items-end">
        <div>
            <label for="admin_doctor_email" class="block text-[0.7rem] text-slate-600 mb-1">Doctor email</label>
            <input id="admin_doctor_email" type="email" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" required>
        </div>
        <div>
            <label for="admin_doctor_firstname" class="block text-[0.7rem] text-slate-600 mb-1">First name (optional)</label>
            <input id="admin_doctor_firstname" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
        </div>
        <div>
            <label for="admin_doctor_lastname" class="block text-[0.7rem] text-slate-600 mb-1">Last name (optional)</label>
            <input id="admin_doctor_lastname" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
        </div>
        <div class="flex items-center gap-2">
            <button type="submit" class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-cyan-600 text-white text-[0.78rem] font-semibold hover:bg-cyan-700 transition-colors">
                Add Doctor
            </button>
        </div>
    </form>

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
                    <th class="py-2 pr-4 font-semibold">ID</th>
                    <th class="py-2 pr-4 font-semibold">Doctor</th>
                    <th class="py-2 pr-4 font-semibold">Email</th>
                    <th class="py-2 pr-4 font-semibold">Status</th>
                    <th class="py-2 pr-4 font-semibold">Schedules</th>
                    <th class="py-2 pr-4 font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody id="admin_doctor_table_body">
                <tr>
                    <td colspan="6" class="py-4 text-center text-[0.78rem] text-slate-400">
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
                        <input type="checkbox" value="1" class="rounded border-slate-300 text-cyan-600 focus:ring-cyan-500"> Mon
                    </label>
                    <label class="inline-flex items-center gap-1">
                        <input type="checkbox" value="2" class="rounded border-slate-300 text-cyan-600 focus:ring-cyan-500"> Tue
                    </label>
                    <label class="inline-flex items-center gap-1">
                        <input type="checkbox" value="3" class="rounded border-slate-300 text-cyan-600 focus:ring-cyan-500"> Wed
                    </label>
                    <label class="inline-flex items-center gap-1">
                        <input type="checkbox" value="4" class="rounded border-slate-300 text-cyan-600 focus:ring-cyan-500"> Thu
                    </label>
                    <label class="inline-flex items-center gap-1">
                        <input type="checkbox" value="5" class="rounded border-slate-300 text-cyan-600 focus:ring-cyan-500"> Fri
                    </label>
                    <label class="inline-flex items-center gap-1">
                        <input type="checkbox" value="6" class="rounded border-slate-300 text-cyan-600 focus:ring-cyan-500"> Sat
                    </label>
                    <label class="inline-flex items-center gap-1">
                        <input type="checkbox" value="0" class="rounded border-slate-300 text-cyan-600 focus:ring-cyan-500"> Sun
                    </label>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 rounded-xl bg-cyan-600 text-white text-[0.78rem] font-semibold hover:bg-cyan-700 transition-colors w-full">
                    Add time slot
                </button>
            </div>
        </form>

        <div class="text-[0.78rem] text-slate-700">
            <h4 class="text-xs font-semibold text-slate-900 mb-2">Existing schedules</h4>
            <div id="adminDoctorScheduleList" class="space-y-2 text-[0.78rem] text-slate-700">
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var errorBox = document.getElementById('adminDoctorError')
        var addForm = document.getElementById('adminAddDoctorForm')
        var emailInput = document.getElementById('admin_doctor_email')
        var firstnameInput = document.getElementById('admin_doctor_firstname')
        var lastnameInput = document.getElementById('admin_doctor_lastname')
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

        var currentDoctorIdForSchedule = null
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
            tableBody.innerHTML = '<tr><td colspan="6" class="py-4 text-center text-[0.78rem] text-slate-400">Loading doctors…</td></tr>'

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
                tableBody.innerHTML = '<tr><td colspan="6" class="py-4 text-center text-[0.78rem] text-slate-400">No doctors found.</td></tr>'
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
                var status = (doctor.status || 'active').toLowerCase()

                var statusClass = 'bg-emerald-50 text-emerald-700 border-emerald-100'
                if (status === 'inactive') {
                    statusClass = 'bg-slate-50 text-slate-600 border-slate-100'
                } else if (status === 'suspended') {
                    statusClass = 'bg-amber-50 text-amber-700 border-amber-100'
                }

                tr.innerHTML =
                    '<td class="py-2 pr-4 text-[0.78rem] text-slate-500">#' + doctor.user_id + '</td>' +
                    '<td class="py-2 pr-4 text-[0.78rem] text-slate-700">' + fullName + '</td>' +
                    '<td class="py-2 pr-4 text-[0.78rem] text-slate-700">' + (doctor.email || '') + '</td>' +
                    '<td class="py-2 pr-4 text-[0.78rem]">' +
                        '<span class="inline-flex items-center rounded-full px-2 py-0.5 text-[0.68rem] font-medium border ' + statusClass + '">' +
                            (status.charAt(0).toUpperCase() + status.slice(1)) +
                        '</span>' +
                    '</td>' +
                    '<td class="py-2 pr-4 text-[0.78rem] text-slate-500">View schedules</td>' +
                    '<td class="py-2 pr-4 text-[0.78rem]">' +
                        '<div class="flex items-center gap-2">' +
                            '<button type="button" class="text-[0.72rem] text-cyan-700 hover:text-cyan-800 font-semibold admin-doctor-edit" data-doctor-id="' + doctor.user_id + '">Edit info</button>' +
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

                    apiFetch("{{ url('/api/doctors') }}/" + id, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            firstname: newFirstname,
                            lastname: newLastname
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
                    var schedules = Array.isArray(payload.data) ? payload.data : payload
                    if (!schedules.length) {
                        scheduleList.textContent = 'No schedules defined yet for this doctor.'
                        return
                    }

                    var html = ''
                    schedules.forEach(function (s) {
                        var days = Array.isArray(s.days) ? s.days.map(function (d) { return d.day_of_week }).join(', ') : ''
                        html += '<div class="flex items-center justify-between rounded-lg border border-slate-200 bg-white px-3 py-2">' +
                            '<div class="text-[0.78rem] text-slate-700">' +
                            '<div><span class="font-semibold">Time:</span> ' + (s.start_time || '') + '–' + (s.end_time || '') + '</div>' +
                            '<div><span class="font-semibold">Days:</span> ' + (days || 'None') + '</div>' +
                            '<div><span class="font-semibold">Max patients:</span> ' + (s.max_patients || '—') + '</div>' +
                            '</div>' +
                            '<button type="button" class="text-[0.72rem] text-rose-600 hover:text-rose-700 font-semibold admin-schedule-delete" data-schedule-id="' + s.schedule_id + '">Delete</button>' +
                            '</div>'
                    })
                    scheduleList.innerHTML = html

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

        if (addForm) {
            addForm.addEventListener('submit', function (e) {
                e.preventDefault()
                showDoctorError('')

                var email = emailInput ? emailInput.value.trim() : ''
                var firstname = firstnameInput ? firstnameInput.value.trim() : ''
                var lastname = lastnameInput ? lastnameInput.value.trim() : ''

                if (!email) {
                    showDoctorError('Doctor email is required.')
                    return
                }

                var body = {
                    email: email,
                    role: 'doctor'
                }
                if (firstname) body.firstname = firstname
                if (lastname) body.lastname = lastname

                apiFetch("{{ url('/api/users/invite') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(body)
                })
                    .then(function (response) {
                        return response.json().then(function (data) {
                            return { ok: response.ok, status: response.status, data: data }
                        })
                    })
                    .then(function (result) {
                        if (!result.ok) {
                            var message = result.data && result.data.message ? result.data.message : 'Failed to add doctor.'
                            showDoctorError(message)
                            return
                        }
                        if (emailInput) emailInput.value = ''
                        if (firstnameInput) firstnameInput.value = ''
                        if (lastnameInput) lastnameInput.value = ''
                        loadDoctors()
                    })
                    .catch(function () {
                        showDoctorError('Network error while adding doctor.')
                    })
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
                        days.push(parseInt(input.value, 10))
                    }
                })

                if (!start || !end || !days.length) {
                    showDoctorError('Start time, end time, and at least one day are required.')
                    return
                }

                var body = {
                    doctor_id: currentDoctorIdForSchedule,
                    start_time: start,
                    end_time: end,
                    days: days
                }
                if (maxPatients) {
                    body.max_patients = parseInt(maxPatients, 10)
                }

                apiFetch("{{ url('/api/doctor-schedules') }}", {
                    method: 'POST',
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
                            showDoctorError('Failed to add schedule.')
                            return
                        }
                        if (scheduleStart) scheduleStart.value = ''
                        if (scheduleEnd) scheduleEnd.value = ''
                        if (scheduleMax) scheduleMax.value = ''
                        var inputs = scheduleForm.querySelectorAll('input[type="checkbox"][value]')
                        inputs.forEach(function (input) {
                            input.checked = false
                        })
                        loadSchedulesForDoctor(currentDoctorIdForSchedule)
                    })
                    .catch(function () {
                        showDoctorError('Network error while adding schedule.')
                    })
            })
        }

        loadDoctors()
    })
</script>
