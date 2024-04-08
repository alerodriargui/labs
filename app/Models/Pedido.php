<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'plant_order'; // Nombre de la tabla

    // Relación con el modelo Order
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    // Relación con el modelo Plant
    public function plant()
    {
        return $this->belongsTo(Plant::class, 'plant_id');
    }
}
