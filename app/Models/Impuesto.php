<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Impuesto extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="impuestos"; 
    protected $primaryKey = 'id_impuesto'; 

    public function estado()
    {
         return $this->belongsTo('App\Models\Estado','id_estado');    
    }
}
