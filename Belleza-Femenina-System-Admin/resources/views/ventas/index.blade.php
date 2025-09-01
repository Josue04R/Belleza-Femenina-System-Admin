@extends('panel.panel')

@section('template_title')
    Ventas
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('/css/categorias/index.css') }}">
<link rel="stylesheet" href="{{ asset('/css/tablas/tablas.css') }}">
<link rel="stylesheet" href="{{ asset('/css/pagination/pagination.css') }}">
@endpush

@section('content')
    <div class="container-fluid py-4 px-5">
        <div class="row mx-1">
            <div class="col-12 px-2">
                <div class="card shadow-sm border-0 custom-card mb-4">
                    <div class="card-header custom-card-header py-3 px-4">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('Lista de Ventas') }}
                            </span>
                             <div class="float-right">
                                <a href="{{ route('ventas.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Nueva Venta') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success mx-4 mt-3 mb-3 custom-alert">
                            <p class="mb-0">{{ session('success') }}</p>
                        </div>
                    @endif

                    <div class="card-body bg-white px-4 py-3">
                        <form method="GET" action="{{ route('ventas.index') }}" class="mb-3 d-flex gap-2">
                            <div>
                                <label for="fecha_inicio">Desde:</label>
                                <input type="date" id="fecha_inicio" name="fecha_inicio" 
                                    value="{{ request('fecha_inicio') }}" class="form-control">
                            </div>

                            <div>
                                <label for="fecha_fin">Hasta:</label>
                                <input type="date" id="fecha_fin" name="fecha_fin" 
                                    value="{{ request('fecha_fin') }}" class="form-control">
                            </div>

                            <div class="align-self-end">
                                <button type="submit" class="btn btn-primary">Filtrar</button>
                                <a href="{{ route('ventas.index') }}" class="btn btn-secondary">Limpiar</a>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-hover custom-table mb-0">
                                <thead class="thead">
                                    <tr>
                                        <th class="text-center px-4">ID Venta</th>
                                        <th class="text-center px-4">Usuario</th>
                                        <th class="text-center px-4">Empleado</th>
                                        <th class="text-center px-4">Fecha</th>
                                        <th class="text-center px-4">Total</th>
                                        <th class="text-center px-4">Detalles</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ventas as $venta)
                                        <tr class="custom-table-row">
                                            <td class="text-center px-4 py-3">{{ $venta->idVenta }}</td>
                                            <td class="text-center px-4 py-3">{{ $venta->cliente->nombre}} {{$venta->cliente->apellido }}</td>
                                            <td class="text-center px-4 py-3">{{ $venta->empleado->nombre  }}</td>
                                            <td class="text-center px-4 py-3">{{ $venta->fecha }}</td>
                                            <td class="text-center px-4 py-3">${{ number_format($venta->total,2) }}</td>
                                            <td class="text-center px-4 py-3">
                                               
                                                    <div class="btn-group btnGrupoCompacto">
                                                        <a href="{{url('/detalleVenta',$venta->idVenta)}}" class="btn btn-success btn-sm">
                                                            Detalle
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </div>
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @if(isset($ventas) && method_exists($ventas, 'links'))
                <div class="cusmtonPagination py-3">
                    <div class="paginationInfo">
                        Showing {{ $ventas->firstItem() }} to {{ $ventas->lastItem() }} of {{ $ventas->total() }} results
                    </div>
                    <div class="paginationLinks">
                        @if ($ventas->onFirstPage())
                            <span class="paginationDisabled">« Previous</span>
                        @else
                            <a href="{{ $ventas->previousPageUrl() }}" class="paginationLink">« Previous</a>
                        @endif

                        @foreach ($ventas->getUrlRange(1, $ventas->lastPage()) as $page => $url)
                            @if ($page == $ventas->currentPage())
                                <span class="pagination-active">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="paginationLink">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if ($ventas->hasMorePages())
                            <a href="{{ $ventas->nextPageUrl() }}" class="paginationLink">Next »</a>
                        @else
                            <span class="paginationDisabled">Next »</span>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection