<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use Illuminate\Http\Request;

class PermisoController extends Controller
{
    /**
     * Mostrar lista de todos los permisos
     */
    public function index()
    {
        $permisos = Permiso::withCount('roles')->get();
        return view('admin.permisos.index', compact('permisos'));
    }

    /**
     * Mostrar formulario para crear nuevo permiso
     */
    public function create()
    {
        return view('admin.permisos.create');
    }

    /**
     * Guardar nuevo permiso en la base de datos
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombrePermiso' => 'required|string|max:50|unique:permisos',

        ]);

        try {
            Permiso::create([
                'nombrePermiso' => $request->nombrePermiso,

            ]);

            session()->flash('swal', [
                'icon' => 'success',
                'title' => 'Éxito',
                'text' => 'Permiso creado correctamente'
            ]);

            return redirect()->route('permisos.index');
        } catch (\Exception $e) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => 'Error',
                'text' => 'Error al crear el permiso: ' . $e->getMessage()
            ]);
            return back()->withInput();
        }
    }

    /**
     * Mostrar formulario para editar permiso
     */
    public function edit($id)
    {
        $permiso = Permiso::findOrFail($id);
        return view('admin.permisos.edit', compact('permiso'));
    }

    /**
     * Actualizar permiso en la base de datos
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombrePermiso' => 'required|string|max:50|unique:permisos,nombrePermiso,' . $id . ',idPermiso',
            'descripcion' => 'nullable|string|max:255'
        ]);

        try {
            $permiso = Permiso::findOrFail($id);

            $permiso->update([
                'nombrePermiso' => $request->nombrePermiso,
                'descripcion' => $request->descripcion
            ]);

            session()->flash('swal', [
                'icon' => 'success',
                'title' => 'Éxito',
                'text' => 'Permiso actualizado correctamente'
            ]);

            return redirect()->route('permisos.index');
        } catch (\Exception $e) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => 'Error',
                'text' => 'Error al actualizar el permiso: ' . $e->getMessage()
            ]);
            return back()->withInput();
        }
    }

    /**
     * Eliminar permiso
     */
    public function destroy($id)
    {
        try {
            $permiso = Permiso::findOrFail($id);

            // Verificar que no hay roles con este permiso
            if ($permiso->roles()->count() > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se puede eliminar este permiso porque está asignado a roles'
                ], 409);
            }

            $permiso->delete();

            return response()->json([
                'success' => true,
                'message' => 'Permiso eliminado correctamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el permiso: ' . $e->getMessage()
            ], 500);
        }
    }
}
