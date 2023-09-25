<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Events;

class EventController extends Controller
{
    public function getEvents(){
        return response ()->json(Events::all(), 200);
    }

    public function getEventsById($id){
        $event = Events::find($id);
        if(is_null($event)){
            return response ()->json(["message" => "Registro no encontrado"],404);
    }
    return response ()->json($event, 200);
}


    public function insertEvents(Request $request){
        $event = Events::create($request->all());
        if(is_null($event)){
            return response()->json(["message" => "Hubo problemas al registrar"], 404);
        }
        return response ()->json($event,200);
    }

    public function updateEvents(Request $request, $id){
        $event = Events::find($id);

    $event->update($request->all());
    return response ()->json($event, 200);

    }

    public function deleteEvents($id){
        $event  = Events::find($id);
        if(is_null($event)){
            return response()->json(["message" => "Registro no encontrado"], 404);
        }
        $event->delete();
        return response ()->json(["message" => "Registro eliminado"], 200);

    }

}
