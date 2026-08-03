<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Department;
use App\Models\Doctor;
class Appointment extends Model
{
    public function department()
{
    return $this->belongsTo(Department::class);
}

public function doctor()
{
    return $this->belongsTo(Doctor::class);
}
}
