<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="empresas"; 
    protected $primaryKey = 'id_empresa'; 
    protected $fillable = ['id_empresa','codigo_empresa','descripcion', 'direccion','telefono'];
}
