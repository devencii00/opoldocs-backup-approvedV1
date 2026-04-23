<div class="bg-white border border-slate-200 rounded-[18px] p-5 shadow-[0_2px_10px_rgba(15,23,42,0.04)]">
    <div class="flex items-center justify-between mb-3">
        <h2 class="text-sm font-semibold text-slate-900">Manage users</h2>
        <span class="text-[0.7rem] text-slate-400 uppercase tracking-widest">Accounts</span>
    </div>
    <p class="text-xs text-slate-500 mb-3">
        Create and manage staff accounts using live data from the system.
    </p>

    <div id="adminUserError" class="hidden mb-3 rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-[0.75rem] text-red-700"></div>

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
        <div>
            <label for="admin_new_password" class="block text-[0.7rem] text-slate-600 mb-1">Password</label>
            <input id="admin_new_password" type="password" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" required>
        </div>
        <div class="flex items-center gap-2">
            <button type="submit" class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-cyan-600 text-white text-[0.78rem] font-semibold hover:bg-cyan-700 transition-colors">
                Create user
            </button>
        </div>
    </form>

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
                    <th class="py-2 pr-4 font-semibold">Email</th>
                    <th class="py-2 pr-4 font-semibold">Current role</th>
                    <th class="py-2 pr-4 font-semibold">Other roles</th>
                    <th class="py-2 pr-4 font-semibold">Created</th>
                    <th class="py-2 pr-4 font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($adminRecentUsers ?? [] as $user)
                    <tr class="border-b border-slate-50 last:border-0 admin-user-row" data-user-id="{{ $user->user_id }}" data-email="{{ strtolower($user->email) }}" data-role="{{ strtolower($user->role ?? '') }}" data-created="{{ optional($user->created_at)->format('Y-m-d') ?? '' }}">
                        <td class="py-2 pr-4 text-[0.78rem] text-slate-500">#{{ $user->user_id }}</td>
                        <td class="py-2 pr-4 text-[0.78rem] text-slate-700">{{ $user->email }}</td>
                        <td class="py-2 pr-4 text-[0.78rem]">
                            <span class="text-[0.78rem] text-slate-700">
                                {{ $user->role ? ucfirst($user->role) : 'None' }}
                            </span>
                        </td>
                        <td class="py-2 pr-4 text-[0.78rem]">
                            <span class="text-slate-500 text-[0.7rem]">—</span>
                        </td>
                        <td class="py-2 pr-4 text-[0.78rem] text-slate-500">
                            {{ optional($user->created_at)->format('Y-m-d') ?? '—' }}
                        </td>
                        <td class="py-2 pr-4 text-[0.78rem]">
                            <div class="flex items-center gap-2">
                                <button type="button" class="text-[0.72rem] text-cyan-700 hover:text-cyan-800 font-semibold admin-user-edit" data-user-id="{{ $user->user_id }}">
                                    Edit
                                </button>
                                <button type="button" class="text-[0.72rem] text-red-600 hover:text-red-700 font-semibold admin-user-delete" data-user-id="{{ $user->user_id }}">
                                Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-4 text-center text-[0.78rem] text-slate-400">
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

        if (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault()

                showUserError('')

                var emailInput = document.getElementById('admin_new_email')
                var roleSelect = document.getElementById('admin_new_role')
                var passwordInput = document.getElementById('admin_new_password')

                var email = emailInput ? emailInput.value : ''
                var role = roleSelect ? roleSelect.value : ''
                var password = passwordInput ? passwordInput.value : ''

                if (!email) {
                    showUserError('Email is required.')
                    return
                }

                if (!password) {
                    showUserError('Password is required.')
                    return
                }

                var body = {
                    email: email,
                    password: password,
                    role: role || 'patient'
                }

                apiFetch("{{ url('/api/users') }}", {
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
                            var message = result.data && result.data.message ? result.data.message : 'Failed to create user.'
                            showUserError(message)
                            return
                        }

                        window.location.reload()
                    })
                    .catch(function () {
                        showUserError('Network error while creating user.')
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
                if (!window.confirm('Delete this user?')) {
                    return
                }

                apiFetch("{{ url('/api/users') }}/" + userId, {
                    method: 'DELETE'
                })
                    .then(function () {
                        window.location.reload()
                    })
                    .catch(function () {
                    })
            })
        })

        var searchInput = document.getElementById('admin_user_search')
        var roleFilter = document.getElementById('admin_user_role_filter')
        var sortSelect = document.getElementById('admin_user_sort')
        var rows = Array.prototype.slice.call(document.querySelectorAll('.admin-user-row'))

        var editButtons = document.querySelectorAll('.admin-user-edit')

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

                var emailCell = row.children[1]
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
                            '<button type="button" class="text-[0.72rem] text-red-600 hover:text-red-700 font-semibold admin-user-delete" data-user-id="' + userId + '">Delete</button>' +
                            '</div>'
                    })
                }
            })
        })

        function applyUserFilters() {
            var query = searchInput ? searchInput.value.toLowerCase().trim() : ''
            var role = roleFilter ? roleFilter.value : ''

            rows.forEach(function (row) {
                var email = row.getAttribute('data-email') || ''
                var id = row.getAttribute('data-user-id') || ''
                var rowRole = row.getAttribute('data-role') || ''

                var matchesSearch = true
                if (query) {
                    matchesSearch = email.indexOf(query) !== -1 || ('#' + id).indexOf(query) !== -1
                }

                var matchesRole = true
                if (role) {
                    matchesRole = rowRole === role
                }

                row.style.display = matchesSearch && matchesRole ? '' : 'none'
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
        if (sortSelect) {
            sortSelect.addEventListener('change', applyUserSort)
        }

        applyUserFilters()
    })
</script>
