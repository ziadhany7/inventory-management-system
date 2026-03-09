<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InventoryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Repositories\Interfaces\StockRepositoryInterface;
use App\Transformers\API\InventoryItemTransformer;
use App\Traits\ApiResponseTrait;

class InventoryController extends Controller
{
    use ApiResponseTrait;
    protected $stockRepo;

    public function __construct(StockRepositoryInterface $stockRepo)
    {
        $this->stockRepo = $stockRepo;
    }
    public function index(Request $request)
    {
        $filters = $request->only(['search', 'min_price']);
        $page = $request->page ?? 1;
        $per_page = $request->per_page ?? 2;

        $cacheKey = 'inventory_list_' . md5(serialize($filters) . $per_page . $page);

        return Cache::remember($cacheKey, 600, function () use ($filters, $per_page) {
            $InventoryQuery = InventoryItem::query()->filter($filters)->paginate($per_page);

            $inventoryTransformer = new InventoryItemTransformer();
            $invertoryResponse = $inventoryTransformer->transformPaginate($InventoryQuery);

            return $this->apiResponse($invertoryResponse, 200, 'invertory response returned successfully');

        });
    }


    public function warehouseInventory($id)
    {
        $stocks = $this->stockRepo->getWarehouseInventory($id);

        return $this->apiResponse($stocks, 200, 'invertory response returned successfully');
    }
}
