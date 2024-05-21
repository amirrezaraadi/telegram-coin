<?php

namespace App\Repository;

use App\Models\Manager\MultipleTouches;

class multiple_touchesRepo
{
    public $query ;
    public function __construct()
    {
        $this->query = MultipleTouches::query() ;
    }

    public function index()
    {
        return $this->query->paginate();
    }

    public function create($data)
    {
        return $this->query->create([
            'title' => $data['title'],
            'unit' => $data['unit'],
            'amount' => $data['amount'],
            'is_default' => 0,
            'player_id' => 1,
        ]);
    }

    public function getFindId($id)
    {
        return $this->query->findOrFail($id);
    }

    public function update($data , $id)
    {
        return $this->query->where('id' , $id->id)->update([
            'title' => $data['title'] ?? $id->title ,
            'unit' => $data['unit'] ?? $id->unit ,
            'amount' => $data['amount'] ?? $id->amount ,
            'is_default' => 0,
            'player_id' => 1,
        ]);
    }

    public function delete($id)
    {
        return $this->query->where('id' , $id)->delete();
    }

    public function getNameFirst( $id)
    {
        return $this->query->where('id' , $id)->select(['title', 'unit'])->first();
    }

    public function getNameNext($id)
    {
        $next = $id + 1;
        $result = $this->query->where('id', $next)->select(['title', 'unit'])->first();
        if ( is_null($result )) {
            return false ;
        }
        return $result ;
    }
}
