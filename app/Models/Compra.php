<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="compras"; //
    protected $primaryKey = 'id_compra'; //
    protected $fillable = ['id_compra','fecha','codigo_compra','id_proveedor','tipo','fecha_pago','categoria','exento','gravado15','gravado18','impuesto15','impuesto18','total','id_usuario'];

    public function proveedor()
    {
        return $this->belongsTo('App\Models\Proveedor','id_proveedor');    
    }
    
    public function user()
    {
        return $this->belongsTo('App\Models\User','id_usuario');    
    }

    public function cuenta()
    {
         return $this->belongsTo('App\Models\TipoCuenta','tipo_cuenta');    
    }

    public function estado()
    {
         return $this->belongsTo('App\Models\EstadoCuenta','id_estado');    
    }

    public function compraCategoria()
    {
        return $this->belongsTo('App\Models\CompraCategoria','id_categoria');    
    }
}
