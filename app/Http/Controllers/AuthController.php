<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Profesor;
use App\Models\Gestion;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('welcome');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username'     => 'required',
            'password'  => 'required',
        ]);

        $user = Usuario::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => 'Cometiste un error!',
                'text' => 'Las credenciales son incorrectas.',
            ]);
            return back()->with('error', 'Credenciales incorrectas.');
        }
        //dd($user);
        $gestion = Gestion::where('estado', 'A')->first();
        //dd($gestion);
        $profesor = Profesor::find($user->id_Profesor);
        $nombre = $profesor->nombres.' '. $profesor->appaterno.' '. $profesor->apmaterno;

        // Obtener permisos del rol del usuario
        $permisos = $user->rol->permisos->pluck('nombrePermiso')->toArray();

        // guardamos usuario en sesión
        session(['gestion_activa'=> $gestion->id_gestion]);
        session(['gestion' => $gestion->anio]);
        session(['usuario_nombre' => $nombre]);
        session(['usuario_id' => $user->idUsuario]);
        session(['profesor_id' => $user->id_Profesor]);
        session(['usuario_rol' => $user->idRol]); // para el middleware
        session(['usuario_permisos' => $permisos]); // permisos del usuario

        if($user->idRol == 2){ // profesor
            return redirect()->route('curso.asignados', $profesor->id_profesor);
        }
        if($user->idRol == 3){ // estudiante
            return redirect()->route('estudiante.asistencia');
        }
        if ($user->idRol == 1) { // administrador
        return redirect()->route('panel');
        }

        //return redirect()->route('panel');
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('login');
    }
}
