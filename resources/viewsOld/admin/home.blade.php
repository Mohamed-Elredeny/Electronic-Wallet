<?php
use Akaunting\Money\Currency;
use Akaunting\Money\Money;
?>
@extends("layouts.admin")
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
                        <h3 class="counter font-weight-normal mt-0">5000</h3>
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
                    <span class="font-size-40 text-primary mr-0 float-right"><i class="fa fa-coins"></i></span>
                    <div class="mini-stat-info">
                        <h3 class="counter font-weight-normal mt-0">5000</h3>
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
                <span class="font-size-40 text-success mr-0 float-right"><i class="mdi mdi-cart-outline"></i></span>
                <div class="mini-stat-info">
                    <h3 class="counter font-weight-normal mt-0">9000</h3>
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
                    <span class="font-size-40 text-warning mr-0 float-right"><i class="mdi mdi-fingerprint"></i></span>
                    <div class="mini-stat-info">
                        <h3 class="counter font-weight-normal mt-0">500</h3>
                    </div>
                    <div class="clearfix"></div>
                    <p class=" mb-0 mt-2 text-muted">{{__('admin/home.Tickets')}} <span class="float-right"></span></p>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title mb-4">{{__('admin/home.ProductsCount')}}</h4>

                <div id="chart" dir="ltr"></div>
            </div>
        </div>
    </div> <!-- end col -->

</div> <!-- end row -->


<div class="row">

    <div class="col-xl-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">{{__('admin/home.LatestTickets')}}</h4>

                <div class="inbox-widget">
                    <a href="#">
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="{{asset('assets/admin/images/martina.jpg')}}" class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author">Didier Charpentier</p>
                            <p class="inbox-item-text">Hey! there I'm available...</p>
                            <p class="inbox-item-date">13:40 PM</p>
                        </div>
                    </a>
                    <a href="#">
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="{{asset('assets/admin/images/martina.jpg')}}" class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author">Sacripant Laderoute</p>
                            <p class="inbox-item-text">I've finished it! See you so...</p>
                            <p class="inbox-item-date">13:34 PM</p>
                        </div>
                    </a>
                    <a href="#">
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="{{asset('assets/admin/images/martina.jpg')}}" class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author">Huon Chalifour</p>
                            <p class="inbox-item-text">This theme is awesome!</p>
                            <p class="inbox-item-date">13:17 PM</p>
                        </div>
                    </a>
                    <a href="#">
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="{{asset('assets/admin/images/martina.jpg')}}" class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author">Paien Barrientos</p>
                            <p class="inbox-item-text">Nice to meet you</p>
                            <p class="inbox-item-date">12:20 PM</p>
                        </div>
                    </a>
                    <a href="#">
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="{{asset('assets/admin/images/martina.jpg')}}" class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author">Aubrey St-Jean</p>
                            <p class="inbox-item-text">Hey! there I'm available...</p>
                            <p class="inbox-item-date">10:15 AM</p>
                        </div>
                    </a>

                    <div class="text-center mt-4 pt-3">
                        <a href="#" class="btn btn-sm btn-primary waves-light waves-effect">{{__('admin/home.LoadMore')}}</a>
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
                    <li class="feed-item">
                        <span class="date">Sep 25</span>
                        <span class="activity-text">Responded to need “Volunteer Activities”</span>
                    </li>
                    <li class="feed-item">
                        <span class="date">Sep 21</span>
                        <span class="activity-text">Responded to need “In-Kind Opportunity”</span>
                    </li>
                    <li class="feed-item">
                        <span class="date">Sep 18</span>
                        <span class="activity-text">Created need “Volunteer Activities”</span>
                    </li>
                    <li class="feed-item">
                        <span class="date">Sep 17</span>
                        <span class="activity-text">Attending the event “Some New Event”</span>
                    </li>
                </ol>

                <div class="text-center mt-3">
                    <a href="#" class="btn btn-sm btn-primary">{{__('admin/home.LoadMore')}}</a>
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
    !function(e){"use strict";
    function a(){}a.prototype.init=function(){
        c3.generate({
            bindto:"#chart",data:{
                columns:[
                    ["Product",150,80,70,152,250,95],
                ],
                type:"bar",
                colors:{
                    Product:"#5468da",
                }
            }
        }),
        c3.generate({
            bindto:"#donut-chart",
            data:{
                columns:[
                    ["Open",78],
                    ["Closed",55],
                    ["Accept",40],
                    ["Refuced",25]
                ],
                type:"donut"
            },
            donut:{
                title:"Tickets",
                width:30,
                label:{show:!1}
            },
            color:{
                pattern:["#f06292","#6d60b0","#5468da","#009688"]
            }
        })}
        e.ChartC3=new a,e.ChartC3.Constructor=a}(window.jQuery),function(){
            "use strict";window.jQuery.ChartC3.init()
        }();
</script>
@endsection