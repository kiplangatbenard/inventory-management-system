<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_type',
        'user_id',
        'gadget_id',
        'description',
        'status',
        'priority',
        'assigned_to',
        'due_date',
        'comments',
        'attachment',
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

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}