<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = User::create(['name'=>'Super Admin', 'email'=>'superadmin@gmail.com','password'=>Hash::make('12345678')]);
        $superAdmin->assignRole('Super Admin');

        $admin = User::create(['name'=>'Admin', 'email'=>'admin@gmail.com','password'=>Hash::make('12345678')]);
        $admin->assignRole('Admin');
    }
}
