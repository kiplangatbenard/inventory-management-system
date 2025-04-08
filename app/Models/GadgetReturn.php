<?php

// app/Models/GadgetReturn.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GadgetReturn extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'gadget_id',
        'reason',
        'status',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function gadget()
    {
        return $this->belongsTo(Gadget::class);
    }
    public function returnRequest()
{
    return $this->hasOne(\App\Models\GadgetReturnRequest::class, 'gadget_id');
}
public function create()
{
    $gadgets = Gadget::where('user_id', auth()->id())
        ->where(function ($query) {
            $query->whereDoesntHave('returnRequest')
                  ->orWhereHas('returnRequest', function ($q) {
                      $q->where('status', '!=', 'approved');
                  });
        })
        ->get();

    return view('user.issues.create', compact('gadgets'));
}

}

