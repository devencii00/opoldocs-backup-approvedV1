<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorSchedule extends Model
{
    use HasFactory;

    protected $table = 'doctor_schedules';

    protected $primaryKey = 'schedule_id';

    protected $fillable = [
        'doctor_id',
        'start_time',
        'end_time',
        'max_patients',
    ];

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id', 'user_id');
    }

    public function days()
    {
        return $this->hasMany(DoctorScheduleDay::class, 'schedule_id');
    }
}
