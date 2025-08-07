<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'سید محمد حسن مقدم فر',
            'email' => 'hasan@seemsys.com',
            'phone' => '09121642157',
            'username' => '09121642157',
            'password' => Hash::make('321321'),
            'type' => 'admin',
            'avatar' => null,
            'status' => '1',
        ]);
    }
}
