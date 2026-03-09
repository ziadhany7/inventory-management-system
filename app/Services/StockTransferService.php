<?php

namespace App\Services;

use App\Repositories\Interfaces\StockRepositoryInterface;
use App\Models\StockTransfer;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Events\LowStockDetected;

class StockTransferService
{
    protected $stockRepo;

    public function __construct(StockRepositoryInterface $stockRepo)
    {
        $this->stockRepo = $stockRepo;
    }

    public function transfer(array $data)
    {
        return DB::transaction(function () use ($data) {
            $fromStock = $this->stockRepo->getStock($data['from_warehouse_id'], $data['inventory_item_id']);

            // الـ Validation المطلوب: التأكد من توفر الكمية
            if (!$fromStock || $fromStock->quantity < $data['quantity']) {
                throw new Exception("Insufficient stock in the source warehouse.");
            }

            // خصم من المخزن الأول
            $fromStock = $this->stockRepo->updateOrCreateStock(
                $data['from_warehouse_id'],
                $data['inventory_item_id'],
                $fromStock->quantity - $data['quantity']
            );

            // تشغيل الـ Event إذا كان المخزون منخفضاً
            if ($fromStock->quantity < 5) {
                event(new LowStockDetected($fromStock));
            }

            // إضافة للمخزن الثاني
            $toStock = $this->stockRepo->getStock($data['to_warehouse_id'], $data['inventory_item_id']);
            $newQuantity = ($toStock ? $toStock->quantity : 0) + $data['quantity'];

            $this->stockRepo->updateOrCreateStock(
                $data['to_warehouse_id'],
                $data['inventory_item_id'],
                $newQuantity
            );

            // تسجيل العملية في الـ Log
            return StockTransfer::create($data);
        });
    }
}
