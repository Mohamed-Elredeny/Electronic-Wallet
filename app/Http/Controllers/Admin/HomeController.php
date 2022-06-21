<?php

namespace App\Http\Controllers\Admin;

use App\models\Product;
use App\models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Admin;
use App\models\Supporter;
use App\models\Ticket;
use App\models\Vendor;
use App\models\VendorTransaction;
use App\models\VendorWallet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $walletsNum = VendorWallet::sum('ballance');
        $DepositsNum = VendorTransaction::where('type','deposit')->sum('amount');
        $WithdrawsNum = VendorTransaction::where('type','withdraw')->sum('amount');
        $transactionNum = VendorTransaction::count();

        $categoryNum = Category::count();
        $productsNum = Product::count();
        $productsAvailableNum = Product::where('state', 'available')->count();
        $productssoldNum = Product::where('state', 'sold')->count();

        $vendors = Vendor::count();
        $supporters = Supporter::count();
        $tickets = Ticket::count();

        $categories = Category::get();

        // المجموعة كام طالب و كام مدرس
        $peoductsCount=[
            'availables'=>[],
            'solds'=>[]
            ];
        $x='';
        $y ='';
        $z = '';
        $a ='';
        $b = '';
        
        // $availablesCount['availables'][] = '';
        // $soldsCount['solds'][] = '';
        foreach ($categories as $category) {
            $availables = Product::where('category_id', $category->id)->where('state', 'available')->count();
            $solds = Product::where('category_id', $category->id)->where('state', 'sold')->count();

            $x .= $availables;
            $availablesCount['availables'][] = $availables;
            $y .= $solds;
            $soldsCount['solds'][] = $solds;

        }

        $xx = '';
        $yy = '';


        if(count($categories)>0)
        {
            for($i=0;$i<count($availablesCount['availables']) ;$i++)
                {
                    $xx .= ',' . $availablesCount['availables'][$i];
                    $yy .= ',' . $soldsCount['solds'][$i];
                }
        }
        else
        {
            $availablesCount ='';
        }
                
        // return $xx;

        $ticketsLast = Ticket::latest()->take(5)->get();
        $transactionssLast = VendorTransaction::latest()->take(5)->get();

        $openTickets = Ticket::where('state', 'open')->count();
        $pendingTickets = Ticket::where('state', 'pending')->count();
        $closeTickets = Ticket::where('state', 'close')->count();
        $acceptTickets = Ticket::where('state', 'accept')->count();
        $refuseTickets = Ticket::where('state', 'refuse')->count();
        // return $tickets;

        return view('admin.home', compact('walletsNum', 'DepositsNum','WithdrawsNum' ,'transactionNum', 
                    'categoryNum', 'productsNum', 'productsAvailableNum', 'productssoldNum', 
                    'vendors', 'supporters', 'tickets',
                'availablesCount', 'xx', 'yy', 'categories',
                'ticketsLast', 'transactionssLast',
                'openTickets', 'pendingTickets', 'closeTickets', 'acceptTickets', 'refuseTickets'
            ));
    }

    public function categorySearch(Request $request)
    {
        $caregory = Category::where('name', 'like', $request->name)->first();
        if ($caregory) {
            $products = Product::where('category_id', $caregory['id'])->paginate(10);
        }
        else
        {
            $products = Product::where('category_id', 0)->paginate(10);
        }
        return view('admin.product.filter', compact('products'));
    }

    public function profile()
    {
        $supporter = Admin::find(Auth::guard('admin')->id());
        return view('admin.profile', compact('supporter'));
    }

    public function updateInfo(Request $request, $id)
    {
        $vendor = Admin::find($id);
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

            $currentPassword = Auth::User('admin')->password;
            if(Hash::check($requestData['Current_Password'], $currentPassword))
            {
                $userId = Auth::User('admin')->id;
                $currentVendor = Admin::find($userId);
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
