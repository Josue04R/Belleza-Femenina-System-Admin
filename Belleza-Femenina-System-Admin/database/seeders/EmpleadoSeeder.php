<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Empleado;
use App\Models\Permiso;

class EmpleadoSeeder extends Seeder
{
    public function run(): void
    {
        Permiso::create([
            'nombrePermiso' => 'Gerente',
			'gestionProductos' => 1,
			'empleados' => 1,
			'permisos' => 1,
			'registroVentas' => 1,
			'ventas' => 1,
			'compras' => 1,
			'pedidos' => 1,
			'gastosOperativos' => 1,
			'inventario' => 1,
			'clientes' => 1,
        ]);
        Empleado::create([
            'nombre'      => 'Cristian',
            'apellido'    => 'Rubio',
            'telefono'    => '77777777',
            'usuario'     => 'CR000',
            'contrasenia' => Hash::make('12345689'),
            'idPermiso'   => 1,
        ]);

        Empleado::create([
            'nombre'      => 'Luis',
            'apellido'    => 'Cruz',
            'telefono'    => '66666666',
            'usuario'     => 'root123',
            'contrasenia' => Hash::make('password'),
            'idPermiso'   => 1                         ,
        ]);

        Empleado::create([
            'nombre'      => 'Josue',
            'apellido'    => 'Romero',
            'telefono'    => '55555555',
            'usuario'     => 'ro22024',
            'contrasenia' => Hash::make('admin123'),
            'idPermiso'   => 1,
        ]);

         Empleado::create([
            'nombre'      => 'Kevin',
            'apellido'    => 'Perez',
            'telefono'    => '55555555',
            'usuario'     => 'KP00000',
            'contrasenia' => Hash::make('admin123'),
            'idPermiso'   => 1,
        ]);
    }
}
