<?php

namespace App\Http\Controllers;

use App\Models\LogEntry;
use App\Models\PatientVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PatientVerificationController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 15);
        if ($perPage < 1) {
            $perPage = 15;
        }
        if ($perPage > 100) {
            $perPage = 100;
        }

        return PatientVerification::query()
            ->with(['patient', 'verifier'])
            ->when($request->query('status'), function ($q) use ($request) {
                $q->where('status', $request->query('status'));
            })
            ->when($request->query('type'), function ($q) use ($request) {
                $q->where('type', $request->query('type'));
            })
            ->when($request->query('patient_id'), function ($q) use ($request) {
                $q->where('patient_id', $request->query('patient_id'));
            })
            ->latest('verification_id')
            ->paginate($perPage);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'patient_id' => ['required', 'exists:users,user_id'],
            'type' => ['required', 'in:senior,pwd,pregnant'],
            'status' => ['nullable', 'in:pending,approved,rejected'],
            'document' => ['nullable', 'file', 'max:10240'],
            'document_path' => ['nullable', 'string'],
            'remarks' => ['nullable', 'string'],
        ]);

        if (! isset($data['status'])) {
            $data['status'] = 'pending';
        }

        if ($request->hasFile('document')) {
            $path = $request->file('document')->store('verifications/'.$data['patient_id'], 'public');
            $data['document_path'] = $path;
        }

        if (in_array($data['status'], ['approved', 'rejected'], true)) {
            $data['verified_by'] = optional($request->user())->user_id;
            $data['verified_at'] = now();
        }

        $verification = PatientVerification::create($data);

        return response()->json($verification->load(['patient', 'verifier']), 201);
    }

    public function show(PatientVerification $patientVerification)
    {
        return $patientVerification->load(['patient', 'verifier']);
    }

    public function update(Request $request, PatientVerification $patientVerification)
    {
        $data = $request->validate([
            'status' => ['sometimes', 'in:pending,approved,rejected'],
            'remarks' => ['sometimes', 'nullable', 'string'],
        ]);

        $originalStatus = $patientVerification->status;

        $patientVerification->update($data);

        if (array_key_exists('status', $data)) {
            if (in_array($data['status'], ['approved', 'rejected'], true)) {
                $patientVerification->verified_by = optional($request->user())->user_id;
                $patientVerification->verified_at = now();
                $patientVerification->save();
            } elseif ($data['status'] === 'pending') {
                $patientVerification->verified_by = null;
                $patientVerification->verified_at = null;
                $patientVerification->save();
            }

            LogEntry::create([
                'user_id' => optional($request->user())->user_id,
                'action' => 'patient_verification_status_changed',
                'table_name' => 'patient_verifications',
                'record_id' => $patientVerification->verification_id,
                'details' => json_encode([
                    'from' => $originalStatus,
                    'to' => $data['status'],
                    'remarks' => array_key_exists('remarks', $data) ? $data['remarks'] : null,
                ]),
                'created_at' => now(),
            ]);
        }

        return $patientVerification->refresh()->load(['patient', 'verifier']);
    }

    public function destroy(PatientVerification $patientVerification)
    {
        $patientVerification->delete();

        return response()->json([
            'message' => 'Verification deleted',
        ]);
    }

    public function stats()
    {
        $counts = PatientVerification::query()
            ->selectRaw('status, COUNT(*) as total_count')
            ->groupBy('status')
            ->pluck('total_count', 'status');

        return response()->json([
            'pending' => (int) ($counts['pending'] ?? 0),
            'approved' => (int) ($counts['approved'] ?? 0),
            'rejected' => (int) ($counts['rejected'] ?? 0),
        ]);
    }

    public function auditLogs(PatientVerification $patientVerification)
    {
        return LogEntry::with('user')
            ->where('table_name', 'patient_verifications')
            ->where('record_id', $patientVerification->verification_id)
            ->latest('created_at')
            ->limit(100)
            ->get();
    }

    public function document(PatientVerification $patientVerification)
    {
        $path = $patientVerification->document_path;
        if (! $path) {
            abort(404);
        }

        $normalized = $path;
        if (str_starts_with($normalized, 'storage/')) {
            $normalized = substr($normalized, strlen('storage/'));
        }

        if (! Storage::disk('public')->exists($normalized)) {
            abort(404);
        }

        return response()->file(Storage::disk('public')->path($normalized));
    }
}
