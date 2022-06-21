<?php

namespace App\Http\Controllers\Vendor;

use App\models\Ticket;
use App\models\Vendor;
use App\models\Product;
use App\models\Category;
use App\models\VendorWallet;
use Illuminate\Http\Request;
use App\models\VendorProduct;
use App\models\VendorWishlist;
use App\models\VendorTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:vendor');
    }

    public function index()
    {
        $walletsNum = VendorWallet::where('vendor_id', Auth::guard('vendor')->id())->sum('ballance');
        $DepositsNum = VendorTransaction::where('vendor_id', Auth::guard('vendor')->id())->where('type','deposit')->sum('amount');
        $WithdrawsNum = VendorTransaction::where('vendor_id', Auth::guard('vendor')->id())->where('type','withdraw')->sum('amount');
        $transactionNum = VendorTransaction::where('vendor_id', Auth::guard('vendor')->id())->count();

        $productsNum = VendorWishlist::where('vendor_id', Auth::guard('vendor')->id())->count();
        $productsAvailableNum = VendorProduct::where('vendor_id', Auth::guard('vendor')->id())->count();

        $tickets = Ticket::where('vendor_id', Auth::guard('vendor')->id())->count();

        $categories = Category::get();

        // المجموعة كام طالب و كام مدرس
        // $peoductsCount=[
        //     'availables'=>[],
        //     'solds'=>[]
        //     ];
        // $x='';
        // $y ='';
        // $z = '';
        // $a ='';
        // $b = '';

        // foreach ($categories as $category) {
        //     $availables = Product::where('category_id', $category->id)->where('state', 'available')->count();
        //     $solds = Product::where('category_id', $category->id)->where('state', 'sold')->count();

        //     $x .= $availables;
        //     $availablesCount['availables'][] = $availables;
        //     $y .= $solds;
        //     $soldsCount['solds'][] = $solds;

        // }

        // $xx = '';
        // $yy = '';

        // for($i=0;$i<count($availablesCount['availables']) ;$i++)
        // {
        //     $xx .= ',' . $availablesCount['availables'][$i];
        //     $yy .= ',' . $soldsCount['solds'][$i];
        // }
        // return $xx;

        $ticketsLast = Ticket::where('vendor_id', Auth::guard('vendor')->id())->latest()->take(5)->get();
        $transactionssLast = VendorTransaction::where('vendor_id', Auth::guard('vendor')->id())->latest()->take(5)->get();

        $openTickets = Ticket::where('vendor_id', Auth::guard('vendor')->id())->where('state', 'open')->count();
        $pendingTickets = Ticket::where('vendor_id', Auth::guard('vendor')->id())->where('state', 'pending')->count();
        $closeTickets = Ticket::where('vendor_id', Auth::guard('vendor')->id())->where('state', 'close')->count();
        $acceptTickets = Ticket::where('vendor_id', Auth::guard('vendor')->id())->where('state', 'accept')->count();
        $refuseTickets = Ticket::where('vendor_id', Auth::guard('vendor')->id())->where('state', 'refuse')->count();
        // return $tickets;

        return view('vendor.home', compact('walletsNum', 'DepositsNum','WithdrawsNum' ,'transactionNum', 
                    'productsNum', 'productsAvailableNum', 'tickets',
                // 'availablesCount', 'xx', 'yy', 'categories',
                'ticketsLast', 'transactionssLast',
                'openTickets', 'pendingTickets', 'closeTickets', 'acceptTickets', 'refuseTickets'
            ));
    }
    
    public function products(){
        $old_array = explode('|', Auth::guard('vendor')->user()->categories);
        $categories = Category::whereIn('id', $old_array)->get();
        return view('vendor.products',compact('categories'));
    }

    public function Changecurrency($currency){
        session()->put('currency',$currency);
        return redirect()->back();
    }
    
    public function profile()
    {
        $supporter = Vendor::find(Auth::guard('vendor')->id());
        $my_groups =  explode('|', $supporter->categories);

        $avilable_groups = [];
        $my_great_groups = [];

        foreach($my_groups as $group ) {
            $my_great_groups [] = Category::find($group);
        }
        $all_groups = Category::get();
        foreach($all_groups as $group ){
            if(!in_array($group->id, $my_groups)){
                $avilable_groups [] = $group;
            }
        }

        return view('vendor.profile', compact('supporter','avilable_groups','my_great_groups'));
    }

    public function deleteCategory($vendor,$category){
        $current_vendor = Vendor::find($vendor);
        $string = $current_vendor->categories;
        $array = explode('|',$string);
        $new_array = [];
        foreach($array as $arr){
            if($category != $arr){
                $new_array [] = $arr;
            }
        }
         $new_array = implode('|',$new_array);
        $current_vendor->update(['categories'=>$new_array]);
        return redirect()->back();
    }

    public function updateInfo(Request $request, $id)
    {
        $vendor = Vendor::find($id);
        if ($request->image) {
            unlink(public_path('assets/images/users') .'/' . $vendor->image);
            $fileName = $request->image->getClientOriginalName();
            $file_to_store = time() . '_' . $fileName ;
            $request->image->move(public_path('assets/images/users'), $file_to_store);

        }
        else{
            $file_to_store = $vendor->image;
        }
        if($request->cards_id){
            $old  = $vendor->categories;
            $old_array = explode('|', $old);
            $new = $request->cards_id;
            foreach ($new as $n ){
                $old_array[] = $n;
            }
            $new_array = implode('|',$old_array);
            $request['cards_id']  = $new_array;
        }else{
            $request['cards_id'] = $vendor->categories;
        }


        $vendor->update([
            'name' => $request->name,
            'email' => $request->email,
            'image'=> $file_to_store,
            'categories' => $request['cards_id'],
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

            $currentPassword = Auth::User('vendor')->password;
            if(Hash::check($requestData['Current_Password'], $currentPassword))
            {
                $userId = Auth::User('vendor')->id;
                $currentVendor = Vendor::find($userId);
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
