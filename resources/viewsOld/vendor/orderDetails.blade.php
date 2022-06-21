@extends("layouts.vendor")
@if(LaravelLocalization::getCurrentLocale() == 'ar')
@section("pageTitle", "تفاصيل الطلب")
@else
@section("pageTitle", "Order Details")
@endif
@section('style')
    <link href="{{asset("assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("assets/admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("assets/admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css")}}" rel="stylesheet" type="text/css"/>
@endsection
@section("content")

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="datatable" class="table table-striped dt-responsive nowrap table-vertical" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>{{__('orders.OrderID')}}</th>
                        <th>{{__('orders.OrderDate')}}</th>
                        <th>{{__('orders.Amount')}}</th>
                        <th>{{__('orders.Code')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                     @foreach($products as $pro)
                        <tr>
                            <td>
                                <a href="#" class="font-weight-bold text-muted">#{{$pro->transaction_number}}</a>
                            </td>
                            <td>{{date_format($pro->created_at,'d-m-Y')}}</td>
                            <td>
                                @if(Session::get('currency') == 'USD')
                                    {{ round($pro->price,2) . ' '.Session::get('currency')}}
                                @else
                                    <?php
                                    $new_balance=  Currency::convert()
                                        ->from('USD')
                                        ->to(Session::get('currency'))
                                        ->amount($pro->price)
                                        ->get();
                                    //echo $new_balance;
                                    ?>
                                    {{ round($new_balance,2) .' '. Session::get('currency')}}
                                @endif

                            </td>
                            <td>
                                {{\App\models\Product::find($pro->product_id)->code}}

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
