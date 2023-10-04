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
                'name' => 'Presensi Masuk',
                'code' => Str::random(64),
                'type' => PresenceTypeEnum::IN,
                'valid_until' => '08:00'
            ],
            [
                'name' => 'Presensi Keluar',
                'code' => Str::random(64),
                'type' => PresenceTypeEnum::OUT,
                'valid_until' => '08:00'
            ]
        ];

        Presence::insert($data);
    }
}
