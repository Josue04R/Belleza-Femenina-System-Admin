@extends('panel.panel') 

@section('content')
<div class="container mt-4">
    <h2>Lista de Ventas</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('ventas.create') }}" class="btn btn-primary mb-3">Nueva Venta</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Venta</th>
                <th>Usuario</th>
                <th>Empleado</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Detalles</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ventas as $venta)
                <tr>
                    <td>{{ $venta->idVenta }}</td>
                    <td>{{ $venta->usuario->nombre ?? '---' }}</td>
                    <td>{{ $venta->empleado->nameU ?? '---' }}</td>
                    <td>{{ $venta->fecha }}</td>
                    <td>${{ number_format($venta->total,2) }}</td>
                    <td>
                        <ul>
                        @foreach($venta->detalles as $detalle)
                            <li>{{ $detalle->producto->nombreP }} 
                                - Cant: {{ $detalle->cantidad }} 
                                - ${{ $detalle->subTotal }}
                            </li>
                        @endforeach
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
