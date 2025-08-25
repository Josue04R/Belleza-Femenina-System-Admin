@extends('panel.panel')

@section('template_title')
    {{ __('Update') }} Pedido
@endsection

@push('styles')
<link rel="stylesheet" href="{{ url('/css/categorias/crearCategoria.css') }}">
@endpush

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Pedido #{{ $pedido->idPedido }}</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('pedidos.update', $pedido) }}" role="form">
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

                            <div class="box-footer mt-4">
                                <button type="submit" class="btn btn-success">Guardar Cambios</button>
                                <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection