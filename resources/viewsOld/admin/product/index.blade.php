@extends("layouts.admin")
@section("pageTitle", "Ejada")
@section("style")
@endsection
@section("content")
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive " >
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

                    @if ($type == 'soled')
                        <h5 class="">{{__('admin/category.SoledProducts')}}</h5>
                    @elseif ($type == 'available')
                        <h5 class="">{{__('admin/category.AvailableProducts')}}</h5>
                    @elseif ($type == 'all')
                        <h5 class="">{{__('admin/category.AllProducts')}}</h5>
                    @endif

                    <table id="" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <thead>
                            <tr>
                                <th>{{__('admin/category.ID')}}</th>
                                <th>{{__('admin/category.Code')}}</th>
                                <th>{{__('admin/category.Date')}}</th>
                                <th>{{__('admin/category.Category')}}</th>
                                <th>{{__('admin/category.Controls')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0 ?>
                            @foreach ($products as $product)
                            <tr>
                                <th>{{$i = $i +1 }}</th>
                                <th>{{$product->code}}</th>
                                <th>{{$product->created_at}}</th>
                                <th>{{$product->category->name}}</th>
                                <th>
                                    <center>
                                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">

                                            <div class="btn-group" role="group">
                                                <button id="btnGroupDrop1" type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    {{__('admin/category.Controls')}}
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                    <a class="btn btn-dark col-sm-12"  href="{{route('admin.product.edit', ['product'=>$product->id])}}">{{__('admin/category.Update')}}</a>
                                                    <form method="post" action="{{route('admin.product.destroy', ['product'=>$product->id])}}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-dark col-sm-12" >{{__('admin/category.Delete')}}</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </center>


                                </th>

                            </tr>
                            @endforeach
                    </table>
                    {{ $products->links() }}
                </div>
            </div>
        </div> <!-- end col -->
    </div>

@endsection
@section("script")
<script src="{{asset("assets/admin/js/app.js")}}"></script>

@endsection
