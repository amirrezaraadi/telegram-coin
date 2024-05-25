<?php

namespace App\Repository;

use App\Models\Robot;

class robotRepo
{


    public function idnex()
    {
        return Robot::query()->paginate();
    }

    public function create($data)
    {
        return Robot::query()->create([
            'title' => $data['title'],
            'hour' => $data['hour'],
            'amount' => $data['amount'],
                'token' => $data['token'],
        ]);
    }

    public function getFindId($id)
    {
        return Robot::query()->findOrFail($id);
    }

    public function update($data, $id)
    {
        return Robot::query()->where('id', $id)->update([
            'title' => $data['title'],
            'hour' => $data['hour'],
            'amount' => $data['amount'],
            'token' => $data['token'],
        ]);
    }

    public function delete($id)
    {
        return Robot::query()->where('id', $id)->delete();
    }
}
