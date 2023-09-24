<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;


class AuthController extends Controller
{
    public function register(Request $request){

        //Validacion de los datos


        $request ->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'


        ]);

        //alta del usuario
        $user = new User();
        $user->name  = $request->name;
        $user->email  = $request->email;
        $user->password  = $request->password;
        $user->save();


        return response($user, Response::HTTP_CREATED);


    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('token')->plainTextToken;


            // Retornar la respuesta con el token y la cookie
            return response(["token" => $token], Response::HTTP_OK);
        } else {
            // Si la autenticación falla, devolver una respuesta de no autorizado
            return response(["message"=>"Credenciales invalidad"], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function userProfile(Request $request){
        return response()->json([
            "message"=> "userProfile OK",
            "userData" => auth()->user()
        ], Response::HTTP_OK);
    }



    public function logout(Request $request){
        $user = auth()->user();

        // Revocar y eliminar todos los tokens de acceso del usuario
        $user->tokens->each(function ($token) {
            $token->delete();
        });

        return response(["message" => "Cierre de sesión OK"], Response::HTTP_OK);

    }

}
