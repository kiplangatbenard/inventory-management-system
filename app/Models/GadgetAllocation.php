<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GadgetAllocation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'department_id', 'user_id', 'gadget_id', 'assigned_at', // Add other fields as needed
    ];

    protected $dates = ['deleted_at'];
    public function gadget()
{
    return $this->belongsTo(Gadget::class, 'gadget_id');
}


public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

}
