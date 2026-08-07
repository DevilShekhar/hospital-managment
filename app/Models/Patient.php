<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Department;
use App\Models\Doctor;

class Patient extends Model
{
    //
        protected $fillable = [
        'patient_id',
        'first_name',
        'last_name',
        'gender',
        'date_of_birth',
        'phone',
        'email',
        'blood_group',
        'marital_status',
        'department_id',
        'doctor_id',
        'address',
        'city',
        'state',
        'country',
        'pin_code',
        'emergency_contact_name',
        'emergency_contact_phone',
        'relation',
        'medical_history',
        'allergies',
        'status',
        'deleted_at',
    ];
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    
}
