@extends('panel.panel') 

@push('styles')
<link rel="stylesheet" href="{{ url('/css/categorias/index.css') }}">
<link rel="stylesheet" href="{{ url('/css/compras/compra.css') }}">
@endpush

@section('template_title')
    Detalle Venta
@endsection

@section('content')
    <div class="container-fluid py-3 px-4">
        <div class="row mx-0">
            <div class="col-12 px-0">
                <div class="card shadow-sm border-0 custom-card mb-3">
                    <div class="card-header custom-card-header py-2 px-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">
                                <i class="fas fa-key mr-2"></i> {{ __('Detalle Venta') }}
                            </h6>
                            <a href="{{ url('ventas') }}" class="btn btnNuevaCompra">
                                <i class="fas fa-plus mr-1"></i> {{ __('Volver') }}
                            </a>
                        </div>
                    </div>

                    <div class="tablaCompraContainer mt-3">
                        <table class="tablaCompraCompleta">
                            <thead>
                                <tr>
                                   
                                    <th>Producto</th>
                                    <th>Estilo</th>
                                    <th>Precio Unitario</th>
                                    <th>Cantidad</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($venta->detalles as $detalle)
                                    <tr>
                                        <td>{{ $detalle->producto->nombreProducto ?? 'N/A' }}</td>
                                        <td>
                                            {{ $detalle->variante->color ?? '' }} - 
                                            {{ $detalle->variante->talla->talla ?? '' }}
                                        </td>
                                        <td>{{$detalle->producto->precio}}</td>
                                        <td>{{ $detalle->cantidad }}</td>
                                        <td>${{ number_format($detalle->subTotal, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection