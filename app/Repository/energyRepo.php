<?php

namespace App\Repository;


use App\Models\Manager\Energy;

class energyRepo
{
    private $query ;
    public function __construct()
    {
        $this->query = Energy::query() ;
    }

    public function index()
    {
        return $this->query->paginate() ;
    }

    public function create($data)
    {
        return $this->query->create([
            'title' => $data['title'],
            'size' => $data['size'],
            'unit' => $data['unit'],
            'amount' => $data['amount'],
            'is_default' => 0,
            'player_id' => 1
        ]);
    }

    public function getFindId($id)
    {
        return $this->query->findOrFail($id);
    }

    public function update($data , $id)
    {
        $energyId = $this->getFindId($id);
        return $this->query->where('id' , $id)->update([
            'title' => $data['title'] ?? $energyId->title,
            'size' => $data['size'] ?? $energyId->size,
            'unit' => $data['unit'] ?? $energyId->unit,
            'amount' => $data['amount'] ?? $energyId->amount,
            'is_default' => $data['is_default'] ?? $energyId->is_default,
            'player_id' => 1
        ]);
    }
    public function delete($id)
    {
        return $this->query->where('id' , $id)->delete();
    }


}
