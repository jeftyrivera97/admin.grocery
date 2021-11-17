<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="facturas"; 
    protected $primaryKey = 'id_factura'; 
    protected $fillable = ['id_factura','codigo_factura','fecha', 'fechaHora','id_cliente','tipo_pago','descuento','exento','gravado15','gravado18','impuesto15','impuesto18','total','tipo','id_usuario'];

    public function cliente()
    {
        return $this->belongsTo('App\Models\Cliente','id_cliente');    
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User','id_usuario');    
    }

    public function estado()
    {
         return $this->belongsTo('App\Models\EstadoCuenta','id_estado');    
    }

    public function pago()
    {
         return $this->belongsTo('App\Models\TipoPago','tipo_pago');    
    }

    public function cuenta()
    {
         return $this->belongsTo('App\Models\TipoCuenta','tipo_cuenta');    
    }

    
}
