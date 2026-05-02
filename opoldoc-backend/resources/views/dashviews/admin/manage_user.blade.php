<div class="bg-white border border-slate-200 rounded-[18px] p-5 shadow-[0_2px_10px_rgba(15,23,42,0.04)]">
    <div class="flex items-center justify-between mb-3">
        <h2 class="text-sm font-semibold text-slate-900">User Management</h2>
        <span class="text-[0.7rem] text-slate-400 uppercase tracking-widest">Accounts</span>
    </div>
    <p class="text-xs text-slate-500 mb-3">
        Create users by email invitation, edit accounts, suspend or activate, search or filter, and view dependents.
    </p>

    <div id="adminUserError" class="hidden mb-3 rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-[0.75rem] text-red-700"></div>
    <div id="adminUserSuccess" class="hidden mb-3 rounded-lg border border-emerald-200 bg-emerald-50 px-3 py-2 text-[0.75rem] text-emerald-700"></div>

    <form id="adminCreateUserForm" class="mb-4 grid gap-2 grid-cols-1 md:grid-cols-4 items-end">
        <div>
            <label for="admin_new_email" class="block text-[0.7rem] text-slate-600 mb-1">Email</label>
            <input id="admin_new_email" type="email" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" required>
        </div>
        <div>
            <label for="admin_new_role" class="block text-[0.7rem] text-slate-600 mb-1">Role</label>
            <select id="admin_new_role" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                <option value="admin">Admin</option>
                <option value="doctor">Doctor</option>
                <option value="receptionist">Receptionist</option>
                <option value="patient">Patient</option>
            </select>
        </div>
        <div class="text-[0.7rem] text-slate-500">
            A temporary password will be generated and emailed to the user.
        </div>
        <div class="flex items-center gap-2">
            <button type="submit" id="adminCreateUserSubmit" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-cyan-600 text-white text-[0.78rem] font-semibold hover:bg-cyan-700 transition-colors disabled:opacity-60 disabled:hover:bg-cyan-600">
                <span id="adminCreateUserSpinner" class="hidden w-3.5 h-3.5 border-2 border-white/40 border-t-white rounded-full animate-spin"></span>
                <span id="adminCreateUserSubmitLabel">Create user</span>
            </button>
        </div>
    </form>

    <div id="adminUserConfirmOverlay" class="hidden fixed inset-0 z-[70] bg-slate-900/40 items-center justify-center p-4">
        <div class="w-full max-w-sm rounded-2xl bg-white border border-slate-200 shadow-[0_12px_30px_rgba(15,23,42,0.24)] p-4">
            <div class="flex items-start gap-3">
                <div class="w-9 h-9 rounded-xl bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-700">
                    <span class="material-symbols-outlined text-[18px] leading-none">help</span>
                </div>
                <div class="flex-1">
                    <div class="text-sm font-semibold text-slate-900">Confirm</div>
                    <div id="adminUserConfirmMessage" class="text-[0.78rem] text-slate-600 mt-0.5">Are you sure?</div>
                </div>
            </div>
            <div class="mt-4 flex items-center justify-end gap-2">
                <button type="button" id="adminUserConfirmCancel" class="px-3 py-2 rounded-xl border border-slate-200 bg-white text-[0.78rem] font-semibold text-slate-700 hover:bg-slate-50">Cancel</button>
                <button type="button" id="adminUserConfirmOk" class="px-3 py-2 rounded-xl bg-slate-900 text-white text-[0.78rem] font-semibold hover:bg-slate-800">Confirm</button>
            </div>
        </div>
    </div>

    <div id="adminUserEditOverlay" class="hidden fixed inset-0 z-50 bg-slate-900/40 items-center justify-center p-4">
        <div class="w-full max-w-lg rounded-2xl bg-white border border-slate-200 shadow-[0_12px_30px_rgba(15,23,42,0.24)] overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <div class="text-sm font-semibold text-slate-900">Edit user</div>
                    <div id="adminUserEditSubtitle" class="text-[0.72rem] text-slate-500">Update basic account information.</div>
                </div>
                <button type="button" id="adminUserEditClose" class="text-slate-400 hover:text-slate-600">
                    <span class="material-symbols-outlined text-[20px] leading-none">close</span>
                </button>
            </div>
            <div class="p-5">
                <div id="adminUserEditError" class="hidden mb-3 rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-[0.75rem] text-red-700"></div>
                <form id="adminUserEditForm" class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label for="adminUserEditFirstname" class="block text-[0.7rem] text-slate-600 mb-1">First name</label>
                        <input id="adminUserEditFirstname" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                    </div>
                    <div>
                        <label for="adminUserEditMiddlename" class="block text-[0.7rem] text-slate-600 mb-1">Middle name</label>
                        <input id="adminUserEditMiddlename" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                    </div>
                    <div>
                        <label for="adminUserEditLastname" class="block text-[0.7rem] text-slate-600 mb-1">Last name</label>
                        <input id="adminUserEditLastname" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                    </div>
                    <div>
                        <label for="adminUserEditContact" class="block text-[0.7rem] text-slate-600 mb-1">Contact number</label>
                        <input id="adminUserEditContact" type="tel" inputmode="tel" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="+63XXXXXXXXXX">
                    </div>
                    <div>
                        <label for="adminUserEditHireDate" class="block text-[0.7rem] text-slate-600 mb-1">Hire date</label>
                        <input id="adminUserEditHireDate" type="date" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                    </div>
                    <div class="md:col-span-2">
                        <label for="adminUserEditEmail" class="block text-[0.7rem] text-slate-600 mb-1">Email</label>
                        <input id="adminUserEditEmail" type="email" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                    </div>
                    <div class="md:col-span-2 flex items-center justify-end gap-2 pt-1">
                        <button type="button" id="adminUserEditCancel" class="px-3 py-2 rounded-xl border border-slate-200 bg-white text-[0.78rem] font-semibold text-slate-700 hover:bg-slate-50">Cancel</button>
                        <button type="submit" id="adminUserEditSave" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-xl bg-cyan-600 text-white text-[0.78rem] font-semibold hover:bg-cyan-700 transition-colors disabled:opacity-60 disabled:hover:bg-cyan-600">
                            <span id="adminUserEditSpinner" class="hidden w-3.5 h-3.5 border-2 border-white/40 border-t-white rounded-full animate-spin"></span>
                            <span>Save changes</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="adminUserStatusOverlay" class="hidden fixed inset-0 z-50 bg-slate-900/40 items-center justify-center p-4">
        <div class="w-full max-w-md rounded-2xl bg-white border border-slate-200 shadow-[0_12px_30px_rgba(15,23,42,0.24)] overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <div class="text-sm font-semibold text-slate-900">Set account status</div>
                    <div id="adminUserStatusSubtitle" class="text-[0.72rem] text-slate-500">Suspend or restore this account.</div>
                </div>
                <button type="button" id="adminUserStatusClose" class="text-slate-400 hover:text-slate-600">
                    <span class="material-symbols-outlined text-[20px] leading-none">close</span>
                </button>
            </div>
            <div class="p-5">
                <div id="adminUserStatusError" class="hidden mb-3 rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-[0.75rem] text-red-700"></div>
                <form id="adminUserStatusForm" class="space-y-3">
                    <div>
                        <label for="adminUserStatusSelect" class="block text-[0.7rem] text-slate-600 mb-1">Status</label>
                        <select id="adminUserStatusSelect" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                            <option value="active">Active (Restore)</option>
                            <option value="suspended">Suspended</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="flex items-center justify-end gap-2 pt-1">
                        <button type="button" id="adminUserStatusCancel" class="px-3 py-2 rounded-xl border border-slate-200 bg-white text-[0.78rem] font-semibold text-slate-700 hover:bg-slate-50">Cancel</button>
                        <button type="submit" id="adminUserStatusSave" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-xl bg-slate-900 text-white text-[0.78rem] font-semibold hover:bg-slate-800 transition-colors disabled:opacity-60 disabled:hover:bg-slate-900">
                            <span id="adminUserStatusSpinner" class="hidden w-3.5 h-3.5 border-2 border-white/40 border-t-white rounded-full animate-spin"></span>
                            <span>Set status</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="mb-3 flex flex-col gap-2 md:flex-row md:items-end">
        <div class="flex-1">
            <label for="admin_user_search" class="block text-[0.7rem] text-slate-600 mb-1">Search users</label>
            <input id="admin_user_search" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Search by name, email, or ID">
        </div>
        <div class="w-full md:w-48">
            <label for="admin_user_role_filter" class="block text-[0.7rem] text-slate-600 mb-1">Filter by role</label>
            <select id="admin_user_role_filter" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                <option value="">All roles</option>
                <option value="admin">Admin</option>
                <option value="doctor">Doctor</option>
                <option value="receptionist">Receptionist</option>
                <option value="patient">Patient</option>
            </select>
        </div>
        <div class="w-full md:w-44">
            <label for="admin_user_status_filter" class="block text-[0.7rem] text-slate-600 mb-1">Filter by status</label>
            <select id="admin_user_status_filter" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                <option value="">All statuses</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
                <option value="suspended">Suspended</option>
            </select>
        </div>
        <div class="w-full md:w-40">
            <label for="admin_user_sort" class="block text-[0.7rem] text-slate-600 mb-1">Sort</label>
            <select id="admin_user_sort" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                <option value="created_desc">Newest first</option>
                <option value="created_asc">Oldest first</option>
                <option value="email_asc">Email A–Z</option>
                <option value="email_desc">Email Z–A</option>
            </select>
        </div>
    </div>

    <div class="overflow-x-auto scrollbar-hidden">
        <table class="min-w-full text-left text-xs text-slate-600">
            <thead>
                <tr class="border-b border-slate-100 text-[0.68rem] uppercase tracking-widest text-slate-400">
                    <th class="py-2 pr-4 font-semibold">ID</th>
                    <th class="py-2 pr-4 font-semibold">Employee no.</th>
                    <th class="py-2 pr-4 font-semibold">Hire date</th>
                    <th class="py-2 pr-4 font-semibold">Name</th>
                    <th class="py-2 pr-4 font-semibold">Contact</th>
                    <th class="py-2 pr-4 font-semibold">Email</th>
                    <th class="py-2 pr-4 font-semibold">Current role</th>
                    <th class="py-2 pr-4 font-semibold">Status</th>
                    <th class="py-2 pr-4 font-semibold">Created</th>
                    <th class="py-2 pr-4 font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($adminRecentUsers ?? [] as $user)
                    @php
                        $status = strtolower($user->status ?? 'active');
                        $statusColors = [
                            'active' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                            'inactive' => 'bg-slate-50 text-slate-600 border-slate-100',
                            'suspended' => 'bg-amber-50 text-amber-700 border-amber-100',
                        ];
                        $statusClass = $statusColors[$status] ?? 'bg-slate-50 text-slate-600 border-slate-100';
                        $fullName = trim(implode(' ', array_filter([
                            $user->firstname ?? null,
                            $user->middlename ?? null,
                            $user->lastname ?? null,
                        ], function ($v) {
                            return (string) $v !== '';
                        })));
                        $contact = $user->contact_number ?? '';
                        $childrenCount = (int) ($user->children_count ?? 0);
                    @endphp
                    <tr class="border-b border-slate-50 last:border-0 admin-user-row"
                        data-user-id="{{ $user->user_id }}"
                        data-email="{{ strtolower($user->email) }}"
                        data-name="{{ strtolower($fullName) }}"
                        data-contact="{{ strtolower($contact) }}"
                        data-role="{{ strtolower($user->role ?? '') }}"
                        data-created="{{ optional($user->created_at)->format('Y-m-d') ?? '' }}"
                        data-created-ts="{{ optional($user->created_at)->timestamp ?? 0 }}"
                        data-status="{{ $status }}"
                        data-children-count="{{ $childrenCount }}">
                        <td class="py-2 pr-4 text-[0.78rem] text-slate-500">#{{ $user->user_id }}</td>
                        <td class="py-2 pr-4 text-[0.78rem] text-slate-700">
                            @if ($user->employee_number)
                                {{ $user->employee_number }}
                            @else
                                <span class="text-slate-400">—</span>
                            @endif
                        </td>
                        <td class="py-2 pr-4 text-[0.78rem] text-slate-500">
                            @if ($user->role !== 'patient' && $user->hire_date)
                                {{ optional($user->hire_date)->format('Y-m-d') }}
                            @else
                                <span class="text-slate-400">—</span>
                            @endif
                        </td>
                        <td class="py-2 pr-4 text-[0.78rem] text-slate-700">
                            @if ($fullName)
                                {{ $fullName }}
                            @else
                                <span class="text-slate-400">—</span>
                            @endif
                        </td>
                        <td class="py-2 pr-4 text-[0.78rem] text-slate-500">
                            @if ($contact)
                                {{ $contact }}
                            @else
                                <span class="text-slate-400">—</span>
                            @endif
                        </td>
                        <td class="py-2 pr-4 text-[0.78rem] text-slate-700">{{ $user->email }}</td>
                        <td class="py-2 pr-4 text-[0.78rem]">
                            <span class="text-[0.78rem] text-slate-700">
                                {{ $user->role ? ucfirst($user->role) : 'None' }}
                            </span>
                        </td>
                        <td class="py-2 pr-4 text-[0.78rem]">
                            <span class="inline-flex items-center rounded-full px-2 py-0.5 text-[0.68rem] font-medium border {{ $statusClass }}">
                                {{ ucfirst($status) }}
                            </span>
                        </td>
                        <td class="py-2 pr-4 text-[0.78rem] text-slate-500">
                            {{ optional($user->created_at)->format('Y-m-d') ?? '—' }}
                        </td>
                        <td class="py-2 pr-4 text-[0.78rem]">
                            <div class="flex items-center gap-2">
                                <button type="button" class="text-[0.72rem] text-cyan-700 hover:text-cyan-800 font-semibold admin-user-edit" data-user-id="{{ $user->user_id }}">
                                    Edit
                                </button>
                                @if ($childrenCount > 0)
                                    <button type="button" class="text-[0.72rem] text-slate-700 hover:text-slate-900 font-semibold admin-user-dependents" data-user-id="{{ $user->user_id }}">
                                        View dependents
                                    </button>
                                @endif
                                <button type="button" class="text-[0.72rem] text-amber-700 hover:text-amber-800 font-semibold admin-user-toggle-status" data-user-id="{{ $user->user_id }}">
                                    @if ($status === 'suspended' || $status === 'inactive')
                                        Activate
                                    @else
                                        Suspend
                                    @endif
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="py-4 text-center text-[0.78rem] text-slate-400">
                            No users found yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var form = document.getElementById('adminCreateUserForm')
        var errorBox = document.getElementById('adminUserError')
        var successBox = document.getElementById('adminUserSuccess')
        var submitBtn = document.getElementById('adminCreateUserSubmit')
        var submitSpinner = document.getElementById('adminCreateUserSpinner')
        var submitLabel = document.getElementById('adminCreateUserSubmitLabel')

        var confirmOverlay = document.getElementById('adminUserConfirmOverlay')
        var confirmMessage = document.getElementById('adminUserConfirmMessage')
        var confirmOk = document.getElementById('adminUserConfirmOk')
        var confirmCancel = document.getElementById('adminUserConfirmCancel')
        var confirmResolver = null

        function showUserError(message) {
            if (!errorBox) {
                return
            }
            errorBox.textContent = message || ''
            if (message) {
                errorBox.classList.remove('hidden')
            } else {
                errorBox.classList.add('hidden')
            }
        }

        function showUserSuccess(message) {
            if (!successBox) return
            successBox.textContent = message || ''
            if (message) {
                successBox.classList.remove('hidden')
            } else {
                successBox.classList.add('hidden')
            }
        }

        function setSubmitting(isSubmitting) {
            if (submitBtn) submitBtn.disabled = !!isSubmitting
            if (submitSpinner) submitSpinner.classList.toggle('hidden', !isSubmitting)
            if (submitLabel) submitLabel.textContent = isSubmitting ? 'Creating...' : 'Create user'
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

        if (confirmOk) confirmOk.addEventListener('click', function () { closeConfirm(true) })
        if (confirmCancel) confirmCancel.addEventListener('click', function () { closeConfirm(false) })
        if (confirmOverlay) {
            confirmOverlay.addEventListener('click', function (e) {
                if (e.target === confirmOverlay) closeConfirm(false)
            })
        }

        if (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault()

                showUserError('')
                showUserSuccess('')

                var emailInput = document.getElementById('admin_new_email')
                var roleSelect = document.getElementById('admin_new_role')

                var email = emailInput ? emailInput.value : ''
                var role = roleSelect ? roleSelect.value : ''

                if (!email) {
                    showUserError('Email is required.')
                    return
                }

                var body = {
                    email: email,
                    role: role || 'patient'
                }

                confirmAction('Create this user and email temporary credentials?')
                    .then(function (confirmed) {
                        if (!confirmed) return
                        setSubmitting(true)
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
                                }).catch(function () {
                                    return { ok: response.ok, status: response.status, data: null }
                                })
                            })
                            .then(function (result) {
                                if (!result.ok) {
                                    var message = result.data && result.data.message ? result.data.message : 'Failed to create user.'
                                    showUserError(message)
                                    return
                                }

                                showUserSuccess('Account created and credentials email sent.')
                                if (emailInput) emailInput.value = ''
                                setTimeout(function () { window.location.reload() }, 700)
                            })
                            .catch(function () {
                                showUserError('Network error while creating user.')
                            })
                            .finally(function () {
                                setSubmitting(false)
                            })
                    })
            })
        }

        var deleteButtons = document.querySelectorAll('.admin-user-delete')
        deleteButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var userId = this.getAttribute('data-user-id')
                if (!userId) {
                    return
                }
                showUserError('')
                showUserSuccess('')
                confirmAction('Delete this user?')
                    .then(function (confirmed) {
                        if (!confirmed) return
                        apiFetch("{{ url('/api/users') }}/" + userId, {
                            method: 'DELETE'
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
                                    var msg = (result.data && result.data.message) ? result.data.message : 'Failed to delete user.'
                                    showUserError(msg)
                                    return
                                }
                                showUserSuccess('User deleted.')
                                setTimeout(function () { window.location.reload() }, 700)
                            })
                            .catch(function () {})
                    })
            })
        })

        var searchInput = document.getElementById('admin_user_search')
        var roleFilter = document.getElementById('admin_user_role_filter')
        var statusFilter = document.getElementById('admin_user_status_filter')
        var sortSelect = document.getElementById('admin_user_sort')
        var rows = Array.prototype.slice.call(document.querySelectorAll('.admin-user-row'))

        var editButtons = document.querySelectorAll('.admin-user-edit')
        var statusButtons = document.querySelectorAll('.admin-user-toggle-status')
        var dependentsButtons = document.querySelectorAll('.admin-user-dependents')
        var dependentsPanel = null

        var userEditOverlay = document.getElementById('adminUserEditOverlay')
        var userEditClose = document.getElementById('adminUserEditClose')
        var userEditCancel = document.getElementById('adminUserEditCancel')
        var userEditForm = document.getElementById('adminUserEditForm')
        var userEditError = document.getElementById('adminUserEditError')
        var userEditSubtitle = document.getElementById('adminUserEditSubtitle')
        var userEditFirstname = document.getElementById('adminUserEditFirstname')
        var userEditMiddlename = document.getElementById('adminUserEditMiddlename')
        var userEditLastname = document.getElementById('adminUserEditLastname')
        var userEditContact = document.getElementById('adminUserEditContact')
        var userEditHireDate = document.getElementById('adminUserEditHireDate')
        var userEditEmail = document.getElementById('adminUserEditEmail')
        var userEditSave = document.getElementById('adminUserEditSave')
        var userEditSpinner = document.getElementById('adminUserEditSpinner')

        var userStatusOverlay = document.getElementById('adminUserStatusOverlay')
        var userStatusClose = document.getElementById('adminUserStatusClose')
        var userStatusCancel = document.getElementById('adminUserStatusCancel')
        var userStatusForm = document.getElementById('adminUserStatusForm')
        var userStatusError = document.getElementById('adminUserStatusError')
        var userStatusSubtitle = document.getElementById('adminUserStatusSubtitle')
        var userStatusSelect = document.getElementById('adminUserStatusSelect')
        var userStatusSave = document.getElementById('adminUserStatusSave')
        var userStatusSpinner = document.getElementById('adminUserStatusSpinner')

        var editingUserId = null
        var statusUserId = null

        function showInlineBox(el, message) {
            if (!el) return
            el.textContent = message || ''
            el.classList.toggle('hidden', !message)
        }

        function setUserEditSubmitting(isSubmitting) {
            if (userEditSave) userEditSave.disabled = !!isSubmitting
            if (userEditSpinner) userEditSpinner.classList.toggle('hidden', !isSubmitting)
        }

        function setUserStatusSubmitting(isSubmitting) {
            if (userStatusSave) userStatusSave.disabled = !!isSubmitting
            if (userStatusSpinner) userStatusSpinner.classList.toggle('hidden', !isSubmitting)
        }

        function formatUserFullName(user) {
            if (!user) return ''
            var parts = []
            if (user.firstname) parts.push(String(user.firstname))
            if (user.middlename) parts.push(String(user.middlename))
            if (user.lastname) parts.push(String(user.lastname))
            return parts.join(' ').trim()
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

        function openUserEditModal(user) {
            if (!userEditOverlay) return
            editingUserId = user && user.user_id ? String(user.user_id) : null
            showInlineBox(userEditError, '')
            setUserEditSubmitting(false)

            var name = formatUserFullName(user)
            if (!name) {
                name = user && user.email ? String(user.email) : ('User #' + (user && user.user_id ? user.user_id : ''))
            }
            if (userEditSubtitle) {
                userEditSubtitle.textContent = 'Editing — ' + name
            }
            if (userEditFirstname) userEditFirstname.value = user.firstname || ''
            if (userEditMiddlename) userEditMiddlename.value = user.middlename || ''
            if (userEditLastname) userEditLastname.value = user.lastname || ''
            if (userEditContact) {
                var normalizedContact = normalizePhilippinesNumber(user.contact_number || '')
                userEditContact.value = normalizedContact || '+63'
            }
            if (userEditHireDate) {
                var hireDateRaw = user && user.hire_date ? String(user.hire_date) : ''
                userEditHireDate.value = hireDateRaw ? hireDateRaw.slice(0, 10) : ''
            }
            if (userEditEmail) userEditEmail.value = user.email || ''

            userEditOverlay.classList.remove('hidden')
            userEditOverlay.classList.add('flex')
        }

        function closeUserEditModal() {
            if (!userEditOverlay) return
            userEditOverlay.classList.add('hidden')
            userEditOverlay.classList.remove('flex')
            editingUserId = null
        }

        function openUserStatusModal(user) {
            if (!userStatusOverlay) return
            statusUserId = user && user.user_id ? String(user.user_id) : null
            showInlineBox(userStatusError, '')
            setUserStatusSubmitting(false)

            var name = formatUserFullName(user)
            if (!name) {
                name = user && user.email ? String(user.email) : ('User #' + (user && user.user_id ? user.user_id : ''))
            }
            if (userStatusSubtitle) {
                userStatusSubtitle.textContent = 'Updating status — ' + name
            }
            if (userStatusSelect) {
                userStatusSelect.value = (user.status || 'active')
            }

            userStatusOverlay.classList.remove('hidden')
            userStatusOverlay.classList.add('flex')
        }

        function closeUserStatusModal() {
            if (!userStatusOverlay) return
            userStatusOverlay.classList.add('hidden')
            userStatusOverlay.classList.remove('flex')
            statusUserId = null
        }

        function fetchUser(userId) {
            return apiFetch("{{ url('/api/users') }}/" + userId, { method: 'GET' })
                .then(function (response) {
                    return response.json().then(function (data) {
                        return { ok: response.ok, status: response.status, data: data }
                    }).catch(function () {
                        return { ok: response.ok, status: response.status, data: null }
                    })
                })
        }

        if (userEditClose) userEditClose.addEventListener('click', closeUserEditModal)
        if (userEditCancel) userEditCancel.addEventListener('click', closeUserEditModal)
        if (userEditOverlay) {
            userEditOverlay.addEventListener('click', function (e) {
                if (e.target === userEditOverlay) closeUserEditModal()
            })
        }
        if (userStatusClose) userStatusClose.addEventListener('click', closeUserStatusModal)
        if (userStatusCancel) userStatusCancel.addEventListener('click', closeUserStatusModal)
        if (userStatusOverlay) {
            userStatusOverlay.addEventListener('click', function (e) {
                if (e.target === userStatusOverlay) closeUserStatusModal()
            })
        }

        editButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var userId = this.getAttribute('data-user-id')
                if (!userId) return
                showUserError('')
                showUserSuccess('')
                fetchUser(userId)
                    .then(function (result) {
                        if (!result.ok || !result.data) {
                            showUserError('Failed to load user details.')
                            return
                        }
                        openUserEditModal(result.data)
                    })
                    .catch(function () {
                        showUserError('Network error while loading user.')
                    })
            })
        })

        statusButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var userId = this.getAttribute('data-user-id')
                if (!userId) return
                showUserError('')
                showUserSuccess('')
                fetchUser(userId)
                    .then(function (result) {
                        if (!result.ok || !result.data) {
                            showUserError('Failed to load user details.')
                            return
                        }
                        openUserStatusModal(result.data)
                    })
                    .catch(function () {
                        showUserError('Network error while loading user.')
                    })
            })
        })

        if (userEditForm) {
            userEditForm.addEventListener('submit', function (e) {
                e.preventDefault()
                if (!editingUserId) return
                if (userEditSave && userEditSave.disabled) return

                showInlineBox(userEditError, '')

                var f = userEditFirstname ? String(userEditFirstname.value || '').trim() : ''
                var m = userEditMiddlename ? String(userEditMiddlename.value || '').trim() : ''
                var l = userEditLastname ? String(userEditLastname.value || '').trim() : ''
                var c = userEditContact ? String(userEditContact.value || '').trim() : ''
                var hireDate = userEditHireDate ? String(userEditHireDate.value || '').trim() : ''

                if (!isValidName(f) || !isValidName(m) || !isValidName(l)) {
                    showInlineBox(userEditError, 'Name fields must contain letters only.')
                    return
                }

                if (c && c !== '+63') {
                    if (!isValidPhilippinesNumber(c)) {
                        showInlineBox(userEditError, 'Contact number must be a valid PH number starting with +63 and 10 digits.')
                        return
                    }
                }

                confirmAction('Are you sure you want to save these changes?')
                    .then(function (confirmed) {
                        if (!confirmed) return

                        setUserEditSubmitting(true)

                        var payload = {
                            firstname: f,
                            middlename: m,
                            lastname: l,
                            email: userEditEmail ? String(userEditEmail.value || '').trim() : '',
                            contact_number: c ? normalizePhilippinesNumber(c) : '',
                            hire_date: hireDate || null
                        }

                        if (payload.firstname === '') payload.firstname = null
                        if (payload.middlename === '') payload.middlename = null
                        if (payload.lastname === '') payload.lastname = null
                        if (payload.contact_number === '' || payload.contact_number === '+63') payload.contact_number = null

                        apiFetch("{{ url('/api/users') }}/" + editingUserId, {
                            method: 'PUT',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify(payload)
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
                                    if (result.status === 422 && result.data && result.data.errors) {
                                        var firstKey = Object.keys(result.data.errors)[0]
                                        var msg = firstKey && result.data.errors[firstKey] && result.data.errors[firstKey][0] ? result.data.errors[firstKey][0] : 'Validation error.'
                                        showInlineBox(userEditError, String(msg))
                                    } else {
                                        var msg2 = (result.data && result.data.message) ? result.data.message : 'Failed to update user.'
                                        showInlineBox(userEditError, String(msg2))
                                    }
                                    return
                                }

                                closeUserEditModal()
                                showUserSuccess('Changes saved.')
                                setTimeout(function () { window.location.reload() }, 700)
                            })
                            .catch(function () {
                                showInlineBox(userEditError, 'Network error while updating user.')
                            })
                            .finally(function () {
                                setUserEditSubmitting(false)
                            })
                    })
            })
        }

        if (userStatusForm) {
            userStatusForm.addEventListener('submit', function (e) {
                e.preventDefault()
                if (!statusUserId) return
                if (userStatusSave && userStatusSave.disabled) return

                showInlineBox(userStatusError, '')

                var nextStatus = userStatusSelect ? userStatusSelect.value : ''
                if (!nextStatus) {
                    showInlineBox(userStatusError, 'Please select a status.')
                    return
                }

                confirmAction('Are you sure you want to set this status for this account?')
                    .then(function (confirmed) {
                        if (!confirmed) return

                        setUserStatusSubmitting(true)

                        apiFetch("{{ url('/api/users') }}/" + statusUserId, {
                            method: 'PUT',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({ status: nextStatus })
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
                                    var msg = (result.data && result.data.message) ? result.data.message : 'Failed to update user status.'
                                    showInlineBox(userStatusError, String(msg))
                                    return
                                }
                                closeUserStatusModal()
                                showUserSuccess('Status updated.')
                                setTimeout(function () { window.location.reload() }, 700)
                            })
                            .catch(function () {
                                showInlineBox(userStatusError, 'Network error while updating user status.')
                            })
                            .finally(function () {
                                setUserStatusSubmitting(false)
                            })
                    })
            })
        }

        function showDependents(userId) {
            if (!userId) {
                return
            }

            apiFetch("{{ url('/api/users') }}/" + userId + "/dependents", {
                method: 'GET'
            })
                .then(function (response) {
                    return response.json().then(function (data) {
                        return { ok: response.ok, data: data }
                    })
                })
                .then(function (result) {
                    if (!result.ok) {
                        return
                    }

                    var dependents = Array.isArray(result.data) ? result.data : []

                    if (!dependentsPanel) {
                        dependentsPanel = document.createElement('div')
                        dependentsPanel.className = 'mb-3 rounded-lg border border-slate-200 bg-slate-50 px-3 py-3 text-[0.78rem] text-slate-700'
                        var container = document.getElementById('adminCreateUserForm')
                        if (container && container.parentNode) {
                            container.parentNode.insertBefore(dependentsPanel, container.nextSibling)
                        }
                    }

                    if (!dependents.length) {
                        dependentsPanel.textContent = 'No dependents found for this user.'
                        return
                    }

                    function computeAge(birthdate) {
                        if (!birthdate) return null
                        var d = new Date(birthdate)
                        if (isNaN(d.getTime())) return null
                        var today = new Date()
                        var age = today.getFullYear() - d.getFullYear()
                        var m = today.getMonth() - d.getMonth()
                        if (m < 0 || (m === 0 && today.getDate() < d.getDate())) {
                            age--
                        }
                        return age
                    }

                    var html = ''
                    html += '<div class="flex items-center justify-between mb-2">' +
                        '<div class="text-[0.78rem] font-semibold text-slate-900">Dependents</div>' +
                        '<a class="text-[0.72rem] font-semibold text-slate-600 hover:text-slate-900" href="{{ url('/dashboard/patient') }}?user_id=' + encodeURIComponent(userId) + '" target="_blank" rel="noopener">Open as patient</a>' +
                        '</div>'

                    html += '<div class="overflow-x-auto scrollbar-hidden">' +
                        '<table class="min-w-full text-left text-[0.78rem] text-slate-600">' +
                        '<thead>' +
                        '<tr class="border-b border-slate-200 text-[0.68rem] uppercase tracking-widest text-slate-400">' +
                        '<th class="py-2 pr-4 font-semibold">Name</th>' +
                        '<th class="py-2 pr-4 font-semibold">Age</th>' +
                        '<th class="py-2 pr-4 font-semibold">Status</th>' +
                        '<th class="py-2 pr-4 font-semibold">Actions</th>' +
                        '</tr>' +
                        '</thead>' +
                        '<tbody>'

                    dependents.forEach(function (d) {
                        var name = ((d.firstname || '') + ' ' + (d.lastname || '')).trim()
                        if (!name) {
                            name = d.email ? d.email : ('User #' + d.user_id)
                        }
                        var age = computeAge(d.birthdate)
                        var activated = !!d.account_activated
                        var statusLabel = activated ? 'Activated' : 'Not activated'
                        var statusClass = activated ? 'bg-emerald-50 text-emerald-700 border-emerald-100' : 'bg-amber-50 text-amber-700 border-amber-100'

                        html += '<tr class="border-b border-slate-200/60 last:border-0">' +
                            '<td class="py-2 pr-4 text-slate-700">' + String(name).replace(/</g, '&lt;') + '</td>' +
                            '<td class="py-2 pr-4 text-slate-500">' + (age === null ? '—' : age) + '</td>' +
                            '<td class="py-2 pr-4">' +
                                '<span class="inline-flex items-center rounded-full px-2 py-0.5 text-[0.68rem] font-medium border ' + statusClass + '">' + statusLabel + '</span>' +
                            '</td>' +
                            '<td class="py-2 pr-4">' +
                                '<div class="flex items-center gap-2">' +
                                    '<a class="text-[0.72rem] font-semibold text-cyan-700 hover:text-cyan-800" href="{{ url('/dashboard/patient') }}?user_id=' + encodeURIComponent(d.user_id) + '" target="_blank" rel="noopener">View records</a>' +
                                    (!activated ? '<button type="button" class="text-[0.72rem] font-semibold text-emerald-700 hover:text-emerald-800 admin-dependent-activate" data-dependent-id="' + d.user_id + '">Activate account</button>' : '') +
                                '</div>' +
                            '</td>' +
                            '</tr>'
                    })

                    html += '</tbody></table></div>'

                    dependentsPanel.innerHTML = html

                    var activateButtons = dependentsPanel.querySelectorAll('.admin-dependent-activate')
                    activateButtons.forEach(function (button) {
                        button.addEventListener('click', function () {
                            var dependentId = this.getAttribute('data-dependent-id')
                            if (!dependentId) return

                            apiFetch("{{ url('/api/users') }}/" + dependentId, {
                                method: 'PUT',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    account_activated: true,
                                    status: 'active'
                                })
                            })
                                .then(function (response) {
                                    return response.json().then(function (data) {
                                        return { ok: response.ok, data: data }
                                    })
                                })
                                .then(function (r) {
                                    if (!r.ok) {
                                        showUserError('Failed to activate dependent account.')
                                        return
                                    }
                                    showDependents(userId)
                                })
                                .catch(function () {
                                    showUserError('Network error while activating dependent account.')
                                })
                        })
                    })
                })
                .catch(function () {
                })
        }

        statusButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var userId = this.getAttribute('data-user-id')
                var row = document.querySelector('.admin-user-row[data-user-id="' + userId + '"]')
                toggleUserStatus(userId, row)
            })
        })

        dependentsButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var userId = this.getAttribute('data-user-id')
                showDependents(userId)
            })
        })

        function applyUserFilters() {
            var query = searchInput ? searchInput.value.toLowerCase().trim() : ''
            var role = roleFilter ? roleFilter.value : ''
            var status = statusFilter ? statusFilter.value.toLowerCase() : ''

            rows.forEach(function (row) {
                var email = row.getAttribute('data-email') || ''
                var name = row.getAttribute('data-name') || ''
                var contact = row.getAttribute('data-contact') || ''
                var id = row.getAttribute('data-user-id') || ''
                var rowRole = row.getAttribute('data-role') || ''
                var rowStatus = row.getAttribute('data-status') || ''

                var matchesSearch = true
                if (query) {
                    matchesSearch =
                        email.indexOf(query) !== -1 ||
                        name.indexOf(query) !== -1 ||
                        contact.indexOf(query) !== -1 ||
                        ('#' + id).indexOf(query) !== -1
                }

                var matchesRole = true
                if (role) {
                    matchesRole = rowRole === role
                }

                var matchesStatus = true
                if (status) {
                    matchesStatus = rowStatus === status
                }

                row.style.display = matchesSearch && matchesRole && matchesStatus ? '' : 'none'
            })

            applyUserSort()
        }

        function applyUserSort() {
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
                if (value === 'email_asc' || value === 'email_desc') {
                    var ea = (a.getAttribute('data-email') || '').toLowerCase()
                    var eb = (b.getAttribute('data-email') || '').toLowerCase()
                    if (ea < eb) return value === 'email_asc' ? -1 : 1
                    if (ea > eb) return value === 'email_asc' ? 1 : -1
                    return 0
                }

                var ta = parseInt(a.getAttribute('data-created-ts') || '0', 10) || 0
                var tb = parseInt(b.getAttribute('data-created-ts') || '0', 10) || 0
                if (ta < tb) return value === 'created_asc' ? -1 : 1
                if (ta > tb) return value === 'created_asc' ? 1 : -1

                var ia = parseInt(a.getAttribute('data-user-id') || '0', 10) || 0
                var ib = parseInt(b.getAttribute('data-user-id') || '0', 10) || 0
                if (ia < ib) return value === 'created_asc' ? -1 : 1
                if (ia > ib) return value === 'created_asc' ? 1 : -1
                return 0
            })

            visibleRows.forEach(function (row) {
                tbody.appendChild(row)
            })
        }

        if (searchInput) {
            searchInput.addEventListener('input', applyUserFilters)
        }
        if (roleFilter) {
            roleFilter.addEventListener('change', applyUserFilters)
        }
        if (statusFilter) {
            statusFilter.addEventListener('change', applyUserFilters)
        }
        if (sortSelect) {
            sortSelect.addEventListener('change', applyUserSort)
        }

        applyUserFilters()
    })
</script>
