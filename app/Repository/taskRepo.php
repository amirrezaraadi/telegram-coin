<?php

namespace App\Repository;

use App\Models\Manager\Task;

class taskRepo
{
    public function index()
    {
        return Task::query()->paginate();
    }

    public function create($data)
    {
        return Task::query()->create([
            'title' => $data['title'],
            'body' => $data['body'],
            'link' => $data['link'],
            'amount' => $data['amount'],
        ]);
    }

    public function getFindId($task)
    {
        return Task::query()->findOrFail($task);
    }
}
