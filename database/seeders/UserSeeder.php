<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User();
        $admin->name = 'Admin';
        $admin->username = 'admin';
        $admin->email = 'admin@gmail.com';
        $admin->password = bcrypt('admin123');
        $admin->phone_number = '081234567891';
        $admin->role_id = 1;
        $admin->is_active = 'Active';
        $admin->save();
    }
}
