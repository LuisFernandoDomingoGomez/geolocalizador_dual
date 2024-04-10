<?php

namespace App\Http\Controllers;

use App\Models\Encuesta;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Spatie\Geocoder\Facades\Geocoder;
use PDF;
use Carbon\Carbon;

use App\Exports\ReportesExport;
use Maatwebsite\Excel\Facades\Excel;

class ReporteController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-reporte')->only('index');
        $this->middleware('permission:generar-listados-reportes', ['only' => ['pdf','export']]);
    }

    public function index(Request $request)
    {
        $query = Encuesta::query();

        $search = $request->input('search');

        if ($search) {
            $query->whereHas('user', function($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            })->orWhereHas('empresa', function($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            });
        }

        $encuestas = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('reporte.index', compact('encuestas', 'search'))
            ->with('i', ($encuestas->currentPage() - 1) * $encuestas->perPage());
    }

    public function pdf()
    {
        $encuestasPorMes = Encuesta::orderBy('created_at')->get()->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('Y-m');
        });
    
        $pdf = PDF::loadView('reporte.pdf', compact('encuestasPorMes'));
        return $pdf->stream();
    }

    public function export()
    {
        return Excel::download(new ReportesExport, 'reporte.xlsx');
    }
}
