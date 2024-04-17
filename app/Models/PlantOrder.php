<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlantOrder extends Model
{
    protected $fillable = [
        'order_id', 'plant_id', 'amount',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function plant()
    {
        return $this->belongsTo(Plant::class);
    }
}