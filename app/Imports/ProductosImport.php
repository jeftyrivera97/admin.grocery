<?php

namespace App\Imports;

use App\Models\Producto;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductosImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Producto([
            'id_producto'=> $row[0],
            'codigo_producto'=> $row[1], 
            'descripcion'  => $row[2], 
            'ruta_imagen'  => $row[3], 
            'id_categoria'  => $row[4], 
            'marca'  => $row[5], 
            'tamaño'  => $row[6], 
            'stock'  => $row[7], 
            'id_impuesto'  => $row[8], 
            'gravado'  => $row[9], 
            'impuesto'  => $row[10], 
            'exento'  => $row[11], 
            'precio_compra'  => $row[12], 
            'precio_venta'  => $row[13],
            'valor'  => $row[14],
            'id_proveedor'  => $row[15],
            'id_estado'  => $row[16],
        ]);
    }
}
