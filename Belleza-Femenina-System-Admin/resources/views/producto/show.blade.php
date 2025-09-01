@extends('panel.panel')

@section('template_title')
    {{ $producto->name ?? __('Show') . " " . __('Producto') }}
@endsection

@push('styles')
<link rel="stylesheet" href="{{ url('/css/categorias/crearCategoria.css') }}">
@endpush

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Producto</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-submit btn-sm" href="{{ route('productos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        <div class="form-group mb-2 mb20">
                            <strong>Id:</strong>
                            <span>{{ $producto->idProducto }}</span>
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Nombre:</strong>
                            <span>{{ $producto->nombreProducto }}</span>
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Marca:</strong>
                            <span>{{ $producto->marcaProducto }}</span>
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Categoria:</strong>
                            <span>{{ $producto->categoria->categoria ?? 'N/A' }}</span>
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Material:</strong>
                            <span>{{ $producto->material }}</span>
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Descripcion:</strong>
                            <span>{{ $producto->descripcion }}</span>
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Precio:</strong>
                            <span>{{ $producto->precio }}</span>
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Estado:</strong>
                            <span>{{ $producto->estado }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection