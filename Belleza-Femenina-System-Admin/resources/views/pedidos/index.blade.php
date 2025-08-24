@extends('panel.panel')

@section('content')
<div class="container">
    <h1>Listado de Pedidos</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Teléfono</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($pedidos as $pedido)
            <tr>
                <td>{{ $pedido->idPedido }}</td>
                <td>{{ $pedido->cliente->nombre ?? 'N/A' }}</td>
                <td>{{ $pedido->cliente->telefono ?? 'N/A' }}</td>
                <td>{{ $pedido->fecha }}</td>
                <td>{{ ucfirst($pedido->estado) }}</td>
                <td>${{ number_format($pedido->total, 2) }}</td>
                <td>
                    <a href="{{ route('pedidos.show', $pedido) }}" class="btn btn-info btn-sm">Detalle</a>
                    <a href="{{ route('pedidos.edit', $pedido) }}" class="btn btn-warning btn-sm">Editar</a>
                    @if($pedido->estado !== 'Anulado')
                        <form action="{{ route('pedidos.anular', $pedido) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-danger btn-sm">Anular</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- Paginación -->
    <div>
        {{ $pedidos->links() }}
    </div>
</div>
@endsection
