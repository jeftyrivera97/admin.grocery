<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planilla extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="planillas"; //a
    protected $primaryKey = 'id_planilla';
    protected $fillable = ['id_planilla','fecha','id_empleado','total','id_usuario'];

    
    public function user()
    {
        return $this->belongsTo('App\Models\User','id_usuario');    
    }
    public function empleado()
    {
        return $this->belongsTo('App\Models\Empleado','id_empleado');    
    }
}
