<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GastoCategoria extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="gasto_categorias"; 
    protected $primaryKey = 'id'; 
  
}
