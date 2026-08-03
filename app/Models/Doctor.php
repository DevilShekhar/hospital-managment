<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table = 'doctor_managements';
     protected $fillable = [
        'name',
        'department_id',
        'email',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
 
}
