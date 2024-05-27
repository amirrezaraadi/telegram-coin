<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEnergyRequest;
use App\Http\Requests\UpdateEnergyRequest;
use App\Models\Manager\Energy;
use App\Repository\energyRepo;

class EnergyController extends Controller
{
    public function __construct(public energyRepo $energyRepo)
    {
    }

    public function index()
    {
        return $this->energyRepo->index();
    }

    public function store(StoreEnergyRequest $request)
    {
        $this->energyRepo->create($request->only([
            'title',
            'size',
            'amount'
        ]));
        return response()->json(['message' => 'create energy success', 'status' => 'success'], 200);
    }


    public function show( $energy)
    {
        return $this->energyRepo->getFindId($energy);
    }

    public function update(UpdateEnergyRequest $request, $energy)
    {
        $this->energyRepo->update($request->only([
            'title',
            'size',
            'amount'
        ]), $energy);
        return response()->json(['message' => 'update energy success', 'status' => 'success'], 200);
    }


    public function destroy($energy)
    {
        $id = $this->energyRepo->getFindId($energy);
        $this->energyRepo->delete($id->id);
        return response()->json(['message' => 'delete energy success', 'status' => 'success'], 200);
    }
}
