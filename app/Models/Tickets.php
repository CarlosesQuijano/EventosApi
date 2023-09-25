<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TypeTickets;

class Tickets extends Model
{
    use HasFactory;

   protected $fillable = ['nombre_ticket', 'cantidad', 'description'];


   public function type()
   {
    return $this->hasMany(TypeTickets::class);
   }
}
