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
    <div class="container-fluid py-4 px-5">
        <div class="row mx-1">
            <div class="col-12 px-2">
                <div class="card shadow-sm border-0 custom-card mb-4">
                    <div class="card-header custom-card-header py-3 px-4">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('Pedidos') }}
                            </span>
                             <div class="float-right">
                                <a href="{{ route('pedidos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success mx-4 mt-3 mb-3 custom-alert">
                            <p class="mb-0">{{ $message }}</p>
                        </div>
                    @endif

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
                                                <form action="{{ route('pedidos.anular', $pedido) }}" method="POST" class="d-inline">
                                                    <div class="btn-group custom-btn-group">
                                                        <a class="btn btn-sm btn-success mx-1" href="{{ route('pedidos.show', $pedido) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Detalle') }}</a>
                                                        <a class="btn btn-sm btn-success mx-1" href="{{ route('pedidos.edit', $pedido) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                        @if($pedido->estado !== 'Anulado')
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn btn-sm btn-danger mx-1" onclick="event.preventDefault(); confirm('¿Estás seguro de anular este pedido?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Anular') }}</button>
                                                        @endif
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="cusmtonPagination py-3">
                    <div class="paginationInfo">
                        Showing {{ $pedidos->firstItem() }} to {{ $pedidos->lastItem() }} of {{ $pedidos->total() }} results
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
    </div>
@endsection