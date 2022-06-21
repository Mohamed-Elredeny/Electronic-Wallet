<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\models\Category;
use App\models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
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
        $products = Product::paginate(10);
        $type = 'all';
        return view('admin.product.index', compact('products', 'type'));
    }

    public function soled()
    {
        $products = Product::where('state', 'soled')->paginate(10);
        $type = 'soled';
        return view('admin.product.index', compact('products', 'type'));
    }

    public function available()
    {
        $products = Product::where('state', 'available')->paginate(10);
        $type = 'available';
        return view('admin.product.index', compact('products', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $code = $request->code;
        $code = preg_replace('/\s+/', ' ', $code);
        $code_explode = explode(' ', $code);
        for($i= 0;$i<count($code_explode);$i++ ) {
            Product::create([
                'code'=>$code_explode[$i],
                'state'=>$request->state,
                'category_id'=>$request->category_id
            ]);
        }
        return redirect()->back()->with('success', 'تم الاضافة بنجاح');
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
        $product = Product::find($id);
        $categories = Category::get();
        return view('admin.product.edit', compact('product', 'categories'));
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
        $product = Product::find($id);

        $product->update([
            'code' => $request->code,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('admin.product.index')->with('success', 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $old = Product::find($id);
        $old->delete();
        return redirect()->route('admin.product.index')->with('success', 'تم الحذف بنجاح');
    }

    public function productCategory($id)
    {
        $products = Product::where('category_id', $id)->paginate(10);
        return view('admin.product.filter', compact('products'));
    }
}
