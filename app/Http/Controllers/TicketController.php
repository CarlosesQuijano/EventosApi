<?php

namespace App\Http\Controllers;

use App\Models\Tickets;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TicketController extends Controller
{
    public function index(){

         $ticket = Tickets::all();

        return response()->json([
            "result" => $ticket

        ], Response::HTTP_OK);


    }

    public function store (Request $request){
        //validamos los datos
        $request->validate([
            "nombre_ticket"=>"required",
            "cantidad" => "required",
            "description"=> "required"
        ]);


        $ticket = Tickets::create($request->all());

        return response()->json([
            "message" => $ticket

        ], Response::HTTP_OK);
    }



    public function show($id){
        $ticket = Tickets::findOrFail($id);
        return $ticket;

    }

    public function update(Request $request, $id){
      //validamos los datos

      $request->validate([
        'nombre_ticket' => 'required',
        'cantidad' => 'required',
        'description' => 'required',


      ]);


      $ticket = Tickets::find($id);
      $ticket->nombre_ticket = $request->nombre_ticket;
      $ticket->cantidad = $request->cantidad;
      $ticket->description = $request->description;
      $ticket->save();

        return response()->json([
            "result" => $ticket
        ], Response::HTTP_OK);
    }

    public function destroy($id){
        Tickets::findOrFail($id)->delete();

        return response()->json([
            "result" => "Ticket deleted successfully"

        ], Response::HTTP_OK);
    }


}
