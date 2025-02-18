<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TripSeeder extends Seeder
{
    public function run()
    {
        DB::table('trip')->insert([
            [
                'trip_id' => 1,
                'start_point' => 'Tokyo',
                'end_point' => 'Kyoto',
                'user_id' => 1,
                'state' => 'planned',
            ],
            [
                'trip_id' => 2,
                'start_point' => 'Osaka',
                'end_point' => 'Hiroshima',
                'user_id' => 2,
                'state' => 'planned',
            ],
            [
                'trip_id' => 3,
                'start_point' => 'Fukuoka',
                'end_point' => 'Sapporo',
                'user_id' => 3,
                'state' => 'planned',
            ],
        ]);
    }
}
