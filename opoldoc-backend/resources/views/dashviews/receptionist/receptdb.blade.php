@php
    $metrics = $receptionMetrics ?? [];
    $sectionKey = $section ?? 'overview';

    $newRegistrationsToday = (int) ($metrics['newRegistrationsToday'] ?? 0);
    $appointmentsToday = (int) ($metrics['appointmentsToday'] ?? 0);
    $walkInsToday = (int) ($metrics['walkInsToday'] ?? 0);
    $pendingQueueRequests = (int) ($metrics['pendingQueueRequests'] ?? 0);
    $waitingInQueue = (int) ($metrics['waitingCount'] ?? 0);
    $currentQueueCount = (int) ($metrics['currentQueueCount'] ?? 0);
    $transactionsToday = (float) ($metrics['transactionsToday'] ?? 0);
@endphp

<div class="space-y-6">
    @if ($sectionKey === 'overview')
        <div>
            <h1 class="text-2xl font-semibold text-slate-900 mb-1">Receptionist workspace</h1>
            <p class="text-sm text-slate-500">Handle registrations, appointments, and the live queue at the front desk.</p>
        </div>

        <div class="grid gap-4 grid-cols-1 lg:grid-cols-3">
            <div class="bg-white border border-slate-200 rounded-[18px] p-5 lg:col-span-2 shadow-[0_2px_10px_rgba(15,23,42,0.04)]">
                <div class="flex items-center justify-between mb-3">
                    <h2 class="text-sm font-semibold text-slate-900">Today at a glance</h2>
                    <span class="text-[0.7rem] text-slate-400 uppercase tracking-widest">Front desk</span>
                </div>
                <div class="grid gap-3 grid-cols-1 sm:grid-cols-3 text-sm text-slate-600">
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                        <div class="text-xs text-slate-500 mb-1">New registrations</div>
                        <div class="font-serif font-bold text-xl text-slate-900">{{ number_format($newRegistrationsToday) }}</div>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                        <div class="text-xs text-slate-500 mb-1">Appointments booked</div>
                        <div class="font-serif font-bold text-xl text-slate-900">{{ number_format($appointmentsToday) }}</div>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                        <div class="text-xs text-slate-500 mb-1">Waiting in queue</div>
                        <div class="font-serif font-bold text-xl text-slate-900">{{ number_format($waitingInQueue) }}</div>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                        <div class="text-xs text-slate-500 mb-1">Walk-ins</div>
                        <div class="font-serif font-bold text-xl text-slate-900">{{ number_format($walkInsToday) }}</div>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                        <div class="text-xs text-slate-500 mb-1">Pending requests</div>
                        <div class="font-serif font-bold text-xl text-slate-900">{{ number_format($pendingQueueRequests) }}</div>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                        <div class="text-xs text-slate-500 mb-1">Current queue count</div>
                        <div class="font-serif font-bold text-xl text-slate-900">{{ number_format($currentQueueCount) }}</div>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 sm:col-span-3">
                        <div class="text-xs text-slate-500 mb-1">Today&apos;s transactions (paid)</div>
                        <div class="font-serif font-bold text-xl text-slate-900">₱{{ number_format($transactionsToday, 2) }}</div>
                    </div>
                </div>

                <div class="mt-5 grid gap-3 grid-cols-1 md:grid-cols-2">
                    <div class="p-3.5 rounded-xl border border-slate-100 bg-slate-50">
                        <div class="text-xs font-semibold text-slate-700 mb-1">Upcoming appointments</div>
                        <p class="text-xs text-slate-500">Quick overview of who is scheduled next, by doctor and time slot.</p>
                    </div>
                    <div class="p-3.5 rounded-xl border border-slate-100 bg-slate-50">
                        <div class="text-xs font-semibold text-slate-700 mb-1">Queue status</div>
                        <p class="text-xs text-slate-500">Track who is waiting, being prepared, or already in consultation.</p>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-slate-200 rounded-[18px] p-5 shadow-[0_2px_10px_rgba(15,23,42,0.04)]">
                <h2 class="text-sm font-semibold text-slate-900 mb-3">Quick actions</h2>
                <div class="space-y-2">
                    <a href="{{ route('dashboard', ['role' => 'receptionist', 'section' => 'register-patient']) }}" class="block w-full px-3 py-2.5 rounded-xl bg-slate-50 text-slate-800 text-[0.85rem] font-semibold hover:bg-slate-100 border border-slate-200 transition-colors">
                        Register new patient
                    </a>
                    <a href="{{ route('dashboard', ['role' => 'receptionist', 'section' => 'book-appointment']) }}" class="block w-full px-3 py-2.5 rounded-xl bg-slate-50 text-slate-800 text-[0.85rem] font-semibold hover:bg-slate-100 border border-slate-200 transition-colors">
                        Book appointment
                    </a>
                    <a href="{{ route('dashboard', ['role' => 'receptionist', 'section' => 'walk-ins']) }}" class="block w-full px-3 py-2.5 rounded-xl bg-slate-50 text-slate-800 text-[0.85rem] font-semibold hover:bg-slate-100 border border-slate-200 transition-colors">
                        Create walk-in
                    </a>
                    <a href="{{ route('dashboard', ['role' => 'receptionist', 'section' => 'queue-management']) }}" class="block w-full px-3 py-2.5 rounded-xl bg-slate-50 text-slate-800 text-[0.85rem] font-semibold hover:bg-slate-100 border border-slate-200 transition-colors">
                        Manage queue
                    </a>
                    <a href="{{ route('dashboard', ['role' => 'receptionist', 'section' => 'verification-oversight']) }}" class="block w-full px-3 py-2.5 rounded-xl bg-slate-50 text-slate-800 text-[0.85rem] font-semibold hover:bg-slate-100 border border-slate-200 transition-colors">
                        Verification requests
                    </a>
                    <a href="{{ route('dashboard', ['role' => 'receptionist', 'section' => 'messages']) }}" class="block w-full px-3 py-2.5 rounded-xl bg-slate-50 text-slate-800 text-[0.85rem] font-semibold hover:bg-slate-100 border border-slate-200 transition-colors">
                        Messages
                    </a>
                    <a href="{{ route('dashboard', ['role' => 'receptionist', 'section' => 'record-payment']) }}" class="block w-full px-3 py-2.5 rounded-xl bg-slate-50 text-slate-800 text-[0.85rem] font-semibold hover:bg-slate-100 border border-slate-200 transition-colors">
                        Record payment
                    </a>
                </div>
            </div>
        </div>
    @else
        <div>
            <h1 class="text-2xl font-semibold text-slate-900 mb-1">Receptionist workspace</h1>
            <p class="text-sm text-slate-500">Front desk tools for queue, registrations, appointments, and billing.</p>
        </div>

        @if ($sectionKey === 'queue-management')
            @include('dashviews.receptionist.reception_queue_management')
        @elseif ($sectionKey === 'register-patient')
            @include('dashviews.receptionist.reception_register_patient')
        @elseif ($sectionKey === 'book-appointment')
            @include('dashviews.receptionist.reception_book_appointment')
        @elseif ($sectionKey === 'walk-ins')
            @include('dashviews.receptionist.reception_walk_ins')
        @elseif ($sectionKey === 'record-payment')
            @include('dashviews.receptionist.reception_record_payment')
        @elseif ($sectionKey === 'verification-oversight')
            @include('dashviews.admin.verification_approvals')
        @elseif ($sectionKey === 'messages')
            <div class="bg-white border border-slate-200 rounded-[18px] p-5 shadow-[0_2px_10px_rgba(15,23,42,0.04)]">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h2 class="text-sm font-semibold text-slate-900">Patient messages</h2>
                        <p class="text-xs text-slate-500">Chat with patients for doctor reassignment and queue updates.</p>
                    </div>
                    <button type="button" id="receptionMessagesRefresh" class="px-3 py-2 rounded-xl bg-slate-900 text-white text-[0.75rem] font-semibold hover:bg-slate-800">Refresh</button>
                </div>

                <div id="receptionMessagesError" class="hidden mb-3 rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-[0.75rem] text-red-700"></div>

                <form id="receptionMessagesOpenForm" class="grid gap-2 grid-cols-1 md:grid-cols-2 items-end mb-4">
                    <div>
                        <label for="receptionMessagesPatientId" class="block text-[0.7rem] text-slate-600 mb-1">Patient ID</label>
                        <input id="receptionMessagesPatientId" type="number" min="1" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Patient ID">
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="w-full md:w-auto px-4 py-2.5 rounded-xl bg-cyan-600 text-white text-[0.78rem] font-semibold hover:bg-cyan-700 transition-colors">Open chat</button>
                    </div>
                </form>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                    <div class="lg:col-span-1 border border-slate-100 rounded-2xl overflow-hidden">
                        <div class="px-4 py-3 bg-slate-50 border-b border-slate-100">
                            <div class="text-xs font-semibold text-slate-700">Conversations</div>
                        </div>
                        <div id="receptionConversationList" class="max-h-[520px] overflow-y-auto scrollbar-hidden bg-white"></div>
                    </div>

                    <div class="lg:col-span-2 border border-slate-100 rounded-2xl overflow-hidden flex flex-col">
                        <div class="px-4 py-3 bg-slate-50 border-b border-slate-100 flex items-center justify-between">
                            <div>
                                <div id="receptionConversationTitle" class="text-xs font-semibold text-slate-700">Select a conversation</div>
                                <div id="receptionConversationMeta" class="text-[0.7rem] text-slate-500"></div>
                            </div>
                        </div>

                        <div id="receptionMessageList" class="flex-1 bg-white p-4 space-y-2 overflow-y-auto scrollbar-hidden"></div>

                        <form id="receptionSendMessageForm" class="border-t border-slate-100 bg-white p-3 flex gap-2 items-end">
                            <div class="flex-1">
                                <label for="receptionMessageText" class="sr-only">Message</label>
                                <textarea id="receptionMessageText" rows="2" class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Type a message…" disabled></textarea>
                            </div>
                            <button id="receptionSendMessageBtn" type="submit" class="px-4 py-2.5 rounded-xl bg-slate-900 text-white text-[0.78rem] font-semibold hover:bg-slate-800 disabled:opacity-60 disabled:hover:bg-slate-900" disabled>Send</button>
                        </form>
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var errorBox = document.getElementById('receptionMessagesError')
                    var refreshBtn = document.getElementById('receptionMessagesRefresh')
                    var conversationList = document.getElementById('receptionConversationList')
                    var messageList = document.getElementById('receptionMessageList')
                    var titleEl = document.getElementById('receptionConversationTitle')
                    var metaEl = document.getElementById('receptionConversationMeta')
                    var openForm = document.getElementById('receptionMessagesOpenForm')
                    var patientIdInput = document.getElementById('receptionMessagesPatientId')
                    var sendForm = document.getElementById('receptionSendMessageForm')
                    var messageText = document.getElementById('receptionMessageText')
                    var sendBtn = document.getElementById('receptionSendMessageBtn')

                    var conversations = []
                    var selectedConversation = null

                    function showError(message) {
                        if (!errorBox) return
                        errorBox.textContent = message || ''
                        errorBox.classList.toggle('hidden', !message)
                    }

                    function escapeHtml(input) {
                        var s = String(input == null ? '' : input)
                        return s
                            .replace(/&/g, '&amp;')
                            .replace(/</g, '&lt;')
                            .replace(/>/g, '&gt;')
                            .replace(/"/g, '&quot;')
                            .replace(/'/g, '&#039;')
                    }

                    function nameForUser(user) {
                        if (!user) return ''
                        var parts = [user.firstname, user.middlename, user.lastname].filter(function (v) { return String(v || '').trim() !== '' })
                        var name = parts.join(' ').trim()
                        if (!name) name = 'User #' + (user.user_id || '')
                        return name
                    }

                    function setSelectedConversation(convo) {
                        selectedConversation = convo || null
                        if (!selectedConversation) {
                            if (titleEl) titleEl.textContent = 'Select a conversation'
                            if (metaEl) metaEl.textContent = ''
                            if (messageText) messageText.disabled = true
                            if (sendBtn) sendBtn.disabled = true
                            if (messageList) messageList.innerHTML = ''
                            return
                        }

                        var patientName = nameForUser(selectedConversation.user)
                        var meta = ['Conversation #' + selectedConversation.conversation_id]

                        if (titleEl) titleEl.textContent = patientName
                        if (metaEl) metaEl.textContent = meta.join(' · ')
                        if (messageText) messageText.disabled = false
                        if (sendBtn) sendBtn.disabled = false
                        loadMessages(selectedConversation.conversation_id)
                    }

                    function renderConversations() {
                        if (!conversationList) return
                        if (!conversations.length) {
                            conversationList.innerHTML = '<div class="p-4 text-[0.78rem] text-slate-400">No conversations yet.</div>'
                            return
                        }

                        var html = ''
                        conversations.forEach(function (c) {
                            var patientName = escapeHtml(nameForUser(c.user))
                            var subtitle = ['Conversation #' + c.conversation_id]
                            var isActive = selectedConversation && String(selectedConversation.conversation_id) === String(c.conversation_id)
                            html += '<button type="button" class="w-full text-left px-4 py-3 border-b border-slate-100 hover:bg-slate-50 ' + (isActive ? 'bg-slate-50' : '') + '" data-conversation-id="' + c.conversation_id + '">' +
                                '<div class="flex items-start justify-between gap-3">' +
                                    '<div>' +
                                        '<div class="text-[0.8rem] font-semibold text-slate-800">' + patientName + '</div>' +
                                        '<div class="text-[0.7rem] text-slate-500 mt-0.5">' + escapeHtml(subtitle.join(' · ')) + '</div>' +
                                    '</div>' +
                                    '<div class="text-[0.7rem] text-slate-400">' + (c.messages_count != null ? ('(' + c.messages_count + ')') : '') + '</div>' +
                                '</div>' +
                            '</button>'
                        })
                        conversationList.innerHTML = html

                        var buttons = conversationList.querySelectorAll('button[data-conversation-id]')
                        buttons.forEach(function (btn) {
                            btn.addEventListener('click', function () {
                                var id = this.getAttribute('data-conversation-id')
                                var convo = conversations.find(function (x) { return String(x.conversation_id) === String(id) })
                                setSelectedConversation(convo || null)
                                renderConversations()
                            })
                        })
                    }

                    function loadConversations(selectConversationId) {
                        showError('')
                        if (conversationList) conversationList.innerHTML = '<div class="p-4 text-[0.78rem] text-slate-400">Loading…</div>'

                        apiFetch("{{ url('/api/conversations') }}?per_page=50", { method: 'GET' })
                            .then(function (response) {
                                return response.json().then(function (data) { return { ok: response.ok, data: data } })
                            })
                            .then(function (result) {
                                if (!result.ok) {
                                    showError('Failed to load conversations.')
                                    if (conversationList) conversationList.innerHTML = ''
                                    return
                                }
                                var payload = result.data
                                conversations = Array.isArray(payload.data) ? payload.data : (Array.isArray(payload) ? payload : [])
                                if (selectConversationId) {
                                    var convo = conversations.find(function (x) { return String(x.conversation_id) === String(selectConversationId) })
                                    if (convo) selectedConversation = convo
                                }
                                renderConversations()
                                if (selectedConversation) {
                                    setSelectedConversation(selectedConversation)
                                } else {
                                    setSelectedConversation(null)
                                }
                            })
                            .catch(function () {
                                showError('Network error while loading conversations.')
                                if (conversationList) conversationList.innerHTML = ''
                            })
                    }

                    function loadMessages(conversationId) {
                        if (!messageList || !conversationId) return
                        messageList.innerHTML = '<div class="text-[0.78rem] text-slate-400">Loading messages…</div>'

                        apiFetch("{{ url('/api/conversations') }}/" + encodeURIComponent(conversationId) + "/messages?per_page=100", { method: 'GET' })
                            .then(function (response) {
                                return response.json().then(function (data) { return { ok: response.ok, data: data } })
                            })
                            .then(function (result) {
                                if (!result.ok) {
                                    messageList.innerHTML = '<div class="text-[0.78rem] text-red-500">Failed to load messages.</div>'
                                    return
                                }
                                var payload = result.data
                                var items = Array.isArray(payload.data) ? payload.data : (Array.isArray(payload) ? payload : [])
                                items = items.slice().reverse()
                                if (!items.length) {
                                    messageList.innerHTML = '<div class="text-[0.78rem] text-slate-400">No messages yet.</div>'
                                    return
                                }

                                var html = ''
                                items.forEach(function (m) {
                                    var isPatient = m.sender === 'user'
                                    var bubbleClass = isPatient ? 'bg-slate-100 text-slate-800' : 'bg-cyan-600 text-white'
                                    var alignClass = isPatient ? 'justify-start' : 'justify-end'
                                    var senderName = isPatient ? 'Patient' : 'Receptionist/System'
                                    html += '<div class="flex ' + alignClass + '">' +
                                        '<div class="max-w-[85%] rounded-2xl px-3 py-2 ' + bubbleClass + '">' +
                                            '<div class="text-[0.68rem] opacity-80 mb-1">' + escapeHtml(senderName) + '</div>' +
                                            '<div class="text-[0.8rem] whitespace-pre-wrap break-words">' + escapeHtml(m.message_text || '') + '</div>' +
                                        '</div>' +
                                    '</div>'
                                })
                                messageList.innerHTML = html
                                messageList.scrollTop = messageList.scrollHeight
                            })
                            .catch(function () {
                                messageList.innerHTML = '<div class="text-[0.78rem] text-red-500">Network error while loading messages.</div>'
                            })
                    }

                    if (refreshBtn) {
                        refreshBtn.addEventListener('click', function () {
                            loadConversations(selectedConversation ? selectedConversation.conversation_id : null)
                        })
                    }

                    if (openForm) {
                        openForm.addEventListener('submit', function (e) {
                            e.preventDefault()
                            showError('')
                            var pid = patientIdInput ? String(patientIdInput.value || '').trim() : ''
                            if (!pid) {
                                showError('Patient ID is required to open a chat.')
                                return
                            }

                            var body = { patient_id: parseInt(pid, 10) }

                            apiFetch("{{ url('/api/conversations') }}", {
                                method: 'POST',
                                headers: { 'Content-Type': 'application/json' },
                                body: JSON.stringify(body)
                            })
                                .then(function (response) {
                                    return response.json().then(function (data) { return { ok: response.ok, data: data } })
                                })
                                .then(function (result) {
                                    if (!result.ok) {
                                        showError('Failed to open conversation.')
                                        return
                                    }
                                    var convo = result.data
                                    loadConversations(convo && convo.conversation_id ? convo.conversation_id : null)
                                })
                                .catch(function () {
                                    showError('Network error while opening conversation.')
                                })
                        })
                    }

                    if (sendForm) {
                        sendForm.addEventListener('submit', function (e) {
                            e.preventDefault()
                            showError('')
                            if (!selectedConversation) return
                            var text = messageText ? String(messageText.value || '').trim() : ''
                            if (!text) return

                            if (sendBtn) sendBtn.disabled = true

                            apiFetch("{{ url('/api/conversations') }}/" + encodeURIComponent(selectedConversation.conversation_id) + "/messages", {
                                method: 'POST',
                                headers: { 'Content-Type': 'application/json' },
                                body: JSON.stringify({ message_text: text })
                            })
                                .then(function (response) {
                                    return response.json().then(function (data) { return { ok: response.ok, data: data } })
                                })
                                .then(function (result) {
                                    if (!result.ok) {
                                        showError('Failed to send message.')
                                        return
                                    }
                                    if (messageText) messageText.value = ''
                                    loadMessages(selectedConversation.conversation_id)
                                    loadConversations(selectedConversation.conversation_id)
                                })
                                .catch(function () {
                                    showError('Network error while sending message.')
                                })
                                .finally(function () {
                                    if (sendBtn) sendBtn.disabled = false
                                })
                        })
                    }

                    loadConversations()
                })
            </script>
        @endif
    @endif
</div>
