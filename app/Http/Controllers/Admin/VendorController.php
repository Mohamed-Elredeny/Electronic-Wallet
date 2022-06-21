<?php

namespace App\Http\Controllers\Admin;

use App\models\Category;
use App\models\Vendor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = Vendor::paginate(10);
        return view('admin.vendors.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = Category::get();
        return view('admin.vendors.create',compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        $rules = [
            'email' => ['required', 'email', 'max:255', 'unique:vendors'],
        ];

        $this->validate($request,$rules);
        $fileName = $request->imagee->getClientOriginalName();
        $file_to_store = time() . '_' . $fileName ;
        $request->imagee->move(public_path('assets/images/users'), $file_to_store);

        $request['password'] = Hash::make($request->password);
        $request['image'] = $file_to_store;
        $request['categories'] = $res;
        Vendor::create($request->all());
        return redirect()->route('admin.vendor.index')->with('success', 'تم الاضافة بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vendor = Vendor::find($id);
        $my_groups =  explode('|', $vendor->categories);

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

        return view('admin.vendors.edit', compact('vendor','avilable_groups','my_great_groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
        if ($request->password) {
            $request['password'] = Hash::make($request->password);
        }
        else{
            $request['password'] = $vendor->password;
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
            'password' => $request->password,
            'image'=> $file_to_store,
            'categories'=>$request['cards_id']
        ]);

        return redirect()->route('admin.vendor.index')->with('success', 'تم التعديل بنجاح');
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
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $old = Vendor::find($id);
        $old->delete();
        return redirect()->route('admin.vendor.index')->with('success', 'تم الحذف بنجاح');
    }
}
