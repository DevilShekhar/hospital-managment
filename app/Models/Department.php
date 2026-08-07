<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
        'deleted_at',
    ];
    protected $casts = [
    'deleted_at' => 'datetime',
    ];
    public function doctors()
{
    return $this->hasMany(Doctor::class);
}
}