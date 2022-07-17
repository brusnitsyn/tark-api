<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSale extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'start',
        'end',
        'old_price',
        'price',
        'is_infinite',
    ];
}
