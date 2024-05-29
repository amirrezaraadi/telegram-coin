<?php

namespace App\Repository;

use App\Models\Manager\Task;

class taskRepo
{
    public function index()
    {
        return Task::query()->paginate();
    }

    public function create($data)
    {
        return Task::query()->create([
            'title' => $data['title'],
            'body' => $data['body'],
            'link' => $data['link'],
            'amount' => $data['amount'],
        ]);
    }

    public function getFindId($task)
    {
        return Task::query()->findOrFail($task);
    }

    public function update($data, $id)
    {
        return Task::query()->where('id', $id->id)->update([
            'title' => $data['title'] ?? $id->title,
            'body' => $data['body'] ?? $id->body,
            'link' => $data['link'] ?? $id->link,
            'amount' => $data['amount'] ?? $id->amount,
        ]);
    }

    public function delete($id)
    {
        return Task::query()->where('id', $id->id)->delete();
    }

    public function all()
    {
        return Task::query()->select(['title' , 'body' ,  'link' ,  'amount' ])->get();
    }

    public function customize()
    {
        return Task::query()->select(['title' , 'body' ,  'link' ,  'amount' ])->get();
    }
    public function getAllId()
    {
        return Task::query()->select(['id'  ])->get();
    }
}
