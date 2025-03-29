<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'description',
        'created_at',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}