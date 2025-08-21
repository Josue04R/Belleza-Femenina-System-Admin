<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cliente
 *
 * @property $idCliente
 * @property $nombre
 * @property $apellido
 * @property $email
 * @property $telefono
 * @property $password
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Cliente extends Model
{
    public $timestamps = false;
    
    protected $primaryKey = 'idCliente';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $perPage = 20;

    protected $fillable = ['nombre', 'apellido', 'email', 'telefono', 'password'];
}

