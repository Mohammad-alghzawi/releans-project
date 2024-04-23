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

    public function setCarPrice($discount)
    {
        // Ensure the discount is a valid number
        if (!is_numeric($discount)) {
            return false;
        }

        // Calculate the price after discount
        $priceAfterDiscount = $this->price - ($this->price * ($discount / 100));

        // Update the price_after_discount attribute
        $this->price_after_discount = $priceAfterDiscount;

        // Save the changes to the database
        $this->save();

        return true;
    }
}
