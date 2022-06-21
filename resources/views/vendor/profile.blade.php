@extends("layouts.vendor")
@if(LaravelLocalization::getCurrentLocale() == 'ar')
@section("pageTitle", "تعديل الحساب")
@else
@section("pageTitle", "Update Profile")
@endif
@section('styleChart')
    <link href="{{asset("assets/admin/libs/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("assets/admin/libs/summernote/summernote-bs4.min.css")}}" rel="stylesheet" type="text/css"/>
@endsection
@section("content")
    <div class="m-5 p-5 bg-white">
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
        @endif
        @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
        @endif
        <h4>{{__('UpdateProfile.ProfileInformation')}}</h4>
        <br>
        <form method="post" action="{{route('vendor.updateInfo',['id' => $supporter->id])}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="col-12 form-line text-center">
                <div class="form-group">
                    <input type="file" id="file" accept="image/*" name="image" onchange="imgchange()" style="width: 100%; display: none; !important"/>
                    <label for="file" class="btn-3" style="
                    border-radius: 35px; background-color:#fff">
                        <span>    
                            <img style="border-radius: 50%; width: 150px; height:150px" id="uploadPreview" alt="" src="{{asset('assets/images/users')}}/{{$supporter->image}}" />
                        </span>
                    </label>
                    <div>{{__('UpdateProfile.UpdateImage')}}</div>
                    {{-- <div id="msgImg" class="help-block with-errors"></div> --}}
                </div>
           
        </div>
            <div class="form-group row">
                <label for="example-text-input" class="col-sm-2 col-form-label">{{__('UpdateProfile.Name')}}  </label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" id="example-text-input" name="name" value="{{$supporter->name}}" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="example-text-input" class="col-sm-2 col-form-label">{{__('UpdateProfile.Email')}}</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" id="example-text-input" name="email" value="{{$supporter->email}}" required>
                </div>
            </div>
            <div class="form-group row">
                <?php $sad = 0; ?>
                @foreach($my_great_groups as $group )
                    @if($group && $sad == 0)
                       <label class="control-label col-sm-2">{{__('home.myAvilableCard')}}</label>
                        <?php $sad++; ?>
                    @endif
                @endforeach
                <div class="col-sm-10 " >
                    @foreach($my_great_groups as $group )
                        @if($group)
                        <div class="row">
                            <div class="col-sm-3">
                                {{$group->name}}
                            </div>
                            <div class="col-sm-3">
                                <a class="btn btn-dark" href="{{route('vendor.delete.category',['vendor'=>$supporter->id,'category'=>$group->id])}}">
                                    {{__('home.delete')}}
                                </a>
                            </div>
                        </div>
                        <br>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="form-group row">
                <label class="control-label col-sm-2">{{__('home.card')}}</label>
                <div class="col-sm-10">
                    <select class="select2 form-control select2-multiple" multiple="multiple" name="cards_id[]" multiple data-placeholder="اختر الإضافات" required>
                        @foreach($avilable_groups as $group)
                            <option value="{{$group->id}}">{{$group->name}}</option>
                        @endforeach
                    </select>
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
      
        <form method="post" action="{{route('vendor.updateAccount')}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group row">
                <label for="example-text-input" class="col-sm-2 col-form-label">{{__('UpdateProfile.CurrentPassword')}} </label>
                <div class="col-sm-10">
                    <input class="form-control" type="password" id="example-text-input" name="Current_Password"  required>
                </div>
            </div>
            <div class="form-group row">
                <label for="example-text-input" class="col-sm-2 col-form-label">{{__('UpdateProfile.NewPassword')}}</label>
                <div class="col-sm-10">
                    <input class="form-control" type="password" id="example-text-input" name="Password" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="exampleFormControlTextarea1" class="col-sm-2 col-form-label">{{__('UpdateProfile.ConfirmPassword')}}  </label>
                <div class="col-sm-10">
                    <input class="form-control" type="password" id="example-text-input" name="password_confirmation" required>
                    <br>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
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
<script src="{{asset("assets/admin/libs/select2/js/select2.min.js")}}"></script>
<script src="{{asset("assets/admin/libs/summernote/summernote-bs4.min.js")}}"></script>
<script src="{{asset("assets/admin/js/pages/email-summernote.init.js")}}"></script>
<script src="{{asset("assets/admin/js/app.js")}}"></script>
@endsection 