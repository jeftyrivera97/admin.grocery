<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngresoCategoria extends Model
{
    public $timestamps = false;
    protected $table="ingreso_categorias"; 
    protected $primaryKey = 'id'; 
}
