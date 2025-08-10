<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Talla extends Model
{
    protected $primaryKey = 'id_talla';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;  

    protected $perPage = 20;

    protected $fillable = ['talla'];  

    public function variantesProductos()
    {
        return $this->hasMany(\App\Models\VariantesProducto::class, 'id_talla', 'id_talla');
    }
}
