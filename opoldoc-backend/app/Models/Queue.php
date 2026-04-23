<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Queue extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'queues';

    protected $primaryKey = 'queue_id';

    protected $fillable = [
        'appointment_id',
        'queue_number',
        'queue_datetime',
        'status',
        'priority_level',
    ];

    protected $casts = [
        'queue_datetime' => 'datetime',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id', 'appointment_id');
    }
}

