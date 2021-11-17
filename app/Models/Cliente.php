<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table="clientes"; //a
    protected $primaryKey = 'id_cliente';
    protected $fillable = ['id_cliente','codigo_cliente','nombre','telefono'];

    public function credito()
    {
        return $this->hasMany('App\Models\Credito');
    }

    public function transaccion()
    {
        return $this->hasMany('App\Models\Transaccion');
    }

    public function estado()
    {
         return $this->belongsTo('App\Models\Estado','id_estado');    
    }
}
