<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QueueManagement extends Model
{
    protected $table = 'queues';
        protected $fillable = [
        'queue_number',
        'patient_id',
        'doctor_id',
        'department_id',
        'appointment_id',
        'specialist',
        'visit_date',
        'priority',
        'remarks',
    ];
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
