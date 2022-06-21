<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class VendorWishlist extends Model
{
    protected $table = 'vendor_wishlists';
    protected $fillable = [
        'vendor_id',
        'product_id',
    ];
    public function product(){
        return $this->belongsTo(Category::class,'product_id');
    }
}
