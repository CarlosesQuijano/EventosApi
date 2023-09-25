<?php

namespace App\Http\Controllers;

use App\Models\Tickets;
use App\Models\TypeTickets;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TypeTicketController extends Controller
{
    public function index(){
        $type = TypeTickets::all();

        return response()->json([
            "results" => $type
        ], Response::HTTP_OK);
    }

    public function store(Request $request)
    {

        $request->validate([
            "name_tickets" =>"required|string",
            "cantidad_tickets" =>"required|numeric|min:0",
            "tickets_id" =>"required"
        ]);


     $category = Tickets::findOrFail($request->tickets_id);
     $product = $category->type()->create([
        "name_tickets" => $request->name_tickets,
        "cantidad_tickets" => $request->cantidad_tickets,

     ]);

     return response()->json([
        "results" => $product
     ], Response::HTTP_OK);


    }

    public function show($id){
        $product = TypeTickets::find($id);
        //devolvemos una rpta
        return response()->json([
            "results" => $product
         ], Response::HTTP_OK);

    }

    public function update(Request $request, $id){
        $request->validate([
            "name_tickets" =>"required|string",
            "cantidad_tickets" =>"required|numeric|min:0",
            "tickets_id" =>"required"
        ]);

        $ticket = Tickets::findOrFail($request->tickets_id);

       $product =  $ticket->type()->where('id' , $id)->update([
            'name_tickets' => $request->name_tickets,
            'cantidad_tickets' => $request->cantidad_tickets
        ]);
        return response()->json([
            "message" => "¡Producto actualizado!",
            "results" => $product
         ], Response::HTTP_OK);
    }

    public function destroy($id){
        TypeTickets::findOrFail($id)->delete();

        return response()->json([
            "message" => "¡Producto Eliminado!",
         ], Response::HTTP_OK);

    }
}
