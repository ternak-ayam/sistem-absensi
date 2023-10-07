<?php

namespace Database\Seeders;

use App\Enums\PresenceTypeEnum;
use App\Models\Presence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PresensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'title' => 'Presensi Jalan Santai',
                'code' => Str::random(64),
                'valid_until' => '08:00'
            ]
        ];

        Presence::insert($data);
    }
}
