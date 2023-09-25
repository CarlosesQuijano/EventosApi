<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tickets;

class TypeTickets extends Model
{
    use HasFactory;
    protected $fillable = ['name_tickets', 'cantidad_tickets'];
    public function ticket()
    {
        return $this->belongsTo(Tickets::class, 'tickets_id');

    }
}
