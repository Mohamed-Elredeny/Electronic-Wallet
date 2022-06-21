<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MyWishlistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:vendor');
    }
}
