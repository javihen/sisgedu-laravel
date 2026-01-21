<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Permiso;
use App\Models\RolPermiso;
use Illuminate\Http\Request;

class RolController extends Controller
{
    /**
     * Mostrar lista de todos los roles
     */
    public function index()
    {
        $roles = Rol::withCount('permisos')->get();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Mostrar formulario para crear nuevo rol
     */
    public function create()
    {
        $permisos = Permiso::all();
        return view('admin.roles.create', compact('permisos'));
    }

    /**
     * Guardar nuevo rol en la base de datos
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombreRol' => 'required|string|max:50|unique:roles',
            'permisos' => 'array'
        ]);

        try {
            // Crear el rol
            $rol = Rol::create([
                'nombreRol' => $request->nombreRol
            ]);

            // Asignar permisos si los hay
            if ($request->has('permisos') && !empty($request->permisos)) {
                $rol->permisos()->sync($request->permisos);
            }

            session()->flash('swal', [
                'icon' => 'success',
                'title' => 'Éxito',
                'text' => 'Rol creado correctamente'
            ]);

            return redirect()->route('roles.index');
        } catch (\Exception $e) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => 'Error',
                'text' => 'Error al crear el rol: ' . $e->getMessage()
            ]);
            return back()->withInput();
        }
    }

    /**
     * Mostrar formulario para editar rol
     */
    public function edit($id)
    {
        $rol = Rol::findOrFail($id);
        $permisos = Permiso::all();
        $permisosDelRol = $rol->permisos->pluck('idPermiso')->toArray();

        return view('admin.roles.edit', compact('rol', 'permisos', 'permisosDelRol'));
    }

    /**
     * Actualizar rol en la base de datos
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombreRol' => 'required|string|max:50|unique:roles,nombreRol,' . $id . ',idRol',
            'permisos' => 'array'
        ]);

        try {
            $rol = Rol::findOrFail($id);

            // Actualizar nombre
            $rol->update([
                'nombreRol' => $request->nombreRol
            ]);

            // Actualizar permisos
            if ($request->has('permisos')) {
                $rol->permisos()->sync($request->permisos);
            } else {
                $rol->permisos()->detach();
            }

            session()->flash('swal', [
                'icon' => 'success',
                'title' => 'Éxito',
                'text' => 'Rol actualizado correctamente'
            ]);

            return redirect()->route('roles.index');
        } catch (\Exception $e) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => 'Error',
                'text' => 'Error al actualizar el rol: ' . $e->getMessage()
            ]);
            return back()->withInput();
        }
    }

    /**
     * Eliminar rol
     */
    public function destroy($id)
    {
        try {
            $rol = Rol::findOrFail($id);

            // Verificar que no hay usuarios con este rol
            if ($rol->usuarios()->count() > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se puede eliminar este rol porque hay usuarios asignados'
                ], 409);
            }

            $rol->delete();

            return response()->json([
                'success' => true,
                'message' => 'Rol eliminado correctamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el rol: ' . $e->getMessage()
            ], 500);
        }
    }
}
