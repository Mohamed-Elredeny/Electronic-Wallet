<?php

namespace App\Http\Controllers;

use AmrShawky\LaravelCurrency\Facade\Currency;
use Akaunting\Money\Money;
use App\models\Vendor;
use App\models\VendorTransaction;
use App\models\VendorWallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Session;

class MoneyController extends Controller
{
    public $currency;
    public $balance ;
    public $amount;


    public function test($vendor_id)
    {

        $vendor = Vendor::find($vendor_id);
        if ($vendor) {
            $wallet = VendorWallet::where('vendor_id', $vendor_id)->get();
            if (count($wallet) <= 0) {
               $userWallet= VendorWallet::create([
                    'ballance' => 0,
                    'currency' => 'USD',
                    'vendor_id'=>$vendor_id
                ]);
            }else{
                $userWallet = $wallet[0];
            }
            $deposit = VendorTransaction::where('vendor_id',$vendor_id)->where('type','deposit')->get();
            $deposit_total = 0;
            foreach($deposit as $d){
                $deposit_total += $d->amount;
            }
            $withdraw = VendorTransaction::where('vendor_id',$vendor_id)->where('type','withdraw')->get();
            $withdraw_total = 0;
            foreach($withdraw as $d){
                $withdraw_total += $d->amount;
            }

            return view('admin.vendors.balance.balance',compact('userWallet','vendor_id','deposit_total','withdraw_total'));
        }else{
            return redirect()->back();
        }
    }
    public function updateCurrency(Request $request ,$vendor){
        $vendorr = VendorWallet::where('vendor_id',$vendor)->first();
        $old_currency = $vendorr->currency;
        $new_currency = $request->currency;
        $balance = $vendorr->ballance;
      /*  return [
           'old_currency'=> $old_currency ,
        'new_currency' => $new_currency ,
        'balance'=>$balance
        ];*/
        $new_balance=  Currency::convert()
            ->from($old_currency)
            ->to($new_currency)
            ->amount($balance)
            ->get();
        $new_balance = doubleval($new_balance);
       // return $new_balance;
        $vendorr->update([
            'currency'=>$request->currency,
            'ballance'=>$new_balance
        ]);
        return redirect()->back()->with('message','updated successfully');

    }
    public function updateCurrencyCharge(Request $request,$type,$id){
        $vendor_id = VendorWallet::where('vendor_id',$id)->first();
        $amount = doubleval($request->amount);
        if(Session::get('currency') != 'USD'){
            $amount=  Currency::convert()
            ->from(Session::get('currency'))
            ->to('USD')
            ->amount($amount)
            ->get(); 
        }
        
        if($type == 'deposit'){
            $vendor_id->ballance= $vendor_id->ballance +$amount;
            $vendor_id->update([
                'ballance'=>$vendor_id->ballance
            ]);
        }else{
            $vendor_id->ballance= $vendor_id->ballance - $amount;
            $vendor_id->update([
                'ballance'=>$vendor_id->ballance
            ]);
        }
        $this->transaction($id,$amount,$type);
        return redirect()->back()->with('message','updated successfully');
    }

    public function transaction($vendor_id,$amount,$type){
            VendorTransaction::create([
                'vendor_id'=>$vendor_id,
                'amount'=>$amount,
                'type'=>$type,
                'currency'=>'USD'
            ]);
    }
    public function viewTransaction($vendor_id,$admin){
        if($admin == 0) {
            $transactions = VendorTransaction::where('vendor_id', $vendor_id)->orderBy('created_at', 'ASC')->paginate(10);
        }else{
            $transactions = VendorTransaction::orderBy('created_at', 'ASC')->paginate(10);
        }
       return view('admin.transaction',compact('transactions','admin'));
    }
    public function viewTransactionVendor($vendor_id,$admin){
        if($admin == 0) {
            $transactions = VendorTransaction::where('vendor_id', $vendor_id)->orderBy('created_at', 'ASC')->paginate(10);
        }else{
            $transactions = VendorTransaction::orderBy('created_at', 'ASC')->paginate(10);
        }
        return view('vendor.transaction',compact('transactions','admin'));
    }
}
