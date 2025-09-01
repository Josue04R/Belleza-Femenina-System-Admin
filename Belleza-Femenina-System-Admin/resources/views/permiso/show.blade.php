@extends('panel.panel')

@section('template_title')
    {{ $permiso->nombrePermiso ?? __('Show') . " " . __('Permiso') }}
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('/css/categorias/crearCategoria.css') }}">
@endpush

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Permiso</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-submit btn-sm" href="{{ route('permisos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        <div class="form-group mb-2 mb20">
                            <strong>ID:</strong>
                            {{ $permiso->idPermiso }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Nivel Permiso:</strong>
                            {{ $permiso->nombrePermiso }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Productos:</strong>
                            {{ $permiso->productos == 1 ? 'Permitido' : 'Denegado' }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Empleados:</strong>
                            {{ $permiso->empleados == 1 ? 'Permitido' : 'Denegado' }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Permisos:</strong>
                            {{ $permiso->permisos == 1 ? 'Permitido' : 'Denegado' }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Reg. Ventas:</strong>
                            {{ $permiso->registroVentas == 1 ? 'Permitido' : 'Denegado' }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Ventas:</strong>
                            {{ $permiso->ventas == 1 ? 'Permitido' : 'Denegado' }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Compras:</strong>
                            {{ $permiso->compras == 1 ? 'Permitido' : 'Denegado' }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Pedidos:</strong>
                            {{ $permiso->pedidos == 1 ? 'Permitido' : 'Denegado' }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Gastos Operativos:</strong>
                            {{ $permiso->gastosOperativos == 1 ? 'Permitido' : 'Denegado' }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Inventario:</strong>
                            {{ $permiso->inventario == 1 ? 'Permitido' : 'Denegado' }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Clientes:</strong>
                            {{ $permiso->clientes == 1 ? 'Permitido' : 'Denegado' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
