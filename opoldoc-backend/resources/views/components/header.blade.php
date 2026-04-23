@props(['role' => 'admin'])

@php
    $roleKey = strtolower($role ?? 'admin');
    $roleNames = [
        'admin' => 'Admin',
        'doctor' => 'Doctor',
        'receptionist' => 'Receptionist',
        'patient' => 'Patient',
    ];
    $roleLabel = $roleNames[$roleKey] ?? ucfirst($roleKey);
@endphp

<header class="sticky top-0 z-30 bg-white/85 backdrop-blur-md border-b border-slate-200 px-8 h-15 flex items-center justify-between">
    <div class="flex items-center gap-1 text-slate-400 text-[0.82rem]">
        <span>Opol Clinic</span>
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="9 18 15 12 9 6" />
        </svg>
        <span class="text-slate-500">{{ $roleLabel }}</span>
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="9 18 15 12 9 6" />
        </svg>
        <span class="text-slate-700 font-semibold">Dashboard</span>
    </div>
    <div class="relative flex items-center gap-3">
        <button id="headerNotificationButton" class="w-8.5 h-8.5 rounded-lg border border-slate-200 bg-white flex items-center justify-center text-slate-500 hover:border-cyan-400 hover:text-cyan-600 relative">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
                <path d="M13.73 21a2 2 0 0 1-3.46 0" />
            </svg>
            <span class="absolute top-1.5 right-1.5 w-1.75 h-1.75 rounded-full bg-cyan-500 border-2 border-white"></span>
        </button>

        <div id="headerNotificationPanel" class="hidden absolute right-0 top-10 w-80 max-h-80 bg-white border border-slate-200 rounded-2xl shadow-[0_10px_30px_rgba(15,23,42,0.18)] overflow-hidden">
            <div class="px-3 py-2 border-b border-slate-100 flex items-center justify-between">
                <p class="text-[0.75rem] font-semibold text-slate-800">Notifications</p>
                <span class="text-[0.65rem] text-slate-400 uppercase tracking-widest">Activity</span>
            </div>
            <div id="headerNotificationBody" class="max-h-64 overflow-y-auto scrollbar-hidden">
                <div class="px-3 py-3 text-[0.75rem] text-slate-400">
                    Loading notifications...
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    (function () {
        function headerApiFetch(path, options) {
            var token = null
            try {
                token = window.localStorage ? window.localStorage.getItem('api_token') : null
            } catch (_) {
                token = null
            }

            var headers = (options && options.headers) ? Object.assign({}, options.headers) : {}
            if (token) {
                headers['Authorization'] = 'Bearer ' + token
            }
            if (!headers['Accept']) {
                headers['Accept'] = 'application/json'
            }

            return fetch(path, Object.assign({}, options, { headers: headers }))
        }

        function renderNotifications(container, items) {
            if (!container) {
                return
            }

            if (!items || !items.length) {
                container.innerHTML = '<div class="px-3 py-3 text-[0.75rem] text-slate-400">No notifications at the moment.</div>'
                return
            }

            var html = ''
            items.forEach(function (item) {
                html += '<div class="px-3 py-2 border-b border-slate-50 last:border-0 flex gap-2">' +
                    '<div class="mt-0.5">' +
                    '<span class="material-symbols-outlined text-[16px] text-cyan-600 leading-none">' + (item.icon || 'notifications') + '</span>' +
                    '</div>' +
                    '<div class="flex-1">' +
                    '<div class="text-[0.75rem] font-semibold text-slate-800">' + item.title + '</div>' +
                    '<div class="text-[0.7rem] text-slate-500">' + item.body + '</div>' +
                    '<div class="text-[0.65rem] text-slate-400 mt-0.5">' + (item.time || '') + '</div>' +
                    '</div>' +
                    '</div>'
            })

            container.innerHTML = html
        }

        document.addEventListener('DOMContentLoaded', function () {
            var button = document.getElementById('headerNotificationButton')
            var panel = document.getElementById('headerNotificationPanel')
            var body = document.getElementById('headerNotificationBody')
            var loaded = false

            if (!button || !panel) {
                return
            }

            button.addEventListener('click', function (e) {
                e.stopPropagation()
                var isHidden = panel.classList.contains('hidden')
                if (isHidden && !loaded) {
                    if (body) {
                        body.innerHTML = '<div class="px-3 py-3 text-[0.75rem] text-slate-400">Loading notifications...</div>'
                    }
                    headerApiFetch("{{ url('/api/notifications') }}", {
                        method: 'GET'
                    })
                        .then(function (response) {
                            return response.json().then(function (data) {
                                return { ok: response.ok, data: data }
                            })
                        })
                        .then(function (result) {
                            if (!result.ok) {
                                if (body) {
                                    body.innerHTML = '<div class="px-3 py-3 text-[0.75rem] text-slate-400">Unable to load notifications.</div>'
                                }
                                return
                            }
                            loaded = true
                            renderNotifications(body, result.data.notifications || [])
                        })
                        .catch(function () {
                            if (body) {
                                body.innerHTML = '<div class="px-3 py-3 text-[0.75rem] text-slate-400">Unable to load notifications.</div>'
                            }
                        })
                }
                panel.classList.toggle('hidden')
            })

            document.addEventListener('click', function () {
                if (panel && !panel.classList.contains('hidden')) {
                    panel.classList.add('hidden')
                }
            })
        })
    })()
</script>
