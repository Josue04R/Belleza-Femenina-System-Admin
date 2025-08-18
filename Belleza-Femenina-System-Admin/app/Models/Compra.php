<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model{
    protected $table = 'compras';
    protected $primaryKey = 'idCompra';
    public $timestamps = false;

    protected $fillable = ['idEmpleado', 'total', 'fecha'];

    public function detalles()
    {
        return $this->hasMany(DetalleCompra::class, 'idCompra','idCompra');
    }
}