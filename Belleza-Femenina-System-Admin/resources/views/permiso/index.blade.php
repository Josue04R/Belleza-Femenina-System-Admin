@extends('panel.panel')

@section('template_title')
    Permisos
@endsection

@push('styles')
<link rel="stylesheet" href="{{ url('/css/categorias/index.css') }}">
<link rel="stylesheet" href="{{ url('/css/permiso/permiso.css') }}">
@endpush

@push('styles')
@endpush

@section('content')
    <div class="container-fluid py-3 px-4">
        <div class="row mx-0">
            <div class="col-12 px-0">
                <div class="card shadow-sm border-0 custom-card mb-3">
                    <div class="card-header custom-card-header py-2 px-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">
                                <i class="fas fa-key mr-2"></i> {{ __('Permisos') }}
                            </h6>
                            <a href="{{ route('permisos.create') }}" class="btn btnNuevoPermiso">
                                <i class="fas fa-plus mr-1"></i> {{ __('Nuevo') }}
                            </a>
                        </div>
                    </div>
                    
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success mx-3 mt-2 mb-2 custom-alert">
                            <p class="mb-0">{{ $message }}</p>
                        </div>
                    @endif
                </div>

                <!-- CONTENEDOR CON SCROLL HORIZONTAL -->
                <div class="tablaPermisoContainer">
                    <table class="tablaPermisoCompleta">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Categoría</th>
                                <th>Productos</th>
                                <th>Taller</th>
                                <th>Variantes</th>
                                <th>Empleados</th>
                                <th>Permisos</th>
                                <th>Reg. Ventas</th>
                                <th>Ventas</th>
                                <th>Compras</th>
                                <th>Pedidos</th>
                                <th>Gastos</th>
                                <th>Inventario</th>
                                <th>Clientes</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permisos as $permiso)
                                <tr>
                                    <td>{{ $permiso->nombrePermiso }}</td>
                                    <td>{{ $permiso->categoriaProductos }}</td>
                                    <td>{{ $permiso->productos }}</td>
                                    <td>{{ $permiso->taller }}</td>
                                    <td>{{ $permiso->variantesProducto }}</td>
                                    <td>{{ $permiso->empleados }}</td>
                                    <td>{{ $permiso->permisos }}</td>
                                    <td>{{ $permiso->registroVentas }}</td>
                                    <td>{{ $permiso->ventas }}</td>
                                    <td>{{ $permiso->compras }}</td>
                                    <td>{{ $permiso->pedidos }}</td>
                                    <td>{{ $permiso->gastosOperativos }}</td>
                                    <td>{{ $permiso->inventario }}</td>
                                    <td>{{ $permiso->clientes }}</td>
                                    <td class="columna-acciones-fija">
                                        <div class="btn-group btnGrupoCompacto">
                                            <a href="{{ route('permisos.show', $permiso->id) }}" class="btn btn-success btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('permisos.edit', $permiso->id) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('permisos.destroy', $permiso->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Confirmar eliminación?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Paginación -->
                <div class="custom-pagination px-3 py-3">
                    {!! $permisos->withQueryString()->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection