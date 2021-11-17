<?php

namespace App\Exports;

use App\Models\Venta;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class VentasExport implements FromView
{
    public function __construct($fecha_inicio, $fecha_final)
    {
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_final = $fecha_final;
    }

    public function view(): View
    {
        return view('excel.ventas', [
            'ventas' => Venta::where('fecha', '>=', $this->fecha_inicio)->where('fecha', '<=', $this->fecha_final)->orderBy('fecha')->get()
        ]);
    }
}


