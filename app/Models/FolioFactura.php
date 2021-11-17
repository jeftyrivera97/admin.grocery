<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FolioFactura extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="folio_facturas"; 
    protected $primaryKey = 'id_folio'; 

    public function estado()
    {
         return $this->belongsTo('App\Models\Estado','id_estado');    
    }
}
