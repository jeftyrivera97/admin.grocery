<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="transacciones"; //a
    protected $primaryKey = 'id_transacciones';
    protected $fillable = ['id_transaccion','fecha','id_cliente','tipo_transaccion','total','saldo','descripcion','id_usuario'];

    public function cliente()
    {
        return $this->belongsTo('App\Models\Cliente','id_cliente');    
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','id_usuario');    
    }
}
