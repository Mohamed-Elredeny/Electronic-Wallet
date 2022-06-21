@extends("layouts.admin")
@if(LaravelLocalization::getCurrentLocale() == 'ar')
@section("pageTitle", "تفاصيل تذكرة")
@else
@section("pageTitle", "Ticket Details")
@endif
@section('styleChart')
    <link href="{{asset("assets/admin/libs/summernote/summernote-bs4.min.css")}}" rel="stylesheet" type="text/css"/>
@endsection
@section("content")
@if ($messages[0]->ticket->state == 'pending')
<a href="{{route('admin.ticket.stete', ['state' => 'accept', 'id' => $messages[0]->ticket->id, 'color'=>'badge-success'])}}" class="btn btn-success waves-effect waves-light">Accept Ticket</a>
<a href="{{route('admin.ticket.stete', ['state' => 'refuse', 'id' => $messages[0]->ticket->id, 'color'=>'badge-pink'])}}" class="btn btn-pink waves-effect waves-light">Refused Ticket</a>
@elseif ($messages[0]->ticket->state == 'open' || $messages[0]->ticket->state == 'accept')
<a href="{{route('admin.ticket.stete', ['state' => 'close', 'id' => $messages[0]->ticket->id, 'color'=>'badge-purple'])}}" class="btn btn-purple waves-effect waves-light">Close Ticket</a>
@endif
@foreach ($messages as $message)
    
<div class="card mt-4">
    <div class="card-body">
        @if ($message->type == 'admin')
            <div class="media mb-5">
                <img class="d-flex mr-3 rounded-circle avatar-sm" src="{{asset('assets/images/users')}}/{{$message->admin->image}}" alt="Generic placeholder image">
                <div class="media-body">
                    <h4 class="font-size-14 m-0">{{$message->admin->name}}</h4>
                    <small class="text-muted">{{$message->created_at}}</small>
                </div>
            </div>
        @elseif ($message->type == 'vendor')
            <div class="media mb-5">
                <img class="d-flex mr-3 rounded-circle avatar-sm" src="{{asset('assets/images/users')}}/{{$message->vendor->image}}" alt="Generic placeholder image">
                <div class="media-body">
                    <h4 class="font-size-14 m-0">{{$message->vendor->name}}</h4>
                    <small class="text-muted">{{$message->created_at}}</small>
                </div>
            </div>
        @elseif ($message->type == 'supporter')
            <div class="media mb-5">
                <img class="d-flex mr-3 rounded-circle avatar-sm" src="{{asset('assets/images/users')}}/{{$message->supporter->image}}" alt="Generic placeholder image">
                <div class="media-body">
                    <h4 class="font-size-14 m-0">{{$message->supporter->name}}</h4>
                    <small class="text-muted">{{$message->created_at}}</small>
                </div>
            </div>
    
        @endif

        <h4 class="mb-4 font-size-18">{{$message->ticket->title}}</h4>

        <?php $x = html_entity_decode($message->message); echo $x ?>
        <hr/>

    </div>

</div>

@endforeach
@if ($messages[0]->ticket->state == 'pending' || $messages[0]->ticket->state == 'open' || $messages[0]->ticket->state == 'accept' )
    
<div class="card mt-4">
    <div class="card-body">

        <form method="post" action="{{route('admin.message.store')}}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$messages[0]->ticket->id}}">
            <div class="form-group">
                <textarea class="summernote" name="message">
                    <h6>{{__('admin/openTicket.Message')}}</h6>
                </textarea>
            </div>

            <div class="btn-toolbar form-group mb-0">
                <div class="">
                    <button type="submit" class="btn btn-secondary waves-effect mt-4"><i class="mdi mdi-reply"></i> {{__('openTicket.Replay')}}</button>
                </div>
            </div>

        </form>

    </div>

</div>
@else
<div class="card mt-4">
    <div class="alert {{$messages[0]->ticket->color}} mb-0" role="alert">
        You can't Replay becuse this state<strong> {{$messages[0]->ticket->state}}</strong>
    </div>
</div>
@endif
@endsection
@section("script")
<script src="{{asset("assets/admin/libs/summernote/summernote-bs4.min.js")}}"></script>
<script src="{{asset("assets/admin/js/pages/email-summernote.init.js")}}"></script>
<script src="{{asset("assets/admin/js/app.js")}}"></script>
@endsection 