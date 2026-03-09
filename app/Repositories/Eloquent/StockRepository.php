<?php

namespace App\Repositories\Eloquent;

use App\Models\Stock;
use App\Repositories\Interfaces\StockRepositoryInterface;

class StockRepository implements StockRepositoryInterface
{
    public function getStock(int $warehouseId, int $itemId)
    {
        return Stock::where('warehouse_id', $warehouseId)
                    ->where('inventory_item_id', $itemId)
                    ->first();
    }

    public function updateOrCreateStock(int $warehouseId, int $itemId, int $quantity)
    {
        return Stock::updateOrCreate(
            ['warehouse_id' => $warehouseId, 'inventory_item_id' => $itemId],
            ['quantity' => $quantity]
        );
    }

    public function getWarehouseInventory(int $warehouseId)
    {
        return Stock::where('warehouse_id', $warehouseId)
                    ->with('inventoryItem')
                    ->get();
    }
}
