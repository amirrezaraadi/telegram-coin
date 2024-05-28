<?php

namespace Database\Seeders;

use App\Models\Manager\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{

    public function run(): void
    {
        $data = [

            [
                'title' => 'check channel',
                'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit,',
                'link' => 'https://www.michaelhorowitz.com',
                'amount' => 5000,
            ],
            [
                'title' => 'view channel',
                'body' => 'sed do eiusmod tempor incididunt ut labore et dolore magna aliqua',
                'link' => 'https://www.linkedin.com/',
                'amount' => 6000,
            ],
            [
                'title' => 'visit channel',
                'body' => 'Egestas purus viverra accumsan in nisl nisi',
                'link' => 'https://www.phishing.org/',
                'amount' => 7000,
            ],
            [
                'title' => 'check site',
                'body' => 'Arcu cursus vitae congue mauris rhoncus aenean vel elit scelerisque . In egestas ',
                'link' => 'https://www.du.edu/',
                'amount' => 8000,
            ],
            [
                'title' => 'view site',
                'body' => 'erat imperdiet sed euismod nisi porta lorem mollis .',
                'link' => 'https://loremsaz.com/',
                'amount' => 9000,
            ],
            [
                'title' => 'visit site',
                'body' => ' Morbi tristique senectus et netus . Mattis pellentesque id nibh tortor id   ',
                'link' => 'https://pusher.com/',
                'amount' => 10000,
            ],
        ];
        foreach ($data as $item) {
            Task::query()->create([
                'title' => $item['title'],
                'body' => $item['body'],
                'link' => $item['link'],
                'amount' => $item['amount'],
            ]);
        }
    }
}

