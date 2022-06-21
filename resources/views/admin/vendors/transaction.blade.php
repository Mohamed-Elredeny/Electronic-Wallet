@extends("layouts.admin")
@if(LaravelLocalization::getCurrentLocale() == 'ar')
@section("pageTitle", "التعاملات المالية")
@else
@section("pageTitle", "Transactions")
@endif
@section('style')
    <link href="{{asset("assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("assets/admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("assets/admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css")}}" rel="stylesheet" type="text/css"/>
@endsection
@section("content")
    <div class="m-5 p-5 bg-white">
        <div class="row">
            <div class="col-sm-2" style="color: rgb(82, 176, 53)">+ 400 $</div>
            <div class="col-sm-10">
                <div>{{__('transaction.Profit_from_order_execution')}} #1941979 </div>
                <div>
                    <i class="far fa-clock"></i> 26/09/2021
                </div>
            </div>
        </div>
        <br>
        <hr>
        <br>
        <div class="row">
            <div class="col-sm-2" style="color: rgb(231, 87, 55)">- 400 $</div>
            <div class="col-sm-10">
                <div>{{__('transaction.Money_has_been_withdrawn_to_purchase_the_order_id')}} #1941979 </div>
                <div>
                    <i class="far fa-clock"></i> 26/09/2021
                </div>
            </div>
        </div>
    </div>
@endsection
@section("script")
<script src="{{asset("assets/admin/js/app.js")}}"></script>
@endsection 