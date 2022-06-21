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
                <h5 class="mb-5 mt-3">{{__('admin/category.Update')}} {{$product->name}}</h5>

                <form method="post" action="{{route('admin.product.update',['product'=>$product->id])}}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">{{__('admin/category.Code')}}</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" id="example-text-input" name="code" value="{{$product->code}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">{{__('admin/category.Category')}}</label>
                        <div class="col-sm-10">
                            <select class="form-control" type="text" id="example-text-input" name="category_id">
                                <option value="{{$product->category_id}}" selected>{{$product->category->name}}</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-dark w-25">{{__('admin/category.Update')}}</button>
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
