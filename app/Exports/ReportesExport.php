<?php

namespace App\Exports;

use App\Models\Encuesta;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;

class ReportesExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        // Obtener todas las encuestas ordenadas por fecha de creación
        $encuestas = Encuesta::orderBy('created_at')->get();

        // Agrupar las encuestas por user_id, mes y día
        $encuestasAgrupadas = $encuestas->groupBy([
            'user_id',
            function ($encuesta) {
                return Carbon::parse($encuesta->created_at)->format('Y-m');
            },
            function ($encuesta) {
                return Carbon::parse($encuesta->created_at)->format('Y-m-d');
            }
        ]);

        return view('reporte.export', [
            'encuestasAgrupadas' => $encuestasAgrupadas
        ]);
    }
}
