<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTrophyRequest;
use App\Http\Requests\UpdateTrophyRequest;
use App\Models\Manager\Trophy;
use App\Repository\trophyRepo;

class TrophyController extends Controller
{
    public function __construct(public trophyRepo $trophyRepo)
    {
    }

    public function index()
    {
        return $this->trophyRepo->index();
    }

    public function store(StoreTrophyRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->trophyRepo->create($request->only('title'));
        return response()->json(['message' => 'success create trophy ', 'status' => 'success'], 200);
    }


    public function show($trophy)
    {
        return $this->trophyRepo->getFindId($trophy);
    }

    public function update(UpdateTrophyRequest $request, $trophy): \Illuminate\Http\JsonResponse
    {
        $id = $this->trophyRepo->getFindId($trophy);
        $this->trophyRepo->upadte($request, $id->id);
        return response()->json(['message' => 'success create trophy ', 'status' => 'success'], 200);
    }


    public function destroy($trophy): \Illuminate\Http\JsonResponse
    {
        $id = $this->trophyRepo->getFindId($trophy);
        $this->trophyRepo->delete($id->id);
        return response()->json(['message' => 'success create trophy ', 'status' => 'success'], 200);
    }

    public function default($id): \Illuminate\Http\JsonResponse
    {
        $trophyId = $this->trophyRepo->getFindId($id);
        $this->trophyRepo->change($trophyId);
        return response()->json(['message' => 'change state create trophy ', 'status' => 'success'], 200);
    }
}
