<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanningSeeder extends Seeder
{
    public function run()
    {
        DB::table('planning')->insert([
            [
                'planning_id' => 1,
                'facility_id' => 1,
                'trip_id' => 1,
                'sequence' => '2025-09-01,2025-09-02', // 値を文字列として扱う
            ],
            [
                'planning_id' => 2,
                'facility_id' => 2,
                'trip_id' => 2,
                'sequence' => '2025-09-05,2025-09-06', // 値を文字列として扱う
            ],
            [
                'planning_id' => 3,
                'facility_id' => 3,
                'trip_id' => 3,
                'sequence' => '2025-09-10,2025-09-12', // 値を文字列として扱う
            ],
        ]);
    }
}
