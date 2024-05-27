<?php

namespace App\Repository;

use App\Models\Manager\TBalance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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

    public function getAllUser()
    {
        return User::query()->count();
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
            'uuid_name' => $data,
            'id_tele' => Str::random(4) ?? null,
            'name' => Str::random(4) ?? 'null',
            'phone' => Str::random(4) ?? null,
            'remember_token' => Str::uuid(Str::random(15)),
            'last_seen' => now(),
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

    public function getConeUserId($uuId)
    {
        $userId = $this->getIdName($uuId);
        return $userId->t_balance->pluck('count_amount')->first();
    }

    public function last_seen($uuId)
    {
        $userId = $this->getIdName($uuId);
        return User::query()->where('id', $userId->id)
            ->update(['last_seen' => (new \DateTime())->format("Y-m-d H:i:s")]);
    }

    public function getDailyUser()
    {
        return User::query()
            ->where('last_seen', ">", Carbon::now()->subMinutes(20))
            ->count();
    }

    public function getOnlinePlayers()
    {
        return User::query()
            ->where('last_seen', ">", Carbon::now()->subMinutes(2))
            ->count();
    }

    public function getTotalTouch()
    {
       return TBalance::query()->sum('amount');
    }

    public function getDatauser($id)
    {
       return User::query()->where('uuid_name' , $id)->first();
    }
}
