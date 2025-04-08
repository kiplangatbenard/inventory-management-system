<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allocation extends Model
{
    use HasFactory;

    protected $fillable = ['gadget_id', 'user_id', 'status'];

    public function gadget()
    {
        return $this->belongsTo(Gadget::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}

