@extends('layouts.app')

@section('template_title')
    {{ $permiso->name ?? __('Show') . " " . __('Permiso') }}
@endsection

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
                            <a class="btn btn-primary btn-sm" href="{{ route('permisos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Idpermiso:</strong>
                                    {{ $permiso->idPermiso }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Nombrepermiso:</strong>
                                    {{ $permiso->nombrePermiso }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Categoriaproductos:</strong>
                                    {{ $permiso->categoriaProductos }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Productos:</strong>
                                    {{ $permiso->productos }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Tallas:</strong>
                                    {{ $permiso->tallas }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Variantesproducto:</strong>
                                    {{ $permiso->variantesProducto }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Empleados:</strong>
                                    {{ $permiso->empleados }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Permisos:</strong>
                                    {{ $permiso->permisos }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Registroventas:</strong>
                                    {{ $permiso->registroVentas }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Ventas:</strong>
                                    {{ $permiso->ventas }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Compras:</strong>
                                    {{ $permiso->compras }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Pedidos:</strong>
                                    {{ $permiso->pedidos }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Gastosoperativos:</strong>
                                    {{ $permiso->gastosOperativos }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Inventario:</strong>
                                    {{ $permiso->inventario }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Clientes:</strong>
                                    {{ $permiso->clientes }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
