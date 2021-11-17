<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="gastos"; 
    protected $primaryKey = 'id_gasto'; 
    protected $fillable = ['id_gasto','codigo_gasto','fecha','id_categoria','descripcion','importe_gravado15','impuesto15','total','id_usuario','tipo'];

    public function user()
    {
        return $this->belongsTo('App\Models\User','id_usuario');    
    }
    public function gastoCategoria()
    {
        return $this->belongsTo('App\Models\GastoCategoria','id_categoria');    
    }
}
