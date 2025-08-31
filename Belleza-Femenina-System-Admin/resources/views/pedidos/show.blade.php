@extends('panel.panel')

@section('template_title')
    {{ __('Detalle del Pedido') . " #" . $pedido->idPedido }}
@endsection

@push('styles')
<link rel="stylesheet" href="{{ url('/css/categorias/crearCategoria.css') }}">
@endpush

@section('content')
<section class="content container">
    <div class="row justify-content-center">
        <div class="col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span class="card-title">{{ __('Detalle del Pedido') }} #{{ $pedido->idPedido }}</span>
                    <a class="btn btn-submit btn-sm" href="{{ route('pedidos.index') }}">
                        {{ __('Back') }}
                    </a>
                </div>

                <div class="card-body bg-white">
                    <div class="form-group mb-2">
                        <strong>Cliente:</strong>
                        {{ $pedido->cliente->nombre ?? 'N/A' }}
                    </div>
                    <div class="form-group mb-2">
                        <strong>Teléfono:</strong>
                        {{ $pedido->cliente->telefono ?? 'N/A' }}
                    </div>
                    <div class="form-group mb-2">
                        <strong>Dirección:</strong>
                        {{ $pedido->direccion }}
                    </div>
                    <div class="form-group mb-2">
                        <strong>Fecha:</strong>
                        {{ $pedido->fecha }}
                    </div>
                    <div class="form-group mb-2">
                        <strong>Estado:</strong>
                        {{ ucfirst($pedido->estado) }}
                    </div>
                    <div class="form-group mb-2">
                        <strong>Total:</strong>
                        ${{ number_format($pedido->total, 2) }}
                    </div>
                    <div class="form-group mb-2">
                        <strong>Observaciones:</strong>
                        {{ $pedido->observaciones ?? 'N/A' }}
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <span class="card-title">{{ __('Detalles del Pedido') }}</span>
                </div>
                <div class="card-body bg-white">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Color / Variante</th>
                                <th>Talla</th>
                                <th>Precio Unitario</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pedido->detalles as $detalle)
                                <tr>
                                    <td>{{ $detalle->variante->producto->nombreProducto ?? 'N/A' }}</td>
                                    <td>{{ $detalle->variante->color ?? 'N/A' }}</td>
                                    <td>{{ $detalle->variante->talla->talla ?? 'N/A' }}</td>
                                    <td>${{ number_format($detalle->variante->precio ?? 0, 2) }}</td>
                                    <td>{{ $detalle->cantidad }}</td>
                                    <td>${{ number_format(($detalle->variante->precio ?? 0) * $detalle->cantidad, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-3 text-center">
                <a href="{{ route('pedidos.edit', $pedido->idPedido) }}" class="btn btn-warning">Editar Pedido</a>
                <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
</section>
@endsection