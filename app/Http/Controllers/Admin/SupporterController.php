<?php

namespace App\Http\Controllers\Admin;

use App\models\Supporter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class SupporterController extends Controller
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
        $vendors = Supporter::paginate(10);
        return view('admin.supporters.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.supporters.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'email' => ['required', 'email', 'max:255', 'unique:supporters'],
        ];

        $this->validate($request,$rules);
        $fileName = $request->imagee->getClientOriginalName();
        $file_to_store = time() . '_' . $fileName ;
        $request->imagee->move(public_path('assets/images/users'), $file_to_store);

        $request['password'] = Hash::make($request->password);
        $request['image'] = $file_to_store;
        Supporter::create($request->all());
        return redirect()->route('admin.supporter.index')->with('success', 'تم الاضافة بنجاح');
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
        $vendor = Supporter::find($id);
        return view('admin.supporters.edit', compact('vendor'));
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
        if ($request->password) {
            $request['password'] = Hash::make($request->password);
        }
        else{
            $request['password'] = $vendor->password;
        }

        $vendor->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
            'image'=> $file_to_store,
        ]);

        return redirect()->route('admin.supporter.index')->with('success', 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $old = Supporter::find($id);
        $old->delete();
        return redirect()->route('admin.supporter.index')->with('success', 'تم الحذف بنجاح');
    }
}
