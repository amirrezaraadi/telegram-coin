<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Manager\Energy;
use App\Models\Manager\MultipleTouches;
use App\Models\Manager\Recharging;
use App\Models\Manager\Trophy;
use App\Models\Robot;
use App\Models\Token;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//        User::factory(1)->create();
//        Energy::factory(10)->create();
//        Recharging::factory(10)->create();
//        Trophy::factory(10)->create();
//        MultipleTouches::factory(10)->create();
//        Robot::factory(10)->create();
        $this->call([
           EnergySeeder::class ,
           MultipleTouchesSeeder::class ,
           RechargingSeeder::class ,
           TrophySeeder::class ,
        ]);
    }
}
