<div class="bg-white border border-slate-200 rounded-[18px] p-5 shadow-[0_2px_10px_rgba(15,23,42,0.04)]">
    <div class="flex items-center justify-between mb-3">
        <div>
            <h2 class="text-sm font-semibold text-slate-900">Record payment</h2>
            <p class="text-xs text-slate-500">Create a payment transaction for a completed visit.</p>
        </div>
        <span class="text-[0.7rem] text-slate-400 uppercase tracking-widest">Billing</span>
    </div>

    <div id="receptionPaymentError" class="hidden mb-3 rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-[0.75rem] text-red-700"></div>
    <div id="receptionPaymentSuccess" class="hidden mb-3 rounded-lg border border-emerald-200 bg-emerald-50 px-3 py-2 text-[0.75rem] text-emerald-700"></div>

    <form id="receptionPaymentForm" class="grid gap-3 grid-cols-1 md:grid-cols-4 items-end mb-4">
        <div>
            <label for="reception_payment_visit_id" class="block text-[0.7rem] text-slate-600 mb-1">Visit ID</label>
            <input id="reception_payment_visit_id" type="number" min="1" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Visit ID" required>
        </div>
        <div>
            <label for="reception_payment_subtotal" class="block text-[0.7rem] text-slate-600 mb-1">Subtotal</label>
            <input id="reception_payment_subtotal" type="number" step="0.01" min="0" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="0.00" required>
        </div>
        <div>
            <label for="reception_payment_discount_amount" class="block text-[0.7rem] text-slate-600 mb-1">Discount amount (optional)</label>
            <input id="reception_payment_discount_amount" type="number" step="0.01" min="0" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="0.00">
        </div>
        <div>
            <label for="reception_payment_total" class="block text-[0.7rem] text-slate-600 mb-1">Total amount</label>
            <input id="reception_payment_total" type="number" step="0.01" min="0" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="0.00" required>
        </div>
        <div>
            <label for="reception_payment_discount_type_id" class="block text-[0.7rem] text-slate-600 mb-1">Discount type ID (optional)</label>
            <input id="reception_payment_discount_type_id" type="number" min="1" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Discount type ID">
        </div>
        <div>
            <label for="reception_payment_mode_id" class="block text-[0.7rem] text-slate-600 mb-1">Payment mode ID</label>
            <input id="reception_payment_mode_id" type="number" min="1" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Mode ID" required>
        </div>
        <div>
            <label for="reception_payment_status_id" class="block text-[0.7rem] text-slate-600 mb-1">Payment status ID</label>
            <input id="reception_payment_status_id" type="number" min="1" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Status ID" required>
        </div>
        <div>
            <label for="reception_payment_reference" class="block text-[0.7rem] text-slate-600 mb-1">Reference number (optional)</label>
            <input id="reception_payment_reference" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Reference">
        </div>
        <div>
            <label for="reception_payment_date" class="block text-[0.7rem] text-slate-600 mb-1">Transaction date</label>
            <input id="reception_payment_date" type="date" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" required>
        </div>
        <div class="md:col-span-4 flex justify-end">
            <button type="submit" class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-cyan-600 text-white text-[0.78rem] font-semibold hover:bg-cyan-700 transition-colors">
                Record payment
            </button>
        </div>
    </form>

    <p class="text-[0.7rem] text-slate-400">
        Use visit IDs and configuration values for payment modes, statuses, and discount types from the admin settings.
    </p>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var form = document.getElementById('receptionPaymentForm')
        var errorBox = document.getElementById('receptionPaymentError')
        var successBox = document.getElementById('receptionPaymentSuccess')

        function showPaymentError(message) {
            if (!errorBox) return
            errorBox.textContent = message || ''
            if (message) {
                errorBox.classList.remove('hidden')
            } else {
                errorBox.classList.add('hidden')
            }
        }

        function showPaymentSuccess(message) {
            if (!successBox) return
            successBox.textContent = message || ''
            if (message) {
                successBox.classList.remove('hidden')
            } else {
                successBox.classList.add('hidden')
            }
        }

        if (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault()

                showPaymentError('')
                showPaymentSuccess('')

                var visitInput = document.getElementById('reception_payment_visit_id')
                var subtotalInput = document.getElementById('reception_payment_subtotal')
                var discountInput = document.getElementById('reception_payment_discount_amount')
                var totalInput = document.getElementById('reception_payment_total')
                var discountTypeInput = document.getElementById('reception_payment_discount_type_id')
                var modeInput = document.getElementById('reception_payment_mode_id')
                var statusInput = document.getElementById('reception_payment_status_id')
                var referenceInput = document.getElementById('reception_payment_reference')
                var dateInput = document.getElementById('reception_payment_date')

                var visitId = visitInput ? parseInt(visitInput.value, 10) : 0
                var subtotal = subtotalInput ? parseFloat(subtotalInput.value || '0') : 0
                var discountAmount = discountInput && discountInput.value ? parseFloat(discountInput.value) : null
                var total = totalInput ? parseFloat(totalInput.value || '0') : 0
                var discountTypeId = discountTypeInput && discountTypeInput.value ? parseInt(discountTypeInput.value, 10) : null
                var paymentModeId = modeInput ? parseInt(modeInput.value, 10) : 0
                var paymentStatusId = statusInput ? parseInt(statusInput.value, 10) : 0
                var reference = referenceInput ? referenceInput.value : ''
                var date = dateInput ? dateInput.value : ''

                if (!visitId || !date || !paymentModeId || !paymentStatusId) {
                    showPaymentError('Visit, date, payment mode, and payment status are required.')
                    return
                }

                if (!subtotalInput || !totalInput || subtotal < 0 || total < 0) {
                    showPaymentError('Subtotal and total amounts must be valid.')
                    return
                }

                if (typeof apiFetch !== 'function') {
                    showPaymentError('API client is not available.')
                    return
                }

                var body = {
                    visit_id: visitId,
                    subtotal: subtotal,
                    total_amount: total,
                    payment_mode_id: paymentModeId,
                    payment_status_id: paymentStatusId,
                    transaction_date: date
                }

                if (discountAmount !== null && !isNaN(discountAmount)) {
                    body.discount_amount = discountAmount
                }
                if (discountTypeId) {
                    body.discount_type_id = discountTypeId
                }
                if (reference) {
                    body.reference_number = reference
                }

                apiFetch("{{ url('/api/transactions') }}", {
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
                            var message = 'Failed to record payment.'
                            if (result.data && result.data.message) {
                                message = result.data.message
                            }
                            showPaymentError(message)
                            return
                        }

                        showPaymentSuccess('Payment has been recorded successfully.')
                        if (visitInput) visitInput.value = ''
                        if (subtotalInput) subtotalInput.value = ''
                        if (discountInput) discountInput.value = ''
                        if (totalInput) totalInput.value = ''
                        if (discountTypeInput) discountTypeInput.value = ''
                        if (modeInput) modeInput.value = ''
                        if (statusInput) statusInput.value = ''
                        if (referenceInput) referenceInput.value = ''
                        if (dateInput) dateInput.value = ''
                    })
                    .catch(function () {
                        showPaymentError('Network error while recording payment.')
                    })
            })
        }
    })
</script>

