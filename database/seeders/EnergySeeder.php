<?php

namespace Database\Seeders;

use App\Models\Manager\Energy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EnergySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ["title" => 1, "size" => 1000, "amount" => 100],
            ["title" => 2, "size" => 2000, "amount" => 200],
            ["title" => 3, "size" => 3000, "amount" => 300],
            ["title" => 4, "size" => 4000, "amount" => 400],
        ];

        foreach ($data as $item) {
            Energy::query()->create([
                "title" => $item['title'],
                "size" => $item['size'],
                "amount" => $item['amount'],
            ]);
        }
    }
}
