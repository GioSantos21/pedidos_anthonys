<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sucursales extends Model
{
    protected $table = 'sucursales';
    protected $fillable = ['cod_sucursal','name','status',];
    public $timestamps = false;
}
