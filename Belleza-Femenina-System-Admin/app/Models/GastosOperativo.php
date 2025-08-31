<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class GastosOperativo
 *
 * @property $idGasto
 * @property $fecha
 * @property $categoria
 * @property $descripcion
 * @property $monto
 * @property $metodo_pago
 * @property $idEmpleado
 * @property $observaciones
 *
 * @property Empleado $empleado
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class GastosOperativo extends Model
{
    protected $table = 'gastosOperativos';
    protected $primaryKey = 'idGasto';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['idGasto', 'fecha', 'categoria', 'descripcion', 'monto', 'metodoPago', 'idEmpleado', 'observaciones'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function empleado()
    {
        return $this->belongsTo(\App\Models\Empleado::class, 'idEmpleado', 'idEmpleado');
    }
    
}
