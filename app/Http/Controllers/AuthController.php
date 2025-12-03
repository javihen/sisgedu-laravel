<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Profesor;
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
        $profesor = Profesor::find($user->id_Profesor);
        $nombre = $profesor->nombres.' '. $profesor->appaterno.' '. $profesor->apmaterno;
        session(['usuario_nombre' => $nombre]);
        // guardamos usuario en sesión
        session(['usuario_id' => $user->idUsuario]);
        session(['usuario_rol' => $user->idRol]); // para el middleware

        return redirect()->route('curso.index');
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('login');
    }
}
