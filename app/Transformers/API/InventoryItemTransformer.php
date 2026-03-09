<?php

namespace App\Transformers\API;

use App\Transformers\BaseTransformer;

class InventoryItemTransformer extends BaseTransformer
{
    public function transform($data): array
    {
        $response = [
            'id' => $data->id,
            'name' => $data->name,
            'sku' => $data->sku,
            'price' => (float) $data->price,
        ];
        if ($data->pivot) {
            $response['quantity'] = $data->pivot->quantity;
        }

        return $response;
    }
}
