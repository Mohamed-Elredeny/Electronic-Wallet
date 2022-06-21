<?php

namespace App\Http\Controllers\Auth;

use App\models\Vendor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Category;
use Illuminate\Support\Facades\Hash;

class VendorRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:vendor');
    }

    public function showRegisterForm()
    {
        $categories = Category::get();
        return view('register', compact('categories'));
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:vendors'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $categories = Category::get();
        $cards =  $request->cards_id;
        $ids =[];
        if(in_array('all',$cards)){
            foreach($categories as $cat){
                $ids [] = $cat->id;
            }
            $res = implode('|',$ids);
        }else{
            $res = implode('|',$cards);
        }
        $fileName = $request->imagee->getClientOriginalName();
        $file_to_store = time() . '_' . $fileName ;
        $request->imagee->move(public_path('assets/images/users'), $file_to_store);

        $request['password'] = Hash::make($request->password);
        $request['image'] = $file_to_store;
        $request['categories'] = $res;
        
        Vendor::create($request->all());

        return redirect()->route('vendor.dashboard');
    }
}
