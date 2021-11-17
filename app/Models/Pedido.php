<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table="pedidos"; 
    protected $primaryKey = 'id_pedido'; 
    protected $fillable = ['id_pedido','id_compra','id_producto','precio_compra','cantidad','subtotal'];

    
    public function compra()
    {
        return $this->belongsTo('App\Models\Compra','id_compra');    
    }

    public function producto()
    {
        return $this->belongsTo('App\Models\Producto','id_producto');    
    }
}
