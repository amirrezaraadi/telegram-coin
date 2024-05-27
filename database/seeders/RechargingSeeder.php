<?php

namespace Database\Seeders;

use App\Models\Manager\Recharging;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RechargingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ["title" => 1,  "size" => 100 , "unit" => 1, "amount" => 100  ],
            ["title" => 2,  "size" => 200 , "unit" => 2, "amount" => 200  ],
            ["title" => 3,  "size" => 300 , "unit" => 3, "amount" => 300  ],
            ["title" => 4,  "size" => 400 , "unit" => 4, "amount" => 400  ],
            ["title" => 4,  "size" => 400 , "unit" => 4, "amount" => 400  ],
        ];

        foreach ($data as $item) {
            Recharging::query()->create([
                "title" => $item['title'],
                "size" => $item['size'],
                "unit" => $item['unit'],
                "amount" => $item['amount'],
            ]);
        }
    }
}
