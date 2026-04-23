<div class="bg-white border border-slate-200 rounded-[18px] p-5 shadow-[0_2px_10px_rgba(15,23,42,0.04)]">
    <div class="flex items-center justify-between mb-3">
        <h2 class="text-sm font-semibold text-slate-900">System settings</h2>
        <span class="text-[0.7rem] text-slate-400 uppercase tracking-widest">Configuration</span>
    </div>
    <p class="text-xs text-slate-500 mb-4">
        Configure chatbot behaviour and review key recovery flows for your clinic system.
    </p>

    <div class="grid gap-4 grid-cols-1 lg:grid-cols-2 text-[0.78rem] text-slate-600">
        <div class="border border-slate-100 rounded-2xl p-4 bg-slate-50/60">
            <div class="flex items-center justify-between mb-2">
                <div>
                    <h3 class="text-xs font-semibold text-slate-900">Chatbot configuration</h3>
                    <p class="text-[0.7rem] text-slate-500">Define questions, options, and optional follow-up flows.</p>
                </div>
                <span class="material-symbols-outlined text-[18px] text-cyan-600 leading-none">smart_toy</span>
            </div>

            <div class="space-y-3">
                <div>
                    <label for="chatbot_welcome_question" class="block text-[0.7rem] text-slate-500 mb-1">Welcome question</label>
                    <input id="chatbot_welcome_question" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-[0.78rem] text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="How can we help you today?">
                </div>
                <div>
                    <label for="chatbot_welcome_options" class="block text-[0.7rem] text-slate-500 mb-1">Options (one per line)</label>
                    <textarea id="chatbot_welcome_options" rows="3" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-[0.78rem] text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Book an appointment&#10;Ask about discounts&#10;Talk to reception"></textarea>
                </div>
                <div class="border-t border-slate-100 pt-3 mt-1">
                    <div class="flex items-center justify-between mb-2">
                        <p class="text-[0.7rem] font-semibold text-slate-800">Follow-up question (optional)</p>
                        <span class="text-[0.68rem] text-slate-400 uppercase tracking-widest">Optional</span>
                    </div>
                    <div class="space-y-2">
                        <input id="chatbot_followup_question" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-[0.78rem] text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Ask a follow-up question (optional)">
                        <textarea id="chatbot_followup_options" rows="2" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-[0.78rem] text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Yes&#10;No"></textarea>
                    </div>
                </div>
                <div class="flex items-center justify-between pt-1">
                    <p class="text-[0.68rem] text-slate-400">Configuration is stored in this browser for now.</p>
                    <button type="button" id="chatbot_save_button" class="inline-flex items-center gap-1 rounded-xl border border-cyan-500/40 bg-cyan-50 px-3 py-1.5 text-[0.72rem] font-semibold text-cyan-700 hover:bg-cyan-100">
                        <span class="material-symbols-outlined text-[16px] leading-none">save</span>
                        Save chatbot
                    </button>
                </div>
            </div>
        </div>

        <div class="border border-slate-100 rounded-2xl p-4 bg-slate-50/60">
            <div class="flex items-center justify-between mb-2">
                <div>
                    <h3 class="text-xs font-semibold text-slate-900">Password recovery flow</h3>
                    <p class="text-[0.7rem] text-slate-500">Preview the 5-digit code and reset experience.</p>
                </div>
                <span class="material-symbols-outlined text-[18px] text-slate-700 leading-none">password</span>
            </div>

            <div class="mt-2 space-y-3">
                <div>
                    <p class="text-[0.7rem] font-semibold text-slate-700 mb-1">Step 1 – Email capture</p>
                    <div class="flex items-center gap-2">
                        <input type="email" class="flex-1 rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-[0.78rem] text-slate-500" placeholder="patient@example.com" disabled>
                        <button type="button" class="rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-[0.72rem] text-slate-500" disabled>Send code</button>
                    </div>
                </div>
                <div>
                    <p class="text-[0.7rem] font-semibold text-slate-700 mb-1">Step 2 – 5-digit code</p>
                    <div class="flex items-center gap-2">
                        <div class="flex gap-1.5">
                            <div class="w-8 h-8 rounded-lg border border-slate-200 bg-white"></div>
                            <div class="w-8 h-8 rounded-lg border border-slate-200 bg-white"></div>
                            <div class="w-8 h-8 rounded-lg border border-slate-200 bg-white"></div>
                            <div class="w-8 h-8 rounded-lg border border-slate-200 bg-white"></div>
                            <div class="w-8 h-8 rounded-lg border border-slate-200 bg-white"></div>
                        </div>
                    </div>
                </div>
                <div>
                    <p class="text-[0.7rem] font-semibold text-slate-700 mb-1">Step 3 – New password</p>
                    <div class="space-y-1">
                        <div class="h-8 rounded-lg border border-slate-200 bg-white"></div>
                        <div class="h-8 rounded-lg border border-slate-200 bg-white"></div>
                    </div>
                </div>
                <div class="pt-1">
                    <p class="text-[0.68rem] text-slate-400">
                        The live forgot password page already uses this flow, with codes generated and validated by the API.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var welcomeInput = document.getElementById('chatbot_welcome_question')
        var welcomeOptionsInput = document.getElementById('chatbot_welcome_options')
        var followupInput = document.getElementById('chatbot_followup_question')
        var followupOptionsInput = document.getElementById('chatbot_followup_options')
        var saveButton = document.getElementById('chatbot_save_button')

        var storageKey = 'opol_chatbot_config'

        function loadConfig() {
            var raw = null
            try {
                raw = window.localStorage ? window.localStorage.getItem(storageKey) : null
            } catch (_) {
                raw = null
            }

            if (!raw) {
                return
            }

            try {
                var config = JSON.parse(raw)
                if (welcomeInput && config.welcome_question) {
                    welcomeInput.value = config.welcome_question
                }
                if (welcomeOptionsInput && Array.isArray(config.welcome_options)) {
                    welcomeOptionsInput.value = config.welcome_options.join('\n')
                }
                if (followupInput && config.followup_question) {
                    followupInput.value = config.followup_question
                }
                if (followupOptionsInput && Array.isArray(config.followup_options)) {
                    followupOptionsInput.value = config.followup_options.join('\n')
                }
            } catch (_) {
            }
        }

        function saveConfig() {
            var welcomeQuestion = welcomeInput ? welcomeInput.value.trim() : ''
            var welcomeOptions = welcomeOptionsInput ? welcomeOptionsInput.value.split('\n').map(function (v) { return v.trim() }).filter(Boolean) : []
            var followupQuestion = followupInput ? followupInput.value.trim() : ''
            var followupOptions = followupOptionsInput ? followupOptionsInput.value.split('\n').map(function (v) { return v.trim() }).filter(Boolean) : []

            var config = {
                welcome_question: welcomeQuestion,
                welcome_options: welcomeOptions,
                followup_question: followupQuestion || null,
                followup_options: followupOptions
            }

            try {
                if (window.localStorage) {
                    window.localStorage.setItem(storageKey, JSON.stringify(config))
                }
            } catch (_) {
            }
        }

        if (saveButton) {
            saveButton.addEventListener('click', function () {
                saveConfig()
                saveButton.classList.add('bg-cyan-100')
                setTimeout(function () {
                    saveButton.classList.remove('bg-cyan-100')
                }, 600)
            })
        }

        loadConfig()
    })
</script>
