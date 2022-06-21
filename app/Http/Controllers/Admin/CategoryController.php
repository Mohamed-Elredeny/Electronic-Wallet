<?php

namespace App\Http\Controllers\Admin;

use AmrShawky\LaravelCurrency\Facade\Currency;
use App\Http\Controllers\Controller;
use App\models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
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
        $vendors = Category::paginate(10);
        return view('admin.category.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
        public function store(Request $request)
    {
        $fileName = $request->imagee->getClientOriginalName();
        $file_to_store = time() . '_' . $fileName ;
        $request->imagee->move(public_path('assets/images/users'), $file_to_store);
        if(Session::get('currency') != 'USD'){
            $amount=  Currency::convert()
                ->from(Session::get('currency'))
                ->to('USD')
                ->amount($request->price)
                ->get();
        }else{
            $amount = $request->price;
        }

        //$request->price = $amount;
        //$request['image'] = $file_to_store;
        Category::create([
            'price'=>$amount,
            'name'=>$request->name,
            'image'=>$file_to_store
        ]);
        return redirect()->route('admin.category.index')->with('success', 'تم الاضافة بنجاح');
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
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
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
        $category = Category::find($id);
        if ($request->image) {
            unlink(public_path('assets/images/users') .'/' . $category->image);
            $fileName = $request->image->getClientOriginalName();
            $file_to_store = time() . '_' . $fileName ;
            $request->image->move(public_path('assets/images/users'), $file_to_store);
        }
        else{
            $file_to_store = $category->image;
        }

        $category->update([
            'name' => $request->name,
            'image'=> $file_to_store,
            'phone' => $request->phone,
        ]);

        return redirect()->route('admin.category.index')->with('success', 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $old = Category::find($id);
        $old->delete();
        return redirect()->route('admin.category.index')->with('success', 'تم الحذف بنجاح');
    }
}
