<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class VendorTransaction extends Model
{
    protected $table = 'vendor_transactions';
    protected $fillable = [
        'vendor_id',
        'type',
        'amount',
        'currency',
        'operation_id'
    ];
    public function vendor(){
        return $this->belongsTo(Vendor::class,'vendor_id');
    }
}
