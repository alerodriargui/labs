<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // Relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function plants()
    {
        return $this->belongsToMany(Plant::class, 'plant_order', 'order_id', 'plant_id')
            ->withPivot('amount');
    }
    
    protected $fillable = [
        'address',
    ];

    // Definición del atributo status como un enum
    protected $statusOptions = [
        'Pending',
        'OnProcess',
        'Completed',
        'Incidence',
        'Growing'
    ];

    // Método para obtener el status en formato legible
    public function getStatusAttribute($value)
    {
        return $this->statusOptions[$value];
    }
}
