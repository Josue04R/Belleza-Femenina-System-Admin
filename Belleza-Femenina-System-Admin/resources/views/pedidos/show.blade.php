@extends('panel.panel')

@section('content')
<div class="container">
    <h1>Detalle del Pedido #{{ $pedido->idPedido }}</h1>

    <div class="card mb-3">
        <div class="card-body">
            <p><strong>Cliente:</strong> {{ $pedido->cliente->nombre ?? 'N/A' }}</p>
            <p><strong>Teléfono:</strong> {{ $pedido->cliente->telefono ?? 'N/A' }}</p>
            <p><strong>Dirección:</strong> {{ $pedido->direccion }}</p>
            <p><strong>Fecha:</strong> {{ $pedido->fecha }}</p>
            <p><strong>Estado:</strong> {{ ucfirst($pedido->estado) }}</p>
            <p><strong>Total:</strong> ${{ number_format($pedido->total, 2) }}</p>
            <p><strong>Observaciones:</strong> {{ $pedido->observaciones ?? 'N/A' }}</p>
        </div>
    </div>

    <h4>Detalles del pedido</h4>
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
                <td>{{ $detalle->variante->producto->nombre_p ?? 'N/A' }}</td>
                <td>{{ $detalle->variante->color ?? 'N/A' }}</td> <!-- Color de la variante -->
                <td>{{ $detalle->variante->talla->talla ?? 'N/A' }}</td>
                <td>${{ number_format($detalle->variante->precio ?? 0, 2) }}</td> <!-- Precio de la variante -->
                <td>{{ $detalle->cantidad }}</td>
                <td>${{ number_format(($detalle->variante->precio ?? 0) * $detalle->cantidad, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('pedidos.edit', $pedido) }}" class="btn btn-warning">Editar Pedido</a>
    <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">Volver</a>
</div>
@endsection
