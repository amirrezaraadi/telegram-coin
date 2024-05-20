<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTBalanceRequest;
use App\Http\Requests\UpdateTBalanceRequest;
use App\Models\Manager\TBalance;
use App\Repository\TBalanceRepo;

class TBalanceController extends Controller
{
    public function __construct(public TBalanceRepo $balanceRepo)
    {
    }

    public function index()
    {
        return $this->balanceRepo->index();
    }

    public function store(StoreTBalanceRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->balanceRepo->create($request->only('amount'));
        return response()->json(['message' => 'success create balance', 'status' => 'success'], 200);
    }


    public function show($tBalance)
    {
        return $this->balanceRepo->getFindId($tBalance);
    }

    public function update(UpdateTBalanceRequest $request, $tBalance): \Illuminate\Http\JsonResponse
    {
        $id = $this->balanceRepo->getFindId($tBalance);
        $this->balanceRepo->update($request->only('amount'), $id);
        return response()->json(['message' => 'success create balance', 'status' => 'success'], 200);
    }


    public function destroy($tBalance): \Illuminate\Http\JsonResponse
    {
        $id = $this->balanceRepo->getFindId($tBalance);
        $this->balanceRepo->delete($id->id);
        return response()->json(['message' => 'success create balance', 'status' => 'success'], 200);
    }
}
