@extends('panel.panel')

@section('template_title')
    {{ $variantesProducto->name ?? __('Show') . " " . __('Variantes Producto') }}
@endsection

@push('styles')
<link rel="stylesheet" href="{{ url('/css/categorias/crearCategoria.css') }}">
@endpush

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card custom-card">
                    <div class="card-header custom-card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Variantes Producto</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-submit btn-sm" href="{{ route('variantes-productos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white custom-card-body">
                        <div class="form-group mb-2 mb20">
                            <strong>Id Variantes:</strong>
                            {{ $variantesProducto->id_variantes }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Id Producto:</strong>
                            {{ $variantesProducto->id_producto }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Id Talla:</strong>
                            {{ $variantesProducto->id_talla }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Color:</strong>
                            {{ $variantesProducto->color }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Stock:</strong>
                            {{ $variantesProducto->stock }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Precio:</strong>
                            {{ $variantesProducto->precio }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection