<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Empleado
 *
 * @property $idEmpleado
 * @property $nombre
 * @property $apellido
 * @property $telefono
 * @property $usuario
 * @property $contrasenia
 * @property $idPermiso
 *
 * @property Permiso $permiso
 * @property Log[] $logs
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Empleado extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['idEmpleado', 'nombre', 'apellido', 'telefono', 'usuario', 'contrasenia', 'idPermiso'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function permiso()
    {
        return $this->belongsTo(\App\Models\Permiso::class, 'idPermiso', 'idPermiso');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logs()
    {
        return $this->hasMany(\App\Models\Log::class, 'idEmpleado', 'idEmpleado');
    }
    
}
