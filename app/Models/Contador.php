<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contador extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="contador"; //a
    protected $primaryKey = 'id_contador';
    protected $fillable = ['id_contador','ultimo'];
}
