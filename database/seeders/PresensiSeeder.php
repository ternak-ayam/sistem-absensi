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
                'type' => PresenceTypeEnum::IN
            ],
            [
                'name' => 'Presensi Keluar',
                'code' => Str::random(64),
                'type' => PresenceTypeEnum::OUT
            ]
        ];

        Presence::insert($data);
    }
}
