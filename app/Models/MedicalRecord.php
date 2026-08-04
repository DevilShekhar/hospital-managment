<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    protected $fillable = [
        'record_no',
        'patient_id',
        'doctor_id',
        'visit_date',
        'visit_time',
        'symptoms',
        'diagnosis',
        'prescription',
        'doctor_notes',
        'follow_up_date',
        'treatment_status',
        'is_deleted',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}