<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;

class InventoryItem extends Model
{
    use HasFactory, Notifiable;
    protected $guarded = [];


    public function stocks()
    {
        return $this->belongsToMany(Warehouse::class, 'stocks')
                    ->withPivot('quantity');
    }

    public function scopeSearch(Builder $query, $term): Builder
    {
        return $query->when($term, function ($q) use ($term) {
            return $q->where('name', 'like', '%' . $term . '%');
        });
    }


    public function scopeMinPrice(Builder $query, $price): Builder
    {
        return $query->when($price, function ($q) use ($price) {
            return $q->where('price', '>=', $price);
        });
    }

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return $query->search($filters['search'] ?? null)
                     ->minPrice($filters['min_price'] ?? null);
    }
}
