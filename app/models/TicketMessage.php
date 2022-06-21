<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class TicketMessage extends Model
{
    protected $table = 'ticket_messages';
    protected $fillable = [
        'sender_id',  
        'message',
        'type',
        'ticket_id',
        'created_at'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'sender_id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'sender_id');
    }

    public function supporter()
    {
        return $this->belongsTo(Supporter::class, 'sender_id');
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }
}
