<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Pedido
 *
 * Representa un pedido en la tabla 'pedidos'.
 *
 * @property int $idPedido              Clave primaria del pedido
 * @property int $idCliente             ID del cliente que realizó el pedido
 * @property int|null $idEmpleado       ID del empleado que atendió el pedido (puede ser null)
 * @property string $fecha              Fecha del pedido
 * @property string $direccion          Dirección de entrega del pedido
 * @property string $estado             Estado del pedido
 * @property float $total               Total del pedido
 * @property string|null $observaciones Observaciones adicionales del pedido
 *
 * @method \Illuminate\Database\Eloquent\Relations\HasMany detalles()  Relación con los detalles del pedido
 */
class Pedido extends Model
{
    protected $table = 'pedidos';
    protected $primaryKey = 'idPedido'; 
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'idCliente',
        'idEmpleado',
        'fecha',
        'direccion',
        'estado',
        'total',
        'observaciones'
    ];

    public function detalles()
    {
        return $this->hasMany(DetallePedido::class, 'idPedido');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'idCliente');
    }

    public function getRouteKeyName()
    {
        return 'idPedido';
    }
}
