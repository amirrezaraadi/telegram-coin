<?php

namespace App\Repository;

use App\Models\Manager\Task;

class taskRepo
{
    public function index()
    {
        return Task::query()->paginate();
    }
}
