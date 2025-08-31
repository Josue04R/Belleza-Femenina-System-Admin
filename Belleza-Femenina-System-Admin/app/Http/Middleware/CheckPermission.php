<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Empleado;

class CheckPermission
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, $permiso)
    {
        // Sacamos el id del empleado desde la sesión
        $empleadoId = session('empleado_id');

        if ($empleadoId) {
            // Buscamos el empleado con su permiso
            $empleado = Empleado::with('permiso')->find($empleadoId);
            //dd($empleado);

            if ($empleado && $empleado->permiso && isset($empleado->permiso->$permiso) && $empleado->permiso->$permiso) {
                return $next($request);
            }
        }

        // Si no tiene sesión o permiso, abortamos
        return abort(403, 'No tienes permisos para acceder a esta sección');
    }
}

