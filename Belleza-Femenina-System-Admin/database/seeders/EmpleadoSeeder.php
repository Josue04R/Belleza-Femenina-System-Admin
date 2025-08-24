<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Empleado;

class EmpleadoSeeder extends Seeder
{
    public function run(): void
    {
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
