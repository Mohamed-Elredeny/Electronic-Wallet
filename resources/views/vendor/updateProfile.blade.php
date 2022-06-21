@extends("layouts.vendor")
@if(LaravelLocalization::getCurrentLocale() == 'ar')
@section("pageTitle", "تعديل الحساب")
@else
@section("pageTitle", "Update Profile")
@endif
@section('style')
@endsection
@section("content")
    <div class="m-5 p-5 bg-white">
        <h4>{{__('UpdateProfile.ProfileInformation')}}</h4>
        <br>
        <form method="post" action="">
            @csrf
            @method('PUT')

            <div class="col-12 form-line text-center">
                <div class="form-group">
                    <input type="file" id="file" accept="image/*" name="image" onchange="imgchange()" style="width: 100%; display: none; !important"/>
                    <label for="file" class="btn-3" style="
                    border-radius: 35px; background-color:#fff">
                        <span>    
                            <img style="border-radius: 50%; width: 150px; height:150px" id="uploadPreview" alt="" src="{{asset('assets/admin/images/martina.jpg')}}" />
                        </span>
                    </label>
                    <div>{{__('UpdateProfile.UpdateImage')}}</div>
                    {{-- <div id="msgImg" class="help-block with-errors"></div> --}}
                </div>
           
        </div>
            <div class="form-group row">
                <label for="example-text-input" class="col-sm-2 col-form-label">{{__('UpdateProfile.Name')}}  </label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" id="example-text-input" name="title_en" value="Martina girgis" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="example-text-input" class="col-sm-2 col-form-label">{{__('UpdateProfile.Email')}}</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" id="example-text-input" name="writer" value="martina@email.com" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="exampleFormControlTextarea1" class="col-sm-2 col-form-label">{{__('UpdateProfile.Phone')}}  </label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" id="example-text-input" name="writer" value="01205916690" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-dark w-25">{{__('UpdateProfile.Save')}}</button>
                </div>
            </div>
        </form>
        <br>
        <hr>
        <br>
        <h4>{{__('UpdateProfile.ChagnePassword')}}</h4>
        <br>
        <form method="post" action="">
            @csrf
            @method('PUT')
            <div class="form-group row">
                <label for="example-text-input" class="col-sm-2 col-form-label">{{__('UpdateProfile.CurrentPassword')}} </label>
                <div class="col-sm-10">
                    <input class="form-control" type="password" id="example-text-input" name="title_en" value="Martina girgis" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="example-text-input" class="col-sm-2 col-form-label">{{__('UpdateProfile.NewPassword')}}</label>
                <div class="col-sm-10">
                    <input class="form-control" type="password" id="example-text-input" name="writer" value="martina@email.com" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="exampleFormControlTextarea1" class="col-sm-2 col-form-label">{{__('UpdateProfile.ConfirmPassword')}}  </label>
                <div class="col-sm-10">
                    <input class="form-control" type="password" id="example-text-input" name="writer" value="01205916690" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-dark w-25">{{__('UpdateProfile.Save')}}</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        function imgchange()
        {
            // document.getElementById("msgImg").innerHTML = "OK your Image changed";
            var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("file").files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("uploadPreview").src = oFREvent.target.result;
        };
        }
    </script>
@endsection
@section("script")
<script src="{{asset("assets/admin/js/app.js")}}"></script>
@endsection 