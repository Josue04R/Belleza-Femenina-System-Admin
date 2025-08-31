<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DetallePedido
 *
 * Representa un detalle de pedido en la tabla 'detalle_pedidos'.
 *
 * @property int $idDetallePedido       Clave primaria del detalle
 * @property int $idPedido              ID del pedido al que pertenece
 * @property int $id_variantes          ID de la variante del producto
 * @property int $cantidad              Cantidad pedida
 * @property float $precioUnitario      Precio unitario de la variante
 * @property float $subtotal            Subtotal de este detalle
 *
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo variante()  Relación con la variante del producto
 */
class DetallePedido extends Model
{
    protected $table = 'detallePedidos';
    protected $primaryKey = 'idDetallePedido';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'idPedido',
        'idVariante',
        'cantidad',
        'precioUnitario',
        'subtotal'
    ];

     public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'idPedido', 'idPedido');
    }

    public function variante()
    {
        return $this->belongsTo(VariantesProducto::class, 'idVariante', 'idVariante');
    }
}
