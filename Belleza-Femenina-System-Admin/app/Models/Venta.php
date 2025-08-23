<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Venta extends Model
{
    protected $table = 'ventas';
    protected $primaryKey = 'idVenta';
    public $timestamps = true; // porque tienes created_at y updated_at

    protected $fillable = [
        'user_id',
        'empleado_id',
        'fecha',
        'total'
    ];

    public function detalles()
    {
        // FK = venta_id, PK = idVenta
        return $this->hasMany(DetalleVenta::class, 'venta_id', 'idVenta');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }
}
