<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserActivity;

class UserActivitySeeder extends Seeder
{
    public function run()
    {
        UserActivity::create([
            'user_id' => 1,
            'description' => 'User logged in'
        ]);

        UserActivity::create([
            'user_id' => 1,
            'description' => 'User reported an issue'
        ]);
    }
}
