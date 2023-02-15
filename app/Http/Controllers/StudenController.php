<?php

namespace App\Http\Controllers;

use App\Models\studen;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudenController extends Controller
{

    //Creacion del nuevo estudiante
    public function registers(request $request)
    {
        $request->validate([
            'mote' => 'required',
            'nombre' => 'required',
            'apellidos' => 'required',
            'date' => 'required',
            'correo' => 'required',
            'password' => 'required',
        ]);

        $studen = new studen();
        $studen->mote = $request->mote;
        $studen->nombre = $request->nombre;
        $studen->apellidos = $request->apellidos;
        $studen->date = $request->date;
        $studen->correo = $request->correo;
        $studen->password = Hash::make($request->password);
        $studen->save();
        return response()->json([
            "status" => 1,
            "message" => "Studen created successfully",
        ]);
    }
    //Creacion del login del studiante
    public function logins(Request $request)
    {
        $request->validate([
            "nombre" => "required",
            "password" => "required"
        ]);
        $studen = studen::where("nombre", "=", $request->nombre)->first();
        if (isset($studen->id)) {
            if (Hash::check($request->password, $studen->password)) {
                $token = $studen->createToken("auth_token")->plainTextToken;
                return response()->json([
                    "status" => 1,
                    "message" => "Usuario logeado exitosamente",
                    "access_token" => $token
                ]);
            } else {
                return response()->json([
                    "status" => 0,
                    "message" => "La contraseña es correcta",
                ]);
            }
        } else {
            return response()->json([
                "status" => 0,
                "message" => "El usuario no esta registrado",
            ]);
        }
    }
    //Creacion del cierre de session
    public function logouts(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect(route('ruta del login'));
    }

    //Mostrar los profesores
    public function showstuden(studen $studen)
    {
        $showstuden = studen::get();
        return response()->json([
            "status" => 1,
            "message" => "studen view successfully",
            "roleshow" => $showstuden
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\studen  $studen
     * @return \Illuminate\Http\Response
     */
    public function destroystuden(studen $studen)
    {
        //
    }
}
