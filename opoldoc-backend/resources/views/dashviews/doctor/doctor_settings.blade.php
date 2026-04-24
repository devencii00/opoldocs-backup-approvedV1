<div class="bg-white border border-slate-200 rounded-[18px] p-5 shadow-[0_2px_10px_rgba(15,23,42,0.04)]">
    <div class="flex items-center justify-between mb-3">
        <h2 class="text-sm font-semibold text-slate-900">Doctor Settings</h2>
        <span class="text-[0.7rem] text-slate-400 uppercase tracking-widest">Doctor</span>
    </div>
    <p class="text-xs text-slate-500 mb-4">
        Update your profile details, change your password, and optionally upload a signature image.
    </p>

    <div class="grid gap-4 grid-cols-1 lg:grid-cols-3 text-[0.78rem] text-slate-600">
        <div class="border border-slate-100 rounded-2xl p-4 bg-slate-50/60 lg:col-span-1">
            <div class="flex items-center justify-between mb-2">
                <div>
                    <h3 class="text-xs font-semibold text-slate-900">Profile</h3>
                    <p class="text-[0.7rem] text-slate-500">Basic information shown in patient-facing records.</p>
                </div>
                <span class="material-symbols-outlined text-[18px] text-cyan-600 leading-none">account_circle</span>
            </div>

            <form id="doctorSettingsProfileForm" class="space-y-3">
                <div>
                    <label for="doctor_profile_name" class="block text-[0.7rem] text-slate-500 mb-1">Display name</label>
                    <input id="doctor_profile_name" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-[0.78rem] text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Dr. Juan Dela Cruz">
                </div>
                <div>
                    <label for="doctor_profile_specialization" class="block text-[0.7rem] text-slate-500 mb-1">Specialization</label>
                    <input id="doctor_profile_specialization" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-[0.78rem] text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Pediatrics, Internal Medicine">
                </div>
                <div>
                    <label for="doctor_profile_contact" class="block text-[0.7rem] text-slate-500 mb-1">Contact number</label>
                    <input id="doctor_profile_contact" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-[0.78rem] text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="09xx xxx xxxx">
                </div>
                <div class="flex items-center justify-between pt-1">
                    <p class="text-[0.68rem] text-slate-400">Profile settings are stored on this device for now.</p>
                    <button type="button" id="doctor_profile_save" class="inline-flex items-center gap-1 rounded-xl border border-cyan-500/40 bg-cyan-50 px-3 py-1.5 text-[0.72rem] font-semibold text-cyan-700 hover:bg-cyan-100">
                        <span class="material-symbols-outlined text-[16px] leading-none">save</span>
                        Save profile
                    </button>
                </div>
            </form>
        </div>

        <div class="border border-slate-100 rounded-2xl p-4 bg-slate-50/60 lg:col-span-1">
            <div class="flex items-center justify-between mb-2">
                <div>
                    <h3 class="text-xs font-semibold text-slate-900">Signature</h3>
                    <p class="text-[0.7rem] text-slate-500">Optional signature image for prescriptions and records.</p>
                </div>
                <span class="material-symbols-outlined text-[18px] text-slate-700 leading-none">gesture</span>
            </div>

            <form id="doctorSettingsSignatureForm" class="space-y-3">
                <div>
                    <label for="doctor_signature_file" class="block text-[0.7rem] text-slate-500 mb-1">Upload signature</label>
                    <input id="doctor_signature_file" type="file" accept="image/*" class="block w-full text-[0.78rem] text-slate-700 file:mr-3 file:rounded-lg file:border file:border-slate-200 file:bg-white file:px-3 file:py-1.5 file:text-[0.78rem] file:font-semibold file:text-slate-700 hover:file:bg-slate-50">
                </div>
                <div>
                    <div class="text-[0.7rem] text-slate-500 mb-1">Current signature</div>
                    <div id="doctor_signature_preview" class="flex items-center justify-center h-24 rounded-lg border border-dashed border-slate-300 bg-white text-[0.72rem] text-slate-400">
                        No signature uploaded yet.
                    </div>
                </div>
                <div class="flex items-center justify-between pt-1">
                    <p class="text-[0.68rem] text-slate-400">Image metadata is stored locally until API integration.</p>
                    <button type="button" id="doctor_signature_save" class="inline-flex items-center gap-1 rounded-xl border border-cyan-500/40 bg-cyan-50 px-3 py-1.5 text-[0.72rem] font-semibold text-cyan-700 hover:bg-cyan-100">
                        <span class="material-symbols-outlined text-[16px] leading-none">save</span>
                        Save signature
                    </button>
                </div>
            </form>
        </div>

        <div class="border border-slate-100 rounded-2xl p-4 bg-slate-50/60 lg:col-span-1">
            <div class="flex items-center justify-between mb-2">
                <div>
                    <h3 class="text-xs font-semibold text-slate-900">Account</h3>
                    <p class="text-[0.7rem] text-slate-500">Change your password for the doctor account.</p>
                </div>
                <span class="material-symbols-outlined text-[18px] text-slate-700 leading-none">lock</span>
            </div>

            <form id="doctorSettingsAccountForm" class="space-y-3">
                <div>
                    <label for="doctor_current_password" class="block text-[0.7rem] text-slate-500 mb-1">Current password</label>
                    <input id="doctor_current_password" type="password" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-[0.78rem] text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                </div>
                <div>
                    <label for="doctor_new_password" class="block text-[0.7rem] text-slate-500 mb-1">New password</label>
                    <input id="doctor_new_password" type="password" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-[0.78rem] text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                </div>
                <div>
                    <label for="doctor_confirm_password" class="block text-[0.7rem] text-slate-500 mb-1">Confirm new password</label>
                    <input id="doctor_confirm_password" type="password" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-[0.78rem] text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                </div>
                <div class="flex items-center justify-between pt-1">
                    <p class="text-[0.68rem] text-slate-400">Password change can be wired to the API endpoint later.</p>
                    <button type="button" id="doctor_account_save" class="inline-flex items-center gap-1 rounded-xl border border-cyan-500/40 bg-cyan-50 px-3 py-1.5 text-[0.72rem] font-semibold text-cyan-700 hover:bg-cyan-100">
                        <span class="material-symbols-outlined text-[16px] leading-none">save</span>
                        Change password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var profileName = document.getElementById('doctor_profile_name')
        var profileSpecialization = document.getElementById('doctor_profile_specialization')
        var profileContact = document.getElementById('doctor_profile_contact')
        var profileSave = document.getElementById('doctor_profile_save')

        var signatureFile = document.getElementById('doctor_signature_file')
        var signaturePreview = document.getElementById('doctor_signature_preview')
        var signatureSave = document.getElementById('doctor_signature_save')

        var currentPassword = document.getElementById('doctor_current_password')
        var newPassword = document.getElementById('doctor_new_password')
        var confirmPassword = document.getElementById('doctor_confirm_password')
        var accountSave = document.getElementById('doctor_account_save')

        var storageKey = 'opol_doctor_settings'

        function loadDoctorSettings() {
            var raw = null
            try {
                raw = window.localStorage ? window.localStorage.getItem(storageKey) : null
            } catch (_) {
                raw = null
            }
            if (!raw) return

            try {
                var config = JSON.parse(raw)
                if (profileName && config.profile_name) profileName.value = config.profile_name
                if (profileSpecialization && config.profile_specialization) profileSpecialization.value = config.profile_specialization
                if (profileContact && config.profile_contact) profileContact.value = config.profile_contact
                if (signaturePreview && config.signature_label) {
                    signaturePreview.textContent = config.signature_label
                    signaturePreview.classList.remove('text-slate-400')
                    signaturePreview.classList.add('text-slate-700')
                }
            } catch (_) {
            }
        }

        function saveProfile() {
            var raw = null
            try {
                raw = window.localStorage ? window.localStorage.getItem(storageKey) : null
            } catch (_) {
                raw = null
            }
            var config = {}
            if (raw) {
                try {
                    config = JSON.parse(raw) || {}
                } catch (_) {
                    config = {}
                }
            }
            config.profile_name = profileName ? profileName.value.trim() : ''
            config.profile_specialization = profileSpecialization ? profileSpecialization.value.trim() : ''
            config.profile_contact = profileContact ? profileContact.value.trim() : ''

            try {
                if (window.localStorage) {
                    window.localStorage.setItem(storageKey, JSON.stringify(config))
                }
            } catch (_) {
            }
        }

        function saveSignature(label) {
            var raw = null
            try {
                raw = window.localStorage ? window.localStorage.getItem(storageKey) : null
            } catch (_) {
                raw = null
            }
            var config = {}
            if (raw) {
                try {
                    config = JSON.parse(raw) || {}
                } catch (_) {
                    config = {}
                }
            }
            config.signature_label = label || 'Signature uploaded'

            try {
                if (window.localStorage) {
                    window.localStorage.setItem(storageKey, JSON.stringify(config))
                }
            } catch (_) {
            }
        }

        function handlePasswordChange() {
            var current = currentPassword ? currentPassword.value : ''
            var next = newPassword ? newPassword.value : ''
            var confirm = confirmPassword ? confirmPassword.value : ''

            if (!current || !next || !confirm) {
                window.alert('Please complete all password fields.')
                return
            }
            if (next !== confirm) {
                window.alert('New password and confirmation do not match.')
                return
            }

            window.alert('Password change wiring to the API can be implemented here.')
        }

        if (profileSave) {
            profileSave.addEventListener('click', function () {
                saveProfile()
                profileSave.classList.add('bg-cyan-100')
                setTimeout(function () {
                    profileSave.classList.remove('bg-cyan-100')
                }, 600)
            })
        }

        if (signatureSave) {
            signatureSave.addEventListener('click', function () {
                var label = 'Signature uploaded'
                if (signatureFile && signatureFile.files && signatureFile.files.length > 0) {
                    label = 'Signature: ' + signatureFile.files[0].name
                }
                if (signaturePreview) {
                    signaturePreview.textContent = label
                    signaturePreview.classList.remove('text-slate-400')
                    signaturePreview.classList.add('text-slate-700')
                }
                saveSignature(label)
            })
        }

        if (accountSave) {
            accountSave.addEventListener('click', function () {
                handlePasswordChange()
            })
        }

        loadDoctorSettings()
    })
</script>

