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
            ["title" => 'wood', "amount" => 0],
            ["title" => 'Bronze', "amount" => 500],
            ["title" => 'silver', "amount" => 10000],
            ["title" => 'Gold', "amount" => 50000],
            ["title" => 'Platinum', "amount" => 100000],
            ["title" => 'Diamond', "amount" => 200000],
        ];

        foreach ($data as $item) {
            Trophy::query()->create([
                "title" => $item['title'],
                "amount" => $item['amount'],
            ]);
        }
    }
}
