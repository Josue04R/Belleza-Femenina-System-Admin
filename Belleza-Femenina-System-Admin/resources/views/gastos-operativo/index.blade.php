@extends('panel.panel')

@section('template_title')
    Gastos Operativos
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
                                {{ __('Gastos Operativos') }}
                            </span>
                            <div class="float-right">
                                <a href="{{ route('gastos-operativos.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
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
                                        <th class="text-center px-4">No</th>
                                        <th class="text-center px-4">Fecha</th>
                                        <th class="text-center px-4">Categoria</th>
                                        <th class="text-center px-4">Descripcion</th>
                                        <th class="text-center px-4">Monto</th>
                                        <th class="text-center px-4">Metodo Pago</th>
                                        <th class="text-center px-4">Idempleado</th>
                                        <th class="text-center px-4">Observaciones</th>
                                        <th class="text-center px-4">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($gastosOperativos as $gastosOperativo)
                                        <tr class="custom-table-row">
                                            <td class="text-center px-4 py-3">{{ ++$i }}</td>
                                            <td class="text-center px-4 py-3">{{ $gastosOperativo->fecha }}</td>
                                            <td class="text-center px-4 py-3">{{ $gastosOperativo->categoria }}</td>
                                            <td class="text-center px-4 py-3">{{ $gastosOperativo->descripcion }}</td>
                                            <td class="text-center px-4 py-3">{{ $gastosOperativo->monto }}</td>
                                            <td class="text-center px-4 py-3">{{ $gastosOperativo->metodoPago }}</td>
                                            <td class="text-center px-4 py-3">{{ $gastosOperativo->idEmpleado }}</td>
                                            <td class="text-center px-4 py-3">{{ $gastosOperativo->observaciones }}</td>
                                            <td class="text-center px-4 py-3">
                                                <form action="{{ route('gastos-operativos.destroy', $gastosOperativo->idGasto) }}" method="POST" class="d-inline">
                                                    <div class="btn-group custom-btn-group">
                                                        <a class="btn btn-sm btn-success mx-1" href="{{ route('gastos-operativos.show', $gastosOperativo->idGasto) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                        <a class="btn btn-sm btn-success mx-1" href="{{ route('gastos-operativos.edit', $gastosOperativo->idGasto) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger mx-1" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
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
                        Showing {{ $gastosOperativos->firstItem() }} to {{ $gastosOperativos->lastItem() }} of {{ $gastosOperativos->total() }} results
                    </div>
                    <div class="paginationLinks">
                        @if ($gastosOperativos->onFirstPage())
                            <span class="paginationDisabled">« Previous</span>
                        @else
                            <a href="{{ $gastosOperativos->previousPageUrl() }}" class="paginationLink">« Previous</a>
                        @endif

                        @foreach ($gastosOperativos->getUrlRange(1, $gastosOperativos->lastPage()) as $page => $url)
                            @if ($page == $gastosOperativos->currentPage())
                                <span class="pagination-active">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="paginationLink">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if ($gastosOperativos->hasMorePages())
                            <a href="{{ $gastosOperativos->nextPageUrl() }}" class="paginationLink">Next »</a>
                        @else
                            <span class="paginationDisabled">Next »</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection