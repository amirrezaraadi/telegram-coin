<?php

namespace App\Repository;

use App\Models\Manager\Trophy;

class trophyRepo
{
    public $query ;
    public function __construct()
    {
        $this->query = Trophy::query();
    }

    public function index()
    {
        return $this->query->paginate();
    }

    public function create($data)
    {
        return $this->query->create([
            'title'  => $data['title'],
        ]);
    }

    public function getFindId($id)
    {
        return $this->query->findOrFail($id);
    }

    public function upadte($data , $id)
    {
        return $this->query->where('id' , $id)->update([
            'title'  => $data['title'],
        ]);
    }

    public function delete($id)
    {
        return $this->query->where('id' , $id)->delete();
    }
}
