<?php

namespace App\models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Supporter extends Authenticatable
{
    use Notifiable;

    protected $guard = 'supporter';
    protected $table = 'supporters';
    protected $fillable = [
        'name',  
        'email', 
        'password',
        'phone',
        'image'
    ];
}
