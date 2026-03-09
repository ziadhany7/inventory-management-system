<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStockTransferRequest;
use App\Services\StockTransferService;
use Illuminate\Http\Response;

class StockTransferController extends Controller
{
    protected $transferService;

    public function __construct(StockTransferService $transferService)
    {
        $this->transferService = $transferService;
    }

    public function store(StoreStockTransferRequest $request)
    {
        try {
            $transfer = $this->transferService->transfer($request->validated());

            return response()->json([
                'message' => 'Stock transferred successfully',
                'data' => $transfer
            ], Response::HTTP_CREATED);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
