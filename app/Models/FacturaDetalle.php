<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacturaDetalle extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table="factura_detalles"; //a
    protected $primaryKey = 'id_detalle';
    protected $fillable = ['id_detalle','linea_detalles','id_factura','id_producto','cantidad','precio_venta','subtotal'];

    public function producto()
    {
         return $this->belongsTo('App\Models\Producto','id_producto');    
    }
    public function factura()
    {
         return $this->belongsTo('App\Models\Factura','id_factura');    
    }
}
