<?php
//use Akaunting\Money\Money;
//use Akaunting\Money\Currency;

use AmrShawky\LaravelCurrency\Facade\Currency;

?>
@extends("layouts.vendor")
@if(LaravelLocalization::getCurrentLocale() == 'ar')
@section("pageTitle", "قائمة الطلبات")
@else
@section("pageTitle", "Order History")
@endif
@section('style')
    <link href="{{asset("assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("assets/admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("assets/admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css")}}" rel="stylesheet" type="text/css"/>
@endsection
@section("content")
<div class="row">
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="mini-stat clearfix">
                    <span class="font-size-40 text-primary mr-0 float-right"><i class="fa fa-coins"></i></span>
                    <div class="mini-stat-info">
                        <h3 class="counter font-weight-normal mt-0">$36,410</h3>
                    </div>
                    <div class="clearfix"></div>
                    <p class=" mb-0 mt-2 text-muted">{{__('orders.MyBalance')}} <span class="float-right"></span></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-6 col-xl-3">
       <div class="card">
           <div class="card-body">
            <div class="mini-stat clearfix">
                <span class="font-size-40 text-success mr-0 float-right"><i class="mdi mdi-cart-outline"></i></span>
                <div class="mini-stat-info">
                    <h3 class="counter font-weight-normal mt-0">$29,854</h3>
                </div>
                <div class="clearfix"></div>
                <p class=" mb-0 mt-2 text-muted">{{__('orders.MyPurchases')}}<span class="float-right"></span></p>
            </div>
           </div>
       </div>
    </div>
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="mini-stat clearfix">
                    <span class="font-size-40 text-warning mr-0 float-right"><i class="mdi mdi-fingerprint"></i></span>
                    <div class="mini-stat-info">
                        <h3 class="counter font-weight-normal mt-0">500</h3>
                    </div>
                    <div class="clearfix"></div>
                    <p class=" mb-0 mt-2 text-muted">{{__('orders.AllOrders')}} <span class="float-right"></span></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="mini-stat clearfix">
                    <span class="font-size-40 text-danger mr-0 float-right"><i class="mdi mdi-heart"></i></span>
                    <div class="mini-stat-info">
                        <h3 class="counter font-weight-normal mt-0">200</h3>
                    </div>
                    <div class="clearfix"></div>
                    <p class=" mb-0 mt-2 text-muted">{{__('orders.WishlistProducts')}} <span class="float-right"></span></p>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="datatable" class="table table-striped dt-responsive nowrap table-vertical" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>{{__('orders.OrderID')}}</th>
                        <th>{{__('orders.OrderDate')}}</th>
                        <th>{{__('orders.Name')}}</th>
                        <th>{{__('orders.Amount')}}</th>
                        <th>{{__('orders.Count')}}</th>
                        <th>{{__('orders.Information')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                            <td>
                                <a href="#" class="font-weight-bold text-muted">#{{$order->transaction_number}}</a>
                            </td>
                            <td>{{date_format($order->created_at,'d-m-Y')}}</td>
                            <td>
                                {{\App\models\Product::find($order->product_id)->category->name }}
                            </td>
                            <td>
                                @if(Session::get('currency') == 'USD')
                                    {{ round($order->price,2) * $order->count . ' '.Session::get('currency')}}
                                @else
                                    <?php
                                    $new_balance=  Currency::convert()
                                        ->from('USD')
                                        ->to(Session::get('currency'))
                                        ->amount($order->price)
                                        ->get();
                                    //echo $new_balance;
                                    ?>
                                        {{ round($new_balance,2) * $order->count.' '. Session::get('currency')}}

                                @endif

                            </td>
                            <td>{{$order->count}}</td>
                            <td>
                                <a href="{{route('vendor.order.details',['transaction_number'=>$order->transaction_number])}}" class="btn btn-primary">{{__('orders.Show')}}</a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection
@section("script")
<script>
    $(document).ready(function() {
        $('#datatable').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'print'
            ]
        } );
    } );


</script>
<script src="{{asset("assets/admin/libs/datatables.net/js/jquery.dataTables.min.js")}}"></script>
<script src="{{asset("assets/admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js")}}"></script>
<script src="{{asset("assets/admin/libs/datatables.net-buttons/js/dataTables.buttons.min.js")}}"></script>
<script src="{{asset("assets/admin/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js")}}"></script>
<script src="{{asset("assets/admin/libs/jszip/jszip.min.js")}}"></script>
<script src="{{asset("assets/admin/libs/pdfmake/build/pdfmake.min.js")}}"></script>
<script src="{{asset("assets/admin/libs/pdfmake/build/vfs_fonts.js")}}"></script>
<script src="{{asset("assets/admin/libs/datatables.net-buttons/js/buttons.html5.min.js")}}"></script>
<script src="{{asset("assets/admin/libs/datatables.net-buttons/js/buttons.print.min.js")}}"></script>
<script src="{{asset("assets/admin/libs/datatables.net-buttons/js/buttons.colVis.min.j")}}"></script>
<script src="{{asset("assets/admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js")}}"></script>
<script src="{{asset("assets/admin/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js")}}"></script>
<script src="{{asset("assets/admin/js/pages/ecommerce.init.js")}}"></script>
<script src="{{asset("assets/admin/js/app.js")}}"></script>
@endsection
