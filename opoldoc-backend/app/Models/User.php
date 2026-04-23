<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    protected $table = 'users';

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'parent_user_id',
        'email',
        'password_hash',
        'role',
        'status',
        'firstname',
        'lastname',
        'middlename',
        'birthdate',
        'sex',
        'address',
        'contact_number',
        'license_number',
        'specialization',
        'employee_number',
        'hire_date',
        'is_dependent',
        'account_activated',
        'relationship',
        'is_first_login',
        'password_reset_token',
        'password_reset_expires_at',
    ];

    protected $hidden = [
        'password_hash',
        'password_reset_token',
    ];

    protected $casts = [
        'birthdate' => 'date',
        'hire_date' => 'date',
        'is_dependent' => 'bool',
        'account_activated' => 'bool',
        'is_first_login' => 'bool',
        'password_reset_expires_at' => 'datetime',
    ];

    protected $appends = [
        'must_change_credentials',
        'current_role',
    ];

    public function getAuthPassword(): string
    {
        return $this->password_hash;
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_user_id', 'user_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_user_id', 'user_id');
    }

    public function getMustChangeCredentialsAttribute(): bool
    {
        return (bool) $this->is_first_login;
    }

    public function getCurrentRoleAttribute(): array
    {
        return [
            'role_name' => $this->role,
        ];
    }
}
