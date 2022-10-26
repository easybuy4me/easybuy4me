<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $primaryKey = 'id';

    protected $guarded = [];

    function ticketReply()
    {
        return $this->hasMany(TicketReply::class);
    }

    function user()
    {
        return $this->belongsTo(User::class);
    }
}
