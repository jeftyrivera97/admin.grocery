<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    public $timestamps = false;
    protected $table="ingresos"; 
    protected $primaryKey = 'id_ingreso';

    public function ingresos()
    {
        return $this->hasMany('App\Models\Ingreso');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','id_usuario');    
    }

    public function categoria()
    {
        return $this->belongsTo('App\Models\IngresoCategoria','id_categoria');    
    }

    public function pintado()
    {
        return $this->belongsToMany('App\Models\Pintado','id_pintado');    
    }

   
  
}
