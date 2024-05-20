<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Support\Str;

class userRepo
{
    private $query;
    private $general;

    public function __construct()
    {
        $this->general = substr(base_convert(sha1(uniqid(mt_rand())), 20, 36), 0, 100);
        $this->query = User::query();
    }

    public function index()
    {
        return $this->query->paginate(15);
    }

    public function create($data)
    {
//        if (! is_null($data['id_tele'])) {
//            $check = Str::after($data['id_tele'], '@');
//        }
        return $this->query->create([
            'uuid_name' => $data['uuid_name'] ?? $this->general,
            'id_tele' => $data['id_tele'] ?? null,
            'name' => Str::after($data['id_tele'], '@') ?? 'null',
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

    public function users_state()
    {
        return User::query()->withCount(['t_balance', 't_energy', 'trophy', 'multi_touche'])->get();
    }


}
