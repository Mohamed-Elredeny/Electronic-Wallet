<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Supporter;
use Illuminate\Support\Facades\Hash;

class SupporterRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:supporter');
    }

    public function showRegisterForm()
    {
        return view('auth.supporter-register');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:supporters'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $request['password'] = Hash::make($request->password);
        Supporter::create($request->all());

        return redirect()->intended(route('supporter.dashboard'));
    }
}
