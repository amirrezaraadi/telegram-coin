<?php

namespace App\Repository;

use App\Models\Manager\TBalance;

class TBalanceRepo
{
    private $query;

    public function __construct()
    {
        $this->query = TBalance::query();
    }

    public function index()
    {
        return $this->query->paginate();
    }

    public function create($data)
    {
        return $this->query->create([
            'amount' => $data['amount'],
            'player_id' => 1
        ]);
    }

    public function getFindId($id)
    {
        return $this->query->findOrFail($id);
    }

    public function update($data, $id)
    {
        return $this->query->where('id', $id->id)->update([
            'amount' => $data['amount'] ?? $id->amount,
            'player_id' => 1
        ]);
    }

    public function delete($id)
    {
        return $this->query->where('id', $id)->delete() ;
    }
}
