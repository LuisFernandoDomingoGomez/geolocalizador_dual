<?php

namespace App\Http\Controllers;

use App\Models\Encuesta;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Spatie\Geocoder\Facades\Geocoder; // Importa la fachada Geocoder

class EncuestaController extends Controller
{
    public function index()
    {
        $encuestas = Encuesta::paginate(10);

        return view('encuesta.index', compact('encuestas'))
            ->with('i', (request()->input('page', 1) - 1) * $encuestas->perPage());
    }

    public function create()
    {
        $user = auth()->user();

        $encuesta = new Encuesta([
            'user_id' => $user->id,
        ]);

        $empresas = Empresa::pluck('name', 'id');

        return view('encuesta.create', compact('encuesta', 'empresas'));
    }


    public function store(Request $request)
{
    // Validación de datos
    $request->validate([
        'empresa_id' => 'required',
        'latitud' => 'required',
        'longitud' => 'required',
    ]);

    // Obtener al usuario autenticado
    $user = auth()->user();

    // Crear una nueva instancia de Encuesta con los datos proporcionados por el formulario
    $encuesta = new Encuesta([
        'user_id' => $user->id,
        'empresa_id' => $request->input('empresa_id'),
        'latitud' => $request->input('latitud'),
        'longitud' => $request->input('longitud'),
    ]);

    // Guardar la encuesta en la base de datos
    $encuesta->save();

    return redirect()->route('encuestas.index')
        ->with('success', 'Tu registro se ha enviado a tus tutores.');
}

    public function show($id)
    {
        $encuesta = Encuesta::find($id);

        return view('encuesta.show', compact('encuesta'));
    }


    public function destroy($id)
    {
        $encuesta = Encuesta::find($id);

        if ($encuesta) {
            $encuesta->delete();
            return redirect()->route('encuestas.index')->with('success', 'Registro eliminado con éxito');
        }

        return redirect()->route('encuestas.index')->with('error', 'No se pudo encontrar la encuesta');
    }
}
