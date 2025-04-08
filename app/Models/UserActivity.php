<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    protected $fillable = ['description', 'user_id']; // Add any other columns if needed

    // Relationship to User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
