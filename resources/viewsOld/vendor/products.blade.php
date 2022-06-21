<?php
//use Akaunting\Money\Money;
//use Akaunting\Money\Currency;
use AmrShawky\LaravelCurrency\Facade\Currency;

    function StarProduct($vendor,$product){
        $products = \App\models\VendorWishlist::where('vendor_id',$vendor)->where('product_id',$product)->get();
        if(count($products) > 0 ){
            return true;
        }
        return false;
    }
?>
@extends("layouts.vendor")
@if(LaravelLocalization::getCurrentLocale() == 'ar')
@section("pageTitle", "المنتجات")
@else
@section("pageTitle", "Products")
@endif
@section('style')
    <link rel="stylesheet" href="{{asset('assets/admin/css/style.css')}}">
    {{-- <script src="https://kit.fontawesome.com/a076d05399.js"></script> --}}
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}
    {{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}

@endsection
@section("content")
<div class="row">
    <div class="wrapper d-flex justify-content-center flex-wrap">
        @foreach($categories as $cat)
            <div class="card ml-1">
          <img src="{{asset('assets/images/users/'.$cat->image)}}" alt="">
          <div class="content">
            <div class="row">
              <div class="details">
                <span>{{$cat->name}}</span>
              </div>

              <div class="price">
                  @if(Session::get('currency') == 'USD')
                      {{ round($cat->price,2) . ' '.Session::get('currency')}}
                  @else
                      <?php

                      $new_balance=  Currency::convert()
                          ->from('USD')
                          ->to(Session::get('currency'))
                          ->amount($cat->price)
                          ->get();
                      //echo $new_balance;
                      ?>

                          {{ round($new_balance,2) .' '. Session::get('currency')}}

                  @endif
              </div>

            </div>
              <div class="row">
                  <div class="col-sm-12 h5">
                      <center>
                          <hr>
                          {{__('home.still_available')}}
                          {{count(\App\models\Product::where('category_id',$cat->id)->where('state','available')->get())}}
                          {{__('home.card')}}
                          <hr>
                      </center>
                  </div>
              </div>
            <div class="buttons">
              <a href="#" class="btn pt-3" data-toggle="modal" data-target="#course{{$cat->id}}" style="border: 0">{{__('products.BuyNow')}}</a>


                <?php
                  if(StarProduct(Auth::guard('vendor')->user()->id ,$cat->id) == true){
                      ?>
                <a href="{{route('wishlist',['action'=>'remove','product_id'=>$cat->id])}}" class="text-danger like bg-white" style="cursor: pointer;border: 0">

                <i class="far fa-heart p-2" style="font-size:30px"></i>
                </a>
                    <?php
                    }else{
                      ?>
                <a href="{{route('wishlist',['action'=>'add','product_id'=>$cat->id])}}" class="text-danger like bg-white" style="cursor: pointer;border: 0">

                <i class="fas fa-heart p-2" style="font-size:30px"></i>
                </a>

            <?php
                    }
                  ?>
            </div>
          </div>
        </div>
        @endforeach

    </div>
</div>
@foreach($categories as $cat)
    <div class="modal fade" id="course{{$cat->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="courseLabel{{$cat->id}}" aria-hidden="true">
        <form action="{{route('make.order')}}" method="post">
                @csrf
            <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header backgroundColor text-white" style="border:none">
                <h5 class="modal-title" style="color: black" id="courseLabel1">Product NAme</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body backgroundColorSec p-5">
                <div class="row">
                    <div class="col-lg-6">
                        <img src="{{asset('assets/images/users/'.$cat->image)}}" style="width: 100%; height: 200px;" alt="">
                        <div class="details mt-3">
                            <h6>{{__('products.ProductPrice')}}:

                                @if(Session::get('currency') == 'USD')
                                    {{ round($cat->price,2) . ' '.Session::get('currency')}}
                                    <input value="{{round($cat->price,2)}}" id="real_price" style="display:none" >
                                @else
                                    <?php

                                    $new_balance=  Currency::convert()
                                        ->from('USD')
                                        ->to(Session::get('currency'))
                                        ->amount($cat->price)
                                        ->get();
                                    //echo $new_balance;
                                    ?>
                                    {{ round($new_balance,2) .' '. Session::get('currency')}}
                                        <input value="{{round($new_balance,2)}}" id="real_price" style="display:none">
                                @endif


                            </h6>
                            <h6 id="textChange">
                                {{__('products.TotalPrice')}}:
                                @if(Session::get('currency') == 'USD')
                                    <span id="plsChangeMe">{{round($cat->price,2)}}</span> {{Session::get('currency')}}

                                @else
                                    <?php
                                    $new_balance=  Currency::convert()
                                        ->from('USD')
                                        ->to(Session::get('currency'))
                                        ->amount($cat->price)
                                        ->get();
                                    //echo $new_balance;
                                    ?>
                                    <span id="plsChangeMe">{{round($new_balance,2)}}</span>  {{Session::get('currency')}}
                                @endif

                            </h6>
                        </div>
                    </div>

                    <div class="col-lg-5 ml-3">
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">{{__('products.Quantity')}} </label>
                            <br>
                            <div class="col-sm-12">
                                <input class="form-control" type="number" max="{{count(\App\models\Product::where('category_id',$cat->id)->where('state','available')->get())}}" minlength="1" value="1" id="example_text_input_martina_md7ka" name="title" required onchange="chnageTotal()">
                                <input type="hidden" value="{{$cat->price}}" style="display:none">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                    @csrf
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('products.Close')}}</button>
                    @if(count(\App\models\Product::where('category_id',$cat->id)->where('state','available')->get()) != 0)
                        <input type="hidden" name="sad_vendor_id" value="{{Auth::guard('vendor')->user()->id}}">
                        <input type="hidden" name="sad_category_id" value="{{$cat->id}}">
                        <input type="hidden" name="sad_price" value="{{$cat->price}}">
                        <button  class="btn btn-primary">{{__('products.BuyNow')}}</button>
                    @endif

              </div>
            </div>
            </div>
        </form>
</div>
@endforeach
@endsection
@section("script")
    <script>
        function chnageTotal(){
            var plsChangeMe = document.getElementById('plsChangeMe').value;
            var example_text_input_martina_md7ka = document.getElementById('example_text_input_martina_md7ka').value;
            var real_price = document.getElementById('real_price').value;
            //alert(plsChangeMe + ' ' + example_text_input_martina_md7ka);
            document.getElementById('plsChangeMe').textContent = real_price * example_text_input_martina_md7ka;
        }
    </script>
<script src="{{asset("assets/admin/js/app.js")}}"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{asset("assets/admin/js/script.js")}}"></script>
{{-- <script src="{{asset("assets/admin/js/script.js")}}"></script> --}}
@endsection
