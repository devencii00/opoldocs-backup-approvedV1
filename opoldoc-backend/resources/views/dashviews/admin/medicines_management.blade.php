<div class="bg-white border border-slate-200 rounded-[18px] p-5 shadow-[0_2px_10px_rgba(15,23,42,0.04)]">
    <div class="flex items-center justify-between mb-3">
        <h2 class="text-sm font-semibold text-slate-900">Medicines</h2>
        <span class="text-[0.7rem] text-slate-400 uppercase tracking-widest">Management</span>
    </div>
    <p class="text-xs text-slate-500 mb-4">
        Manage medicine catalog entries and activate/deactivate them.
    </p>

    <div id="adminMedicineError" class="hidden mb-3 rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-[0.75rem] text-red-700"></div>

    <div class="mb-3 flex flex-col gap-2 md:flex-row md:items-end">
        <div class="flex-1">
            <label for="admin_medicine_search" class="block text-[0.7rem] text-slate-600 mb-1">Search</label>
            <input id="admin_medicine_search" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Generic or brand name">
        </div>
        <div class="w-full md:w-40">
            <label for="admin_medicine_active_filter" class="block text-[0.7rem] text-slate-600 mb-1">Active</label>
            <select id="admin_medicine_active_filter" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                <option value="">All</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>
    </div>

    <div class="overflow-x-auto scrollbar-hidden mb-4">
        <table class="min-w-full text-left text-xs text-slate-600">
            <thead>
                <tr class="border-b border-slate-100 text-[0.68rem] uppercase tracking-widest text-slate-400">
                    <th class="py-2 pr-4 font-semibold">Generic name</th>
                    <th class="py-2 pr-4 font-semibold">Brand name</th>
                    <th class="py-2 pr-4 font-semibold">Active</th>
                    <th class="py-2 pr-4 font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody id="admin_medicine_table_body">
                <tr>
                    <td colspan="4" class="py-4 text-center text-[0.78rem] text-slate-400">
                        Loading medicines…
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
        <div class="flex items-center justify-between mb-3">
            <div class="text-[0.8rem] font-semibold text-slate-900" id="admin_medicine_form_title">Add medicine</div>
            <button type="button" id="admin_medicine_form_reset" class="text-[0.72rem] font-semibold text-slate-600 hover:text-slate-900">Reset</button>
        </div>

        <form id="adminMedicineForm" class="grid gap-2 grid-cols-1 md:grid-cols-2">
            <div>
                <label for="admin_medicine_generic" class="block text-[0.7rem] text-slate-600 mb-1">Generic name</label>
                <input id="admin_medicine_generic" type="text" required class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Required">
            </div>
            <div>
                <label for="admin_medicine_brand" class="block text-[0.7rem] text-slate-600 mb-1">Brand name</label>
                <input id="admin_medicine_brand" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Optional">
            </div>
            <div class="md:col-span-2">
                <label for="admin_medicine_indications" class="block text-[0.7rem] text-slate-600 mb-1">Indications</label>
                <textarea id="admin_medicine_indications" rows="2" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Optional"></textarea>
            </div>
            <div class="md:col-span-2">
                <label for="admin_medicine_contraindications" class="block text-[0.7rem] text-slate-600 mb-1">Contraindications</label>
                <textarea id="admin_medicine_contraindications" rows="2" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Optional"></textarea>
            </div>
            <div class="md:col-span-2 flex items-center justify-between gap-2">
                <label class="inline-flex items-center gap-2 text-[0.78rem] text-slate-700">
                    <input id="admin_medicine_active" type="checkbox" class="rounded border-slate-300 text-cyan-600 focus:ring-cyan-500" checked>
                    Active
                </label>
                <div class="flex items-center gap-2">
                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 rounded-xl bg-cyan-600 text-white text-[0.78rem] font-semibold hover:bg-cyan-700 transition-colors">
                        Save
                    </button>
                    <button type="button" id="admin_medicine_deactivate" class="hidden inline-flex items-center justify-center px-4 py-2 rounded-xl bg-slate-900 text-white text-[0.78rem] font-semibold hover:bg-slate-800 transition-colors">
                        Deactivate
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var errorBox = document.getElementById('adminMedicineError')
        var searchInput = document.getElementById('admin_medicine_search')
        var activeFilter = document.getElementById('admin_medicine_active_filter')
        var tableBody = document.getElementById('admin_medicine_table_body')

        var formTitle = document.getElementById('admin_medicine_form_title')
        var formReset = document.getElementById('admin_medicine_form_reset')
        var form = document.getElementById('adminMedicineForm')
        var genericInput = document.getElementById('admin_medicine_generic')
        var brandInput = document.getElementById('admin_medicine_brand')
        var indicationsInput = document.getElementById('admin_medicine_indications')
        var contraindicationsInput = document.getElementById('admin_medicine_contraindications')
        var activeInput = document.getElementById('admin_medicine_active')
        var deactivateBtn = document.getElementById('admin_medicine_deactivate')

        var medicines = []
        var editingId = null

        function showError(message) {
            if (!errorBox) return
            if (!message) {
                errorBox.textContent = ''
                errorBox.classList.add('hidden')
                return
            }
            errorBox.textContent = message
            errorBox.classList.remove('hidden')
        }

        function escapeHtml(text) {
            return String(text || '')
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;')
        }

        function resetForm() {
            editingId = null
            if (formTitle) formTitle.textContent = 'Add medicine'
            if (genericInput) genericInput.value = ''
            if (brandInput) brandInput.value = ''
            if (indicationsInput) indicationsInput.value = ''
            if (contraindicationsInput) contraindicationsInput.value = ''
            if (activeInput) activeInput.checked = true
            if (deactivateBtn) deactivateBtn.classList.add('hidden')
            showError('')
        }

        function loadMedicines() {
            if (!tableBody) return
            tableBody.innerHTML = '<tr><td colspan="4" class="py-4 text-center text-[0.78rem] text-slate-400">Loading medicines…</td></tr>'
            apiFetch("{{ url('/api/medicines') }}?per_page=100", { method: 'GET' })
                .then(function (response) {
                    return response.json().then(function (data) {
                        return { ok: response.ok, data: data }
                    })
                })
                .then(function (result) {
                    if (!result.ok) {
                        showError('Failed to load medicines.')
                        medicines = []
                        renderMedicines()
                        return
                    }
                    medicines = Array.isArray(result.data.data) ? result.data.data : (Array.isArray(result.data) ? result.data : [])
                    renderMedicines()
                })
                .catch(function () {
                    showError('Network error while loading medicines.')
                    medicines = []
                    renderMedicines()
                })
        }

        function renderMedicines() {
            if (!tableBody) return

            var query = searchInput ? searchInput.value.toLowerCase().trim() : ''
            var activeVal = activeFilter ? activeFilter.value : ''

            var filtered = medicines.slice()
            if (query) {
                filtered = filtered.filter(function (m) {
                    var g = String(m.generic_name || '').toLowerCase()
                    var b = String(m.brand_name || '').toLowerCase()
                    return g.indexOf(query) !== -1 || b.indexOf(query) !== -1
                })
            }
            if (activeVal !== '') {
                var expected = activeVal === '1'
                filtered = filtered.filter(function (m) {
                    return !!m.is_active === expected
                })
            }

            if (!filtered.length) {
                tableBody.innerHTML = '<tr><td colspan="4" class="py-4 text-center text-[0.78rem] text-slate-400">No medicines found.</td></tr>'
                return
            }

            var html = ''
            filtered.forEach(function (m) {
                var active = !!m.is_active
                var badge = active
                    ? '<span class="inline-flex items-center rounded-full px-2 py-0.5 text-[0.68rem] font-medium border bg-emerald-50 text-emerald-700 border-emerald-100">Active</span>'
                    : '<span class="inline-flex items-center rounded-full px-2 py-0.5 text-[0.68rem] font-medium border bg-slate-50 text-slate-600 border-slate-100">Inactive</span>'

                html += '<tr class="border-b border-slate-50 last:border-0">' +
                    '<td class="py-2 pr-4 text-[0.78rem] text-slate-700">' + escapeHtml(m.generic_name || '—') + '</td>' +
                    '<td class="py-2 pr-4 text-[0.78rem] text-slate-500">' + (m.brand_name ? escapeHtml(m.brand_name) : '<span class="text-slate-400">—</span>') + '</td>' +
                    '<td class="py-2 pr-4 text-[0.78rem]">' + badge + '</td>' +
                    '<td class="py-2 pr-4 text-[0.78rem]">' +
                        '<div class="flex items-center gap-2">' +
                            '<button type="button" class="text-[0.72rem] font-semibold text-cyan-700 hover:text-cyan-800 admin-medicine-edit" data-id="' + m.medicine_id + '">Edit</button>' +
                            (active
                                ? '<button type="button" class="text-[0.72rem] font-semibold text-slate-700 hover:text-slate-900 admin-medicine-toggle" data-id="' + m.medicine_id + '" data-active="0">Deactivate</button>'
                                : '<button type="button" class="text-[0.72rem] font-semibold text-emerald-700 hover:text-emerald-800 admin-medicine-toggle" data-id="' + m.medicine_id + '" data-active="1">Activate</button>') +
                        '</div>' +
                    '</td>' +
                '</tr>'
            })

            tableBody.innerHTML = html
            bindTableActions()
        }

        function bindTableActions() {
            var editButtons = document.querySelectorAll('.admin-medicine-edit')
            editButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    var id = this.getAttribute('data-id')
                    var m = medicines.find(function (x) { return String(x.medicine_id) === String(id) })
                    if (!m) return
                    editingId = m.medicine_id
                    if (formTitle) formTitle.textContent = 'Edit medicine #' + editingId
                    if (genericInput) genericInput.value = m.generic_name || ''
                    if (brandInput) brandInput.value = m.brand_name || ''
                    if (indicationsInput) indicationsInput.value = m.indications || ''
                    if (contraindicationsInput) contraindicationsInput.value = m.contraindications || ''
                    if (activeInput) activeInput.checked = !!m.is_active
                    if (deactivateBtn) {
                        if (!!m.is_active) {
                            deactivateBtn.classList.remove('hidden')
                        } else {
                            deactivateBtn.classList.add('hidden')
                        }
                    }
                    showError('')
                })
            })

            var toggleButtons = document.querySelectorAll('.admin-medicine-toggle')
            toggleButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    var id = this.getAttribute('data-id')
                    var active = this.getAttribute('data-active')
                    if (!id || active === null) return
                    updateMedicine(id, { is_active: active === '1' })
                })
            })
        }

        function updateMedicine(id, body) {
            showError('')
            apiFetch("{{ url('/api/medicines') }}/" + id, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(body)
            })
                .then(function (response) {
                    return response.json().then(function (data) {
                        return { ok: response.ok, data: data }
                    })
                })
                .then(function (result) {
                    if (!result.ok) {
                        showError('Failed to update medicine.')
                        return
                    }
                    loadMedicines()
                })
                .catch(function () {
                    showError('Network error while updating medicine.')
                })
        }

        if (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault()
                showError('')
                var genericName = genericInput ? genericInput.value.trim() : ''
                if (!genericName) {
                    showError('Generic name is required.')
                    return
                }
                var body = {
                    generic_name: genericName,
                    brand_name: brandInput ? brandInput.value.trim() : '',
                    indications: indicationsInput ? indicationsInput.value.trim() : '',
                    contraindications: contraindicationsInput ? contraindicationsInput.value.trim() : '',
                    is_active: activeInput ? !!activeInput.checked : true
                }

                var url = "{{ url('/api/medicines') }}"
                var method = 'POST'
                if (editingId) {
                    url = url + '/' + editingId
                    method = 'PUT'
                }

                apiFetch(url, {
                    method: method,
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(body)
                })
                    .then(function (response) {
                        return response.json().then(function (data) {
                            return { ok: response.ok, data: data }
                        })
                    })
                    .then(function (result) {
                        if (!result.ok) {
                            showError('Failed to save medicine.')
                            return
                        }
                        resetForm()
                        loadMedicines()
                    })
                    .catch(function () {
                        showError('Network error while saving medicine.')
                    })
            })
        }

        if (deactivateBtn) {
            deactivateBtn.addEventListener('click', function () {
                if (!editingId) return
                updateMedicine(editingId, { is_active: false })
            })
        }

        if (formReset) {
            formReset.addEventListener('click', function () {
                resetForm()
            })
        }

        if (searchInput) {
            searchInput.addEventListener('input', renderMedicines)
        }
        if (activeFilter) {
            activeFilter.addEventListener('change', renderMedicines)
        }

        resetForm()
        loadMedicines()
    })
</script>

