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
                    <th class="py-2 pr-4 font-semibold">License #</th>
                    <th class="py-2 pr-4 font-semibold">Contact</th>
                    <th class="py-2 pr-4 font-semibold">Schedule summary</th>
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

        <form id="adminDoctorScheduleForm" class="mb-3 grid gap-2 grid-cols-1 md:grid-cols-7 items-end">
            <div>
                <label for="admin_schedule_from_day" class="block text-[0.7rem] text-slate-600 mb-1">From day</label>
                <select id="admin_schedule_from_day" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                    <option value="">Select</option>
                    <option value="mon">Mon</option>
                    <option value="tue">Tue</option>
                    <option value="wed">Wed</option>
                    <option value="thu">Thu</option>
                    <option value="fri">Fri</option>
                    <option value="sat">Sat</option>
                    <option value="sun">Sun</option>
                </select>
            </div>
            <div>
                <label for="admin_schedule_to_day" class="block text-[0.7rem] text-slate-600 mb-1">To day</label>
                <select id="admin_schedule_to_day" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                    <option value="">Select</option>
                    <option value="mon">Mon</option>
                    <option value="tue">Tue</option>
                    <option value="wed">Wed</option>
                    <option value="thu">Thu</option>
                    <option value="fri">Fri</option>
                    <option value="sat">Sat</option>
                    <option value="sun">Sun</option>
                </select>
            </div>
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
                <label for="admin_schedule_room" class="block text-[0.7rem] text-slate-600 mb-1">Room # (optional)</label>
                <input id="admin_schedule_room" type="number" min="1" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="e.g. 101">
            </div>
            <input type="hidden" id="admin_schedule_slot_minutes" value="60">
            <div class="flex items-center gap-2">
                <button type="submit" id="adminDoctorScheduleSubmit" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-xl bg-cyan-600 text-white text-[0.78rem] font-semibold hover:bg-cyan-700 transition-colors w-full disabled:opacity-60 disabled:hover:bg-cyan-600">
                    <span id="adminDoctorScheduleSpinner" class="hidden w-3.5 h-3.5 border-2 border-white/40 border-t-white rounded-full animate-spin"></span>
                    <span id="adminDoctorScheduleSubmitLabel">Generate schedule</span>
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
                    <button type="button" id="adminConfirmOk" class="inline-flex items-center justify-center gap-2 px-3 py-2 rounded-xl bg-slate-900 text-white text-[0.78rem] font-semibold hover:bg-slate-800">
                        <span id="adminConfirmOkSpinner" class="hidden w-3.5 h-3.5 border-2 border-white/40 border-t-white rounded-full animate-spin"></span>
                        <span id="adminConfirmOkLabel">Confirm</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="text-[0.78rem] text-slate-700">
            <h4 class="text-xs font-semibold text-slate-900 mb-2">Existing schedules</h4>
            <div class="mb-2 flex flex-col gap-2 md:flex-row md:items-end md:justify-between">
                <div class="flex items-center gap-2">
                    <button type="button" id="adminScheduleSelectAll" class="px-3 py-2 rounded-xl border border-slate-200 bg-white text-[0.72rem] font-semibold text-slate-700 hover:bg-slate-50">Select all</button>
                    <button type="button" id="adminScheduleClearAll" class="px-3 py-2 rounded-xl border border-slate-200 bg-white text-[0.72rem] font-semibold text-slate-700 hover:bg-slate-50">Clear</button>
                </div>
                <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-end">
                    <div class="w-full sm:w-40">
                        <label for="adminScheduleBulkDay" class="block text-[0.7rem] text-slate-600 mb-1">Day</label>
                        <select id="adminScheduleBulkDay" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                            <option value="">Select day</option>
                            <option value="mon">Mon</option>
                            <option value="tue">Tue</option>
                            <option value="wed">Wed</option>
                            <option value="thu">Thu</option>
                            <option value="fri">Fri</option>
                            <option value="sat">Sat</option>
                            <option value="sun">Sun</option>
                        </select>
                    </div>
                    <div class="flex items-center gap-2">
                         <button type="button" id="adminScheduleDeleteDay" class="px-3 py-2 rounded-xl bg-rose-600 text-white text-[0.72rem] font-semibold hover:bg-rose-700">Delete day</button>
                      
                        <button type="button" id="adminScheduleDeleteSelected" class="px-3 py-2 rounded-xl bg-rose-600 text-white text-[0.72rem] font-semibold hover:bg-rose-700">Delete selected</button>
                       
                    </div>
                </div>
            </div>
            <div id="adminDoctorScheduleList" class="space-y-2 text-[0.78rem] text-slate-700">
            </div>
            <div class="mt-4">
                <h4 class="text-xs font-semibold text-slate-900 mb-2">Weekly grid</h4>
                <div id="adminDoctorScheduleGrid" class="grid grid-cols-7 gap-2 text-[0.72rem]"></div>
            </div>
        </div>
    </div>

    <div id="adminDoctorAvailabilityOverlay" class="hidden fixed inset-0 z-50 bg-slate-900/40 items-center justify-center p-4">
        <div class="w-full max-w-2xl rounded-2xl bg-white border border-slate-200 shadow-[0_12px_30px_rgba(15,23,42,0.24)] overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-100 flex items-start justify-between gap-3">
                <div>
                    <div class="text-sm font-semibold text-slate-900" id="adminDoctorAvailabilityTitle">Manage Availability</div>
                    <div class="text-[0.72rem] text-slate-500">Select time slots and mark them available/unavailable.</div>
                </div>
                <button type="button" id="adminDoctorAvailabilityClose" class="text-slate-400 hover:text-slate-600">
                    <span class="material-symbols-outlined text-[20px] leading-none">close</span>
                </button>
            </div>
            <div class="p-5">
                <div id="adminDoctorAvailabilityError" class="hidden mb-3 rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-[0.75rem] text-red-700"></div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-2 mb-3 items-end">
                    <div>
                        <label for="adminDoctorAvailabilityDayFilter" class="block text-[0.7rem] text-slate-600 mb-1">Filter by day</label>
                        <select id="adminDoctorAvailabilityDayFilter" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                            <option value="">All days</option>
                            <option value="mon">Mon</option>
                            <option value="tue">Tue</option>
                            <option value="wed">Wed</option>
                            <option value="thu">Thu</option>
                            <option value="fri">Fri</option>
                            <option value="sat">Sat</option>
                            <option value="sun">Sun</option>
                        </select>
                    </div>
                    <div>
                        <label for="adminDoctorAvailabilityMode" class="block text-[0.7rem] text-slate-600 mb-1">Action</label>
                        <select id="adminDoctorAvailabilityMode" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                            <option value="unavailable">Mark unavailable</option>
                            <option value="available">Mark available</option>
                        </select>
                    </div>
                    <div class="flex items-center justify-end gap-2">
                        <button type="button" id="adminDoctorAvailabilitySave" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-xl bg-cyan-600 text-white text-[0.78rem] font-semibold hover:bg-cyan-700 transition-colors w-full disabled:opacity-60 disabled:hover:bg-cyan-600">
                            <span id="adminDoctorAvailabilitySpinner" class="hidden w-3.5 h-3.5 border-2 border-white/40 border-t-white rounded-full animate-spin"></span>
                            Save
                        </button>
                    </div>
                </div>

                <div id="adminDoctorAvailabilityList" class="max-h-[55vh] overflow-y-auto scrollbar-hidden space-y-3"></div>
            </div>
        </div>
    </div>

    <div id="adminDoctorEditOverlay" class="hidden fixed inset-0 z-50 bg-slate-900/40 items-center justify-center p-4">
        <div class="w-full max-w-lg rounded-2xl bg-white border border-slate-200 shadow-[0_12px_30px_rgba(15,23,42,0.24)] overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <div class="text-sm font-semibold text-slate-900">Edit doctor</div>
                    <div id="adminDoctorEditSubtitle" class="text-[0.72rem] text-slate-500">Update profile information.</div>
                </div>
                <button type="button" id="adminDoctorEditClose" class="text-slate-400 hover:text-slate-600">
                    <span class="material-symbols-outlined text-[20px] leading-none">close</span>
                </button>
            </div>
            <div class="p-5">
                <div id="adminDoctorEditError" class="hidden mb-3 rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-[0.75rem] text-red-700"></div>
                <form id="adminDoctorEditForm" class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label for="adminDoctorEditFirstname" class="block text-[0.7rem] text-slate-600 mb-1">First name</label>
                        <input id="adminDoctorEditFirstname" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                    </div>
                    <div>
                        <label for="adminDoctorEditMiddlename" class="block text-[0.7rem] text-slate-600 mb-1">Middle name</label>
                        <input id="adminDoctorEditMiddlename" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                    </div>
                    <div>
                        <label for="adminDoctorEditLastname" class="block text-[0.7rem] text-slate-600 mb-1">Last name</label>
                        <input id="adminDoctorEditLastname" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                    </div>
                    <div>
                        <label for="adminDoctorEditSpecialization" class="block text-[0.7rem] text-slate-600 mb-1">Specialization</label>
                        <input id="adminDoctorEditSpecialization" type="text" list="adminDoctorSpecializationList" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                        <datalist id="adminDoctorSpecializationList">
                            <option value="Pediatrics"></option>
                            <option value="General Medicine"></option>
                            <option value="Surgeon"></option>
                        </datalist>
                    </div>
                    <div>
                        <label for="adminDoctorEditLicense" class="block text-[0.7rem] text-slate-600 mb-1">License number</label>
                        <input id="adminDoctorEditLicense" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                    </div>
                    <div>
                        <label for="adminDoctorEditContact" class="block text-[0.7rem] text-slate-600 mb-1">Contact number</label>
                        <input id="adminDoctorEditContact" type="tel" inputmode="tel" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="+63XXXXXXXXXX">
                    </div>
                    <div class="md:col-span-2">
                        <label for="adminDoctorEditEmail" class="block text-[0.7rem] text-slate-600 mb-1">Email</label>
                        <input id="adminDoctorEditEmail" type="email" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                    </div>
                    <div class="md:col-span-2 flex items-center justify-end gap-2 pt-1">
                        <button type="button" id="adminDoctorEditCancel" class="px-3 py-2 rounded-xl border border-slate-200 bg-white text-[0.78rem] font-semibold text-slate-700 hover:bg-slate-50">Cancel</button>
                        <button type="submit" id="adminDoctorEditSave" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-xl bg-cyan-600 text-white text-[0.78rem] font-semibold hover:bg-cyan-700 transition-colors disabled:opacity-60 disabled:hover:bg-cyan-600">
                            <span id="adminDoctorEditSpinner" class="hidden w-3.5 h-3.5 border-2 border-white/40 border-t-white rounded-full animate-spin"></span>
                            <span id="adminDoctorEditSaveLabel">Save changes</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="adminDoctorEditConfirmOverlay" class="hidden fixed inset-0 z-[60] bg-slate-900/40 items-center justify-center p-4">
        <div class="w-full max-w-sm rounded-2xl bg-white border border-slate-200 shadow-[0_12px_30px_rgba(15,23,42,0.24)] p-4">
            <div class="flex items-start gap-3">
                <div class="w-9 h-9 rounded-xl bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-700">
                    <span class="material-symbols-outlined text-[18px] leading-none">help</span>
                </div>
                <div class="flex-1">
                    <div class="text-sm font-semibold text-slate-900">Confirm</div>
                    <div id="adminDoctorEditConfirmMessage" class="text-[0.78rem] text-slate-600 mt-0.5">Are you sure?</div>
                </div>
            </div>
            <div class="mt-4 flex items-center justify-end gap-2">
                <button type="button" id="adminDoctorEditConfirmCancel" class="px-3 py-2 rounded-xl border border-slate-200 bg-white text-[0.78rem] font-semibold text-slate-700 hover:bg-slate-50">Cancel</button>
                <button type="button" id="adminDoctorEditConfirmOk" class="px-3 py-2 rounded-xl bg-slate-900 text-white text-[0.78rem] font-semibold hover:bg-slate-800">Confirm</button>
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
        var scheduleFromDay = document.getElementById('admin_schedule_from_day')
        var scheduleToDay = document.getElementById('admin_schedule_to_day')
        var scheduleStartHour = document.getElementById('admin_schedule_start_hour')
        var scheduleStartMin = document.getElementById('admin_schedule_start_min')
        var scheduleStartAmPm = document.getElementById('admin_schedule_start_ampm')
        var scheduleEndHour = document.getElementById('admin_schedule_end_hour')
        var scheduleEndMin = document.getElementById('admin_schedule_end_min')
        var scheduleEndAmPm = document.getElementById('admin_schedule_end_ampm')
        var scheduleMax = document.getElementById('admin_schedule_max')
        var scheduleRoom = document.getElementById('admin_schedule_room')
        var scheduleSlotMinutes = document.getElementById('admin_schedule_slot_minutes')
        var scheduleList = document.getElementById('adminDoctorScheduleList')
        var scheduleGrid = document.getElementById('adminDoctorScheduleGrid')
        var scheduleSubmit = document.getElementById('adminDoctorScheduleSubmit')
        var scheduleSpinner = document.getElementById('adminDoctorScheduleSpinner')
        var scheduleSubmitLabel = document.getElementById('adminDoctorScheduleSubmitLabel')
        var scheduleSelectAll = document.getElementById('adminScheduleSelectAll')
        var scheduleClearAll = document.getElementById('adminScheduleClearAll')
        var scheduleBulkDay = document.getElementById('adminScheduleBulkDay')
        var scheduleDeleteSelected = document.getElementById('adminScheduleDeleteSelected')
        var scheduleDeleteDay = document.getElementById('adminScheduleDeleteDay')
        var scheduleDeleteAll = document.getElementById('adminScheduleDeleteAll')

        var availabilityOverlay = document.getElementById('adminDoctorAvailabilityOverlay')
        var availabilityTitle = document.getElementById('adminDoctorAvailabilityTitle')
        var availabilityClose = document.getElementById('adminDoctorAvailabilityClose')
        var availabilityError = document.getElementById('adminDoctorAvailabilityError')
        var availabilityDayFilter = document.getElementById('adminDoctorAvailabilityDayFilter')
        var availabilityMode = document.getElementById('adminDoctorAvailabilityMode')
        var availabilityList = document.getElementById('adminDoctorAvailabilityList')
        var availabilitySave = document.getElementById('adminDoctorAvailabilitySave')
        var availabilitySpinner = document.getElementById('adminDoctorAvailabilitySpinner')

        var confirmOverlay = document.getElementById('adminConfirmOverlay')
        var confirmMessage = document.getElementById('adminConfirmMessage')
        var confirmOk = document.getElementById('adminConfirmOk')
        var confirmOkSpinner = document.getElementById('adminConfirmOkSpinner')
        var confirmOkLabel = document.getElementById('adminConfirmOkLabel')
        var confirmCancel = document.getElementById('adminConfirmCancel')
        var confirmResolver = null
        var confirmCountdownTimer = null
        var confirmOkOriginalText = null

        var currentDoctorIdForSchedule = null
        var currentScheduleId = null
        var loadedSchedules = []
        var currentDoctorIdForAvailability = null
        var loadedAvailabilitySchedules = []
        var doctors = []

        var doctorEditOverlay = document.getElementById('adminDoctorEditOverlay')
        var doctorEditClose = document.getElementById('adminDoctorEditClose')
        var doctorEditCancel = document.getElementById('adminDoctorEditCancel')
        var doctorEditForm = document.getElementById('adminDoctorEditForm')
        var doctorEditError = document.getElementById('adminDoctorEditError')
        var doctorEditSubtitle = document.getElementById('adminDoctorEditSubtitle')
        var doctorEditFirstname = document.getElementById('adminDoctorEditFirstname')
        var doctorEditMiddlename = document.getElementById('adminDoctorEditMiddlename')
        var doctorEditLastname = document.getElementById('adminDoctorEditLastname')
        var doctorEditSpecialization = document.getElementById('adminDoctorEditSpecialization')
        var doctorEditLicense = document.getElementById('adminDoctorEditLicense')
        var doctorEditContact = document.getElementById('adminDoctorEditContact')
        var doctorEditEmail = document.getElementById('adminDoctorEditEmail')
        var doctorEditSave = document.getElementById('adminDoctorEditSave')
        var doctorEditSpinner = document.getElementById('adminDoctorEditSpinner')

        var editingDoctorId = null

        var doctorEditConfirmOverlay = document.getElementById('adminDoctorEditConfirmOverlay')
        var doctorEditConfirmMessage = document.getElementById('adminDoctorEditConfirmMessage')
        var doctorEditConfirmOk = document.getElementById('adminDoctorEditConfirmOk')
        var doctorEditConfirmCancel = document.getElementById('adminDoctorEditConfirmCancel')
        var doctorEditConfirmResolver = null

        var apiBasePath = "{{ request()->getBasePath() }}"
        function apiUrl(path) {
            return String(apiBasePath || '') + String(path || '')
        }

        function fetchAllDoctorSchedules(doctorId, onSuccess, onFailure) {
            var perPage = 100
            var page = 1
            var all = []

            function fail(message) {
                if (typeof onFailure === 'function') onFailure(message || 'Failed to load schedules.')
            }

            function fetchPage() {
                var url = apiUrl('/api/doctor-schedules') +
                    '?doctor_id=' + encodeURIComponent(doctorId) +
                    '&per_page=' + encodeURIComponent(perPage) +
                    '&page=' + encodeURIComponent(page)

                apiFetch(url, { method: 'GET' })
                    .then(function (response) { return readResponse(response) })
                    .then(function (result) {
                        if (!result.ok || !result.data) {
                            if (result.status === 401) {
                                fail('Session expired. Please log in again.')
                                return
                            }
                            if (result.status === 403) {
                                fail('Forbidden (403). Your account does not have permission to view this doctor’s schedules. Please sign out and sign in as an admin.')
                                return
                            }
                            var msg = (result.data && result.data.message) ? String(result.data.message) : 'Failed to load schedules.'
                            if (!result.data && result.raw) {
                                msg += ' HTTP ' + String(result.status || '')
                            }
                            fail(msg)
                            return
                        }

                        var payload = result.data
                        var items = Array.isArray(payload && payload.data) ? payload.data : []
                        all = all.concat(items)

                        var lastPage = parseInt(payload && payload.last_page ? payload.last_page : 1, 10)
                        if (isNaN(lastPage) || lastPage < 1) lastPage = 1

                        if (page < lastPage) {
                            page += 1
                            fetchPage()
                            return
                        }

                        if (typeof onSuccess === 'function') {
                            try {
                                onSuccess(all)
                            } catch (e) {
                                var renderMsg = 'Failed to render schedules.'
                                if (e && e.message) renderMsg += ' ' + String(e.message)
                                fail(renderMsg)
                            }
                        }
                    })
                    .catch(function (err) {
                        var msg = 'Network error while loading schedules.'
                        if (err && err.message) msg += ' ' + String(err.message)
                        fail(msg)
                    })
            }

            fetchPage()
        }

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

        function showDoctorEditError(message) {
            if (!doctorEditError) {
                return
            }
            doctorEditError.textContent = message || ''
            doctorEditError.classList.toggle('hidden', !message)
        }

        function setDoctorEditSubmitting(isSubmitting) {
            if (doctorEditSave) doctorEditSave.disabled = !!isSubmitting
            if (doctorEditSpinner) doctorEditSpinner.classList.toggle('hidden', !isSubmitting)
        }

        function openDoctorEditModal(doctor) {
            if (!doctorEditOverlay) {
                return
            }
            editingDoctorId = doctor && doctor.user_id ? String(doctor.user_id) : null
            showDoctorEditError('')
            setDoctorEditSubmitting(false)

            var fullName = ((doctor.firstname || '') + ' ' + (doctor.lastname || '')).trim()
            if (!fullName) {
                fullName = 'Doctor #' + (doctor.user_id || '')
            }
            if (doctorEditSubtitle) {
                doctorEditSubtitle.textContent = 'Editing — ' + fullName
            }

            if (doctorEditFirstname) doctorEditFirstname.value = doctor.firstname || ''
            if (doctorEditMiddlename) doctorEditMiddlename.value = doctor.middlename || ''
            if (doctorEditLastname) doctorEditLastname.value = doctor.lastname || ''
            if (doctorEditSpecialization) doctorEditSpecialization.value = doctor.specialization || ''
            if (doctorEditLicense) doctorEditLicense.value = doctor.license_number || ''
            if (doctorEditContact) {
                var normalizedContact = normalizePhilippinesNumber(doctor.contact_number || '')
                doctorEditContact.value = normalizedContact || '+63'
            }
            if (doctorEditEmail) doctorEditEmail.value = doctor.email || ''

            doctorEditOverlay.classList.remove('hidden')
            doctorEditOverlay.classList.add('flex')
        }

        function closeDoctorEditModal() {
            if (!doctorEditOverlay) {
                return
            }
            doctorEditOverlay.classList.add('hidden')
            doctorEditOverlay.classList.remove('flex')
            editingDoctorId = null
        }

        function confirmDoctorEditAction(message) {
            return new Promise(function (resolve) {
                if (!doctorEditConfirmOverlay || !doctorEditConfirmMessage || !doctorEditConfirmOk || !doctorEditConfirmCancel) {
                    resolve(window.confirm(message || 'Are you sure?'))
                    return
                }
                doctorEditConfirmMessage.textContent = message || 'Are you sure?'
                doctorEditConfirmResolver = resolve
                doctorEditConfirmOverlay.classList.remove('hidden')
                doctorEditConfirmOverlay.classList.add('flex')
            })
        }

        function normalizePhilippinesNumber(value) {
            var raw = String(value || '').trim()
            if (!raw) {
                return ''
            }
            raw = raw.replace(/\s+/g, '').replace(/-/g, '')
            if (raw.startsWith('+63')) {
                return raw
            }
            if (raw.startsWith('63')) {
                return '+' + raw
            }
            if (raw.startsWith('0') && raw.length >= 2) {
                return '+63' + raw.slice(1)
            }
            if (/^\d+$/.test(raw)) {
                return '+63' + raw
            }
            return raw
        }

        function isValidPhilippinesNumber(value) {
            var normalized = normalizePhilippinesNumber(value)
            return /^\+63\d{10}$/.test(normalized)
        }

        function isValidName(value) {
            var v = String(value || '').trim()
            if (v === '') {
                return true
            }
            return /^[A-Za-z][A-Za-z\s.'-]*$/.test(v)
        }

        function closeDoctorEditConfirm(result) {
            if (doctorEditConfirmOverlay) {
                doctorEditConfirmOverlay.classList.add('hidden')
                doctorEditConfirmOverlay.classList.remove('flex')
            }
            var resolver = doctorEditConfirmResolver
            doctorEditConfirmResolver = null
            if (typeof resolver === 'function') {
                resolver(!!result)
            }
        }

        if (doctorEditConfirmOk) {
            doctorEditConfirmOk.addEventListener('click', function () { closeDoctorEditConfirm(true) })
        }
        if (doctorEditConfirmCancel) {
            doctorEditConfirmCancel.addEventListener('click', function () { closeDoctorEditConfirm(false) })
        }
        if (doctorEditConfirmOverlay) {
            doctorEditConfirmOverlay.addEventListener('click', function (e) {
                if (e.target === doctorEditConfirmOverlay) closeDoctorEditConfirm(false)
            })
        }

        if (doctorEditClose) {
            doctorEditClose.addEventListener('click', closeDoctorEditModal)
        }
        if (doctorEditCancel) {
            doctorEditCancel.addEventListener('click', closeDoctorEditModal)
        }
        if (doctorEditOverlay) {
            doctorEditOverlay.addEventListener('click', function (e) {
                if (e.target === doctorEditOverlay) closeDoctorEditModal()
            })
        }

        if (doctorEditForm) {
            doctorEditForm.addEventListener('submit', function (e) {
                e.preventDefault()
                if (!editingDoctorId) {
                    return
                }
                if (doctorEditSave && doctorEditSave.disabled) {
                    return
                }

                showDoctorEditError('')

                var f = doctorEditFirstname ? String(doctorEditFirstname.value || '').trim() : ''
                var m = doctorEditMiddlename ? String(doctorEditMiddlename.value || '').trim() : ''
                var l = doctorEditLastname ? String(doctorEditLastname.value || '').trim() : ''
                var c = doctorEditContact ? String(doctorEditContact.value || '').trim() : ''

                if (!isValidName(f) || !isValidName(m) || !isValidName(l)) {
                    showDoctorEditError('Name fields must contain letters only.')
                    return
                }
                if (c && c !== '+63') {
                    if (!isValidPhilippinesNumber(c)) {
                        showDoctorEditError('Contact number must be a valid PH number starting with +63 and 10 digits.')
                        return
                    }
                }

                confirmDoctorEditAction('Are you sure you want to save these changes?')
                    .then(function (confirmed) {
                        if (!confirmed) {
                            return null
                        }

                        setDoctorEditSubmitting(true)

                        var payload = {
                            firstname: f,
                            middlename: m,
                            lastname: l,
                            specialization: doctorEditSpecialization ? String(doctorEditSpecialization.value || '').trim() : '',
                            license_number: doctorEditLicense ? String(doctorEditLicense.value || '').trim() : '',
                            contact_number: c ? normalizePhilippinesNumber(c) : '',
                            email: doctorEditEmail ? String(doctorEditEmail.value || '').trim() : ''
                        }

                        if (payload.middlename === '') payload.middlename = null
                        if (payload.specialization === '') payload.specialization = null
                        if (payload.license_number === '') payload.license_number = null
                        if (payload.contact_number === '' || payload.contact_number === '+63') payload.contact_number = null
                        if (payload.email === '') delete payload.email

                        return apiFetch(apiUrl('/api/doctors') + "/" + editingDoctorId, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify(payload)
                        })
                            .then(readResponse)
                            .then(function (result) {
                                if (!result.ok) {
                                    if (result.status === 422 && result.data && result.data.errors) {
                                        var firstKey = Object.keys(result.data.errors)[0]
                                        var msg = firstKey && result.data.errors[firstKey] && result.data.errors[firstKey][0] ? result.data.errors[firstKey][0] : 'Validation error.'
                                        showDoctorEditError(String(msg))
                                    } else {
                                        var msg2 = (result.data && result.data.message) ? result.data.message : 'Failed to update doctor.'
                                        showDoctorEditError(String(msg2))
                                    }
                                    return
                                }

                                showDoctorSuccess('Changes saved.')
                                setTimeout(function () { showDoctorSuccess('') }, 2500)
                                closeDoctorEditModal()
                                loadDoctors()
                            })
                            .catch(function () {
                                showDoctorEditError('Network error while updating doctor.')
                            })
                            .finally(function () {
                                setDoctorEditSubmitting(false)
                            })
                    })
                    .catch(function () {})
            })
        }

        function setScheduleSubmitting(isSubmitting) {
            if (scheduleSubmit) scheduleSubmit.disabled = !!isSubmitting
            if (scheduleSpinner) scheduleSpinner.classList.toggle('hidden', !isSubmitting)
            if (scheduleSubmitLabel) scheduleSubmitLabel.textContent = currentScheduleId ? (isSubmitting ? 'Saving...' : 'Save changes') : (isSubmitting ? 'Saving...' : 'Generate schedule')
        }

        function showAvailabilityError(message) {
            if (!availabilityError) return
            availabilityError.textContent = message || ''
            availabilityError.classList.toggle('hidden', !message)
        }

        function setAvailabilitySubmitting(isSubmitting) {
            if (availabilitySave) availabilitySave.disabled = !!isSubmitting
            if (availabilitySpinner) availabilitySpinner.classList.toggle('hidden', !isSubmitting)
        }

        function stopConfirmCountdown() {
            if (confirmCountdownTimer) {
                clearInterval(confirmCountdownTimer)
                confirmCountdownTimer = null
            }
            if (confirmOk) {
                confirmOk.disabled = false
                confirmOk.classList.remove('opacity-60', 'cursor-not-allowed')
            }
            if (confirmOkSpinner) {
                confirmOkSpinner.classList.add('hidden')
            }
            if (confirmOkLabel && confirmOkOriginalText != null) {
                confirmOkLabel.textContent = confirmOkOriginalText
            }
            confirmOkOriginalText = null
        }

        function confirmAction(message, options) {
            return new Promise(function (resolve) {
                if (!confirmOverlay || !confirmMessage || !confirmOk || !confirmCancel) {
                    resolve(window.confirm(message || 'Are you sure?'))
                    return
                }
                stopConfirmCountdown()
                confirmMessage.textContent = message || 'Are you sure?'
                var confirmText = options && options.confirmText ? String(options.confirmText) : 'Confirm'
                if (confirmOkLabel) confirmOkLabel.textContent = confirmText
                confirmOkOriginalText = confirmText
                confirmResolver = resolve
                confirmOverlay.classList.remove('hidden')
                confirmOverlay.classList.add('flex')

                var countdownSeconds = options && options.countdownSeconds ? parseInt(String(options.countdownSeconds), 10) : 0
                if (!countdownSeconds || isNaN(countdownSeconds) || countdownSeconds < 1) {
                    return
                }

                confirmOk.disabled = true
                confirmOk.classList.add('opacity-60', 'cursor-not-allowed')
                if (confirmOkSpinner) confirmOkSpinner.classList.remove('hidden')

                var remaining = countdownSeconds
                if (confirmOkLabel) confirmOkLabel.textContent = confirmText + ' (' + remaining + ')'

                confirmCountdownTimer = setInterval(function () {
                    remaining -= 1
                    if (remaining <= 0) {
                        stopConfirmCountdown()
                        return
                    }
                    if (confirmOkLabel) {
                        confirmOkLabel.textContent = confirmText + ' (' + remaining + ')'
                    }
                }, 1000)
            })
        }

        function closeConfirm(result) {
            if (confirmOverlay) {
                confirmOverlay.classList.add('hidden')
                confirmOverlay.classList.remove('flex')
            }
            stopConfirmCountdown()
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

        function formatTimeCompact(hhmm) {
            var t = String(hhmm || '').slice(0, 5)
            if (!/^\d{2}:\d{2}$/.test(t)) return ''
            var parts = t.split(':')
            var h24 = parseInt(parts[0], 10)
            var m = parts[1]
            var ap = h24 >= 12 ? 'PM' : 'AM'
            var h12 = h24 % 12
            if (h12 === 0) h12 = 12
            if (m === '00') return String(h12) + ap
            return String(h12) + ':' + m + ap
        }

        function loadDoctors() {
            if (!tableBody) return
            tableBody.innerHTML = '<tr><td colspan="6" class="py-4 text-center text-[0.78rem] text-slate-400">Loading doctors…</td></tr>'

            apiFetch(apiUrl('/api/doctors'), {
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
                var specialization = (doctor.specialization || '').trim()
                var licenseNumber = (doctor.license_number || '').trim()
                var contactNumber = (doctor.contact_number || '').trim()
                var schedules = Array.isArray(doctor.doctor_schedules) ? doctor.doctor_schedules : []
                var scheduleCount = schedules.length
                var daySet = {}
                schedules.forEach(function (s) {
                    if (s && s.day_of_week) {
                        daySet[String(s.day_of_week).toLowerCase()] = true
                    }
                })
                var dayKeys = Object.keys(daySet)
                var dayOrder = ['mon','tue','wed','thu','fri','sat','sun']
                dayKeys.sort(function (a, b) {
                    return dayOrder.indexOf(a) - dayOrder.indexOf(b)
                })
                var scheduleSummary = 'No schedules'
                if (scheduleCount && dayKeys.length) {
                    var fromDay = dayKeys[0]
                    var toDay = dayKeys[dayKeys.length - 1]
                    var dayText = fromDay === toDay ? ('[ ' + String(fromDay).toUpperCase() + ' ]') : ('[ ' + String(fromDay).toUpperCase() + ' - ' + String(toDay).toUpperCase() + ' ]')

                    var range = (schedules || []).reduce(function (acc, s) {
                        var st = String(s && s.start_time ? s.start_time : '').slice(0, 5)
                        var et = String(s && s.end_time ? s.end_time : '').slice(0, 5)
                        if (/^\d{2}:\d{2}$/.test(st)) {
                            if (!acc.start || st < acc.start) acc.start = st
                        }
                        if (/^\d{2}:\d{2}$/.test(et)) {
                            if (!acc.end || et > acc.end) acc.end = et
                        }
                        return acc
                    }, { start: null, end: null })

                    var timeText = (range && range.start && range.end)
                        ? ('[ ' + (formatTimeCompact(range.start) || range.start) + ' - ' + (formatTimeCompact(range.end) || range.end) + ' ]')
                        : ''

                    scheduleSummary = dayText + (timeText ? (' ' + timeText) : '')
                }
                var unavailableCount = schedules.filter(function (s) { return s && s.is_available === false }).length
                var availabilityLabel = scheduleCount ? (unavailableCount ? ('Unavailable slots: ' + unavailableCount) : 'All slots available') : 'No schedule'
                var availabilityClass = scheduleCount && unavailableCount ? 'text-rose-700 bg-rose-50 border-rose-100' : 'text-emerald-700 bg-emerald-50 border-emerald-100'

                tr.innerHTML =
                    '<td class="py-2 pr-4 text-[0.78rem] text-slate-700">' + fullName + '</td>' +
                    '<td class="py-2 pr-4 text-[0.78rem] text-slate-500">' +
                        (specialization ? specialization : '<span class="text-slate-400">—</span>') +
                        '<div class="mt-1 inline-flex items-center px-2 py-0.5 rounded-full text-[0.68rem] font-semibold border ' + availabilityClass + '">' + availabilityLabel + '</div>' +
                    '</td>' +
                    '<td class="py-2 pr-4 text-[0.78rem] text-slate-500">' + (licenseNumber ? licenseNumber : '<span class="text-slate-400">—</span>') + '</td>' +
                    '<td class="py-2 pr-4 text-[0.78rem] text-slate-500">' + (contactNumber ? contactNumber : '<span class="text-slate-400">—</span>') + '</td>' +
                    '<td class="py-2 pr-4 text-[0.78rem] text-slate-500">' + scheduleSummary + '</td>' +
                    '<td class="py-2 pr-4 text-[0.78rem]">' +
                        '<div class="flex items-center gap-2">' +
                            '<button type="button" class="text-[0.72rem] text-cyan-700 hover:text-cyan-800 font-semibold admin-doctor-edit" data-doctor-id="' + doctor.user_id + '">Edit</button>' +
                            '<button type="button" class="text-[0.72rem] text-slate-700 hover:text-slate-900 font-semibold admin-doctor-schedule" data-doctor-id="' + doctor.user_id + '" data-doctor-name="' + fullName.replace(/"/g, '&quot;') + '">Manage schedule</button>' +
                            '<button type="button" class="text-[0.72rem] text-amber-700 hover:text-amber-800 font-semibold admin-doctor-availability" data-doctor-id="' + doctor.user_id + '">Availability</button>' +
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
                    openDoctorEditModal(doctor)
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
                    if (scheduleFromDay) scheduleFromDay.value = ''
                    if (scheduleToDay) scheduleToDay.value = ''
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

            var availabilityButtons = tableBody.querySelectorAll('.admin-doctor-availability')
            availabilityButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    var id = this.getAttribute('data-doctor-id')
                    var doctor = doctors.find(function (d) { return String(d.user_id) === String(id) })
                    if (!doctor) return
                    var fullName = ((doctor.firstname || '') + ' ' + (doctor.lastname || '')).trim()
                    if (!fullName) fullName = 'Doctor #' + doctor.user_id
                    openAvailabilityModal(String(doctor.user_id), fullName)
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

            fetchAllDoctorSchedules(doctorId, function (all) {
                loadedSchedules = Array.isArray(all) ? all : []
                    if (!loadedSchedules.length) {
                        scheduleList.textContent = 'No schedules defined yet for this doctor.'
                        if (scheduleGrid) {
                            scheduleGrid.innerHTML = ''
                        }
                        return
                    }

                    var html = ''
                    var dayLabels = {
                        mon: 'Mon',
                        tue: 'Tue',
                        wed: 'Wed',
                        thu: 'Thu',
                        fri: 'Fri',
                        sat: 'Sat',
                        sun: 'Sun'
                    }
                    loadedSchedules.forEach(function (s) {
                        var dayKey = s && s.day_of_week ? String(s.day_of_week).toLowerCase() : ''
                        var day = dayLabels[dayKey] || (dayKey ? dayKey.toUpperCase() : '—')
                        var startLabel = formatTimeLabel(s.start_time || '')
                        var endLabel = formatTimeLabel(s.end_time || '')
                        var avail = s && s.is_available === false ? 'Unavailable' : 'Available'
                        var availClass = s && s.is_available === false ? 'text-rose-700 bg-rose-50 border-rose-100' : 'text-emerald-700 bg-emerald-50 border-emerald-100'
                        var roomLabel = (s.room_number != null && String(s.room_number) !== '') ? String(s.room_number) : '—'
                        html += '<div class="flex items-center justify-between rounded-lg border border-slate-200 bg-white px-3 py-2">' +
                            '<div class="text-[0.78rem] text-slate-700">' +
                            '<div class="flex items-center gap-2 flex-wrap">' +
                                '<div><span class="font-semibold">Day:</span> ' + day + '</div>' +
                                '<div class="inline-flex items-center px-2 py-0.5 rounded-full text-[0.68rem] font-semibold border ' + availClass + '">' + avail + '</div>' +
                            '</div>' +
                            '<div><span class="font-semibold">Time:</span> ' + (startLabel || (s.start_time || '')) + '–' + (endLabel || (s.end_time || '')) + '</div>' +
                            '<div><span class="font-semibold">Max patients:</span> ' + (s.max_patients || '—') + '</div>' +
                            '<div><span class="font-semibold">Room:</span> ' + roomLabel + '</div>' +
                            '</div>' +
                            '<div class="flex items-center gap-2">' +
                                '<input type="checkbox" class="admin-schedule-check w-4 h-4 accent-cyan-600" data-schedule-id="' + s.schedule_id + '">' +
                                '<button type="button" class="text-[0.72rem] text-cyan-700 hover:text-cyan-800 font-semibold admin-schedule-edit" data-schedule-id="' + s.schedule_id + '">Edit</button>' +
                                '<button type="button" class="text-[0.72rem] text-rose-600 hover:text-rose-700 font-semibold admin-schedule-delete" data-schedule-id="' + s.schedule_id + '">Delete</button>' +
                            '</div>' +
                            '</div>'
                    })
                    scheduleList.innerHTML = html

                    renderScheduleGrid(loadedSchedules)
                    wireScheduleBulkActions(doctorId)

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
                            if (scheduleRoom) scheduleRoom.value = schedule.room_number != null ? String(schedule.room_number) : ''
                            if (scheduleFromDay) scheduleFromDay.value = schedule.day_of_week || ''
                            if (scheduleToDay) scheduleToDay.value = schedule.day_of_week || ''
                            setScheduleSubmitting(false)
                        })
                    })

                    var deleteButtons = scheduleList.querySelectorAll('.admin-schedule-delete')
                    deleteButtons.forEach(function (button) {
                        button.addEventListener('click', function () {
                            var scheduleId = this.getAttribute('data-schedule-id')
                            if (!scheduleId) return
                            showDoctorError('')
                            showDoctorSuccess('')

                            confirmAction('Delete this schedule?', { countdownSeconds: 3, confirmText: 'Delete' })
                                .then(function (confirmed) {
                                    if (!confirmed) return
                                    apiFetch(apiUrl('/api/doctor-schedules') + "/" + scheduleId, {
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
            }, function (message) {
                scheduleList.textContent = message || 'Failed to load schedules.'
            })
        }

        function setBulkDeleting(isDeleting) {
            var buttons = [scheduleSelectAll, scheduleClearAll, scheduleDeleteSelected, scheduleDeleteDay, scheduleDeleteAll]
            buttons.forEach(function (btn) {
                if (!btn) return
                btn.disabled = !!isDeleting
                btn.classList.toggle('opacity-60', !!isDeleting)
                btn.classList.toggle('cursor-not-allowed', !!isDeleting)
            })
            if (scheduleBulkDay) {
                scheduleBulkDay.disabled = !!isDeleting
                scheduleBulkDay.classList.toggle('opacity-60', !!isDeleting)
                scheduleBulkDay.classList.toggle('cursor-not-allowed', !!isDeleting)
            }
        }

        function getCheckedScheduleIds() {
            if (!scheduleList) return []
            var checks = scheduleList.querySelectorAll('.admin-schedule-check')
            var ids = []
            checks.forEach(function (c) {
                if (!c || !c.checked) return
                var id = c.getAttribute('data-schedule-id')
                if (id) ids.push(parseInt(id, 10))
            })
            return ids.filter(function (v) { return !isNaN(v) })
        }

        function bulkDeleteSchedules(payload, successMessage) {
            if (!payload || !payload.doctor_id) return
            setBulkDeleting(true)
            apiFetch(apiUrl('/api/doctor-schedules/bulk-delete'), {
                method: 'DELETE',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            })
                .then(function (response) { return readResponse(response) })
                .then(function (result) {
                    if (!result.ok) {
                        var msg = (result.data && result.data.message) ? String(result.data.message) : 'Failed to delete schedules.'
                        if (result.status === 401) msg = 'Session expired. Please log in again.'
                        if (result.status === 403) msg = 'You do not have permission to delete schedules.'
                        if (result.status === 422 && result.data && result.data.errors) {
                            var all = []
                            Object.keys(result.data.errors).forEach(function (key) {
                                var v = result.data.errors[key]
                                if (Array.isArray(v)) v.forEach(function (x) { all.push(String(x)) })
                            })
                            if (all.length) msg = all.join(' ')
                        }
                        showDoctorError(msg)
                        return
                    }
                    var deleted = result.data && result.data.deleted != null ? parseInt(result.data.deleted, 10) : null
                    var finalMsg = successMessage || 'Schedules deleted.'
                    if (deleted != null && !isNaN(deleted)) {
                        finalMsg = finalMsg + ' Deleted ' + deleted + '.'
                    }
                    showDoctorSuccess(finalMsg)
                    loadSchedulesForDoctor(String(payload.doctor_id))
                    loadDoctors()
                })
                .catch(function () {
                    showDoctorError('Network error while deleting schedules.')
                })
                .finally(function () {
                    setBulkDeleting(false)
                })
        }

        function wireScheduleBulkActions(doctorId) {
            if (!scheduleList) return

            if (scheduleSelectAll) {
                scheduleSelectAll.onclick = function () {
                    var checks = scheduleList.querySelectorAll('.admin-schedule-check')
                    checks.forEach(function (c) { c.checked = true })
                }
            }
            if (scheduleClearAll) {
                scheduleClearAll.onclick = function () {
                    var checks = scheduleList.querySelectorAll('.admin-schedule-check')
                    checks.forEach(function (c) { c.checked = false })
                }
            }
            if (scheduleDeleteSelected) {
                scheduleDeleteSelected.onclick = function () {
                    showDoctorError('')
                    showDoctorSuccess('')
                    var ids = getCheckedScheduleIds()
                    if (!ids.length) {
                        showDoctorError('Select at least one schedule.')
                        return
                    }
                    confirmAction('Delete ' + ids.length + ' selected schedule(s)?', { countdownSeconds: 3, confirmText: 'Delete' })
                        .then(function (confirmed) {
                            if (!confirmed) return
                            bulkDeleteSchedules({ doctor_id: parseInt(doctorId, 10), schedule_ids: ids }, 'Selected schedules deleted.')
                        })
                }
            }
            if (scheduleDeleteDay) {
                scheduleDeleteDay.onclick = function () {
                    showDoctorError('')
                    showDoctorSuccess('')
                    var day = scheduleBulkDay ? String(scheduleBulkDay.value || '') : ''
                    if (!day) {
                        showDoctorError('Select a day first.')
                        return
                    }
                    var countForDay = loadedSchedules.filter(function (s) { return String(s.day_of_week || '') === day }).length
                    confirmAction('Delete all schedules for ' + day.toUpperCase() + '? (' + countForDay + ' slot(s))', { countdownSeconds: 3, confirmText: 'Delete' })
                        .then(function (confirmed) {
                            if (!confirmed) return
                            bulkDeleteSchedules({ doctor_id: parseInt(doctorId, 10), day_of_week: day }, 'Day schedules deleted.')
                        })
                }
            }
            if (scheduleDeleteAll) {
                scheduleDeleteAll.onclick = function () {
                    showDoctorError('')
                    showDoctorSuccess('')
                    var countAll = Array.isArray(loadedSchedules) ? loadedSchedules.length : 0
                    confirmAction('Delete ALL schedules for this doctor? (' + countAll + ' slot(s))', { countdownSeconds: 3, confirmText: 'Delete all' })
                        .then(function (confirmed) {
                            if (!confirmed) return
                            bulkDeleteSchedules({ doctor_id: parseInt(doctorId, 10) }, 'All schedules deleted.')
                        })
                }
            }
        }

        function openAvailabilityModal(doctorId, doctorName) {
            currentDoctorIdForAvailability = doctorId
            loadedAvailabilitySchedules = []
            showAvailabilityError('')
            setAvailabilitySubmitting(false)

            if (availabilityTitle) {
                availabilityTitle.textContent = 'Manage Availability — ' + (doctorName || ('Doctor #' + doctorId))
            }
            if (availabilityDayFilter) availabilityDayFilter.value = ''
            if (availabilityMode) availabilityMode.value = 'unavailable'
            if (availabilityList) availabilityList.innerHTML = 'Loading schedules…'

            if (availabilityOverlay) {
                availabilityOverlay.classList.remove('hidden')
                availabilityOverlay.classList.add('flex')
            }

            loadAvailabilitySchedulesForDoctor(doctorId)
        }

        function closeAvailabilityModal() {
            if (availabilityOverlay) {
                availabilityOverlay.classList.add('hidden')
                availabilityOverlay.classList.remove('flex')
            }
            currentDoctorIdForAvailability = null
            loadedAvailabilitySchedules = []
            showAvailabilityError('')
            setAvailabilitySubmitting(false)
        }

        function loadAvailabilitySchedulesForDoctor(doctorId) {
            if (!availabilityList || !doctorId) return
            availabilityList.innerHTML = 'Loading schedules…'
            loadedAvailabilitySchedules = []

            fetchAllDoctorSchedules(doctorId, function (all) {
                loadedAvailabilitySchedules = Array.isArray(all) ? all : []
                renderAvailabilityList()
            }, function (message) {
                showAvailabilityError(message || 'Failed to load schedules.')
                availabilityList.innerHTML = ''
            })
        }

        function renderAvailabilityList() {
            if (!availabilityList) return
            var dayFilter = availabilityDayFilter ? String(availabilityDayFilter.value || '').toLowerCase() : ''
            var dayOrder = [
                { key: 'mon', label: 'Monday' },
                { key: 'tue', label: 'Tuesday' },
                { key: 'wed', label: 'Wednesday' },
                { key: 'thu', label: 'Thursday' },
                { key: 'fri', label: 'Friday' },
                { key: 'sat', label: 'Saturday' },
                { key: 'sun', label: 'Sunday' }
            ]
            if (!Array.isArray(dayOrder)) dayOrder = []

            var grouped = {}
            for (var i = 0; i < dayOrder.length; i++) {
                grouped[dayOrder[i].key] = []
            }

            var availabilitySlots = Array.isArray(loadedAvailabilitySchedules) ? loadedAvailabilitySchedules : []
            for (var a = 0; a < availabilitySlots.length; a++) {
                var s = availabilitySlots[a]
                var key = s && s.day_of_week ? String(s.day_of_week).toLowerCase() : ''
                if (!key || !grouped[key]) continue
                if (dayFilter && dayFilter !== key) continue
                grouped[key].push(s)
            }

            for (var j = 0; j < dayOrder.length; j++) {
                var dayKey = dayOrder[j].key
                grouped[dayKey].sort(function (a, b) {
                    var sa = String(a.start_time || '').slice(0, 5)
                    var sb = String(b.start_time || '').slice(0, 5)
                    if (sa < sb) return -1
                    if (sa > sb) return 1
                    return 0
                })
            }

            var html = ''
            for (var k = 0; k < dayOrder.length; k++) {
                var d = dayOrder[k]
                var rows = grouped[d.key] || []
                if (!rows.length) continue
                html += '<div class="rounded-xl border border-slate-200 bg-white p-3">' +
                    '<div class="text-[0.72rem] font-semibold text-slate-900 mb-2">' + d.label + '</div>'

                for (var r = 0; r < rows.length; r++) {
                    var s2 = rows[r]
                    var start = String(s2.start_time || '').slice(0, 5)
                    var end = String(s2.end_time || '').slice(0, 5)
                    var label = (formatTimeLabel(start) || start) + '–' + (formatTimeLabel(end) || end)
                    var isUnavailable = s2.is_available === false
                    var badgeClass = isUnavailable ? 'text-rose-700 bg-rose-50 border-rose-100' : 'text-emerald-700 bg-emerald-50 border-emerald-100'
                    var badgeText = isUnavailable ? 'Unavailable' : 'Available'

                    html += '<label class="flex items-center justify-between gap-3 rounded-lg border border-slate-100 bg-slate-50/60 px-3 py-2 mb-1">' +
                        '<div class="flex items-center gap-2">' +
                            '<input type="checkbox" class="rounded border-slate-300 text-cyan-600 focus:ring-cyan-500" data-schedule-id="' + s2.schedule_id + '">' +
                            '<span class="text-[0.78rem] text-slate-700 font-semibold">' + label + '</span>' +
                        '</div>' +
                        '<span class="inline-flex items-center px-2 py-0.5 rounded-full text-[0.68rem] font-semibold border ' + badgeClass + '">' + badgeText + '</span>' +
                    '</label>'
                }

                html += '</div>'
            }

            if (!html) {
                html = '<div class="text-[0.78rem] text-slate-500">No schedules found for the selected filter.</div>'
            }

            availabilityList.innerHTML = html
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

        if (availabilityClose) {
            availabilityClose.addEventListener('click', function () {
                closeAvailabilityModal()
            })
        }
        if (availabilityOverlay) {
            availabilityOverlay.addEventListener('click', function (e) {
                if (e.target === availabilityOverlay) {
                    closeAvailabilityModal()
                }
            })
        }
        if (availabilityDayFilter) {
            availabilityDayFilter.addEventListener('change', function () {
                renderAvailabilityList()
            })
        }
        if (availabilitySave) {
            availabilitySave.addEventListener('click', function () {
                showAvailabilityError('')
                if (!currentDoctorIdForAvailability) {
                    showAvailabilityError('No doctor selected.')
                    return
                }
                if (!availabilityList) {
                    showAvailabilityError('Schedule list not available.')
                    return
                }

                var checked = availabilityList.querySelectorAll('input[type="checkbox"][data-schedule-id]:checked')
                var ids = []
                checked.forEach(function (c) {
                    var id = c.getAttribute('data-schedule-id')
                    if (id) ids.push(parseInt(id, 10))
                })

                if (!ids.length) {
                    showAvailabilityError('Select at least one time slot.')
                    return
                }

                var mode = availabilityMode ? String(availabilityMode.value || '') : 'unavailable'
                var isAvailable = mode === 'available'

                confirmAction('Are you sure you want to save this schedule?')
                    .then(function (confirmed) {
                        if (!confirmed) return
                        setAvailabilitySubmitting(true)

                        apiFetch(apiUrl('/api/doctor-schedules/bulk-availability'), {
                            method: 'PATCH',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({
                                schedule_ids: ids,
                                is_available: isAvailable
                            })
                        })
                            .then(function (response) { return readResponse(response) })
                            .then(function (result) {
                                if (!result.ok) {
                                    var msg = (result.data && result.data.message) ? String(result.data.message) : 'Failed to update availability.'
                                    showAvailabilityError(msg)
                                    return
                                }
                                showDoctorSuccess('Availability updated.')
                                loadDoctors()
                                loadAvailabilitySchedulesForDoctor(currentDoctorIdForAvailability)
                                if (currentDoctorIdForSchedule && String(currentDoctorIdForSchedule) === String(currentDoctorIdForAvailability)) {
                                    loadSchedulesForDoctor(currentDoctorIdForSchedule)
                                }
                            })
                            .catch(function () {
                                showAvailabilityError('Network error while updating availability.')
                            })
                            .finally(function () {
                                setAvailabilitySubmitting(false)
                            })
                    })
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
                if (scheduleRoom) scheduleRoom.value = ''
                if (scheduleFromDay) scheduleFromDay.value = ''
                if (scheduleToDay) scheduleToDay.value = ''
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
                var roomNumberRaw = scheduleRoom ? String(scheduleRoom.value || '').trim() : ''
                var fromDay = scheduleFromDay ? String(scheduleFromDay.value || '') : ''
                var toDay = scheduleToDay ? String(scheduleToDay.value || '') : ''
                var slotMinutes = scheduleSlotMinutes && scheduleSlotMinutes.value ? parseInt(String(scheduleSlotMinutes.value), 10) : 60
                if (!slotMinutes || isNaN(slotMinutes)) {
                    slotMinutes = 60
                }

                if (!start || !end || !fromDay || (!currentScheduleId && !toDay)) {
                    showDoctorError(currentScheduleId ? 'Day, start time, and end time are required.' : 'From day, to day, start time, and end time are required.')
                    return
                }

                var startMinutes = minutesFromHHMM(start)
                var endMinutes = minutesFromHHMM(end)
                if (isNaN(startMinutes) || isNaN(endMinutes) || endMinutes <= startMinutes) {
                    showDoctorError('End time must be after start time.')
                    return
                }

                if (!currentScheduleId) {
                    var diff = endMinutes - startMinutes
                    if (diff % slotMinutes !== 0) {
                        showDoctorError('Time range must be divisible by ' + slotMinutes + ' minutes.')
                        return
                    }
                }

                var body = {}
                if (maxPatients) {
                    body.max_patients = parseInt(maxPatients, 10)
                }
                if (roomNumberRaw !== '') {
                    var roomNumber = parseInt(roomNumberRaw, 10)
                    if (isNaN(roomNumber) || roomNumber < 1) {
                        showDoctorError('Room number must be a valid number (1 or higher).')
                        return
                    }
                    body.room_number = roomNumber
                } else {
                    body.room_number = null
                }

                var url = apiUrl('/api/doctor-schedules')
                var method = 'POST'
                if (currentScheduleId) {
                    url = url + '/' + currentScheduleId
                    method = 'PUT'
                    body.day_of_week = fromDay
                    body.start_time = start
                    body.end_time = end
                } else {
                    body.doctor_id = currentDoctorIdForSchedule
                    body.from_day = fromDay
                    body.to_day = toDay
                    body.start_time = start
                    body.end_time = end
                    body.slot_minutes = slotMinutes
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
                        var successMsg = currentScheduleId ? 'Slot updated.' : 'Slots generated.'
                        if (!currentScheduleId && result.data && (result.data.created != null || result.data.updated != null)) {
                            var created = parseInt(result.data.created || 0, 10)
                            var updated = parseInt(result.data.updated || 0, 10)
                            if (isNaN(created)) created = 0
                            if (isNaN(updated)) updated = 0
                            successMsg = 'Slots generated. Created ' + created + ', updated ' + updated + '.'
                        }
                        showDoctorSuccess(successMsg)
                        if (scheduleStartHour) scheduleStartHour.value = ''
                        if (scheduleStartMin) scheduleStartMin.value = ''
                        if (scheduleStartAmPm) scheduleStartAmPm.value = ''
                        if (scheduleEndHour) scheduleEndHour.value = ''
                        if (scheduleEndMin) scheduleEndMin.value = ''
                        if (scheduleEndAmPm) scheduleEndAmPm.value = ''
                        if (scheduleMax) scheduleMax.value = ''
                        if (scheduleRoom) scheduleRoom.value = ''
                        if (scheduleFromDay) scheduleFromDay.value = ''
                        if (scheduleToDay) scheduleToDay.value = ''
                        currentScheduleId = null
                        loadSchedulesForDoctor(currentDoctorIdForSchedule)
                        loadDoctors()
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
            if (!Array.isArray(dayOrder)) dayOrder = []

            var slotsByDay = {}
            for (var i = 0; i < dayOrder.length; i++) {
                slotsByDay[dayOrder[i].key] = []
            }

            var inputSchedules = Array.isArray(schedules) ? schedules : []
            for (var s = 0; s < inputSchedules.length; s++) {
                var slot = inputSchedules[s]
                var key = slot && slot.day_of_week ? String(slot.day_of_week).toLowerCase() : null
                if (!key || !slotsByDay[key]) continue
                slotsByDay[key].push({
                    start: (slot.start_time || '').slice(0, 5),
                    end: (slot.end_time || '').slice(0, 5),
                    max: slot.max_patients || null,
                    available: slot.is_available !== false
                })
            }

            for (var j = 0; j < dayOrder.length; j++) {
                var dayKey = dayOrder[j].key
                slotsByDay[dayKey].sort(function (a, b) {
                    if (a.start < b.start) return -1
                    if (a.start > b.start) return 1
                    return 0
                })
            }

            scheduleGrid.innerHTML = ''
            for (var k = 0; k < dayOrder.length; k++) {
                var d = dayOrder[k]
                var col = document.createElement('div')
                col.className = 'rounded-xl border border-slate-200 bg-white p-2'
                var header = '<div class="text-[0.68rem] font-semibold uppercase tracking-widest text-slate-400 mb-2">' + d.label + '</div>'
                var items = slotsByDay[d.key].map(function (s) {
                    var boxClass = s.available ? 'bg-slate-50 border-slate-200/70' : 'bg-rose-50 border-rose-100'
                    var status = s.available ? '' : '<div class="text-[0.68rem] font-semibold text-rose-700">Unavailable</div>'
                    return '<div class="rounded-lg px-2 py-1 border mb-1 ' + boxClass + '">' +
                        '<div class="text-[0.74rem] font-semibold text-slate-700">' + s.start + '–' + s.end + '</div>' +
                        '<div class="text-[0.68rem] text-slate-500">Max: ' + (s.max ? s.max : '—') + '</div>' +
                        status +
                        '</div>'
                }).join('')
                if (!items) {
                    items = '<div class="text-[0.72rem] text-slate-400">—</div>'
                }
                col.innerHTML = header + items
                scheduleGrid.appendChild(col)
            }
        }

        loadDoctors()
    })
</script>
