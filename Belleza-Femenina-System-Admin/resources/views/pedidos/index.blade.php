@extends('panel.panel')

@section('template_title')
    Pedidos
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ url('/css/categorias/index.css') }}">
    <link rel="stylesheet" href="{{ url('/css/tablas/tablas.css') }}">
    <link rel="stylesheet" href="{{ url('/css/pagination/pagination.css') }}">
@endpush

@section('content')
    <div class="card shadow-sm border-0 custom-card mb-4">
        {{-- HEADER CON TITULO Y FILTRO --}}
        <div class="card-header custom-card-header py-3 px-4">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap:10px;">
            <span id="card_title">{{ __('Pedidos') }}</span>

            {{-- FILTRO Y BUSCADOR COMPACTO --}}
            <form method="GET" action="{{ route('pedidos.index') }}" class="d-flex align-items-center gap-2 flex-wrap">
                {{-- Filtrar por estado --}}
                <select name="estado" class="form-select form-select-sm" style="width: 130px;">
                    <option value="">Todos</option>
                    <option value="enviado" {{ request('estado') == 'enviado' ? 'selected' : '' }}>Enviado</option>
                    <option value="pendiente" {{ request('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                    <option value="procesado" {{ request('estado') == 'procesado' ? 'selected' : '' }}>Procesado</option>
                    <option value="cancelado" {{ request('estado') == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                </select>

                {{-- Buscar por cliente --}}
                <input type="text" name="cliente" class="form-control form-control-sm" placeholder="Buscar cliente" value="{{ request('cliente') }}" style="width: 180px;">

                {{-- Filtrar por fecha --}}
                <input type="date" name="fecha" class="form-control form-control-sm" value="{{ request('fecha') }}" style="width: 150px;">

                {{-- Botones --}}
                <button type="submit" class="btn btn-primary btn-sm" style="height: 32px;">Filtrar</button>
                    <a href="{{ route('pedidos.index') }}" class="btn btn-primary btn-sm" style="height: 32px;">Borrar Filtro</a>
                </form>
            </div>
        </div>


        {{-- TABLA --}}
        <div class="card-body bg-white px-4 py-3">
            <div class="table-responsive">
                <table class="table table-hover custom-table mb-0">
                    <thead class="thead">
                        <tr>
                            <th class="text-center px-4">ID</th>
                            <th class="text-center px-4">Cliente</th>
                            <th class="text-center px-4">Teléfono</th>
                            <th class="text-center px-4">Fecha</th>
                            <th class="text-center px-4">Estado</th>
                            <th class="text-center px-4">Total</th>
                            <th class="text-center px-4">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pedidos as $pedido)
                            <tr class="custom-table-row">
                                <td class="text-center px-4 py-3">{{ $pedido->idPedido }}</td>
                                <td class="text-center px-4 py-3">{{ $pedido->cliente->nombre ?? 'N/A' }}</td>
                                <td class="text-center px-4 py-3">{{ $pedido->cliente->telefono ?? 'N/A' }}</td>
                                <td class="text-center px-4 py-3">{{ $pedido->fecha }}</td>
                                <td class="text-center px-4 py-3">{{ ucfirst($pedido->estado) }}</td>
                                <td class="text-center px-4 py-3">${{ number_format($pedido->total, 2) }}</td>
                                <td class="text-center px-4 py-3">
                                    <form action="{{ route('pedidos.anular', $pedido->idPedido) }}" method="POST" class="d-inline">
                                        <div class="btn-group custom-btn-group">
                                            <a class="btn btn-sm btn-success mx-1" href="{{ route('pedidos.show', $pedido->idPedido) }}"><i class="fa fa-fw fa-eye"></i> Detalle</a>
                                            <a class="btn btn-sm btn-success mx-1" href="{{ route('pedidos.edit', $pedido->idPedido) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                            @if($pedido->estado !== 'cancelado')
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-sm btn-danger mx-1" onclick="event.preventDefault(); confirm('¿Estás seguro de anular este pedido?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> Anular</button>
                                            @endif
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- PAGINACION --}}
            <div class="cusmtonPagination py-3">
                <div class="paginationInfo">
                    Mostrando {{ $pedidos->firstItem() }} a {{ $pedidos->lastItem() }} de {{ $pedidos->total() }} resultados
                </div>
                <div class="paginationLinks">
                    @if ($pedidos->onFirstPage())
                        <span class="paginationDisabled">« Previous</span>
                    @else
                        <a href="{{ $pedidos->previousPageUrl() }}" class="paginationLink">« Previous</a>
                    @endif

                    @foreach ($pedidos->getUrlRange(1, $pedidos->lastPage()) as $page => $url)
                        @if ($page == $pedidos->currentPage())
                            <span class="pagination-active">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="paginationLink">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if ($pedidos->hasMorePages())
                        <a href="{{ $pedidos->nextPageUrl() }}" class="paginationLink">Next »</a>
                    @else
                        <span class="paginationDisabled">Next »</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
