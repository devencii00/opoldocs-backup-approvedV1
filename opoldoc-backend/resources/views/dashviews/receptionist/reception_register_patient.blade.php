<div class="bg-white border border-slate-200 rounded-[18px] p-5 shadow-[0_2px_10px_rgba(15,23,42,0.04)]">
    <div class="flex items-center justify-between mb-3">
        <div>
            <h2 class="text-sm font-semibold text-slate-900">Register patient</h2>
            <p class="text-xs text-slate-500">Create a patient account and capture basic details for front desk use.</p>
        </div>
        <span class="text-[0.7rem] text-slate-400 uppercase tracking-widest">Patients</span>
    </div>

    <div id="receptionRegisterPatientError" class="hidden mb-3 rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-[0.75rem] text-red-700"></div>
    <div id="receptionRegisterPatientSuccess" class="hidden mb-3 rounded-lg border border-emerald-200 bg-emerald-50 px-3 py-2 text-[0.75rem] text-emerald-700"></div>
    <pre id="receptionRegisterPatientCredentials" class="hidden mb-3 rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-[0.7rem] text-slate-700 overflow-x-auto"></pre>

    <form id="receptionRegisterPatientForm" class="grid gap-3 grid-cols-1 md:grid-cols-3 items-end mb-4">
        <div class="md:col-span-3">
            <label class="inline-flex items-center gap-2 text-[0.75rem] text-slate-700 font-semibold">
                <input id="reception_patient_is_dependent" type="checkbox" class="h-4 w-4 rounded border-slate-300 text-cyan-600 focus:ring-cyan-500">
                Dependent account
            </label>
            <div class="text-[0.7rem] text-slate-400 mt-1">
                Enable to link this patient as a dependent under an existing parent patient.
            </div>
        </div>

        <div id="receptionDependentParentSection" class="hidden md:col-span-3">
            <label for="reception_parent_search" class="block text-[0.7rem] text-slate-600 mb-1">Parent (search by name, email, ID)</label>
            <div class="relative">
                <input id="reception_parent_search" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Type to search parent">
                <input id="reception_parent_user_id" type="hidden">
                <div id="receptionParentResults" class="hidden absolute z-10 mt-1 w-full rounded-lg border border-slate-200 bg-white shadow-sm overflow-hidden"></div>
            </div>
            <div id="receptionParentPreview" class="hidden mt-2 rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-[0.78rem] text-slate-700"></div>
        </div>

        <div>
            <label for="reception_patient_firstname" class="block text-[0.7rem] text-slate-600 mb-1">Firstname</label>
            <input id="reception_patient_firstname" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Firstname">
        </div>
        <div>
            <label for="reception_patient_lastname" class="block text-[0.7rem] text-slate-600 mb-1">Lastname</label>
            <input id="reception_patient_lastname" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Lastname">
        </div>
        <div>
            <label for="reception_patient_birthdate" class="block text-[0.7rem] text-slate-600 mb-1">Birthdate</label>
            <input id="reception_patient_birthdate" type="date" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
        </div>
        <div>
            <label for="reception_patient_sex" class="block text-[0.7rem] text-slate-600 mb-1">Sex</label>
            <select id="reception_patient_sex" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                <option value="">Select</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        </div>
        <div>
            <label for="reception_patient_contact" class="block text-[0.7rem] text-slate-600 mb-1">Contact number</label>
            <input id="reception_patient_contact" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="09xxxxxxxxx">
        </div>
        <div class="md:col-span-3">
            <label for="reception_patient_address" class="block text-[0.7rem] text-slate-600 mb-1">Address</label>
            <input id="reception_patient_address" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Complete address">
        </div>
        <div class="md:col-span-2">
            <label for="reception_patient_email" class="block text-[0.7rem] text-slate-600 mb-1">Email (optional)</label>
            <input id="reception_patient_email" type="email" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Leave empty to auto-generate">
        </div>
        <div>
            <button id="receptionRegisterPatientSubmit" type="submit" class="w-full inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-cyan-600 text-white text-[0.78rem] font-semibold hover:bg-cyan-700 transition-colors">
                Register
            </button>
        </div>
    </form>

    <p class="text-[0.7rem] text-slate-400">
        If email is empty, the system generates a default email and password and flags the account for first login.
    </p>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var form = document.getElementById('receptionRegisterPatientForm')
        var errorBox = document.getElementById('receptionRegisterPatientError')
        var successBox = document.getElementById('receptionRegisterPatientSuccess')
        var credentialsBox = document.getElementById('receptionRegisterPatientCredentials')
        var dependentToggle = document.getElementById('reception_patient_is_dependent')
        var parentSection = document.getElementById('receptionDependentParentSection')
        var parentSearchInput = document.getElementById('reception_parent_search')
        var parentUserIdInput = document.getElementById('reception_parent_user_id')
        var parentResults = document.getElementById('receptionParentResults')
        var parentPreview = document.getElementById('receptionParentPreview')
        var submitButton = document.getElementById('receptionRegisterPatientSubmit')
        var parentSearchTimer = null
        var selectedParent = null

        function showRegisterPatientError(message) {
            if (!errorBox) return
            errorBox.textContent = message || ''
            if (message) {
                errorBox.classList.remove('hidden')
            } else {
                errorBox.classList.add('hidden')
            }
        }

        function showRegisterPatientSuccess(message) {
            if (!successBox) return
            successBox.textContent = message || ''
            if (message) {
                successBox.classList.remove('hidden')
            } else {
                successBox.classList.add('hidden')
            }
        }

        function showCredentials(payload) {
            if (!credentialsBox) return
            if (!payload) {
                credentialsBox.textContent = ''
                credentialsBox.classList.add('hidden')
                return
            }
            try {
                credentialsBox.textContent = JSON.stringify(payload, null, 2)
            } catch (_) {
                credentialsBox.textContent = String(payload)
            }
            credentialsBox.classList.remove('hidden')
        }

        function setParentSelection(parent) {
            selectedParent = parent || null
            if (parentUserIdInput) parentUserIdInput.value = parent && parent.user_id ? String(parent.user_id) : ''

            if (parentPreview) {
                if (!parent) {
                    parentPreview.textContent = ''
                    parentPreview.classList.add('hidden')
                } else {
                    var parts = []
                    var name = ((parent.firstname || '') + ' ' + (parent.lastname || '')).trim()
                    if (!name) name = 'User #' + parent.user_id
                    parts.push('Name: ' + name)
                    if (parent.email) parts.push('Email: ' + parent.email)
                    if (parent.contact_number) parts.push('Contact: ' + parent.contact_number)
                    if (parent.address) parts.push('Address: ' + parent.address)
                    parentPreview.textContent = parts.join(' • ')
                    parentPreview.classList.remove('hidden')
                }
            }

            if (parentResults) {
                parentResults.innerHTML = ''
                parentResults.classList.add('hidden')
            }
        }

        function setDependentMode(on) {
            var enabled = !!on
            if (parentSection) parentSection.classList.toggle('hidden', !enabled)
            if (submitButton) submitButton.textContent = enabled ? 'Register dependent' : 'Register patient'
            if (!enabled) {
                if (parentSearchInput) parentSearchInput.value = ''
                setParentSelection(null)
            }
        }

        if (dependentToggle) {
            dependentToggle.addEventListener('change', function () {
                setDependentMode(!!dependentToggle.checked)
            })
            setDependentMode(!!dependentToggle.checked)
        }

        function renderParentResults(items) {
            if (!parentResults) return
            var list = Array.isArray(items) ? items : []
            if (!list.length) {
                parentResults.innerHTML = '<div class="px-3 py-2 text-[0.75rem] text-slate-500">No parents found.</div>'
                parentResults.classList.remove('hidden')
                return
            }

            var html = ''
            list.forEach(function (p) {
                var name = ((p.firstname || '') + ' ' + (p.lastname || '')).trim()
                if (!name) name = 'User #' + p.user_id
                var meta = [p.email, p.contact_number].filter(Boolean).join(' • ')
                html += '<button type="button" class="w-full text-left px-3 py-2 hover:bg-slate-50 border-b border-slate-100 last:border-0">' +
                    '<div class="text-[0.78rem] text-slate-800 font-semibold">' + String(name).replace(/</g, '&lt;') + '</div>' +
                    '<div class="text-[0.72rem] text-slate-500">#' + p.user_id + (meta ? ' • ' + String(meta).replace(/</g, '&lt;') : '') + '</div>' +
                '</button>'
            })
            parentResults.innerHTML = html
            parentResults.classList.remove('hidden')

            var buttons = parentResults.querySelectorAll('button')
            Array.prototype.forEach.call(buttons, function (btn, idx) {
                btn.addEventListener('click', function () {
                    setParentSelection(list[idx])
                    if (parentSearchInput) {
                        var chosenName = ((list[idx].firstname || '') + ' ' + (list[idx].lastname || '')).trim()
                        if (!chosenName) chosenName = 'User #' + list[idx].user_id
                        parentSearchInput.value = chosenName
                    }
                })
            })
        }

        function searchParents(query) {
            if (typeof apiFetch !== 'function') return
            apiFetch("{{ url('/api/patients') }}?parents_only=1&per_page=8&search=" + encodeURIComponent(query), { method: 'GET' })
                .then(function (response) {
                    return response.json().then(function (data) {
                        return { ok: response.ok, data: data }
                    }).catch(function () {
                        return { ok: response.ok, data: null }
                    })
                })
                .then(function (result) {
                    if (!result.ok) {
                        renderParentResults([])
                        return
                    }
                    var list = []
                    if (result.data && Array.isArray(result.data.data)) {
                        list = result.data.data
                    } else if (Array.isArray(result.data)) {
                        list = result.data
                    }
                    renderParentResults(list)
                })
                .catch(function () {
                    renderParentResults([])
                })
        }

        if (parentSearchInput) {
            parentSearchInput.addEventListener('input', function () {
                var q = String(parentSearchInput.value || '').trim()
                if (parentSearchTimer) clearTimeout(parentSearchTimer)
                if (q.length < 2) {
                    if (parentResults) parentResults.classList.add('hidden')
                    return
                }
                parentSearchTimer = setTimeout(function () {
                    searchParents(q)
                }, 250)
            })
        }

        document.addEventListener('click', function (e) {
            if (!parentResults || parentResults.classList.contains('hidden')) return
            var target = e.target
            if (parentResults.contains(target)) return
            if (parentSearchInput && parentSearchInput.contains(target)) return
            parentResults.classList.add('hidden')
        })

        if (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault()

                showRegisterPatientError('')
                showRegisterPatientSuccess('')
                showCredentials(null)

                var firstnameInput = document.getElementById('reception_patient_firstname')
                var lastnameInput = document.getElementById('reception_patient_lastname')
                var birthdateInput = document.getElementById('reception_patient_birthdate')
                var sexInput = document.getElementById('reception_patient_sex')
                var contactInput = document.getElementById('reception_patient_contact')
                var addressInput = document.getElementById('reception_patient_address')
                var emailInput = document.getElementById('reception_patient_email')
                var isDependent = dependentToggle ? !!dependentToggle.checked : false
                var parentId = parentUserIdInput ? parseInt(parentUserIdInput.value || '0', 10) : 0

                if (typeof apiFetch !== 'function') {
                    showRegisterPatientError('API client is not available.')
                    return
                }

                var body = {
                    firstname: firstnameInput ? firstnameInput.value.trim() : '',
                    lastname: lastnameInput ? lastnameInput.value.trim() : '',
                    birthdate: birthdateInput ? birthdateInput.value : '',
                    sex: sexInput ? sexInput.value : '',
                    contact_number: contactInput ? contactInput.value.trim() : '',
                    address: addressInput ? addressInput.value.trim() : ''
                }

                var email = emailInput ? emailInput.value.trim() : ''
                if (email) {
                    body.email = email
                }

                var url = isDependent ? "{{ url('/api/dependents') }}" : "{{ url('/api/patients') }}"
                if (isDependent) {
                    if (!parentId) {
                        showRegisterPatientError('Please select the parent patient first.')
                        return
                    }
                    body.parent_user_id = parentId
                }

                apiFetch(url, {
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
                            var message = 'Failed to register patient.'
                            if (result.data && result.data.message) {
                                message = result.data.message
                            }
                            showRegisterPatientError(message)
                            return
                        }

                        var payload = result.data || null
                        var credentials = payload && payload.credentials ? payload.credentials : null
                        var dependent = payload && payload.dependent ? payload.dependent : null
                        var activation = payload && payload.activation ? payload.activation : null

                        if (isDependent) {
                            if (activation && activation.requires_email) {
                                showRegisterPatientSuccess('Dependent registered. ' + (activation.prompt || 'Add email to activate account.'))
                            } else {
                                showRegisterPatientSuccess('Dependent has been registered successfully.')
                            }
                            showCredentials(credentials ? { email: credentials.email, password: credentials.password } : null)
                        } else {
                            showRegisterPatientSuccess('Patient has been registered successfully.')
                            showCredentials(credentials ? { email: credentials.email, password: credentials.password } : null)
                        }

                        if (firstnameInput) firstnameInput.value = ''
                        if (lastnameInput) lastnameInput.value = ''
                        if (birthdateInput) birthdateInput.value = ''
                        if (sexInput) sexInput.value = ''
                        if (contactInput) contactInput.value = ''
                        if (addressInput) addressInput.value = ''
                        if (emailInput) emailInput.value = ''
                        if (dependentToggle) dependentToggle.checked = false
                        setDependentMode(false)
                    })
                    .catch(function () {
                        showRegisterPatientError('Network error while registering patient.')
                    })
            })
        }
    })
</script>
