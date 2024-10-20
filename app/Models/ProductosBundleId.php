<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductosBundleId extends Model
{
    use HasFactory;
    protected $table = 'products_bundle_id';

    protected $fillable = [
        'id_product',
        'producto',
        'price',
        'cantidad',
    ];


}
