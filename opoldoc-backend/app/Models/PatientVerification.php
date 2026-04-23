<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientVerification extends Model
{
    use HasFactory;

    protected $table = 'patient_verifications';

    protected $primaryKey = 'verification_id';

    protected $fillable = [
        'patient_id',
        'type',
        'status',
    ];

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id', 'user_id');
    }
}

