<?php
use AmrShawky\LaravelCurrency\Facade\Currency;
?>
@extends("layouts.vendor")
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

        @foreach($transactions as $trans)

            <div class="row">
                @if($trans->type == 'deposit')
                    <div class="col-sm-2" style="color: rgb(82, 176, 53)">+

                        @if(Session::get('currency') == 'USD')
                            {{ round($trans->amount,2) . ' '.Session::get('currency')}}
                        @else
                            <?php
                            $new_balance=  Currency::convert()
                                ->from('USD')
                                ->to(Session::get('currency'))
                                ->amount($trans->amount)
                                ->get();
                            //echo $new_balance;
                            ?>
                            {{ round($new_balance,2) .' '. Session::get('currency')}}
                        @endif

                    </div>

                    <div class="col-sm-8">

                        <div>{{__('transactions.deposit_message')}}

                            {{__('transactions.transaction_number')}} &#160; {{'#'. $trans->id}}  &#160;

                        </div>
                        <div>

                            <i class="far fa-calendar"></i> {{date_format(date_create($trans->created_at),'Y/m/d' )}}
                            <br>
                            <i class="far fa-clock"></i> {{date_format(date_create($trans->created_at),'h:i:s A' )}}

                        </div>
                    </div>

                @elseif($trans->type == 'withdraw')
                    <div class="col-sm-2" style="color:red">-
                        @if(Session::get('currency') == 'USD')
                            {{ round($trans->amount,2) . ' '.Session::get('currency')}}
                        @else
                            <?php

                            $new_balance=  Currency::convert()
                                ->from('USD')
                                ->to(Session::get('currency'))
                                ->amount($trans->amount)
                                ->get();
                            //echo $new_balance;
                            ?>
                            {{ round($new_balance,2) .' '. Session::get('currency')}}
                        @endif

                    </div>

                    <div class="col-sm-8">

                        <div>{{__('transactions.Withdraw_message')}}

                            {{__('transactions.transaction_number')}} &#160; {{'#'. $trans->id}}  &#160;

                        </div>
                        <div>
                            <i class="far fa-calendar"></i> {{date_format(date_create($trans->created_at),'Y/m/d' )}}
                            <br>
                            <i class="far fa-clock"></i> {{date_format(date_create($trans->created_at),'h:i:s A' )}}

                        </div>
                    </div>

                @else

                    <div class="col-sm-2" style="color:red">-
                        @if(Session::get('currency') == 'USD')
                            {{ round($trans->amount,2) . ' '.Session::get('currency')}}
                        @else
                            <?php

                            $new_balance=  Currency::convert()
                                ->from('USD')
                                ->to(Session::get('currency'))
                                ->amount($trans->amount)
                                ->get();
                            //echo $new_balance;
                            ?>
                            {{ round($new_balance,2) .' '. Session::get('currency')}}
                        @endif

                    </div>

                    <div class="col-sm-8">

                        <div>{{__('transactions.make_new_order')}}

                            {{__('transactions.transaction_number')}} &#160; {{'#'. $trans->id}}  &#160;

                        </div>
                        <div>
                            <i class="far fa-calendar"></i> {{date_format(date_create($trans->created_at),'Y/m/d' )}}
                            <br>
                            <i class="far fa-clock"></i> {{date_format(date_create($trans->created_at),'h:i:s A' )}}

                        </div>
                    </div>
                    <div class="col-sm-2" style="color: rgb(82, 176, 53)">
                        <a href="{{route('vendor.order.details',['transaction_number'=>$trans->operation_id])}}"
                           target="_blank"
                           class="btn btn-dark">{{__('transactions.view_cards')}}</a>
                    </div>

                @endif
            </div>
            <br>
            <hr>
            <br>
        @endforeach
        {{$transactions->links()}}


    </div>
@endsection
@section("script")
    <script src="{{asset("assets/admin/js/app.js")}}"></script>
@endsection