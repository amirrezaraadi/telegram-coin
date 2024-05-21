<?php

namespace App\Http\Controllers;

use App\Models\Manager\Recharging;
use App\Http\Requests\StoreRechargingRequest;
use App\Http\Requests\UpdateRechargingRequest;
use App\Repository\rechargingRepo;

class RechargingController extends Controller
{
    public function __construct(public rechargingRepo $rechargingRepo)
    {
    }

    public function index()
    {
        return $this->rechargingRepo->index();
    }

    public function store(StoreRechargingRequest $request)
    {
        $this->rechargingRepo->create($request->only([
            'title',
            'size',
            'unit',
            'amount'
        ]));
        return response()->json(['message' => 'create energy success', 'status' => 'success'], 200);
    }


    public function show( $energy)
    {
        return $this->rechargingRepo->getFindId($energy);
    }

    public function update(UpdateRechargingRequest $request, $energy)
    {
        $this->rechargingRepo->update($request->only([
            'title',
            'size',
            'unit',
            'amount'
        ]), $energy);
        return response()->json(['message' => 'update energy success', 'status' => 'success'], 200);
    }


    public function destroy($energy)
    {
        $id = $this->rechargingRepo->getFindId($energy);
        $this->rechargingRepo->delete($id->id);
        return response()->json(['message' => 'delete energy success', 'status' => 'success'], 200);
    }
}
