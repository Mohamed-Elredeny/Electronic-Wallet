<?php
namespace App\Http\Controllers\Vendor;
use App\models\Product;
use Illuminate\Support\Facades\Session;

use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use App\models\VendorProduct;
use App\models\VendorWishlist;
use App\models\VendorWallet;
use App\models\UserNotification;
use App\models\VendorTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use AmrShawky\LaravelCurrency\Facade\Currency;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:vendor');

    }

    public function notify($user_id,$product_id){
        $curent_number =  Product::where('category_id',$product_id)->where('state','available')->get();
        UserNotification::create([
            'user_id'=>$user_id,
            'notification_id'=>3,
            'read'=>0,
            'category_id'=>$product_id,
            'curent_number'=>count($curent_number),
        ]);
    }

    public function makeOrder(Request $request){

        $vendor_id = $request->sad_vendor_id;
        $category = $request->sad_category_id;
        $price = $request->sad_price;
        if(Session::get('currency') != 'USD'){
            $price=  Currency::convert()
                ->from(Session::get('currency'))
                ->to('USD')
                ->amount($price)
                ->get();
        }
        //return $price;
        $quantity = $request->title;
        $transaction_number=  uniqid();

        $order_total_price = floatval($quantity * $price);
        $wallet = VendorWallet::where('vendor_id',$vendor_id)->first();
        $current_ballance = floatval($wallet->ballance);
        if($current_ballance > $order_total_price) {
            //1. Change Products State
            //2. Add Products To Vendor Product
            //3. Send Warning if products less than 10
            $products_num = $quantity;
            $available = Product::where('category_id', $category)->where('state', 'available')->get();
            if (count($available) >= $products_num) {
                for ($i = 0; $i < $products_num; $i++) {
                    //Sold
                    $available[$i]->update([
                        'state' => 'sold'
                    ]);
                    VendorProduct::create([
                        'vendor_id' => $vendor_id,
                        'product_id' => $available[$i]->id,
                        'transaction_number' => $transaction_number
                    ]);
                    $current_ballance -= $order_total_price;
                    $wallet->update([
                        'ballance'=>$current_ballance
                    ]);
                }
            }
            $new_available = Product::where('category_id', $category)->where('state', 'available')->get();
            if (count($available) <= 10) {
                $this->notify($vendor_id, $category);
            }
            $this->transaction($vendor_id, $quantity * $price, 'order', $transaction_number);
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }
    
    public function transaction($vendor_id,$amount,$type,$transaction_number){
        VendorTransaction::create([
            'vendor_id'=>$vendor_id,
            'amount'=>$amount,
            'type'=>$type,
            'currency'=>'USD',
            'operation_id'=>$transaction_number
        ]);
    }

    public function vendorOrders(){
        $vendor_id  = Auth::guard('vendor')->user()->id;
        $products = VendorProduct::where('vendor_id',$vendor_id)->get();
        $orders  = $products->unique('transaction_number');
        foreach($products as $prod){
            $real = Product::find($prod->product_id);
            $prod->category_name  = $real->name;
            $prod->count=  VendorProduct::where('transaction_number',$prod->transaction_number)->count();
            $prod->price=  $real->category->price * $prod->count;
        }
        return view('vendor.myOrders',compact('products','orders'));
    }

    public function OrderDetails($transaction_number){
        $products  =VendorProduct::where('transaction_number',$transaction_number)->get();
        foreach($products as $prod){
            $real = Product::find($prod->product_id);
            $prod->category_name  = $real->name;
            $prod->count=  VendorProduct::where('transaction_number',$prod->transaction_number)->count();
            $prod->price=  $real->category->price * $prod->count;
        }
        return view('vendor.orderDetails',compact('products'));
    }

    public function wishlist($action,$product_id){
        if($action == 'add'){
            VendorWishlist::create([
                'vendor_id'=>Auth::guard('vendor')->user()->id,
                'product_id'=>$product_id
            ]);
        }else{
            $wishlist = VendorWishlist::where('vendor_id',Auth::guard('vendor')->user()->id)->where('product_id',$product_id)->get();
            foreach($wishlist as $pro){
                $pro->delete();
            }
        }
        return redirect()->back();
    }
    
    public function viewWishlist(){
        $categories = VendorWishlist::where('vendor_id',Auth::guard('vendor')->user()->id)->get();
        return view('vendor.wishlist',compact('categories'));
    }
}
