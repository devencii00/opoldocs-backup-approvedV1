<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Queue Display — Opol Doctors Clinic</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@400;500;600&display=swap">
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0,'wght' 400,'GRAD' 0,'opsz' 24; }
        .scrollbar-hidden { scrollbar-width: none; }
        .scrollbar-hidden::-webkit-scrollbar { width: 0; height: 0; }
    </style>
</head>
<body class="min-h-screen bg-slate-950 text-white">
<div class="min-h-screen flex flex-col">
    <div class="flex items-center justify-between px-6 md:px-10 py-4 border-b border-slate-800">
        <div>
            <div class="text-[0.75rem] text-slate-400 uppercase tracking-widest">Opol Clinic</div>
            <div class="text-lg md:text-xl font-semibold text-white">Queue Display</div>
            <div class="text-[0.75rem] text-slate-400 mt-0.5">
                <span id="queueDisplayDateLabel"></span>
                @if ($doctorId)
                    · Doctor filter: #{{ $doctorId }}
                @endif
            </div>
        </div>
        <div class="flex items-center gap-2">
            <button id="queueDisplayFullscreen" type="button" class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl bg-slate-800 text-slate-100 text-[0.78rem] font-semibold hover:bg-slate-700">
                <span class="material-symbols-outlined text-[18px] leading-none">fullscreen</span>
                Full screen
            </button>
            <button id="queueDisplayRefresh" type="button" class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl bg-cyan-600 text-white text-[0.78rem] font-semibold hover:bg-cyan-700">
                <span class="material-symbols-outlined text-[18px] leading-none">refresh</span>
                Refresh
            </button>
        </div>
    </div>

    <div class="flex-1 grid grid-cols-1 lg:grid-cols-3">
        <div class="lg:col-span-2 p-6 md:p-10 flex items-center justify-center">
            <div class="w-full max-w-2xl">
                <div class="text-[0.85rem] text-cyan-300 uppercase tracking-[0.3em] mb-3">Now serving</div>
                <div id="queueNowServingCard" class="rounded-3xl bg-slate-900/60 border border-slate-700 px-6 md:px-8 py-8 shadow-[0_0_40px_rgba(8,47,73,0.7)]">
                    <div class="text-[0.9rem] text-slate-300 mb-2">Queue number</div>
                    <div id="queueNowServingNumber" class="text-6xl md:text-7xl font-serif font-bold text-white tracking-[0.25em]">---</div>
                    <div id="queueNowServingPatient" class="mt-5 text-[1rem] md:text-[1.1rem] text-white font-semibold">—</div>
                    <div id="queueNowServingDoctor" class="mt-1 text-[0.8rem] text-slate-400">—</div>
                </div>
                <div id="queueNowServingEmpty" class="hidden rounded-3xl bg-slate-900/60 border border-slate-700 px-6 md:px-8 py-8 text-center text-slate-300">
                    No queue is currently being served.
                </div>
                <div id="queueDisplayError" class="hidden mt-4 rounded-2xl border border-red-500/30 bg-red-500/10 px-4 py-3 text-[0.85rem] text-red-200"></div>
            </div>
        </div>

        <div class="border-t lg:border-t-0 lg:border-l border-slate-800 bg-slate-950/60 p-6 md:p-8">
            <div class="flex items-center justify-between mb-3">
                <div class="text-[0.85rem] text-slate-300 uppercase tracking-[0.25em]">Next patients</div>
                <div id="queueNextMeta" class="text-[0.75rem] text-slate-500"></div>
            </div>
            <div id="queueNextList" class="space-y-3 max-h-[70vh] overflow-y-auto scrollbar-hidden"></div>
        </div>
    </div>
</div>

