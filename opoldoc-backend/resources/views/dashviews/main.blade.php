@extends('layouts.app')

@section('title', 'Dashboard')

@section('body')
<div class="flex min-h-screen">
    <x-sidebar :role="$role" />

    <div class="ml-[248px] flex-1 flex flex-col min-h-screen">
        <x-header :role="$role" />

        <div class="flex-1 p-8 md:p-5">
            @php
                $mapping = [
                    'admin' => 'admindb',
                    'doctor' => 'doctordb',
                    'receptionist' => 'receptdb',
                    'patient' => null,
                ];

                $key = $mapping[$role] ?? null;
                $viewName = $key ? 'dashviews.' . $role . '.' . $key : null;
            @endphp

            @if ($viewName)
                @includeIf($viewName)
            @endif
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var expectedRole = "{{ strtolower($role ?? 'admin') }}"
        if (typeof apiFetch !== 'function') return

        apiFetch("{{ request()->getBasePath() }}/api/user", { method: 'GET' })
            .then(function (r) { return r.json().then(function (d) { return { ok: r.ok, status: r.status, data: d } }).catch(function () { return { ok: r.ok, status: r.status, data: null } }) })
            .then(function (result) {
                if (!result.ok || !result.data) {
                    return
                }

                var actualRole = result.data && result.data.role ? String(result.data.role).toLowerCase() : ''
                var userId = result.data && result.data.user_id ? String(result.data.user_id) : ''
                if (!actualRole) return
                if (actualRole === expectedRole) return

                var target = "{{ request()->getBaseUrl() }}/dashboard/" + encodeURIComponent(actualRole)
                if (actualRole !== 'admin' && userId) {
                    target += '?user_id=' + encodeURIComponent(userId)
                }
                window.location.href = target
            })
            .catch(function () {})
    })
</script>
@endsection
