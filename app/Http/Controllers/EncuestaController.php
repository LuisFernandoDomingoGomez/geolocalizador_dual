<?php

namespace App\Http\Controllers;

use App\Models\Encuesta;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Geocoder\Facades\Geocoder; // Importa la fachada Geocoder

use PDF;
use Carbon\Carbon;

use App\Exports\EncuestasExport;
use Maatwebsite\Excel\Facades\Excel;

class EncuestaController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-encuesta|crear-encuesta|editar-encuesta|borrar-encuesta')->only('index');
        $this->middleware('permission:crear-encuesta', ['only' => ['create','store']]);
        $this->middleware('permission:editar-encuesta', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-encuesta', ['only' => ['destroy']]);
        $this->middleware('permission:generar-listados-encuestas', ['only' => ['pdf','export']]);
    }

    public function index()
    {
        $user = Auth::user();
        $encuestas = Encuesta::where('user_id', $user->id)
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);

        return view('encuesta.index', compact('encuestas'))
            ->with('i', (request()->input('page', 1) - 1) * $encuestas->perPage());
    }

    public function pdf()
    {
        $user_id = auth()->id();
        $encuestasPorMes = Encuesta::where('user_id', $user_id)
                                    ->orderBy('created_at')
                                    ->get()
                                    ->groupBy(function($date) {
                                        return Carbon::parse($date->created_at)->format('Y-m');
                                    });
    
        $pdf = PDF::loadView('encuesta.pdf', compact('encuestasPorMes'));
        return $pdf->stream();
    }
    

    public function export()
    {
        return Excel::download(new EncuestasExport, 'encuesta.xlsx');
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
