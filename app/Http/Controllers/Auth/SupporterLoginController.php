<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SupporterLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:supporter')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.supporter-login');
    }

    public function login(Request $request)
    {

        // Attempt to log the user in
        if(Auth::guard('supporter')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember))
        {
            return redirect()->route('supporter.dashboard');
        }

        // if unsuccessful
        return redirect()->back()->with('error', 'البريد الالكتروني او كلمة المرور غير صحيحة');
    }
}
