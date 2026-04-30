<div class="bg-white border border-slate-200 rounded-[18px] p-5 shadow-[0_2px_10px_rgba(15,23,42,0.04)]">
    <div class="flex items-center justify-between mb-3">
        <h2 class="text-sm font-semibold text-slate-900">Doctor Management</h2>
        <span class="text-[0.7rem] text-slate-400 uppercase tracking-widest">Doctors</span>
    </div>
    <p class="text-xs text-slate-500 mb-4">
        Manage doctor profiles and schedules. Doctor accounts are created in the Users module by assigning the Doctor role.
    </p>

    <div id="adminDoctorError" class="hidden mb-3 rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-[0.75rem] text-red-700"></div>
    <div id="adminDoctorSuccess" class="hidden mb-3 rounded-lg border border-emerald-200 bg-emerald-50 px-3 py-2 text-[0.75rem] text-emerald-700"></div>

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
                <label class="block text-[0.7rem] text-slate-600 mb-1">Start time</label>
                <div class="grid grid-cols-3 gap-1">
                    <select id="admin_schedule_start_hour" class="w-full rounded-lg border border-slate-200 bg-white px-2 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                        <option value="">HH</option>
                        @for ($h = 1; $h <= 12; $h++)
                            <option value="{{ $h }}">{{ $h }}</option>
                        @endfor
                    </select>
                    <select id="admin_schedule_start_min" class="w-full rounded-lg border border-slate-200 bg-white px-2 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                        <option value="">MM</option>
                        <option value="00">00</option>
                        <option value="15">15</option>
                        <option value="30">30</option>
                        <option value="45">45</option>
                    </select>
                    <select id="admin_schedule_start_ampm" class="w-full rounded-lg border border-slate-200 bg-white px-2 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                        <option value="">AM/PM</option>
                        <option value="am">AM</option>
                        <option value="pm">PM</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-[0.7rem] text-slate-600 mb-1">End time</label>
                <div class="grid grid-cols-3 gap-1">
                    <select id="admin_schedule_end_hour" class="w-full rounded-lg border border-slate-200 bg-white px-2 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                        <option value="">HH</option>
                        @for ($h = 1; $h <= 12; $h++)
                            <option value="{{ $h }}">{{ $h }}</option>
                        @endfor
                    </select>
                    <select id="admin_schedule_end_min" class="w-full rounded-lg border border-slate-200 bg-white px-2 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                        <option value="">MM</option>
                        <option value="00">00</option>
                        <option value="15">15</option>
                        <option value="30">30</option>
                        <option value="45">45</option>
                    </select>
                    <select id="admin_schedule_end_ampm" class="w-full rounded-lg border border-slate-200 bg-white px-2 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                        <option value="">AM/PM</option>
                        <option value="am">AM</option>
                        <option value="pm">PM</option>
                    </select>
                </div>
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
                <button type="submit" id="adminDoctorScheduleSubmit" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-xl bg-cyan-600 text-white text-[0.78rem] font-semibold hover:bg-cyan-700 transition-colors w-full disabled:opacity-60 disabled:hover:bg-cyan-600">
                    <span id="adminDoctorScheduleSpinner" class="hidden w-3.5 h-3.5 border-2 border-white/40 border-t-white rounded-full animate-spin"></span>
                    <span id="adminDoctorScheduleSubmitLabel">Add schedule</span>
                </button>
            </div>
        </form>

        <div id="adminConfirmOverlay" class="hidden fixed inset-0 z-50 bg-slate-900/40 items-center justify-center p-4">
            <div class="w-full max-w-sm rounded-2xl bg-white border border-slate-200 shadow-[0_12px_30px_rgba(15,23,42,0.24)] p-4">
                <div class="flex items-start gap-3">
                    <div class="w-9 h-9 rounded-xl bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-700">
                        <span class="material-symbols-outlined text-[18px] leading-none">help</span>
                    </div>
                    <div class="flex-1">
                        <div class="text-sm font-semibold text-slate-900">Confirm</div>
                        <div id="adminConfirmMessage" class="text-[0.78rem] text-slate-600 mt-0.5">Are you sure?</div>
                    </div>
                </div>
                <div class="mt-4 flex items-center justify-end gap-2">
                    <button type="button" id="adminConfirmCancel" class="px-3 py-2 rounded-xl border border-slate-200 bg-white text-[0.78rem] font-semibold text-slate-700 hover:bg-slate-50">Cancel</button>
                    <button type="button" id="adminConfirmOk" class="px-3 py-2 rounded-xl bg-slate-900 text-white text-[0.78rem] font-semibold hover:bg-slate-800">Confirm</button>
                </div>
            </div>
        </div>

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
        var successBox = document.getElementById('adminDoctorSuccess')
        var searchInput = document.getElementById('admin_doctor_search')
        var sortSelect = document.getElementById('admin_doctor_sort')
        var tableBody = document.getElementById('admin_doctor_table_body')

        var schedulePanel = document.getElementById('adminDoctorSchedulePanel')
        var scheduleTitle = document.getElementById('adminDoctorScheduleTitle')
        var scheduleClose = document.getElementById('adminDoctorScheduleClose')
        var scheduleForm = document.getElementById('adminDoctorScheduleForm')
        var scheduleStartHour = document.getElementById('admin_schedule_start_hour')
        var scheduleStartMin = document.getElementById('admin_schedule_start_min')
        var scheduleStartAmPm = document.getElementById('admin_schedule_start_ampm')
        var scheduleEndHour = document.getElementById('admin_schedule_end_hour')
        var scheduleEndMin = document.getElementById('admin_schedule_end_min')
        var scheduleEndAmPm = document.getElementById('admin_schedule_end_ampm')
        var scheduleMax = document.getElementById('admin_schedule_max')
        var scheduleList = document.getElementById('adminDoctorScheduleList')
        var scheduleGrid = document.getElementById('adminDoctorScheduleGrid')
        var scheduleSubmit = document.getElementById('adminDoctorScheduleSubmit')
        var scheduleSpinner = document.getElementById('adminDoctorScheduleSpinner')
        var scheduleSubmitLabel = document.getElementById('adminDoctorScheduleSubmitLabel')

        var confirmOverlay = document.getElementById('adminConfirmOverlay')
        var confirmMessage = document.getElementById('adminConfirmMessage')
        var confirmOk = document.getElementById('adminConfirmOk')
        var confirmCancel = document.getElementById('adminConfirmCancel')
        var confirmResolver = null

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

        function showDoctorSuccess(message) {
            if (!successBox) return
            successBox.textContent = message || ''
            if (message) {
                successBox.classList.remove('hidden')
            } else {
                successBox.classList.add('hidden')
            }
        }

        function setScheduleSubmitting(isSubmitting) {
            if (scheduleSubmit) scheduleSubmit.disabled = !!isSubmitting
            if (scheduleSpinner) scheduleSpinner.classList.toggle('hidden', !isSubmitting)
            if (scheduleSubmitLabel) scheduleSubmitLabel.textContent = currentScheduleId ? (isSubmitting ? 'Saving...' : 'Save changes') : (isSubmitting ? 'Saving...' : 'Add schedule')
        }

        function confirmAction(message) {
            return new Promise(function (resolve) {
                if (!confirmOverlay || !confirmMessage || !confirmOk || !confirmCancel) {
                    resolve(window.confirm(message || 'Are you sure?'))
                    return
                }
                confirmMessage.textContent = message || 'Are you sure?'
                confirmResolver = resolve
                confirmOverlay.classList.remove('hidden')
                confirmOverlay.classList.add('flex')
            })
        }

        function closeConfirm(result) {
            if (confirmOverlay) {
                confirmOverlay.classList.add('hidden')
                confirmOverlay.classList.remove('flex')
            }
            var resolver = confirmResolver
            confirmResolver = null
            if (typeof resolver === 'function') {
                resolver(!!result)
            }
        }

        if (confirmOk) {
            confirmOk.addEventListener('click', function () { closeConfirm(true) })
        }
        if (confirmCancel) {
            confirmCancel.addEventListener('click', function () { closeConfirm(false) })
        }
        if (confirmOverlay) {
            confirmOverlay.addEventListener('click', function (e) {
                if (e.target === confirmOverlay) closeConfirm(false)
            })
        }

        function pad2(n) {
            return String(n).padStart(2, '0')
        }

        function to24Hour(hour12, minute, ampm) {
            var h = parseInt(hour12, 10)
            if (isNaN(h) || h < 1 || h > 12) return ''
            var m = String(minute || '')
            if (!/^\d{2}$/.test(m)) return ''
            var ap = String(ampm || '').toLowerCase()
            if (ap !== 'am' && ap !== 'pm') return ''
            var base = h % 12
            if (ap === 'pm') base += 12
            return pad2(base) + ':' + m
        }

        function minutesFromHHMM(hhmm) {
            var t = String(hhmm || '').slice(0, 5)
            if (!/^\d{2}:\d{2}$/.test(t)) return NaN
            var parts = t.split(':')
            return (parseInt(parts[0], 10) * 60) + parseInt(parts[1], 10)
        }

        function set12HourSelects(prefix, hhmm) {
            var t = String(hhmm || '').slice(0, 5)
            if (!/^\d{2}:\d{2}$/.test(t)) return
            var parts = t.split(':')
            var h24 = parseInt(parts[0], 10)
            var m = parts[1]
            var ap = h24 >= 12 ? 'pm' : 'am'
            var h12 = h24 % 12
            if (h12 === 0) h12 = 12
            var hEl = document.getElementById('admin_schedule_' + prefix + '_hour')
            var mEl = document.getElementById('admin_schedule_' + prefix + '_min')
            var apEl = document.getElementById('admin_schedule_' + prefix + '_ampm')
            if (hEl) hEl.value = String(h12)
            if (mEl) mEl.value = m
            if (apEl) apEl.value = ap
        }

        function formatTimeLabel(hhmm) {
            var t = String(hhmm || '').slice(0, 5)
            if (!/^\d{2}:\d{2}$/.test(t)) return ''
            var parts = t.split(':')
            var h24 = parseInt(parts[0], 10)
            var m = parts[1]
            var ap = h24 >= 12 ? 'PM' : 'AM'
            var h12 = h24 % 12
            if (h12 === 0) h12 = 12
            return h12 + ':' + m + ' ' + ap
        }

        function readResponse(response) {
            return response.text().then(function (text) {
                var data = null
                try {
                    data = text ? JSON.parse(text) : null
                } catch (e) {
                    data = null
                }
                return { ok: response.ok, status: response.status, data: data, raw: text }
            })
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
                    if (scheduleStartHour) scheduleStartHour.value = ''
                    if (scheduleStartMin) scheduleStartMin.value = ''
                    if (scheduleStartAmPm) scheduleStartAmPm.value = ''
                    if (scheduleEndHour) scheduleEndHour.value = ''
                    if (scheduleEndMin) scheduleEndMin.value = ''
                    if (scheduleEndAmPm) scheduleEndAmPm.value = ''
                    if (scheduleMax) scheduleMax.value = ''
                    if (scheduleForm) {
                        var inputs = scheduleForm.querySelectorAll('input[type="checkbox"][value]')
                        inputs.forEach(function (input) {
                            input.checked = false
                        })
                    }
                    showDoctorError('')
                    showDoctorSuccess('')
                    setScheduleSubmitting(false)
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
                        var startLabel = formatTimeLabel(s.start_time || '')
                        var endLabel = formatTimeLabel(s.end_time || '')
                        html += '<div class="flex items-center justify-between rounded-lg border border-slate-200 bg-white px-3 py-2">' +
                            '<div class="text-[0.78rem] text-slate-700">' +
                            '<div><span class="font-semibold">Time:</span> ' + (startLabel || (s.start_time || '')) + '–' + (endLabel || (s.end_time || '')) + '</div>' +
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
                            set12HourSelects('start', schedule.start_time || '')
                            set12HourSelects('end', schedule.end_time || '')
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
                            showDoctorError('')
                            showDoctorSuccess('')

                            confirmAction('Delete this schedule?')
                                .then(function (confirmed) {
                                    if (!confirmed) return
                                    apiFetch("{{ url('/api/doctor-schedules') }}/" + scheduleId, {
                                        method: 'DELETE'
                                    })
                                        .then(function (response) {
                                            return readResponse(response)
                                        })
                                        .then(function (result) {
                                            if (!result.ok) {
                                                var msg = (result.data && result.data.message) ? result.data.message : 'Failed to delete schedule.'
                                                if (!result.data && result.raw) {
                                                    msg = 'Failed to delete schedule.'
                                                }
                                                showDoctorError(msg)
                                                return
                                            }
                                            showDoctorSuccess('Schedule deleted.')
                                            loadSchedulesForDoctor(doctorId)
                                        })
                                        .catch(function () {
                                            showDoctorError('Network error while deleting schedule.')
                                        })
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
                if (scheduleStartHour) scheduleStartHour.value = ''
                if (scheduleStartMin) scheduleStartMin.value = ''
                if (scheduleStartAmPm) scheduleStartAmPm.value = ''
                if (scheduleEndHour) scheduleEndHour.value = ''
                if (scheduleEndMin) scheduleEndMin.value = ''
                if (scheduleEndAmPm) scheduleEndAmPm.value = ''
                if (scheduleMax) scheduleMax.value = ''
                if (scheduleForm) {
                    var inputs = scheduleForm.querySelectorAll('input[type="checkbox"][value]')
                    inputs.forEach(function (input) {
                        input.checked = false
                    })
                }
                showDoctorError('')
                showDoctorSuccess('')
            })
        }

        if (scheduleForm) {
            scheduleForm.addEventListener('submit', function (e) {
                e.preventDefault()
                if (!currentDoctorIdForSchedule) {
                    showDoctorError('Select a doctor to manage schedules.')
                    return
                }
                showDoctorError('')
                showDoctorSuccess('')

                var start = to24Hour(
                    scheduleStartHour ? scheduleStartHour.value : '',
                    scheduleStartMin ? scheduleStartMin.value : '',
                    scheduleStartAmPm ? scheduleStartAmPm.value : ''
                )
                var end = to24Hour(
                    scheduleEndHour ? scheduleEndHour.value : '',
                    scheduleEndMin ? scheduleEndMin.value : '',
                    scheduleEndAmPm ? scheduleEndAmPm.value : ''
                )
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

                var startMinutes = minutesFromHHMM(start)
                var endMinutes = minutesFromHHMM(end)
                if (isNaN(startMinutes) || isNaN(endMinutes) || endMinutes <= startMinutes) {
                    showDoctorError('End time must be after start time.')
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

                setScheduleSubmitting(true)
                apiFetch(url, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(body)
                })
                    .then(function (response) {
                        return readResponse(response)
                    })
                    .then(function (result) {
                        if (!result.ok) {
                            var message = 'Failed to save schedule.'
                            if (result.data && result.data.message) {
                                message = result.data.message
                            } else if (result.data && result.data.errors) {
                                var all = []
                                Object.keys(result.data.errors).forEach(function (key) {
                                    var v = result.data.errors[key]
                                    if (Array.isArray(v)) {
                                        v.forEach(function (x) { all.push(String(x)) })
                                    } else if (v != null) {
                                        all.push(String(v))
                                    }
                                })
                                if (all.length) {
                                    message = all.join(' ')
                                }
                            } else if (!result.data && result.raw) {
                                message = 'Failed to save schedule.'
                            } else if (result.status === 401) {
                                message = 'Session expired. Please log in again.'
                            } else if (result.status === 403) {
                                message = 'You do not have permission to manage schedules.'
                            }
                            showDoctorError(message)
                            return
                        }
                        showDoctorSuccess(currentScheduleId ? 'Schedule updated.' : 'Schedule created.')
                        if (scheduleStartHour) scheduleStartHour.value = ''
                        if (scheduleStartMin) scheduleStartMin.value = ''
                        if (scheduleStartAmPm) scheduleStartAmPm.value = ''
                        if (scheduleEndHour) scheduleEndHour.value = ''
                        if (scheduleEndMin) scheduleEndMin.value = ''
                        if (scheduleEndAmPm) scheduleEndAmPm.value = ''
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
                    .finally(function () {
                        setScheduleSubmitting(false)
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
