<?php

namespace App\models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Vendor extends Authenticatable
{
    use Notifiable;

    protected $guard = 'vendor';
    protected $table = 'vendors';
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'phone',
        'categories'
    ];

    public function balance()
    {
        return $this->hasOne(VendorWallet::class, 'vendor_id');
    }
}
