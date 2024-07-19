<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use Illuminate\Support\Facades\DB;

class PersonaController extends Controller
{
    public function alta(Request $request)
    {
        $persona = new Persona();
        $persona->id = $request->input('id');
        $persona->nombre = $request->input('nombre');
        $persona->apellido = $request->input('apellido');
        $persona->telefono = $request->input('telefono');
        $persona->save();
        return response()->json(['mensaje' => 'Persona creada con éxito'], 201);
    }


    public function baja($id)
    {
        $persona = Persona::find($id);
        if (!$persona) {
            return response()->json(['mensaje' => 'Persona no encontrada'], 404);
        }
        $persona->delete();
        return response()->json(['mensaje' => 'Persona eliminada con éxito'], 200);
    }


    public function modificar(Request $request, $id)
    {
        $persona = Persona::find($id);
        if (!$persona) {
            return response()->json(['mensaje' => 'Persona no encontrada'], 404);
        }
        $persona->nombre = $request->input('nombre');
        $persona->apellido = $request->input('apellido');
        $persona->telefono = $request->input('telefono');
        $persona->save();
        return response()->json(['mensaje' => 'Persona actualizada con éxito'], 200);
    }


    public function listar()
    {
        $personas = Persona::all();
        return response()->json($personas, 200);
    }


    public function buscar(Request $request)
    {
        $query = $request->input('query');
        $personas = Persona::where('nombre', 'LIKE', "%$query%")
            ->orWhere('apellido', 'LIKE', "%$query%")
            ->get();
        return response()->json($personas, 200);
    }

    public function show($id)
{
    $persona = Persona::find($id);

    if (!$persona) {
        return abort(404);
    }

    return view('personas.show', ['persona' => $persona]);
}
}