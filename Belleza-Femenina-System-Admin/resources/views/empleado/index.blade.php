@extends('panel.panel')

@section('template_title')
    Empleados
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
                                {{ __('Empleados') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('empleados.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nuevo') }}
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
                                        <th class="text-center px-4">Nombre</th>
                                        <th class="text-center px-4">Apellido</th>
                                        <th class="text-center px-4">Telefono</th>
                                        <th class="text-center px-4">Usuario</th>
                                        <th class="text-center px-4">Nivel Acceso</th>
                                        <th class="text-center px-4">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($empleados as $empleado)
                                        <tr class="custom-table-row">
                                            <td class="text-center px-4 py-3">{{ $empleado->nombre }}</td>
                                            <td class="text-center px-4 py-3">{{ $empleado->apellido }}</td>
                                            <td class="text-center px-4 py-3">{{ $empleado->telefono }}</td>
                                            <td class="text-center px-4 py-3">{{ $empleado->usuario }}</td>
                                            <td class="text-center px-4 py-3">{{ $empleado->permiso->nombrePermiso }}</td>

                                            <td class="text-center px-4 py-3">
                                                <form action="{{ route('empleados.destroy', $empleado->idEmpleado) }}" method="POST" class="d-inline">
                                                    <div class="btn-group custom-btn-group">
                                                        <a class="btn btn-sm btn-success mx-1" href="{{ route('empleados.show', $empleado->idEmpleado) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                        <a class="btn btn-sm btn-success mx-1" href="{{ route('empleados.edit', $empleado->idEmpleado) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                        Showing {{ $empleados->firstItem() }} to {{ $empleados->lastItem() }} of {{ $empleados->total() }} results
                    </div>
                    <div class="paginationLinks">
                        @if ($empleados->onFirstPage())
                            <span class="paginationDisabled">« Previous</span>
                        @else
                            <a href="{{ $empleados->previousPageUrl() }}" class="paginationLink">« Previous</a>
                        @endif

                        @foreach ($empleados->getUrlRange(1, $empleados->lastPage()) as $page => $url)
                            @if ($page == $empleados->currentPage())
                                <span class="pagination-active">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="paginationLink">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if ($empleados->hasMorePages())
                            <a href="{{ $empleados->nextPageUrl() }}" class="paginationLink">Next »</a>
                        @else
                            <span class="paginationDisabled">Next »</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection