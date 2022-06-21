<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class VendorProduct extends Model
{
    protected $table = 'vendor_products';
    protected $fillable = [
        'vendor_id',
        'product_id',
        'transaction_number'
    ];
}
