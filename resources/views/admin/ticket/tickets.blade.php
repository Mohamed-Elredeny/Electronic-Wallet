@extends("layouts.admin")
@if(LaravelLocalization::getCurrentLocale() == 'ar')
@section("pageTitle", "كل التذاكر")
@else
@section("pageTitle", "All Tickets")
@endif
@section('style')
    <link href="{{asset("assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("assets/admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("assets/admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css")}}" rel="stylesheet" type="text/css"/>
@endsection
@section("content")
        <div class="card mt-4">
            <ul class="message-list">
               @foreach ($tickets as $ticket)
               <li>
                    <div class="col-mail col-mail-1">
                        <a href="{{route('admin.ticket.show', ['ticket' => $ticket->id])}}" class="title">{{$ticket->vendor->name}}</a>
                    </div>
                    <div class="col-mail col-mail-2">
                        <a href="{{route('admin.ticket.show', ['ticket' => $ticket->id])}}" class="subject"><span class="{{$ticket->color}} badge mr-2">{{$ticket->state}}</span> 
                                <span class="teaser">{{$ticket->title}}</span>
                            </a>
                        <div class="date">{{date('Y-m-d',strtotime($ticket->created_at))}}</div>
                    </div>
                </li>
               @endforeach
                
            </ul>
        </div>
@endsection
@section("script")
<script src="{{asset("assets/admin/js/app.js")}}"></script>
@endsection 