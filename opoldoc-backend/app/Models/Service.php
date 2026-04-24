<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';

    protected $primaryKey = 'service_id';

    public $timestamps = false;

    protected $fillable = [
        'service_name',
        'description',
        'price',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function appointments()
    {
        return $this->belongsToMany(Appointment::class, 'appointment_services', 'service_id', 'appointment_id');
    }
}
