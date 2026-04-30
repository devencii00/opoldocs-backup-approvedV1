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

    <div id="adminUserConfirmOverlay" class="hidden fixed inset-0 z-50 bg-slate-900/40 items-center justify-center p-4">
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

    <div class="mb-3 flex flex-col gap-2 md:flex-row md:items-end">
        <div class="flex-1">
            <label for="admin_user_search" class="block text-[0.7rem] text-slate-600 mb-1">Search users</label>
            <input id="admin_user_search" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Search by email or ID">
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
                        $fullName = trim(($user->firstname ?? '') . ' ' . ($user->lastname ?? ''));
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
                        data-status="{{ $status }}"
                        data-children-count="{{ $childrenCount }}">
                        <td class="py-2 pr-4 text-[0.78rem] text-slate-500">#{{ $user->user_id }}</td>
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
                        <td colspan="8" class="py-4 text-center text-[0.78rem] text-slate-400">
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

        editButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var userId = this.getAttribute('data-user-id')
                if (!userId) {
                    return
                }

                var row = document.querySelector('.admin-user-row[data-user-id="' + userId + '"]')
                if (!row) {
                    return
                }

                var emailCell = row.children[3]
                var originalEmail = emailCell.getAttribute('data-original-email') || emailCell.textContent.trim()
                emailCell.setAttribute('data-original-email', originalEmail)

                emailCell.innerHTML = '<input type="email" class="w-full rounded-lg border border-slate-200 bg-white px-2 py-1 text-[0.78rem] text-slate-800 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-200 outline-none" value="' + originalEmail + '">'

                var actionsCell = row.children[row.children.length - 1]
                actionsCell.innerHTML =
                    '<div class="flex items-center gap-2">' +
                    '<button type="button" class="text-[0.72rem] text-cyan-700 hover:text-cyan-800 font-semibold admin-user-save" data-user-id="' + userId + '">Save</button>' +
                    '<button type="button" class="text-[0.72rem] text-slate-500 hover:text-slate-700 font-semibold admin-user-cancel" data-user-id="' + userId + '">Cancel</button>' +
                    '</div>'

                var saveBtn = actionsCell.querySelector('.admin-user-save')
                var cancelBtn = actionsCell.querySelector('.admin-user-cancel')

                if (saveBtn) {
                    saveBtn.addEventListener('click', function () {
                        var input = emailCell.querySelector('input[type="email"]')
                        var newEmail = input ? input.value.trim() : ''
                        if (!newEmail) {
                            showUserError('Email is required to update the user.')
                            return
                        }

                        apiFetch("{{ url('/api/users') }}/" + userId, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({ email: newEmail })
                        })
                            .then(function (response) {
                                return response.json().then(function (data) {
                                    return { ok: response.ok, data: data }
                                })
                            })
                            .then(function (result) {
                                if (!result.ok) {
                                    var message = result.data && result.data.message ? result.data.message : 'Failed to update user.'
                                    showUserError(message)
                                    return
                                }
                                window.location.reload()
                            })
                            .catch(function () {
                                showUserError('Network error while updating user.')
                            })
                    })
                }

                if (cancelBtn) {
                    cancelBtn.addEventListener('click', function () {
                        emailCell.textContent = originalEmail
                        actionsCell.innerHTML =
                            '<div class="flex items-center gap-2">' +
                            '<button type="button" class="text-[0.72rem] text-cyan-700 hover:text-cyan-800 font-semibold admin-user-edit" data-user-id="' + userId + '">Edit</button>' +
                            (parseInt(row.getAttribute('data-children-count') || '0', 10) > 0 ? '<button type="button" class="text-[0.72rem] text-slate-700 hover:text-slate-900 font-semibold admin-user-dependents" data-user-id="' + userId + '">View dependents</button>' : '') +
                            '<button type="button" class="text-[0.72rem] text-amber-700 hover:text-amber-800 font-semibold admin-user-toggle-status" data-user-id="' + userId + '">Toggle status</button>' +
                            '</div>'
                    })
                }
            })
        })

        function toggleUserStatus(userId, row) {
            if (!userId || !row) {
                return
            }
            var currentStatus = row.getAttribute('data-status') || 'active'
            var nextStatus = currentStatus === 'suspended' || currentStatus === 'inactive' ? 'active' : 'suspended'

            apiFetch("{{ url('/api/users') }}/" + userId, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ status: nextStatus })
            })
                .then(function (response) {
                    return response.json().then(function (data) {
                        return { ok: response.ok, data: data }
                    })
                })
                .then(function (result) {
                    if (!result.ok) {
                        var message = result.data && result.data.message ? result.data.message : 'Failed to update user status.'
                        showUserError(message)
                        return
                    }
                    window.location.reload()
                })
                .catch(function () {
                    showUserError('Network error while updating user status.')
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

                var ca = a.getAttribute('data-created') || ''
                var cb = b.getAttribute('data-created') || ''
                if (ca < cb) return value === 'created_asc' ? -1 : 1
                if (ca > cb) return value === 'created_asc' ? 1 : -1
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
