<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        return Transaction::with('appointment')->paginate();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'appointment_id' => ['required', 'exists:appointments,appointment_id'],
            'amount' => ['required', 'numeric'],
            'discount_amount' => ['nullable', 'numeric'],
            'discount_type' => ['nullable', 'in:none,senior,pwd'],
            'payment_mode' => ['nullable', 'in:cash,gcash,card'],
            'payment_status' => ['nullable', 'in:pending,paid,failed'],
            'reference_number' => ['nullable', 'string'],
            'transaction_datetime' => ['nullable', 'date'],
            'visit_datetime' => ['nullable', 'date'],
            'diagnosis' => ['nullable', 'string'],
            'treatment_notes' => ['nullable', 'string'],
        ]);

        if (! isset($data['discount_amount'])) {
            $data['discount_amount'] = 0;
        }

        if (! isset($data['discount_type'])) {
            $data['discount_type'] = 'none';
        }

        if (! isset($data['payment_status'])) {
            $data['payment_status'] = 'pending';
        }

        $transaction = Transaction::create($data);

        return response()->json($transaction->load('appointment'), 201);
    }

    public function show(Transaction $transaction)
    {
        return $transaction->load(['appointment', 'prescriptions']);
    }

    public function update(Request $request, Transaction $transaction)
    {
        $data = $request->validate([
            'amount' => ['sometimes', 'numeric'],
            'discount_amount' => ['sometimes', 'numeric'],
            'discount_type' => ['sometimes', 'in:none,senior,pwd'],
            'payment_mode' => ['sometimes', 'in:cash,gcash,card'],
            'payment_status' => ['sometimes', 'in:pending,paid,failed'],
            'reference_number' => ['sometimes', 'nullable', 'string'],
            'transaction_datetime' => ['sometimes', 'nullable', 'date'],
            'visit_datetime' => ['sometimes', 'nullable', 'date'],
            'diagnosis' => ['sometimes', 'nullable', 'string'],
            'treatment_notes' => ['sometimes', 'nullable', 'string'],
        ]);

        $transaction->update($data);

        return $transaction->refresh()->load(['appointment', 'prescriptions']);
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return response()->json([
            'message' => 'Transaction deleted',
        ]);
    }
}

