<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Global Groups Admin',
            'email' => 'admin@globalgroups.com',
            'password' => Hash::make('GlobalGroups@123')
        ]);
    }
}