<script>
    (function () {
        var date = @json($date);
        var doctorId = @json($doctorId);

        var dateLabel = document.getElementById('queueDisplayDateLabel');
        var btnRefresh = document.getElementById('queueDisplayRefresh');
        var btnFullscreen = document.getElementById('queueDisplayFullscreen');

        var errorBox = document.getElementById('queueDisplayError');
        var nowCard = document.getElementById('queueNowServingCard');
        var nowEmpty = document.getElementById('queueNowServingEmpty');
        var nowNumber = document.getElementById('queueNowServingNumber');
        var nowPatient = document.getElementById('queueNowServingPatient');
        var nowDoctor = document.getElementById('queueNowServingDoctor');
        var nextList = document.getElementById('queueNextList');
        var nextMeta = document.getElementById('queueNextMeta');

        function showError(message) {
            if (!errorBox) return;
            errorBox.textContent = message || '';
            errorBox.classList.toggle('hidden', !message);
        }

        function escapeHtml(value) {
            return String(value == null ? '' : value)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }

        function pad3(n) {
            var s = String(n == null ? '' : n);
            if (!s) return '---';
            while (s.length < 3) s = '0' + s;
            return s;
        }

        function render(payload) {
            if (dateLabel) dateLabel.textContent = 'Date: ' + (payload && payload.date ? payload.date : date);

            var serving = payload ? payload.now_serving : null;
            if (serving && serving.queue_number != null) {
                if (nowCard) nowCard.classList.remove('hidden');
                if (nowEmpty) nowEmpty.classList.add('hidden');
                if (nowNumber) nowNumber.textContent = pad3(serving.queue_number);
                if (nowPatient) nowPatient.textContent = (serving.patient && serving.patient.name) ? serving.patient.name : 'Patient';
                if (nowDoctor) nowDoctor.textContent = (serving.doctor && serving.doctor.name) ? ('Doctor: ' + serving.doctor.name) : 'Doctor: —';
            } else {
                if (nowCard) nowCard.classList.add('hidden');
                if (nowEmpty) nowEmpty.classList.remove('hidden');
            }

            var next = payload && Array.isArray(payload.next) ? payload.next : [];
            var counts = payload && payload.counts ? payload.counts : null;
            if (nextMeta) {
                var waitingCount = counts && counts.waiting != null ? String(counts.waiting) : '';
                nextMeta.textContent = waitingCount ? (waitingCount + ' waiting') : '';
            }

            if (!nextList) return;
            if (!next.length) {
                nextList.innerHTML = '<div class="rounded-2xl border border-slate-800 bg-slate-900/40 px-4 py-4 text-[0.85rem] text-slate-300">No patients waiting.</div>';
                return;
            }

            nextList.innerHTML = next.map(function (q) {
                var qn = q && q.queue_number != null ? pad3(q.queue_number) : '---';
                var patient = q && q.patient && q.patient.name ? q.patient.name : 'Patient';
                var doctor = q && q.doctor && q.doctor.name ? q.doctor.name : 'Doctor';
                return '' +
                    '<div class="rounded-2xl border border-slate-800 bg-slate-900/40 px-4 py-3 flex items-center justify-between gap-4">' +
                        '<div>' +
                            '<div class="text-[0.75rem] text-slate-400 mb-1">Queue #' + escapeHtml(qn) + '</div>' +
                            '<div class="text-[0.95rem] text-white font-semibold">' + escapeHtml(patient) + '</div>' +
                            '<div class="text-[0.75rem] text-slate-400 mt-0.5">Doctor: ' + escapeHtml(doctor) + '</div>' +
                        '</div>' +
                        '<div class="text-right text-[0.7rem] text-slate-400">' + (q && q.priority_level != null ? ('Priority ' + escapeHtml(q.priority_level)) : '') + '</div>' +
                    '</div>';
            }).join('');
        }

        function load() {
            showError('');
            var url = "{{ route('queue.display.data') }}" + '?date=' + encodeURIComponent(date || '');
            if (doctorId) {
                url += '&doctor_id=' + encodeURIComponent(doctorId);
            }
            fetch(url, { headers: { 'Accept': 'application/json' } })
                .then(function (res) { return res.json().then(function (data) { return { ok: res.ok, data: data }; }); })
                .then(function (result) {
                    if (!result.ok) {
                        showError('Failed to load queue display.');
                        return;
                    }
                    render(result.data);
                })
                .catch(function () {
                    showError('Network error while loading queue display.');
                });
        }

        if (btnRefresh) {
            btnRefresh.addEventListener('click', load);
        }
        if (btnFullscreen) {
            btnFullscreen.addEventListener('click', function () {
                try {
                    if (!document.fullscreenElement) {
                        document.documentElement.requestFullscreen();
                    } else {
                        document.exitFullscreen();
                    }
                } catch (_) {
                }
            });
        }

        load();
        setInterval(load, 5000);
    })();
</script>
</body>
</html>
