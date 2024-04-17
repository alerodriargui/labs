<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    use HasFactory;

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
