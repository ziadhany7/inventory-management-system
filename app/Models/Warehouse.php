<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
class Warehouse extends Model
{
    use HasFactory, Notifiable;
    protected $guarded = [];

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }


}
