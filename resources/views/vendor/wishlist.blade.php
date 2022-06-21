<?php
use AmrShawky\LaravelCurrency\Facade\Currency;
?>
@extends("layouts.vendor")
@if(LaravelLocalization::getCurrentLocale() == 'ar')
@section("pageTitle", "المفضلة")
@else
@section("pageTitle", "My Wishlist")
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
                <img src="{{asset('assets/images/users/'.$cat->product->image)}}" alt="">
                <div class="content">
                    <div class="row">
                        <div class="details">
                            <span>{{$cat->product->name}}</span>
                        </div>

                        <div class="price">
                            @if(Session::get('currency') == 'USD')
                                {{ round($cat->product->price,2) . ' '.Session::get('currency')}}
                            @else
                                <?php

                                $new_balance=  Currency::convert()
                                    ->from('USD')
                                    ->to(Session::get('currency'))
                                    ->amount($cat->product->price)
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
                        <a href="#" class="btn pt-3" data-toggle="modal" data-target="#course{{$cat->product->id}}" style="border: 0">{{__('products.BuyNow')}}</a>

                        <a href="{{route('wishlist',['action'=>'remove','product_id'=>$cat->product->id])}}" class="text-danger like bg-white" style="cursor: pointer;border: 0">
                            <i class="far fa-heart p-2" style="font-size:30px"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>
@foreach($categories as $cat)
<div class="modal fade" id="course{{$cat->product->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="courseLabel1" aria-hidden="true">
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
                  <img src="{{asset('assets/images/users/'.$cat->product->image)}}" style="width: 100%; height: 200px;" alt="">
                  <div class="details mt-3">
                      <h6>{{__('products.ProductPrice')}}: 40$</h6>
                      <h6>{{__('products.TotalPrice')}}: 80$</h6>
                  </div>
              </div>
              <div class="col-lg-5 ml-3">
                  <div class="form-group row">
                      <label for="example-text-input" class="col-sm-2 col-form-label">{{__('products.Quantity')}} </label>
                      <br>
                      <div class="col-sm-12">
                          <input class="form-control" type="number" max="10" minlength="1" value="1" id="example-text-input" name="title" required>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('products.Close')}}</button>
          <button type="button" class="btn btn-primary">{{__('products.BuyNow')}}</button>
        </div>

      </div>
  </div>
</div>
@endforeach
@endsection
@section("script")
<script src="{{asset("assets/admin/js/app.js")}}"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(".removeButton").click(function () {
    $("#product1").css("display", "none");
});
</script>
{{-- <script src="{{asset("assets/admin/js/script.js")}}"></script> --}}
{{-- <script src="{{asset("assets/admin/js/script.js")}}"></script> --}}
@endsection
