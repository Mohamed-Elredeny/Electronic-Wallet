@extends("layouts.admin")
<link href="{{asset("assets/admin/libs/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css"/>

@section("pageTitle", "Dashboard")
@section("content")
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
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
                    <h5 class="mb-5 mt-3">{{__('admin/vendor.AddNewVendor')}}</h5>

                    <form method="post" action="{{route('admin.vendor.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">{{__('admin/vendor.Name')}}</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" id="example-text-input" name="name" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">{{__('admin/vendor.Email')}}</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="email" id="example-text-input" name="email" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label"> {{__('admin/vendor.Password')}}</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" id="example-text-input" name="password" >
                                @error('email')
                                <span class="" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label"> {{__('admin/vendor.Phone')}} </label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" id="example-text-input" name="phone" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">{{__('admin/vendor.Image')}}</label>
                            <div class="custom-file col-sm-10">
                                <input name="imagee" type="file" class="custom-file-input" id="customFileLangHTML" >
                                <label class="custom-file-label" for="customFileLangHTML" data-browse="{{__('admin/vendor.UplodeImage')}}"></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-2">{{__('home.card')}}</label>
                            <div class="col-sm-10">
                                <select class="select2 form-control select2-multiple" multiple="multiple" name="cards_id[]" multiple data-placeholder="اختر الإضافات" required>
                                    <option value="all">{{__('home.all')}}</option>
                                @foreach($groups as $group)
                                        <option value="{{$group->id}}">{{$group->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-dark w-25" >{{__('admin/vendor.Add')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->


@endsection

@section("script")
    <script src="{{asset("assets/admin/js/app.js")}}"></script>
    <script src="{{asset("assets/admin/libs/tinymce/tinymce.min.js")}}"></script>
    <script src="{{asset("assets/admin/js/pages/form-editor.init.js")}}"></script>
    <script src="{{asset("assets/admin/libs/select2/js/select2.min.js")}}"></script>
@endsection
