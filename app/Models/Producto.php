<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="productos"; //
    protected $primaryKey = 'id_producto'; //
    protected $fillable = ['id_producto','codigo_producto','descripcion','ruta_imagen','id_categoria','marca','tamaño','stock','id_impuesto','gravado','impuesto','exento','precio_compra','precio_venta','valor','id_proveedor','id_estado'];
    
    public function pedido()
    {
        return $this->hasMany('App\Models\Pedido');
    }

    public function productoCategoria()
    {
        return $this->belongsTo('App\Models\ProductoCategoria','id_categoria');    
    }

    public function estado()
    {
        return $this->belongsTo('App\Models\Estado','id_estado');    
    }

    public function proveedor()
    {
        return $this->belongsTo('App\Models\Proveedor','id_proveedor');    
    }
    public function tipoImpuesto()
    {
        return $this->belongsTo('App\Models\Impuesto','id_impuesto');    
    }
    
}
