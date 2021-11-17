<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompraCategoria extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="compra_categorias"; 
    protected $primaryKey = 'id_categoria'; 
    protected $fillable = ['id_categoria','descripcion','id_estado'];

    public function estado()
    {
         return $this->belongsTo('App\Models\Estado','id_estado');    
    }
}
