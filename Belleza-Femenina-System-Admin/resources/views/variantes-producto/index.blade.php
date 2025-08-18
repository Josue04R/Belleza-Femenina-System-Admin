@extends('panel.panel')

@section('template_title')
    Variantes Productos
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
                                {{ __('Variantes Productos') }}
                            </span>
                            <div class="float-right">
                                <a href="{{ route('variantes-productos.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
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
                                        <th class="text-center px-4">Nombre Producto</th>
                                        <th class="text-center px-4">Talla</th>
                                        <th class="text-center px-4">Color</th>
                                        <th class="text-center px-4">Stock</th>
                                        <th class="text-center px-4">Precio</th>
                                        <th class="text-center px-4">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($variantesProductos as $variantesProducto)
                                        <tr class="custom-table-row">
                                            <td class="text-center px-4 py-3">{{ $variantesProducto->producto?->nombre_p }}</td>
                                            <td class="text-center px-4 py-3">{{ $variantesProducto->talla?->talla }}</td>
                                            <td class="text-center px-4 py-3">{{ $variantesProducto->color }}</td>
                                            <td class="text-center px-4 py-3">{{ $variantesProducto->stock }}</td>
                                            <td class="text-center px-4 py-3">{{ $variantesProducto->precio }}</td>
                                            <td class="text-center px-4 py-3">
                                                <form action="{{ route('variantes-productos.destroy', $variantesProducto->id_variantes) }}" method="POST" class="d-inline">
                                                    <div class="btn-group custom-btn-group">
                                                        <a class="btn btn-sm btn-success mx-1" href="{{ route('variantes-productos.show', $variantesProducto->id_variantes) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                        <a class="btn btn-sm btn-success mx-1" href="{{ route('variantes-productos.edit', $variantesProducto->id_variantes) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                        Showing {{ $variantesProductos->firstItem() }} to {{ $variantesProductos->lastItem() }} of {{ $variantesProductos->total() }} results
                    </div>
                    <div class="paginationLinks">
                        @if ($variantesProductos->onFirstPage())
                            <span class="paginationDisabled">« Previous</span>
                        @else
                            <a href="{{ $variantesProductos->previousPageUrl() }}" class="paginationLink">« Previous</a>
                        @endif

                        @foreach ($variantesProductos->getUrlRange(1, $variantesProductos->lastPage()) as $page => $url)
                            @if ($page == $variantesProductos->currentPage())
                                <span class="pagination-active">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="paginationLink">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if ($variantesProductos->hasMorePages())
                            <a href="{{ $variantesProductos->nextPageUrl() }}" class="paginationLink">Next »</a>
                        @else
                            <span class="paginationDisabled">Next »</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection