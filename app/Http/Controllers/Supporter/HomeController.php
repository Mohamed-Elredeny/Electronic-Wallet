<?php

namespace App\Http\Controllers\supporter;

use App\models\Supporter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:supporter');
    }

    public function index()
    {
        $supporter = Supporter::find(Auth::guard('supporter')->id());
        return view('supporter.home', compact('supporter'));
    }

    public function updateInfo(Request $request, $id)
    {
        $vendor = Supporter::find($id);
        if ($request->image) {
            unlink(public_path('assets/images/users') .'/' . $vendor->image);
            $fileName = $request->image->getClientOriginalName();
            $file_to_store = time() . '_' . $fileName ;
            $request->image->move(public_path('assets/images/users'), $file_to_store);

        }
        else{
            $file_to_store = $vendor->image;
        }

        $vendor->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'image'=> $file_to_store,
        ]);

        return redirect()->back()->with('success', 'تم التعديل بنجاح');
    }

    public function updateAccount(Request $request)
    {
        $rules = [
            'Current_Password' => 'required',
            'Password' => ['required', 'same:Password', 'min:8'],
            'password_confirmation' => 'required|same:Password',
        ];
        $this->validate($request,$rules);
        
        if(Auth::Check())
        {
        $requestData = $request->All();

            $currentPassword = Auth::User('supporter')->password;
            if(Hash::check($requestData['Current_Password'], $currentPassword))
            {
                $userId = Auth::User('supporter')->id;
                $currentVendor = Supporter::find($userId);
                $currentVendor->update([
                    'password'  => Hash::make($requestData['Password']),
                ]);
                return redirect()->back()->with('success', 'success');
            }
            else
            {
                return redirect()->back()->with('success', 'Sorry, your current password was not recognised. Please try again.!');
            }
        }
        else
        {
            return redirect()->back()->with('error', 'Sorry');
        }
    }

}
