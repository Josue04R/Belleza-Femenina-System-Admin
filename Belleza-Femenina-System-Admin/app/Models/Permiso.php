<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Permiso
 *
 * @property $idPermiso
 * @property $nombrePermiso
 * @property $categoriaProductos
 * @property $productos
 * @property $tallas
 * @property $variantesProducto
 * @property $empleados
 * @property $permisos
 * @property $registroVentas
 * @property $ventas
 * @property $compras
 * @property $pedidos
 * @property $gastosOperativos
 * @property $inventario
 * @property $clientes
 *
 * @property Empleado[] $empleados
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Permiso extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['idPermiso', 'nombrePermiso', 'categoriaProductos', 'productos', 'tallas', 'variantesProducto', 'empleados', 'permisos', 'registroVentas', 'ventas', 'compras', 'pedidos', 'gastosOperativos', 'inventario', 'clientes'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function empleados()
    {
        return $this->hasMany(\App\Models\Empleado::class, 'idPermiso', 'idPermiso');
    }
    
}
