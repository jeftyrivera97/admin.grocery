<?php

namespace App\Exports;

use App\Models\Compra;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ComprasExport implements FromView
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
        return view('excel.compras', [
            'compras' => Compra::where('fecha', '>=', $this->fecha_inicio)->where('fecha', '<=', $this->fecha_final)->orderBy('fecha')->get()
        ]);
    }
}
