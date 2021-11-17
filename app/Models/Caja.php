<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="cajas"; //a
    protected $primaryKey = 'id_caja';
    protected $fillable = ['id_caja','fecha','fechaHora_inicio','fechaHora_cierre','faltante','id_estado','id_usuario'];

    public function user()
    {
        return $this->belongsTo('App\Models\User','id_usuario');    
    }

    public function estado()
    {
         return $this->belongsTo('App\Models\Estado','id_estado');    
    }
}
