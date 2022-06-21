<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class VendorWallet extends Model
{
    protected $table = 'vendor_wallets';
    protected $fillable = [
        'vendor_id',
        'ballance',
        'currency'
    ];
}
