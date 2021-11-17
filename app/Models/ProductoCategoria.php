<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoCategoria extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="producto_categorias"; 
    protected $primaryKey = 'id'; 
    protected $fillable = ['id_categoria','descripcion','estado'];

    public function estado()
    {
         return $this->belongsTo('App\Models\Estado','id_estado');    
    }

}
