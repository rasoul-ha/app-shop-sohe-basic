<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        // Add default user 
        $user = new User();
        $user->name = 'demo-user';
        $user->email = 'demo@user.com';
        $user->email_verified_at = now();
        $user->password = bcrypt('12345678');
        $user->save();

    }
}
