<?php

namespace App\Listeners;

use App\Events\LowStockDetected;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class SendLowStockNotification implements ShouldQueue
{
    public function handle(LowStockDetected $event): void
    {
        Log::info("Low stock alert: Item {$event->stock->inventory_item_id} in warehouse {$event->stock->warehouse_id} is low. Current quantity: {$event->stock->quantity}");
    }
}
