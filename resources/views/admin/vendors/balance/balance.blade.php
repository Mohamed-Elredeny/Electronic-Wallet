<?php
use AmrShawky\LaravelCurrency\Facade\Currency;
/*function getCurFromName($curName){
    switch($curName){
        case 'USD':
            return '$';
        case 'KWD':
            return ''
        case 'SAR':
        case 'AED':
        case 'OMR':
        case 'EMP':

    }
}*/
?>
@extends("layouts.admin")
@section("pageTitle", "Dashboard")
@section("content")
    <style>
        body {
            margin: 0;
        }

        .submit-area {
            padding: 30px;
            margin-top: 50px;
            border-radius: 10px;
            box-shadow: 5px 5px gray;
            color: white;
            background-color: #212529;
        }

        #account-area {
            margin-top: 5%;
        }

        .deposit {
            background-color: #212529;
        }

        .withdraw {
            background-color: #212529;
        }

        .balance {
            background-color: #212529;
        }

        .status {
            margin: 0 20px;
            color: white;
            padding: 20px;
            border-radius: 10px;
        }

    </style>

    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-3">
                <div class="deposit status">
                    <h5>{{__('transactions.deposit')}}</h5>
                    <h2 class="change-changeCurrency">

                        @if(Session::get('currency') == 'USD')
                            {{ round($deposit_total,2) . ' '.Session::get('currency')}}
                        @else
                            <?php

                            $new_balance=  Currency::convert()
                                ->from('USD')
                                ->to(Session::get('currency'))
                                ->amount($deposit_total)
                                ->get();
                            //echo $new_balance;
                            ?>
                            {{ round($new_balance,2) .' '. Session::get('currency')}}
                        @endif

                    </h2>
                </div>
            </div>

            <div class="col-lg-4 mb-3">
                <div class="withdraw status">
                    <h5>{{__('transactions.withdraw')}}</h5>
                    <h2>
                        @if(Session::get('currency') == 'USD')
                            {{ round($withdraw_total,2) . ' '.Session::get('currency')}}
                        @else
                            <?php

                            $new_balance=  Currency::convert()
                                ->from('USD')
                                ->to(Session::get('currency'))
                                ->amount($withdraw_total)
                                ->get();
                            //echo $new_balance;
                            ?>
                            {{ round($new_balance,2) .' '. Session::get('currency')}}
                        @endif

                    </h2>
                </div>
            </div>

            <div class="col-lg-4 mb-3">
                <div class="balance status">
                    <h5>{{__('transactions.balance')}}</h5>
                    <h2>
                        @if(Session::get('currency') == 'USD')
                            {{ round($userWallet->ballance,2) . ' '.Session::get('currency')}}
                        @else
                            <?php

                            $new_balance=  Currency::convert()
                                ->from('USD')
                                ->to(Session::get('currency'))
                                ->amount($userWallet->ballance)
                                ->get();
                            //echo $new_balance;
                            ?>
                            {{ round($new_balance,2) .' '. Session::get('currency')}}
                        @endif

{{--
                        {{ new Money($userWallet->ballance, new Currency($userWallet->currency),true) }}
--}}
                    </h2>

                </div>
            </div>
        </div>
        <form action="{{route('currency.change.dropdown.post')}}" method="post">
            @csrf

            <div class="container">
                <div class="row">

                    <div class="col-lg-12">
                        <div class="submit-area">
                            <h4>{{__('transactions.currency')}}</h4>
                            <select id="deposit-amount" type="text" class="form-control"  onchange="submit()" name="currency">
                                <option value=""> {{__('transactions.select_currency')}}</option>
                                <option value="USD">USD</option>
                                <option value="KWD">KWD</option>
                                <option value="SAR">SAR</option>
                                <option value="AED">AED</option>
                                <option value="USD">USD</option>
                                <option value="OMR">OMR</option>
                                <option value="EGP">EGP</option>
                            </select>

                        </div>
                    </div>
        </form>

        <div class="col-lg-6">
            <div class="submit-area">
                <form action="{{route('vendor.currency.charge',['id'=>$vendor_id,'type'=>'deposit'])}}" method="post">
                    @csrf
                    <h4>{{__('transactions.deposit_amount')}}</h4>
                    <input id="deposit-amount" type="text" class="form-control" placeholder="{{__('transactions.enter_deposit_amount')}}" name="amount"><br>
                    <button id="withdraw-btn" class="btn btn-success" type="submit">{{__('transactions.deposit')}}</button>
                </form>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="submit-area">
                <form action="{{route('vendor.currency.charge',['id'=>$vendor_id,'type'=>'withdraw'])}}" method="post">
                    @csrf
                    <h4>{{__('transactions.withdraw_amount')}}</h4>
                    <input id="withdraw-amount" type="text" class="form-control" placeholder="{{__('transactions.enter_withdraw_amount')}}" name="amount"><br>
                    <button id="withdraw-btn" class="btn btn-success" type="submit">{{__('transactions.withdraw')}}</button>
                </form>
            </div>
        </div>
    </div>
    </div>



@endsection

@section("script")
    <script>
        function changeCurrency(){
            alert(1);
        }
        //deposit button event handler
        const deposit_btn = document.getElementById('deposit-btn');
        deposit_btn.addEventListener('click', function(){

            const depositStringToInt = getInputNumb("deposit-amount");

            updateSpanTest("current-deposit", depositStringToInt);
            updateSpanTest("current-balance", depositStringToInt);

            //setting up the input field blank when clicked
            document.getElementById('deposit-amount').value = "";

        })

        //withdraw button event handler
        const withdraw_btn = document.getElementById('withdraw-btn');
        withdraw_btn.addEventListener('click', function(){
            const withdrawNumb = getInputNumb("withdraw-amount");

            updateSpanTest("current-withdraw", withdrawNumb);
            updateSpanTest("current-balance", -1 * withdrawNumb);
            //setting up the input field blank when clicked
            document.getElementById('withdraw-amount').value = "";
        })

        //function to parse string input to int
        function getInputNumb(idName){
            const amount = document.getElementById(idName).value;
            const amountNumber = parseFloat(amount);
            return amountNumber;
        }

        function updateSpanTest(idName, addedNumber){
            //x1.1 updating balance the same way
            const current = document.getElementById(idName).innerText;
            const currentStringToInt = parseFloat(current);

            const total = currentStringToInt + addedNumber;

            //x1.2 setting this value in balance
            document.getElementById(idName).innerText = total;
        }
    </script>

    <script src="{{asset("assets/admin/libs/tinymce/tinymce.min.js")}}"></script>
    <script src="{{asset("assets/admin/js/pages/form-editor.init.js")}}"></script>
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
