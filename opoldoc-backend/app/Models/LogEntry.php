<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogEntry extends Model
{
    use HasFactory;

    protected $table = 'logs';

    protected $primaryKey = 'log_id';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'action',
        'table_name',
        'record_id',
        'details',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
