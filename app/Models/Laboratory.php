<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Department;
use Illuminate\Database\Eloquent\SoftDeletes;

class Laboratory extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'lab_code',
        'test_name',
        'department_id',
        'category',
        'sample_type',
        'container_type',
        'price',
        'turnaround_time',
        'fasting_required',
        'home_collection',
        'description',
        'status',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}