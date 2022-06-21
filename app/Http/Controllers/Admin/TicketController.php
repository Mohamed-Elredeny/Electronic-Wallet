<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\models\Ticket;
use App\models\TicketMessage;
use App\models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::paginate(10);
        return view('admin.ticket.tickets',compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendors = Vendor::get();
        return view('admin.ticket.openTicket', compact('vendors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ticketId = Ticket::insertGetId([
            'title' => $request->title,
            'state' => $request->state,
            'color' => $request->color,
            'vendor_id' => $request->vendor_id,
            'created_at' => now(),
        ]);

        TicketMessage::create([
            'sender_id' => Auth::guard('admin')->id(),
            'type' => 'admin',
            'message' => $request->message,
            'ticket_id' => $ticketId,
            'created_at' => now(),
        ]);
        $messages = TicketMessage::where('ticket_id',$ticketId)->get();
        return view('admin.ticket.ticketDetails', compact('messages'));
    }

    public function storeMessage(Request $request)
    {
        TicketMessage::create([
            'sender_id' => Auth::guard('admin')->id(),
            'type' => 'admin',
            'message' => $request->message,
            'ticket_id' => $request->id,
            'created_at' => now(),
        ]);
        $messages = TicketMessage::where('ticket_id',$request->id)->get();
        return view('admin.ticket.ticketDetails', compact('messages'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $messages = TicketMessage::where('ticket_id',$id)->get();
        return view('admin.ticket.ticketDetails', compact('messages'));
    }

    public function changeState($state, $id, $color)
    {
        $ticket = Ticket::find($id);
        $ticket->update([
            'state' => $state,
            'color' => $color,
        ]);
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
