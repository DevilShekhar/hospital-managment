<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, HasRoles, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'name',
        'employee_id',
        'email',
        'mobile',
        'gender',
        'dob',
        'department_id',
        'password',
        'photo',
        'status',
        'address',
        'city',
        'state',
        'pincode',
        'status',
        'role_id',
        'specialist_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    // Relationship with Department
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function specialist()
{
    return $this->belongsTo(Specialist::class, 'specialist_id');
}
}  
