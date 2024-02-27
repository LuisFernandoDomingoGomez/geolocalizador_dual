<?php

namespace App\Http\Controllers;

use App\Models\Encuesta;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Spatie\Geocoder\Facades\Geocoder; // Importa la fachada Geocoder

class ReporteController extends Controller
{
    public function index()
    {
        $encuestas = Encuesta::paginate(10);

        return view('reporte.index', compact('encuestas'))
            ->with('i', (request()->input('page', 1) - 1) * $encuestas->perPage());
    }
}
