<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Warehouse;
use App\Models\InventoryItem;
use App\Models\Stock;

class StockTransferFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_transfer_stock_successfully()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $w1 = Warehouse::create(['name' => 'Main', 'location' => 'Cairo']);
        $w2 = Warehouse::create(['name' => 'Sub', 'location' => 'Alex']);
        $item = InventoryItem::create(['name' => 'Laptop', 'sku' => 'LP123', 'price' => 1000]);

        Stock::create(['warehouse_id' => $w1->id, 'inventory_item_id' => $item->id, 'quantity' => 10]);

        $response = $this->actingAs($user, 'sanctum')->postJson('/api/stock-transfers', [
            'from_warehouse_id' => $w1->id,
            'to_warehouse_id' => $w2->id,
            'inventory_item_id' => $item->id,
            'quantity' => 4,
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('stocks', [
            'warehouse_id' => $w1->id,
            'quantity' => 6
        ]);
    }
}
