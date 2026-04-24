<div class="bg-white border border-slate-200 rounded-[18px] p-5 shadow-[0_2px_10px_rgba(15,23,42,0.04)]">
    <div class="flex items-center justify-between mb-3">
        <h2 class="text-sm font-semibold text-slate-900">Settings</h2>
        <span class="text-[0.7rem] text-slate-400 uppercase tracking-widest">Admin</span>
    </div>
    <p class="text-xs text-slate-500 mb-4">
        Configure clinic information, queue behaviour, payment methods, and admin account preferences.
    </p>

    <div class="grid gap-4 grid-cols-1 lg:grid-cols-2 text-[0.78rem] text-slate-600">
        <div class="border border-slate-100 rounded-2xl p-4 bg-slate-50/60">
            <div class="flex items-center justify-between mb-2">
                <div>
                    <h3 class="text-xs font-semibold text-slate-900">Clinic Info</h3>
                    <p class="text-[0.7rem] text-slate-500">Name, address, and primary contact details.</p>
                </div>
                <span class="material-symbols-outlined text-[18px] text-cyan-600 leading-none">local_hospital</span>
            </div>

            <form id="settingsClinicForm" class="space-y-3">
                <div>
                    <label for="settings_clinic_name" class="block text-[0.7rem] text-slate-500 mb-1">Clinic name</label>
                    <input id="settings_clinic_name" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-[0.78rem] text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Opol Doctors Clinic">
                </div>
                <div>
                    <label for="settings_clinic_address" class="block text-[0.7rem] text-slate-500 mb-1">Address</label>
                    <textarea id="settings_clinic_address" rows="2" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-[0.78rem] text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Street, Barangay, City"></textarea>
                </div>
                <div>
                    <label for="settings_clinic_contact" class="block text-[0.7rem] text-slate-500 mb-1">Contact number</label>
                    <input id="settings_clinic_contact" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-[0.78rem] text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="09xx xxx xxxx">
                </div>
                <div class="flex items-center justify-between pt-1">
                    <p class="text-[0.68rem] text-slate-400">Settings are stored locally for now.</p>
                    <button type="button" id="settings_clinic_save" class="inline-flex items-center gap-1 rounded-xl border border-cyan-500/40 bg-cyan-50 px-3 py-1.5 text-[0.72rem] font-semibold text-cyan-700 hover:bg-cyan-100">
                        <span class="material-symbols-outlined text-[16px] leading-none">save</span>
                        Save clinic
                    </button>
                </div>
            </form>
        </div>

        <div class="border border-slate-100 rounded-2xl p-4 bg-slate-50/60">
            <div class="flex items-center justify-between mb-2">
                <div>
                    <h3 class="text-xs font-semibold text-slate-900">Queue Settings</h3>
                    <p class="text-[0.7rem] text-slate-500">Default max patients and queue cutoff behaviour.</p>
                </div>
                <span class="material-symbols-outlined text-[18px] text-slate-700 leading-none">schedule</span>
            </div>

            <form id="settingsQueueForm" class="space-y-3">
                <div>
                    <label for="settings_queue_max" class="block text-[0.7rem] text-slate-500 mb-1">Default max patients per doctor</label>
                    <input id="settings_queue_max" type="number" min="1" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-[0.78rem] text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="e.g. 20">
                </div>
                <div>
                    <label for="settings_queue_behavior" class="block text-[0.7rem] text-slate-500 mb-1">Queue behaviour (cutoff logic)</label>
                    <select id="settings_queue_behavior" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-[0.78rem] text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                        <option value="strict">Strict cutoff (block new entries when full)</option>
                        <option value="warn">Warn reception when near capacity</option>
                        <option value="flexible">Flexible (allow overbooking with warning)</option>
                    </select>
                </div>
                <div class="flex items-center justify-between pt-1">
                    <p class="text-[0.68rem] text-slate-400">Behaviour can later drive queue logic in the API.</p>
                    <button type="button" id="settings_queue_save" class="inline-flex items-center gap-1 rounded-xl border border-cyan-500/40 bg-cyan-50 px-3 py-1.5 text-[0.72rem] font-semibold text-cyan-700 hover:bg-cyan-100">
                        <span class="material-symbols-outlined text-[16px] leading-none">save</span>
                        Save queue
                    </button>
                </div>
            </form>
        </div>

        <div class="border border-slate-100 rounded-2xl p-4 bg-slate-50/60">
            <div class="flex items-center justify-between mb-2">
                <div>
                    <h3 class="text-xs font-semibold text-slate-900">Payment Settings</h3>
                    <p class="text-[0.7rem] text-slate-500">Toggle which payment methods are available.</p>
                </div>
                <span class="material-symbols-outlined text-[18px] text-emerald-600 leading-none">payments</span>
            </div>

            <form id="settingsPaymentForm" class="space-y-3">
                <div class="space-y-1">
                    <label class="inline-flex items-center gap-2 text-[0.78rem] text-slate-700">
                        <input id="settings_payment_cash" type="checkbox" class="rounded border-slate-300 text-cyan-600 focus:ring-cyan-500">
                        Cash
                    </label>
                    <label class="inline-flex items-center gap-2 text-[0.78rem] text-slate-700">
                        <input id="settings_payment_gcash" type="checkbox" class="rounded border-slate-300 text-cyan-600 focus:ring-cyan-500">
                        GCash
                    </label>
                    <label class="inline-flex items-center gap-2 text-[0.78rem] text-slate-700">
                        <input id="settings_payment_card" type="checkbox" class="rounded border-slate-300 text-cyan-600 focus:ring-cyan-500">
                        Card
                    </label>
                </div>
                <div class="flex items-center justify-between pt-1">
                    <p class="text-[0.68rem] text-slate-400">Use this as reference for reception billing flows.</p>
                    <button type="button" id="settings_payment_save" class="inline-flex items-center gap-1 rounded-xl border border-cyan-500/40 bg-cyan-50 px-3 py-1.5 text-[0.72rem] font-semibold text-cyan-700 hover:bg-cyan-100">
                        <span class="material-symbols-outlined text-[16px] leading-none">save</span>
                        Save payments
                    </button>
                </div>
            </form>
        </div>

        <div class="border border-slate-100 rounded-2xl p-4 bg-slate-50/60">
            <div class="flex items-center justify-between mb-2">
                <div>
                    <h3 class="text-xs font-semibold text-slate-900">Account</h3>
                    <p class="text-[0.7rem] text-slate-500">Change the current admin password.</p>
                </div>
                <span class="material-symbols-outlined text-[18px] text-slate-700 leading-none">lock</span>
            </div>

            <form id="settingsAccountForm" class="space-y-3">
                <div>
                    <label for="settings_current_password" class="block text-[0.7rem] text-slate-500 mb-1">Current password</label>
                    <input id="settings_current_password" type="password" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-[0.78rem] text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                </div>
                <div>
                    <label for="settings_new_password" class="block text-[0.7rem] text-slate-500 mb-1">New password</label>
                    <input id="settings_new_password" type="password" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-[0.78rem] text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                </div>
                <div>
                    <label for="settings_confirm_password" class="block text-[0.7rem] text-slate-500 mb-1">Confirm new password</label>
                    <input id="settings_confirm_password" type="password" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-[0.78rem] text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                </div>
                <div class="flex items-center justify-between pt-1">
                    <p class="text-[0.68rem] text-slate-400">This will call the API password change endpoint once wired.</p>
                    <button type="button" id="settings_account_save" class="inline-flex items-center gap-1 rounded-xl border border-cyan-500/40 bg-cyan-50 px-3 py-1.5 text-[0.72rem] font-semibold text-cyan-700 hover:bg-cyan-100">
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
        var clinicName = document.getElementById('settings_clinic_name')
        var clinicAddress = document.getElementById('settings_clinic_address')
        var clinicContact = document.getElementById('settings_clinic_contact')
        var clinicSave = document.getElementById('settings_clinic_save')

        var queueMax = document.getElementById('settings_queue_max')
        var queueBehavior = document.getElementById('settings_queue_behavior')
        var queueSave = document.getElementById('settings_queue_save')

        var paymentCash = document.getElementById('settings_payment_cash')
        var paymentGcash = document.getElementById('settings_payment_gcash')
        var paymentCard = document.getElementById('settings_payment_card')
        var paymentSave = document.getElementById('settings_payment_save')

        var currentPassword = document.getElementById('settings_current_password')
        var newPassword = document.getElementById('settings_new_password')
        var confirmPassword = document.getElementById('settings_confirm_password')
        var accountSave = document.getElementById('settings_account_save')

        var storageKey = 'opol_admin_settings'

        function loadSettings() {
            var raw = null
            try {
                raw = window.localStorage ? window.localStorage.getItem(storageKey) : null
            } catch (_) {
                raw = null
            }
            if (!raw) return

            try {
                var config = JSON.parse(raw)
                if (clinicName && config.clinic_name) clinicName.value = config.clinic_name
                if (clinicAddress && config.clinic_address) clinicAddress.value = config.clinic_address
                if (clinicContact && config.clinic_contact) clinicContact.value = config.clinic_contact
                if (queueMax && typeof config.queue_max === 'number') queueMax.value = String(config.queue_max)
                if (queueBehavior && config.queue_behavior) queueBehavior.value = config.queue_behavior
                if (paymentCash) paymentCash.checked = !!config.payment_cash
                if (paymentGcash) paymentGcash.checked = !!config.payment_gcash
                if (paymentCard) paymentCard.checked = !!config.payment_card
            } catch (_) {
            }
        }

        function saveClinic() {
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
            config.clinic_name = clinicName ? clinicName.value.trim() : ''
            config.clinic_address = clinicAddress ? clinicAddress.value.trim() : ''
            config.clinic_contact = clinicContact ? clinicContact.value.trim() : ''

            try {
                if (window.localStorage) {
                    window.localStorage.setItem(storageKey, JSON.stringify(config))
                }
            } catch (_) {
            }
        }

        function saveQueue() {
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
            var maxVal = queueMax ? queueMax.value.trim() : ''
            config.queue_max = maxVal ? parseInt(maxVal, 10) : null
            config.queue_behavior = queueBehavior ? queueBehavior.value : 'strict'

            try {
                if (window.localStorage) {
                    window.localStorage.setItem(storageKey, JSON.stringify(config))
                }
            } catch (_) {
            }
        }

        function savePayments() {
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
            config.payment_cash = paymentCash ? paymentCash.checked : false
            config.payment_gcash = paymentGcash ? paymentGcash.checked : false
            config.payment_card = paymentCard ? paymentCard.checked : false

            try {
                if (window.localStorage) {
                    window.localStorage.setItem(storageKey, JSON.stringify(config))
                }
            } catch (_) {
            }
        }

        function saveAccount() {
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

            window.alert('Password change wiring to API can be implemented here.')
        }

        if (clinicSave) {
            clinicSave.addEventListener('click', function () {
                saveClinic()
                clinicSave.classList.add('bg-cyan-100')
                setTimeout(function () {
                    clinicSave.classList.remove('bg-cyan-100')
                }, 600)
            })
        }

        if (queueSave) {
            queueSave.addEventListener('click', function () {
                saveQueue()
                queueSave.classList.add('bg-cyan-100')
                setTimeout(function () {
                    queueSave.classList.remove('bg-cyan-100')
                }, 600)
            })
        }

        if (paymentSave) {
            paymentSave.addEventListener('click', function () {
                savePayments()
                paymentSave.classList.add('bg-cyan-100')
                setTimeout(function () {
                    paymentSave.classList.remove('bg-cyan-100')
                }, 600)
            })
        }

        if (accountSave) {
            accountSave.addEventListener('click', function () {
                saveAccount()
            })
        }

        loadSettings()
    })
</script>
