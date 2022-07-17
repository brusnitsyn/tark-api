<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductProp extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'prop_id',
    ];
}
