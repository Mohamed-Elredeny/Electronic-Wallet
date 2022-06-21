<?php

namespace App\Http\Controllers\Vendor;

use App\models\Ticket;
use Illuminate\Http\Request;
use App\models\TicketMessage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:vendor');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::where('vendor_id', Auth::guard('vendor')->id())->paginate(10);
        return view('vendor.tickets',compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendor.openTicket');
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
            'vendor_id' => Auth::guard('vendor')->id(),
            'created_at' => now(),
        ]);

        TicketMessage::create([
            'sender_id' => Auth::guard('vendor')->id(),
            'type' => 'vendor',
            'message' => $request->message,
            'ticket_id' => $ticketId,
            'created_at' => now(),
        ]);
        $messages = TicketMessage::where('ticket_id',$ticketId)->get();
        return view('vendor.ticketDetails', compact('messages'));
    }

    public function storeMessage(Request $request)
    {
        TicketMessage::create([
            'sender_id' => Auth::guard('vendor')->id(),
            'type' => 'vendor',
            'message' => $request->message,
            'ticket_id' => $request->id,
            'created_at' => now(),
        ]);
        $messages = TicketMessage::where('ticket_id',$request->id)->get();
        return view('vendor.ticketDetails', compact('messages'));
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
        return view('vendor.ticketDetails', compact('messages'));
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
