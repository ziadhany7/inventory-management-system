<?php

namespace App\Repositories\Interfaces;

interface StockRepositoryInterface
{
    public function getStock(int $warehouseId, int $itemId);
    public function updateOrCreateStock(int $warehouseId, int $itemId, int $quantity);
    public function getWarehouseInventory(int $warehouseId);
}
