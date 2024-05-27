<?php

namespace Database\Seeders;

use App\Models\Manager\MultipleTouches;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MultipleTouchesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ["title" => 1, "unit" => 1, "amount" => 100],
            ["title" => 2, "unit" => 2, "amount" => 200],
            ["title" => 3, "unit" => 3, "amount" => 300],
            ["title" => 4, "unit" => 4, "amount" => 400],
        ];

        foreach ($data as $item) {
            MultipleTouches::query()->create([
                "title" => $item['title'],
                "unit" => $item['unit'],
                "amount" => $item['amount'],
            ]);
        }
    }
}
