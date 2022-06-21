<?php
use AmrShawky\LaravelCurrency\Facade\Currency;
?>
@extends("layouts.admin")
@section("pageTitle", "Ejada")
@section("style")
@endsection
@section("content")
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive " >
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    <h5 class="">{{__('admin/category.Category')}}</h5>

                    <table id="" class="table table-bordered dt-responsive nowrap " style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <thead>
                        <tr>
                            <th>{{__('admin/category.ID')}}</th>
                            <th>{{__('admin/category.Image')}}</th>
                            <th>{{__('admin/category.Name')}}</th>
                            <th>{{__('admin/category.Price')}}</th>
                            <th>{{__('admin/category.ProductsCount')}}</th>
                            <th>{{__('admin/category.AddProduct')}}</th>
                            <th>{{__('admin/category.ShowProducts')}}</th>
                            <th>{{__('admin/category.Controls')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0 ?>
                            @foreach ($vendors as $vendor)
                            <tr>
                                <th>{{$i = $i +1 }}</th>
                                <th>
                                    <a class="btn btn-dark col-sm-12" onclick="modelDes('{{$vendor->id}}','{{$vendor->image}}')" data-toggle="modal" data-target="#image{{$vendor->id}}">{{__('admin/category.Show')}}</a><br>
                                </th>
                                <th>{{$vendor->name}}</th>
                                <th>
                                    @if(Session::get('currency') == 'USD')
                                        {{ round($vendor->price,2) . ' '.Session::get('currency')}}
                                    @else
                                        <?php
                                        $new_balance=  Currency::convert()
                                            ->from('USD')
                                            ->to(Session::get('currency'))
                                            ->amount($vendor->price)
                                            ->get();
                                        //echo $new_balance;
                                        ?>
                                        {{ round($new_balance,2) .' '. Session::get('currency')}}
                                    @endif

                                </th>
                                <th>{{count($vendor->products)}}</th>
                                <th>
                                    <a class="btn btn-dark col-sm-12" onclick="modelAddProduct('{{$vendor->id}}')" data-toggle="modal" data-target="#form{{$vendor->id}}">{{__('admin/category.Add')}}</a><br>
                                </th>
                                <th>
                                    <a class="btn btn-dark col-sm-12" href="{{route('admin.productCategory',['id' => $vendor->id])}}">{{__('admin/category.Show')}}</a><br>
                                </th>
                                <th>
                                    <center>
                                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">

                                            <div class="btn-group" role="group">
                                                <button id="btnGroupDrop1" type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    {{__('admin/category.Controls')}}
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                    {{-- <a class="btn btn-dark col-sm-12" href="{{route('admin.vendor.show', ['vendor'=>$vendor->id])}}">Show</a><br> --}}
                                                    <a class="btn btn-dark col-sm-12"  href="{{route('admin.category.edit', ['category'=>$vendor->id])}}">{{__('admin/category.Update')}}</a>
                                                    <form method="post" action="{{route('admin.category.destroy', ['category'=>$vendor->id])}}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-dark col-sm-12" >{{__('admin/category.Delete')}}</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </center>


                                </th>

                            </tr>
                            @endforeach
                    </table>
                    {{ $vendors->links() }}
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <div id="modelImagee">

    </div>
    <div id="modelAdd">

    </div>
<script>
    function modelDes(x,y){
        document.getElementById('modelImagee').innerHTML =`
            <div class="modal " id="image`+x+`" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">  {{__('admin/category.Image')}}  </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="group-img-container text-center post-modal">
                                <img  src="{{asset('assets/images/users/`+ y +`')}}" alt="" class="group-img img-fluid" style="width:400px; hieght:400px" ><br>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">غلق</button>
                        </div>
                    </div>
                </div>
            </div>
        `
    }

    function modelAddProduct(x){
        document.getElementById('modelAdd').innerHTML =`
            <div class="modal " id="form`+x+`" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"> {{__('admin/category.Image')}} </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{route('admin.product.store')}}" >
                            @csrf
                            <input type="hidden" name="category_id" value="`+x+`">
                            <input type="hidden" name="state" value="available">
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">{{__('admin/category.Code')}}:</label>
                                    <textarea class="form-control" name="code" id="message-text"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">{{__('admin/category.Save')}}</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('admin/category.Close')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        `
    }
</script>
@endsection
@section("script")
<script src="{{asset("assets/admin/js/app.js")}}"></script>

@endsection
