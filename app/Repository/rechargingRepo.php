<?php

namespace App\Repository;


use App\Models\Manager\Energy;
use App\Models\Manager\Recharging;
use App\Models\Pivot\PlayerRecharging;

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
        ]);
    }

    public function getFindId($id)
    {
        return $this->query->findOrFail($id);
    }


    public function getFindIdName($id)
    {
        return $this->query->where('id', $id)->first();
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

    public function getNameNext($id , $user)
    {
        $next = $id + 1;
        $result = $this->query->where('id', $next)->select(['id' , 'title', 'size', 'unit' , 'amount'])->first();
        if ( is_null($result )) {
            return false ;
        }
        $amount = $user->t_balance->pluck('amount')->first();
        $checkCache = $amount >= $result->amount;
        if (! $checkCache) {
            return false;
        }
        $remaining = $amount - $result->amount;
        $save_user = $user->t_balance()->update(['amount' => $remaining]);
        $table = PlayerRecharging::getPlayerId($user->id);
        $table->update(['recharging_id' => $result->id]);
        return $result;
    }
}
