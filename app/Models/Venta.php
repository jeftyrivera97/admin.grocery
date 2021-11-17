<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="ventas"; //a
    protected $primaryKey = 'id_venta';
    protected $fillable = ['id_venta','fecha','fechaHora','id_pintado','descripcion','total','id_usuario'];

    public function user()
    {
        return $this->belongsTo('App\Models\User','id_usuario');    
    }

    public function cliente()
    {
        return $this->belongsTo('App\Models\Cliente','id_cliente');    
    }
}
