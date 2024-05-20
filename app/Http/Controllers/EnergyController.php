<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEnergyRequest;
use App\Http\Requests\UpdateEnergyRequest;
use App\Models\Manager\Energy;
use App\Repository\energyRepo;

class EnergyController extends Controller
{
    public function __construct(public energyRepo $energyRepo){}

    public function index()
    {
        return $this->energyRepo->index();
    }
    public function store(StoreEnergyRequest $request)
    {
        return response()->json(['message' => 'create energy suuccess' , 'status' => 'success'] , 200) ;
    }


    public function show(Energy $energy)
    {
        return $this->energyRepo->getFindId($energy);
    }


    public function edit( $energy)
    {
        return $this->energyRepo->getFindId($energy);
    }


    public function update(UpdateEnergyRequest $request,  $energy)
    {
        $this->energyRepo->update($request , $energy);
        return response()->json(['message' => 'update energy success' , 'status' => 'success'] , 200) ;
    }


    public function destroy( $energy)
    {
        $this->energyRepo->delete($energy);
      return response()->json(['message' => 'delete energy success' , 'status' => 'success'] , 200) ;
    }
}
