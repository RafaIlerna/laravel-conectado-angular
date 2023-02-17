<?php

namespace App\Http\Controllers;

use App\Models\teacher;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{

    //Creacion del nuevo estudiante
    public function registert(request $request)
    {
        $request->validate([
            'mote' => 'required',
            'nombre' => 'required',
            'apellidos' => 'required',
            'centro' => 'required',
            'correo' => 'required',
            'password' => 'required',
        ]);

        $teacher = new teacher();
        $teacher->mote = $request->mote;
        $teacher->nombre = $request->nombre;
        $teacher->apellidos = $request->apellidos;
        $teacher->centro = $request->centro;
        $teacher->correo = $request->correo;
        $teacher->password = Hash::make($request->password);
        $teacher->save();
        return response()->json([
            "status" => 1,
            "message" => "Profesor creado exitosamente",
            "value" => $teacher
        ]);
    }
    //Creacion del login del profesor
    public function logint(Request $request)
    {
        $request->validate([
            "mote" => "required",
            "password" => "required"
        ]);
        $teacher = teacher::where("mote", "=", $request->mote)->first();
        if (isset($teacher->id)) {
            if (Hash::check($request->password, $teacher->password)) {
                return response()->json([
                    "status" => 1,
                    "message" => "Profesor logeado exitosamente",
                    "value" => $teacher
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
                "message" => "El profesor no esta registrado",
            ]);
        }
    }
    //Creacion del cierre de session
    public function logoutt(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect(route('ruta del login'));
    }

    //Mostrar los profesores
    public function showteacher(teacher $teacher)
    {
        $showteacher = teacher::get();
        return response()->json([
            "status" => 1,
            "message" => "Vista del profesor exitosa",
            "roleshow" => $showteacher
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\studen  $studen
     * @return \Illuminate\Http\Response
     */
    public function destroystuden(teacher $teacher)
    {
        //
    }
}
