<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="proveedores"; //a
    protected $primaryKey = 'id_proveedor';
    protected $fillable = ['id_proveedor','codigo_proveedor','descripcion','categoria','contacto','telefono'];

    public function compra()
    {
        return $this->hasMany('App\Models\Compra');
    }

    public function estado()
    {
         return $this->belongsTo('App\Models\Estado','id_estado');    
    }

}
