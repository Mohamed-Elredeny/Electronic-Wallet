<?php
use AmrShawky\LaravelCurrency\Facade\Currency;
?>
@extends("layouts.vendor")
@if(LaravelLocalization::getCurrentLocale() == 'ar')
@section("pageTitle", "الرئيسية")
@else
@section("pageTitle", "Home")
@endif
@section('styleChart')
<link href="{{asset("assets/admin/libs/c3/c3.min.css")}}" id="bootstrap-style" rel="stylesheet" type="text/css"/>
@endsection
@section("content")
{{-- {{ Money::USD(500)}} --}}
<div class="row">
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="mini-stat clearfix">
                    <span class="font-size-40 text-primary mr-0 float-right"><i class="fa fa-coins"></i></span>
                    <div class="mini-stat-info">
                        <h3 class="counter font-weight-normal mt-0">
                            @if(Session::get('currency') == 'USD')
                                {{ round($walletsNum,2) . ' '.Session::get('currency')}}
                            @else
                                <?php

                                $new_balance=  Currency::convert()
                                    ->from('USD')
                                    ->to(Session::get('currency'))
                                    ->amount($walletsNum)
                                    ->get();
                                //echo $new_balance;
                                ?>
                                {{ round($new_balance,2) .' '. Session::get('currency')}}
                            @endif
                            {{-- {{$walletsNum}} --}}
                        </h3>
                    </div>
                    <div class="clearfix"></div>
                    <p class=" mb-0 mt-2 text-muted">{{__('admin/home.Balance')}} <span class="float-right"></span></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="mini-stat clearfix">
                    <span class="font-size-40 text-success mr-0 float-right"><i class="fa fa-coins"></i></span>
                    <div class="mini-stat-info">
                        <h3 class="counter font-weight-normal mt-0">
                            @if(Session::get('currency') == 'USD')
                                {{ round($DepositsNum,2) . ' '.Session::get('currency')}}
                            @else
                                <?php

                                $new_balance=  Currency::convert()
                                    ->from('USD')
                                    ->to(Session::get('currency'))
                                    ->amount($DepositsNum)
                                    ->get();
                                //echo $new_balance;
                                ?>
                                {{ round($new_balance,2) .' '. Session::get('currency')}}
                            @endif
                            {{-- {{$DepositsNum}} --}}
                        </h3>
                    </div>
                    <div class="clearfix"></div>
                    <p class=" mb-0 mt-2 text-muted">{{__('transactions.deposit')}} <span class="float-right"></span></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="mini-stat clearfix">
                    <span class="font-size-40 text-pink mr-0 float-right"><i class="fa fa-coins"></i></span>
                    <div class="mini-stat-info">
                        <h3 class="counter font-weight-normal mt-0">
                            @if(Session::get('currency') == 'USD')
                            {{ round($WithdrawsNum,2) . ' '.Session::get('currency')}}
                            @else
                                <?php

                                $new_balance=  Currency::convert()
                                    ->from('USD')
                                    ->to(Session::get('currency'))
                                    ->amount($WithdrawsNum)
                                    ->get();
                                //echo $new_balance;
                                ?>
                                {{ round($new_balance,2) .' '. Session::get('currency')}}
                            @endif
                            {{-- {{$WithdrawsNum}} --}}
                        </h3>
                    </div>
                    <div class="clearfix"></div>
                    <p class=" mb-0 mt-2 text-muted">{{__('transactions.withdraw')}} <span class="float-right"></span></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="mini-stat clearfix">
                    <span class="font-size-40 text-warning mr-0 float-right"><i class="fa fa-coins"></i></span>
                    <div class="mini-stat-info">
                        <h3 class="counter font-weight-normal mt-0">{{$transactionNum}}</h3>
                    </div>
                    <div class="clearfix"></div>
                    <p class=" mb-0 mt-2 text-muted">{{__('admin/home.Transactions')}} <span class="float-right"></span></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card">
            <div class="card-body">
             <div class="mini-stat clearfix">
                 <span class="font-size-40 text-success mr-0 float-right"><i class=" fab fa-gratipay"></i></span>
                 <div class="mini-stat-info">
                     <h3 class="counter font-weight-normal mt-0">{{$productsNum}}</h3>
                 </div>
                 <div class="clearfix"></div>
                 <p class=" mb-0 mt-2 text-muted">{{__('section.my_Wishlist')}}<span class="float-right"></span></p>
             </div>
            </div>
        </div>
     </div>
     <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card">
            <div class="card-body">
             <div class="mini-stat clearfix">
                 <span class="font-size-40 text-pink mr-0 float-right"><i class="mdi mdi-cart-outline"></i></span>
                 <div class="mini-stat-info">
                     <h3 class="counter font-weight-normal mt-0">{{$productsAvailableNum}}</h3>
                 </div>
                 <div class="clearfix"></div>
                 <p class=" mb-0 mt-2 text-muted">{{__('admin/home.products')}}<span class="float-right"></span></p>
             </div>
            </div>
        </div>
     </div>
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="mini-stat clearfix">
                    <span class="font-size-40 text-pink mr-0 float-right"><i class="mdi mdi-comment-question"></i></span>
                    <div class="mini-stat-info">
                        <h3 class="counter font-weight-normal mt-0">{{$tickets}}</h3>
                    </div>
                    <div class="clearfix"></div>
                    <p class=" mb-0 mt-2 text-muted">{{__('admin/home.Tickets')}} <span class="float-right"></span></p>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">

    <div class="col-xl-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">{{__('admin/home.LatestTickets')}}</h4>

                <div class="inbox-widget">
                    @foreach ($ticketsLast as $ticketLast)
                    <a href="{{route('admin.ticket.show', ['ticket' => $ticketLast->id])}}">
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="{{asset('assets/images/users')}}/{{$ticketLast->vendor->image}}" class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author">{{$ticketLast->title}}</p>
                            <p class="inbox-item-date">{{date('Y-m-d',strtotime($ticketLast->created_at))}}</p>
                        </div>
                    </a>
                    @endforeach

                    <div class="text-center mt-4 pt-3">
                        <a href="{{route('vendor.ticket.index')}}" class="btn btn-sm btn-primary waves-light waves-effect">{{__('admin/home.LoadMore')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">{{__('admin/home.LastTransactions')}} </h4>

                <ol class="activity-feed mb-0">
                    @foreach ($transactionssLast as $transactionLast)
                    @if($transactionLast->type == 'deposit')
                    <li class="feed-item">
                        <span class="date">{{date('Y-m-d',strtotime($transactionLast->created_at))}}</span>
                        <span class="activity-text">
                            +

                            @if(Session::get('currency') == 'USD')
                                {{ round($transactionLast->amount,2) . ' '.Session::get('currency')}}
                            @else
                                <?php
                                $new_balance=  Currency::convert()
                                    ->from('USD')
                                    ->to(Session::get('currency'))
                                    ->amount($transactionLast->amount)
                                    ->get();
                                //echo $new_balance;
                                ?>
                                {{ round($new_balance,2) .' '. Session::get('currency')}}
                            @endif

                            {{__('transactions.deposit_message')}}
                            {{$transactionLast->vendor->name}}
                            {{__('transactions.transaction_number')}} &#160; {{'#'. $transactionLast->id}}  &#160;
                        </span>
                    </li>
                    @else
                    <li class="feed-item">
                        <span class="date">{{date('Y-m-d',strtotime($transactionLast->created_at))}}</span>
                        <span class="activity-text">
                            -

                            @if(Session::get('currency') == 'USD')
                                {{ round($transactionLast->amount,2) . ' '.Session::get('currency')}}
                            @else
                                <?php
                                $new_balance=  Currency::convert()
                                    ->from('USD')
                                    ->to(Session::get('currency'))
                                    ->amount($transactionLast->amount)
                                    ->get();
                                //echo $new_balance;
                                ?>
                                {{ round($new_balance,2) .' '. Session::get('currency')}}
                            @endif

                            {{__('transactions.Withdraw_message')}} 
                            {{$transactionLast->vendor->name}}
                            {{__('transactions.transaction_number')}} &#160; {{'#'. $transactionLast->id}}  &#160;
                        </span>
                    </li>
                    @endif
                    @endforeach
                </ol>

                <div class="text-center mt-3">
                    <a href="{{route('vendor.transaction',['vendor_id'=>Auth::guard('vendor')->user()->id,'admin'=>0])}}" class="btn btn-sm btn-primary">{{__('admin/home.LoadMore')}}</a>
                </div>
            </div>
        </div>
    </div>


    <div class="col-xl-4">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title mb-4">{{__('admin/home.Tickets')}}</h4>

            </div>

                <div id="donut-chart" dir="ltr"></div>

            </div>
        </div>
    </div>


</div>
<!-- end row -->
@endsection

@section("script")
<script src="{{asset("assets/admin/libs/d3/d3.min.js")}}"></script>
<script src="{{asset("assets/admin/libs/c3/c3.min.js")}}"></script>
<script src="{{asset("assets/admin/js/app.js")}}"></script>

{{-- <script src="{{asset("assets/admin/js/pages/c3-chart.init.js")}}"></script> --}}
<script>
    //  

    !function(e){"use strict";
    function a(){}a.prototype.init=function(){
        
        c3.generate({
            bindto:"#donut-chart",
            data:{
                columns:[
                    ["{{__('admin/home.Open')}}",{{$openTickets}}],
                    ["{{__('admin/home.Close')}}",{{$closeTickets}}],
                    ["{{__('admin/home.Accept')}}",{{$acceptTickets}}],
                    ["{{__('admin/home.Refused')}}",{{$refuseTickets}}],
                    ["{{__('admin/home.Pending')}}",{{$pendingTickets}}]
                ],
                type:"donut"
            },
            donut:{
                title:"{{__('admin/home.Ticket')}}",
                width:30,
                label:{show:!1}
            },
            color:{
                pattern:["#ffbb44","#39325c","#4ac18e","#f06292","#3bc3e9"]
            }
        })}
        e.ChartC3=new a,e.ChartC3.Constructor=a}(window.jQuery),function(){
            "use strict";window.jQuery.ChartC3.init()
        }();
</script>
@endsection