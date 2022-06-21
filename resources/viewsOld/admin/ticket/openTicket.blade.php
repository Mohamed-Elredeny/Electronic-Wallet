@extends("layouts.admin")
@if(LaravelLocalization::getCurrentLocale() == 'ar')
@section("pageTitle", "افتح تذكرة")
@else
@section("pageTitle", "Open Ticket")
@endif
@section('styleChart')
    <link href="{{asset("assets/admin/libs/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("assets/admin/libs/summernote/summernote-bs4.min.css")}}" rel="stylesheet" type="text/css"/>
@endsection
@section("content")
<div class="card mt-4">
    <div class="card-body">

        <form method="post" action="{{route('admin.ticket.store')}}" enctype="multipart/form-data">
            @csrf
            {{-- <div class="form-group">
                <input type="email" class="form-control" placeholder="To">
            </div> --}}
            <input name="color" value="badge-warning " type="hidden">
            <div class="form-group mb-3">
                <label class="control-label">{{__('admin/openTicket.Vendor')}}</label>

                <input type="hidden" value="open" name="state">
                <select class="form-control select2" name="vendor_id" data-placeholder="{{__('admin/openTicket.Vendor')}}" required>
                    @foreach ($vendors as $vendor)
                        <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                    @endforeach
                    
                </select>

            </div>

            <div class="form-group">
                <label class="control-label">{{__('openTicket.Subject')}}</label>
                <input type="text" class="form-control" name="title" placeholder="{{__('openTicket.Subject')}}" required>
            </div>
            <div class="form-group">
                <label class="control-label">{{__('admin/openTicket.Message')}}</label>
                <textarea  class="summernote" name="message">
                    <h6>{{__('admin/openTicket.Message')}}</h6>
                </textarea >
            </div>

            <div class="btn-toolbar form-group mb-0">
                <div class="">
                    <button class="btn btn-dark waves-effect waves-light" type="submit"> <span>{{__('openTicket.Send')}}</span> <i class="fab fa-telegram-plane ml-2"></i> </button>
                </div>
            </div>

        </form>

    </div>

</div>
@endsection
@section("script")
<script src="{{asset("assets/admin/libs/select2/js/select2.min.js")}}"></script>
<script src="{{asset("assets/admin/libs/summernote/summernote-bs4.min.js")}}"></script>
<script src="{{asset("assets/admin/js/pages/email-summernote.init.js")}}"></script>
<script src="{{asset("assets/admin/js/app.js")}}"></script>
@endsection 