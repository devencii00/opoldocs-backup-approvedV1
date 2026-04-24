<div class="bg-white border border-slate-200 rounded-[18px] p-5 shadow-[0_2px_10px_rgba(15,23,42,0.04)]">
    <div class="flex items-center justify-between mb-3">
        <h2 class="text-sm font-semibold text-slate-900">Services Management</h2>
        <span class="text-[0.7rem] text-slate-400 uppercase tracking-widest">Services</span>
    </div>
    <p class="text-xs text-slate-500 mb-4">
        Add services, edit details, delete entries, and update prices for the clinic.
    </p>

    <div id="adminServiceError" class="hidden mb-3 rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-[0.75rem] text-red-700"></div>

    <form id="adminAddServiceForm" class="mb-4 grid gap-2 grid-cols-1 md:grid-cols-4 items-end">
        <div>
            <label for="admin_service_name" class="block text-[0.7rem] text-slate-600 mb-1">Service name</label>
            <input id="admin_service_name" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" required>
        </div>
        <div class="md:col-span-2">
            <label for="admin_service_description" class="block text-[0.7rem] text-slate-600 mb-1">Description (optional)</label>
            <input id="admin_service_description" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
        </div>
        <div class="flex items-center gap-2">
            <div class="flex-1">
                <label for="admin_service_price" class="block text-[0.7rem] text-slate-600 mb-1">Price (optional)</label>
                <input id="admin_service_price" type="number" step="0.01" min="0" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
            </div>
            <button type="submit" class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-cyan-600 text-white text-[0.78rem] font-semibold hover:bg-cyan-700 transition-colors">
                Add Service
            </button>
        </div>
    </form>

    <div class="mb-3 flex flex-col gap-2 md:flex-row md:items-end">
        <div class="flex-1">
            <label for="admin_service_search" class="block text-[0.7rem] text-slate-600 mb-1">Search services</label>
            <input id="admin_service_search" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Search by name or description">
        </div>
        <div class="w-full md:w-40">
            <label for="admin_service_sort" class="block text-[0.7rem] text-slate-600 mb-1">Sort</label>
            <select id="admin_service_sort" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                <option value="name_asc">Name A–Z</option>
                <option value="name_desc">Name Z–A</option>
                <option value="price_asc">Price low–high</option>
                <option value="price_desc">Price high–low</option>
            </select>
        </div>
    </div>

    <div class="overflow-x-auto scrollbar-hidden">
        <table class="min-w-full text-left text-xs text-slate-600">
            <thead>
                <tr class="border-b border-slate-100 text-[0.68rem] uppercase tracking-widest text-slate-400">
                    <th class="py-2 pr-4 font-semibold">ID</th>
                    <th class="py-2 pr-4 font-semibold">Service</th>
                    <th class="py-2 pr-4 font-semibold">Description</th>
                    <th class="py-2 pr-4 font-semibold">Price</th>
                    <th class="py-2 pr-4 font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody id="admin_service_table_body">
                <tr>
                    <td colspan="5" class="py-4 text-center text-[0.78rem] text-slate-400">
                        Loading services…
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var errorBox = document.getElementById('adminServiceError')
        var addForm = document.getElementById('adminAddServiceForm')
        var nameInput = document.getElementById('admin_service_name')
        var descInput = document.getElementById('admin_service_description')
        var priceInput = document.getElementById('admin_service_price')
        var searchInput = document.getElementById('admin_service_search')
        var sortSelect = document.getElementById('admin_service_sort')
        var tableBody = document.getElementById('admin_service_table_body')

        var services = []

        function showServiceError(message) {
            if (!errorBox) return
            errorBox.textContent = message || ''
            if (message) {
                errorBox.classList.remove('hidden')
            } else {
                errorBox.classList.add('hidden')
            }
        }

        function loadServices() {
            if (!tableBody) return
            tableBody.innerHTML = '<tr><td colspan="5" class="py-4 text-center text-[0.78rem] text-slate-400">Loading services…</td></tr>'

            apiFetch("{{ url('/api/services') }}", {
                method: 'GET'
            })
                .then(function (response) {
                    return response.json().then(function (data) {
                        return { ok: response.ok, data: data }
                    })
                })
                .then(function (result) {
                    if (!result.ok) {
                        tableBody.innerHTML = '<tr><td colspan="5" class="py-4 text-center text-[0.78rem] text-red-500">Failed to load services.</td></tr>'
                        return
                    }
                    var payload = result.data
                    services = Array.isArray(payload.data) ? payload.data : payload
                    renderServices()
                })
                .catch(function () {
                    tableBody.innerHTML = '<tr><td colspan="5" class="py-4 text-center text-[0.78rem] text-red-500">Network error while loading services.</td></tr>'
                })
        }

        function renderServices() {
            if (!tableBody) return

            var query = searchInput ? searchInput.value.toLowerCase().trim() : ''
            var sort = sortSelect ? sortSelect.value : 'name_asc'

            var filtered = services.slice().filter(function (service) {
                var name = (service.service_name || '').toLowerCase()
                var description = (service.description || '').toLowerCase()
                if (!query) return true
                return name.indexOf(query) !== -1 || description.indexOf(query) !== -1
            })

            filtered.sort(function (a, b) {
                if (sort === 'price_asc' || sort === 'price_desc') {
                    var pa = parseFloat(a.price || '0')
                    var pb = parseFloat(b.price || '0')
                    if (pa < pb) return sort === 'price_asc' ? -1 : 1
                    if (pa > pb) return sort === 'price_asc' ? 1 : -1
                    return 0
                }
                var na = (a.service_name || '').toLowerCase()
                var nb = (b.service_name || '').toLowerCase()
                if (na < nb) return sort === 'name_asc' ? -1 : 1
                if (na > nb) return sort === 'name_asc' ? 1 : -1
                return 0
            })

            if (!filtered.length) {
                tableBody.innerHTML = '<tr><td colspan="5" class="py-4 text-center text-[0.78rem] text-slate-400">No services found.</td></tr>'
                return
            }

            tableBody.innerHTML = ''

            filtered.forEach(function (service) {
                var tr = document.createElement('tr')
                tr.className = 'border-b border-slate-50 last:border-0'

                var price = service.price != null ? '₱' + parseFloat(service.price).toFixed(2) : '—'

                tr.innerHTML =
                    '<td class="py-2 pr-4 text-[0.78rem] text-slate-500">#' + service.service_id + '</td>' +
                    '<td class="py-2 pr-4 text-[0.78rem] text-slate-700">' + (service.service_name || '') + '</td>' +
                    '<td class="py-2 pr-4 text-[0.78rem] text-slate-500">' + (service.description || '') + '</td>' +
                    '<td class="py-2 pr-4 text-[0.78rem] text-slate-700">' + price + '</td>' +
                    '<td class="py-2 pr-4 text-[0.78rem]">' +
                        '<div class="flex items-center gap-2">' +
                            '<button type="button" class="text-[0.72rem] text-cyan-700 hover:text-cyan-800 font-semibold admin-service-edit" data-service-id="' + service.service_id + '">Edit</button>' +
                            '<button type="button" class="text-[0.72rem] text-rose-600 hover:text-rose-700 font-semibold admin-service-delete" data-service-id="' + service.service_id + '">Delete</button>' +
                        '</div>' +
                    '</td>'

                tableBody.appendChild(tr)
            })

            var editButtons = tableBody.querySelectorAll('.admin-service-edit')
            editButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    var id = this.getAttribute('data-service-id')
                    var service = services.find(function (s) { return String(s.service_id) === String(id) })
                    if (!service) return

                    var newName = window.prompt('Service name', service.service_name || '') || ''
                    var newDescription = window.prompt('Description', service.description || '') || ''
                    var pricePrompt = window.prompt('Price (leave blank for none)', service.price != null ? String(service.price) : '') || ''
                    var newPrice = pricePrompt.trim() === '' ? null : parseFloat(pricePrompt)

                    var body = {
                        service_name: newName,
                        description: newDescription
                    }
                    if (pricePrompt.trim() !== '') {
                        body.price = newPrice
                    } else {
                        body.price = null
                    }

                    apiFetch("{{ url('/api/services') }}/" + id, {
                        method: 'PUT',
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
                                showServiceError('Failed to update service.')
                                return
                            }
                            loadServices()
                        })
                        .catch(function () {
                            showServiceError('Network error while updating service.')
                        })
                })
            })

            var deleteButtons = tableBody.querySelectorAll('.admin-service-delete')
            deleteButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    var id = this.getAttribute('data-service-id')
                    if (!id) return
                    if (!window.confirm('Delete this service?')) return

                    apiFetch("{{ url('/api/services') }}/" + id, {
                        method: 'DELETE'
                    })
                        .then(function (response) {
                            return response.json().then(function (data) {
                                return { ok: response.ok, data: data }
                            })
                        })
                        .then(function (result) {
                            if (!result.ok) {
                                showServiceError('Failed to delete service.')
                                return
                            }
                            loadServices()
                        })
                        .catch(function () {
                            showServiceError('Network error while deleting service.')
                        })
                })
            })
        }

        if (addForm) {
            addForm.addEventListener('submit', function (e) {
                e.preventDefault()
                showServiceError('')

                var name = nameInput ? nameInput.value.trim() : ''
                var description = descInput ? descInput.value.trim() : ''
                var priceRaw = priceInput ? priceInput.value.trim() : ''

                if (!name) {
                    showServiceError('Service name is required.')
                    return
                }

                var body = {
                    service_name: name
                }
                if (description) {
                    body.description = description
                }
                if (priceRaw !== '') {
                    body.price = parseFloat(priceRaw)
                }

                apiFetch("{{ url('/api/services') }}", {
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
                            showServiceError('Failed to add service.')
                            return
                        }
                        if (nameInput) nameInput.value = ''
                        if (descInput) descInput.value = ''
                        if (priceInput) priceInput.value = ''
                        loadServices()
                    })
                    .catch(function () {
                        showServiceError('Network error while adding service.')
                    })
            })
        }

        if (searchInput) {
            searchInput.addEventListener('input', function () {
                renderServices()
            })
        }
        if (sortSelect) {
            sortSelect.addEventListener('change', function () {
                renderServices()
            })
        }

        loadServices()
    })
</script>

