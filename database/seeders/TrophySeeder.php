<?php

namespace Database\Seeders;

use App\Models\Manager\Trophy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrophySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ["title" => 'Rice', "amount" => 100],
            ["title" => 'Bronze', "amount" => 200],
            ["title" => 'silver', "amount" => 300],
            ["title" => 'Gold', "amount" => 400],
            ["title" => 'Titan', "amount" => 400],
        ];

        foreach ($data as $item) {
            Trophy::query()->create([
                "title" => $item['title'],
                "amount" => $item['amount'],
            ]);
        }
    }
}
