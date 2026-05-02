<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $currentUser = $request->user();

        $request->validate([
            'status' => ['nullable', 'in:active,inactive'],
            'is_active' => ['nullable', 'boolean'],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
        ]);

        $perPage = (int) $request->query('per_page', 15);
        if ($perPage < 1) {
            $perPage = 15;
        }
        if ($perPage > 100) {
            $perPage = 100;
        }

        $query = Service::query()->orderBy('service_name');

        if (! $currentUser || $currentUser->role !== 'admin') {
            $query->where('is_active', true);
        } else {
            if ($request->filled('status')) {
                $query->where('is_active', $request->query('status') === 'active');
            } elseif ($request->has('is_active')) {
                $query->where('is_active', $request->boolean('is_active'));
            }
        }

        return $query->paginate($perPage);
    }

    public function store(Request $request)
    {
        $currentUser = $request->user();
        if (! $currentUser || $currentUser->role !== 'admin') {
            abort(403);
        }

        $data = $request->validate([
            'service_name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'price' => ['nullable', 'numeric'],
        ]);

        $service = Service::create($data);

        return response()->json($service, 201);
    }

    public function show(Request $request, Service $service)
    {
        $currentUser = $request->user();
        if ($service->is_active === false && $currentUser && $currentUser->role !== 'admin') {
            abort(404);
        }

        return $service;
    }

    public function update(Request $request, Service $service)
    {
        $currentUser = $request->user();
        if (! $currentUser || $currentUser->role !== 'admin') {
            abort(403);
        }

        $data = $request->validate([
            'service_name' => ['sometimes', 'string'],
            'description' => ['sometimes', 'nullable', 'string'],
            'price' => ['sometimes', 'nullable', 'numeric'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $service->update($data);

        return $service->refresh();
    }

    public function destroy(Request $request, Service $service)
    {
        $currentUser = $request->user();
        if (! $currentUser || $currentUser->role !== 'admin') {
            abort(403);
        }

        $service->delete();

        return response()->json([
            'message' => 'Service deleted',
        ]);
    }
}
