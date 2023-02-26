<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add default admin 
        $user = new Admin();
        $user->name = 'demo-admin';
        $user->email = 'demo@admin.com';
        $user->email_verified_at = now();
        $user->password = bcrypt('12345678');
        $user->save();

     

    }
}
