<?php

namespace Database\Seeders;

use App\Models\Admin;
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
        User::where('username', 'joko')->forceDelete();

        User::create([
            'name' => 'Joko',
            'email' => 'joko@example.com',
            'username' => 'joko',
            'password' => Hash::make('password'),
            'phone' => '00132193193',
            'state' => 'gay'
        ]);
    }
}
