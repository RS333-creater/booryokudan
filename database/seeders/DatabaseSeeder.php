<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UsersTableSeeder::class, 
            TripSeeder::class,
            FacilitySeeder::class,
            PlanningSeeder::class,// 他のシーダーを追加する場合はここに追加
        ]);
    }
}
