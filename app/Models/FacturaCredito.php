<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacturaCredito extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="factura_creditos"; 
    protected $primaryKey = 'id_facturaCredito'; 
    protected $fillable = ['id','id_factura','saldo'];

    public function factura()
    {
         return $this->belongsTo('App\Models\Factura','id_factura');    
    }

    public function estado()
    {
         return $this->belongsTo('App\Models\Estado','id_estado');    
    }
    
}
