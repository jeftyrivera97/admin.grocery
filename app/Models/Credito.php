<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credito extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="creditos"; //a
    protected $primaryKey = 'id_credito';
    protected $fillable = ['id_credito','id_cliente','saldo'];

    public function cliente()
    {
        return $this->belongsTo('App\Models\Cliente','id_cliente');    
    }
}
