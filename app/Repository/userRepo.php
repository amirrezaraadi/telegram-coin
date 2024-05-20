<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Support\Str;

class userRepo
{
    private $query;

    public function __construct()
    {
        $this->query = User::query();
    }

    public function index()
    {
        return $this->query->paginate(15);
    }

    public function create($data)
    {
        return $this->query->create([
            'uuid_name' => $data['uuid_name'],
            'name' => Str::after($data['uuid_name'], '@'),
            'id_tele' => $data['id_tele'] ?? substr(base_convert(sha1(uniqid(mt_rand())), 20, 36), 0, 100),
            'phone' => $data['phone'] ?? null,
            'remember_token' => Str::uuid(Str::random(15))
        ]);
    }

    public function getFindId($id)
    {
        return $this->query->findOrFail($id);
    }

    public function getUuId($id)
    {
        return $this->query->where('id_tele', $id)->first();
    }

    public function getIdName($nameId)
    {
        return $this->query->where('uuid_name', $nameId)->first();
    }

    public function add_wallet($data, $id)
    {
        return $this->query->where('id', $id)->update([
            'wallet' => $data['wallet'],
        ]);
    }


}
