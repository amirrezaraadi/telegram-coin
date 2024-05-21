<?php

namespace App\Repository;


use App\Models\Manager\Energy;
use App\Models\Manager\Recharging;

class rechargingRepo
{
    private $query ;
    public function __construct()
    {
        $this->query = Recharging::query() ;
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
        $recharging = $this->getFindId($id);
        return $this->query->where('id' , $id)->update([
            'title' => $data['title'] ?? $recharging->title,
            'size' => $data['size'] ?? $recharging->size,
            'unit' => $data['unit'] ?? $recharging->unit,
            'amount' => $data['amount'] ?? $recharging->amount,
            'is_default' => $data['is_default'] ?? $recharging->is_default,
            'player_id' => 1
        ]);
    }
    public function delete($id)
    {
        return $this->query->where('id' , $id)->delete();
    }

    public function getNameFirst($id)
    {
        return $this->query->where('id' , $id)->select(['title', 'size', 'unit'])->first();
    }

    public function getNameNext($id)
    {
        $next = $id + 1;
        $result = $this->query->where('id', $next)->select(['title', 'size', 'unit'])->first();
        if ( is_null($result )) {
            return false ;
        }
        return $result ;
    }
}
