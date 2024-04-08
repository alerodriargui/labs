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

    // Relación con el modelo Address
    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

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
