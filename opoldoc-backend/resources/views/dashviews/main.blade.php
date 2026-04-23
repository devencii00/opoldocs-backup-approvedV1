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
@endsection
