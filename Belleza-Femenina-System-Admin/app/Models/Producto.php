<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Producto
 *
 * @property $id_producto
 * @property $nombre_p
 * @property $marca_p
 * @property $id_cate
 * @property $material
 * @property $descripcion
 * @property $precio
 * @property $imagen
 * @property $estado
 *
 * @property Categoria $categoria
 * @property VariantesProducto[] $variantesProductos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Producto extends Model
{
    protected $primaryKey = 'idProducto';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false; 
    protected $perPage = 20;

    protected $fillable = [
        'nombreProducto', 'marcaProducto', 'idCategoria',
        'material', 'descripcion', 'precio', 'imagen', 'estado'
    ];

    public function categoria()
    {
        return $this->belongsTo(\App\Models\Categoria::class, 'idCategoria', 'idCategoria');
    }

    public function variantesProductos()
    {
        return $this->hasMany(\App\Models\VariantesProducto::class, 'idProducto', 'idProducto');
    }
}

