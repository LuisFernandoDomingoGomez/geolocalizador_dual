<?php

namespace App\Exports;

use App\Models\Encuesta;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;

class EncuestasExport implements FromView, ShouldAutoSize
{

    public function view(): View
    {
        $user = auth()->user();

        $encuestas = Encuesta::where('user_id', $user->id)->get();

        if ($encuestas->isEmpty()) {
            return view('encuesta.export', [
                'encuestasPorMes' => [],
                'cantidadPorMes' => [],
                'encuestas' => [],
            ]);
        }

        // Agrupar las encuestas por mes
        $encuestasPorMes = $encuestas->groupBy(function ($encuesta) {
            return Carbon::parse($encuesta->created_at)->format('Y-m');
        });

        $cantidadPorMes = [];
        foreach ($encuestasPorMes as $mes => $encuestasDelMes) {
            $cantidadPorMes[$mes] = $encuestasDelMes->count();
        }

        return view('encuesta.export', [
            'encuestasPorMes' => $encuestasPorMes,
            'cantidadPorMes' => $cantidadPorMes,
            'encuestas' => $encuestas,
        ]);
    }

}