<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Gadget extends Model
{
    use HasFactory;

    // Define the fillable attributes
    protected $fillable = [
        'name',
        'type',
        'status',
        'assigned_to',
        'user_id',
        'serial_number',
        'condition',
        'description',
    ];
    //i was added this code of user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with GadgetRequest
    public function requests()
    {
        return $this->hasMany(GadgetRequest::class);
    }
    

public function dashboard()
{
    // Fetch gadgets assigned to the logged-in user
    $assignedGadgets = Gadget::where('assigned_to', auth()->id())->get();

    return view('user.dashboard', [
        'assignedGadgets' => $assignedGadgets,
    ]);
}
public function department()
{
    return $this->belongsTo(Department::class);
}
// app/Models/Gadget.php

public function returnRequest()
{
    return $this->hasOne(GadgetReturn::class, 'gadget_id');
}


}