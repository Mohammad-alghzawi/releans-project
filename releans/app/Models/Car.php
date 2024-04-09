<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'model_year',
        'color',
        'image',
        'stock',
        'discount',
        'price',
        'price_after_discount',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    
}
