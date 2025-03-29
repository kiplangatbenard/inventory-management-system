<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'manager_id'];

    // Relationship with the Manager (User)
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    // Relationship with Employees (Users in this Department)
    public function employees()
    {
        return $this->hasMany(User::class, 'department_id');
    }
    use HasFactory;

   // protected $fillable = ['name'];

    public function users()
    {
        return $this->hasMany(User::class, 'department_id');
        //return $this->hasMany(User::class);
    }

    // Relationship with Gadgets Assigned to Employees in this Department
    public function gadgets()
    {
        return $this->hasManyThrough(Gadget::class, User::class, 'department_id', 'user_id', 'id', 'id');
    }
}
