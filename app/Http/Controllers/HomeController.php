<?php

namespace App\Http\Controllers;

use App\models\Ticket;
use Illuminate\Http\Request;

class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function checkAuthLogin(Request $request)
    {
        if($request->type == 'admin')
        {
            return redirect()->route('admin.login',['password'=> $request->password, 'email'=>$request->email]);
        }
        elseif($request->type == 'supporter')
        {
            return redirect()->route('supporter.login',['password'=> $request->password, 'email'=>$request->email]);
        }
        elseif($request->type == 'vendor')
        {
            // return 'vendor';
            return redirect()->route('vendor.login',['password'=> $request->password, 'email'=>$request->email]);
        }
        return 'sad';
    }

    public function test()
    {
        $users = Ticket::all()->groupBy('state')->toArray();
        return $users;
    }
}
