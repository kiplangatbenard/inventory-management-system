<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'gadget_id', 'description', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function gadget()
    {
        return $this->belongsTo(Gadget::class);
    }
}

