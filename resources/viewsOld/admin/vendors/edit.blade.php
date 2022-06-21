@extends("layouts.admin")
@section("pageTitle", "Ejada")
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
                    <h5 class="mb-5 mt-3">{{__('admin/vendor.Update')}} {{$vendor->name}}</h5>

                    <form method="post" action="{{route('admin.vendor.update',['vendor'=>$vendor->id])}}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">{{__('admin/vendor.Name')}}</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" id="example-text-input" name="name" value="{{$vendor->name}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">{{__('admin/vendor.Email')}}</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="email" id="example-text-input" name="email" value="{{$vendor->email}}">
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
                                <input class="form-control" type="text" id="example-text-input" name="phone" value="{{$vendor->phone}}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">{{__('admin/vendor.Password')}}</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="password" id="example-text-input" name="password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">{{__('admin/vendor.Image')}}</label>
                            <div class="custom-file col-sm-10">
                                <input name="image" type="file" class="custom-file-input" id="customFileLangHTML">
                                <label class="custom-file-label" for="customFileLangHTML" data-browse="{{__('admin/vendor.UplodeImage')}}"></label>
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
                                            <a class="btn btn-dark" href="{{route('delete.category',['vendor'=>$vendor->id,'category'=>$group->id])}}">
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
                                <button type="submit" class="btn btn-dark w-25">{{__('admin/vendor.Update')}}</button>
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

@endsection
