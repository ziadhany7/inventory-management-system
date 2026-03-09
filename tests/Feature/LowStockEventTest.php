<?php

namespace Tests\Feature;

use App\Events\LowStockDetected;
use App\Models\User;
use App\Models\Warehouse;
use App\Models\InventoryItem;
use App\Models\Stock;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class LowStockEventTest extends TestCase
{
    use RefreshDatabase;

    public function test_low_stock_event_is_fired()
    {
        Event::fake();

        $user = User::factory()->create();
        $w1 = Warehouse::create(['name' => 'W1', 'location' => 'Loc1']);
        $w2 = Warehouse::create(['name' => 'W2', 'location' => 'Loc2']);
        $item = InventoryItem::create(['name' => 'Item', 'sku' => 'SKU1', 'price' => 100]);

        Stock::create(['warehouse_id' => $w1->id, 'inventory_item_id' => $item->id, 'quantity' => 6]);

        $this->actingAs($user, 'sanctum')->postJson('/api/stock-transfers', [
            'from_warehouse_id' => $w1->id,
            'to_warehouse_id' => $w2->id,
            'inventory_item_id' => $item->id,
            'quantity' => 2,
        ]);

        Event::assertDispatched(LowStockDetected::class);
    }
}
