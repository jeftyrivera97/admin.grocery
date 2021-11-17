<?php

namespace App\Exports;

use App\Models\Factura;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class FacturasExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($fecha_inicio, $fecha_final)
    {
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_final = $fecha_final;
    }

    public function view(): View
    {
        return view('excel.facturas', [
            'facturas' => Factura::where('fecha', '>=', $this->fecha_inicio)->where('fecha', '<=', $this->fecha_final)->where('tipo_factura','Contado')->where('tipo',1)->orderBy('fechaHora')->get()
        ]);
    }
}
