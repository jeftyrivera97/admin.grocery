<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoCuenta extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table="estado_cuentas"; //
    protected $primaryKey = 'id'; //
}
