<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Categoria
 *
 * @property $id_cate
 * @property $categoria
 * @property $descripcion
 *
 * @property Producto[] $productos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Categoria extends Model
{
    protected $primaryKey = 'idCategoria';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false; 

    protected $perPage = 20;

    protected $fillable = ['categoria', 'descripcion'];

    public function productos()
    {
        return $this->hasMany(\App\Models\Producto::class, 'idCategoria', 'idCategoria');
    }
}

