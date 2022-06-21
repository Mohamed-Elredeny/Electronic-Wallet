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
                    <h5 class="">{{__('admin/vendor.Supporters')}}</h5>

                    <table id="" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <thead>
                        <tr>
                            <th>{{__('admin/vendor.ID')}}</th>
                            <th>{{__('admin/vendor.Image')}}</th>
                            <th>{{__('admin/vendor.Name')}}</th>
                            <th>{{__('admin/vendor.Email')}}</th>
                            <th>{{__('admin/vendor.Phone')}}</th>
                            <th>{{__('admin/vendor.Controls')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0 ?>
                            @foreach ($vendors as $vendor)
                            <tr>
                                <th>{{$i = $i +1 }}</th>
                                <th>
                                    <a class="btn btn-dark col-sm-12" data-toggle="modal" data-target="#image{{$vendor->id}}">{{__('admin/vendor.Show')}}</a><br>
                                </th>
                                <th>{{$vendor->name}}</th>
                                <th>{{$vendor->email}}</th>
                                <th>{{$vendor->phone}}</th>
                                <th>
                                    <center>
                                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">

                                            <div class="btn-group" role="group">
                                                <button id="btnGroupDrop1" type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    {{__('admin/vendor.Controls')}}
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                    {{-- <a class="btn btn-dark col-sm-12" href="{{route('admin.vendor.show', ['vendor'=>$vendor->id])}}">Show</a><br> --}}
                                                    <a class="btn btn-dark col-sm-12"  href="{{route('admin.supporter.edit', ['supporter'=>$vendor->id])}}">{{__('admin/vendor.Update')}}</a>
                                                    <form method="post" action="{{route('admin.supporter.destroy', ['supporter'=>$vendor->id])}}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-dark col-sm-12" >{{__('admin/vendor.Delete')}}</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </center>


                                </th>

                            </tr>
                            @endforeach
                    </table>
                    {{ $vendors->links() }}
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@foreach ($vendors as $image)
<div class="modal fade" id="image{{$image->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="fileLabel{{$image->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header backgroundColor text-white" style="border:none">
                <h5 class="modal-title" style="color: black" id="fileLabel{{$image->id}}">{{__('admin/vendor.Image')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{{__('admin/vendor.Close')}}">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body backgroundColorSec p-5">
                <div class="group-img-container text-center post-modal">
                    <img  src="{{asset('assets/images/users/'. $image->image)}}" alt="" class="group-img img-fluid " ><br>
                </div>
            </div>

        </div>
    </div>
</div>
@endforeach
@endsection
@section("script")
<script src="{{asset("assets/admin/js/app.js")}}"></script>

@endsection
