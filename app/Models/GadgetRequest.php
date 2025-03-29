<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GadgetRequest extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'gadget_id', 'gadget_type', 'reason', 'status'];

    // Relationship to the Gadget model
    public function gadget()
    {
        return $this->belongsTo(Gadget::class)->withDefault([
            'name' => 'Gadget Not Found',
        ]);
    }
     // Define the relationship with the User model
     public function user()
     {
         return $this->belongsTo(User::class, 'user_id');
     }
     
 
     
}
