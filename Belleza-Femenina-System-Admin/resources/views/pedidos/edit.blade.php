@extends('panel.panel')

@section('content')
<div class="container">
    <h1>Editar Pedido #{{ $pedido->idPedido }}</h1>

    <form action="{{ route('pedidos.update', $pedido) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Dirección solo lectura -->
        <div class="form-group">
            <label>Dirección</label>
            <input type="text" class="form-control" value="{{ $pedido->direccion }}" readonly>
        </div>

        <div class="form-group">
            <label>Estado</label>
            <select name="estado" class="form-control">
                <option value="pendiente" {{ $pedido->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="confirmado" {{ $pedido->estado == 'confirmado' ? 'selected' : '' }}>Confirmado</option>
                <option value="procesando" {{ $pedido->estado == 'procesando' ? 'selected' : '' }}>Procesando</option>
                <option value="enviado" {{ $pedido->estado == 'enviado' ? 'selected' : '' }}>Enviado</option>
                <option value="entregado" {{ $pedido->estado == 'entregado' ? 'selected' : '' }}>Entregado</option>
                <option value="cancelado" {{ $pedido->estado == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
            </select>
        </div>

        <div class="form-group">
            <label>Observaciones</label>
            <textarea name="observaciones" class="form-control">{{ $pedido->observaciones }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Guardar Cambios</button>
        <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
