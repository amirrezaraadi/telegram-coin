<?php

namespace App\Repository;

use App\Models\Manager\Trophy;

class trophyRepo
{
    public $query;

    public function __construct()
    {
        $this->query = Trophy::query();
    }

    public function index()
    {
        return $this->query->with('soft_delete')->paginate();
    }

    public function create($data)
    {
        return $this->query->create([
            'title' => $data['title'],
            'player_id' => 1,
        ]);
    }

    public function getFindId($id)
    {
        return $this->query->findOrFail($id);
    }

    public function upadte($data, $id)
    {
        return $this->query->where('id', $id)->update([
            'title' => $data['title'],
            'player_id' => 1,
        ]);
    }

    public function delete($id)
    {
        return $this->query->where('id', $id)->delete();
    }

    public function change($id)
    {
        if ($id->is_default === 0)
            return $this->query->where('id', $id->id)->update(['is_default' => 1]);
        if ($id->is_default=== 1)
            return $this->query->where('id', $id->id)->update(['is_default' => 0]);
    }
}
