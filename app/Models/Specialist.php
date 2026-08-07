<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'department_id',
        'description',
        'status',
        'deleted_at'
    ];
    protected $casts = [
        'status' => 'integer',
        'deleted_at' => 'datetime',
    ];

    
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}