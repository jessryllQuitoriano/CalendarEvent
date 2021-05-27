<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventDate extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'date'];

    public function event()
    {
        return $this->belongsTo(CalendarEvent::class, 'event_id', 'id');
    }
}
