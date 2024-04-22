<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    use HasFactory;

    protected $table = 'plant'; // Nombre de la tabla

    const CREATED_AT = 'created_at'; // Nombre de la columna de creación
    const UPDATED_AT = 'updated_at'; // Nombre de la columna de actualización
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'scientific_name',
        'season',
        'description',
        'unit_price',
        'img_path',
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'plant_order', 'plant_id', 'order_id')
            ->withPivot('amount');
    }
}
