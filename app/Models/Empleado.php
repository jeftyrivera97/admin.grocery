<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="empleados"; 
    protected $primaryKey = 'id_empleado'; 
    protected $fillable = ['id_empleado','codigo_empleado','nombre', 'puesto','estado'];
}
