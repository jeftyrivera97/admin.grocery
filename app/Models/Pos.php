<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pos extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="pos"; 
    protected $primaryKey = 'id_pos';
    protected $fillable = ['id_pos','codigo_pos','id_factura'];

    public function factura()
    {
         return $this->belongsTo('App\Models\Factura','id_factura');    
    }
}
