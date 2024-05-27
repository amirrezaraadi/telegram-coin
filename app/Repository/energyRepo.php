<?php

namespace App\Repository;


use App\Models\Manager\Energy;
use App\Models\Pivot\PlayerEnergy;

class energyRepo
{
    private $query;

    public function __construct()
    {
        $this->query = Energy::query();
    }

    public function index()
    {
        return $this->query->paginate();
    }

    public function create($data)
    {
        return $this->query->create([
            'title' => $data['title'],
            'size' => $data['size'],
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
    public function update($data, $id)
    {
        $energyId = $this->getFindId($id);
        return $this->query->where('id', $id)->update([
            'title' => $data['title'] ?? $energyId->title,
            'size' => $data['size'] ?? $energyId->size,
            'amount' => $data['amount'] ?? $energyId->amount,
            'is_default' => $data['is_default'] ?? $energyId->is_default,
        ]);
    }

    public function delete($id)
    {
        return $this->query->where('id', $id)->delete();
    }

    public function getNameFirst($id)
    {
        return $this->query->where('id', $id)->select(['title', 'size'])->first();
    }

    public function getNameNext($id, $user)
    {
        $next = $id + 1;
        $result = $this->query->where('id', $next)->select(['id', 'title', 'size', 'amount'])->first();
        if (is_null($result)) {
            return false;
        }
        $amount = $user->t_balance->pluck('amount')->first();
        $checkCache = $amount >= $result->amount;
        if (! $checkCache) {
            return false;
        }
        $remaining = $amount - $result->amount;
        $save_user = $user->t_balance()->update(['amount' => $remaining]);
        $table = PlayerEnergy::getPlayerId($user->id);
        $table->update(['energy_id' => $result->id]);
        return $result;
    }


}
