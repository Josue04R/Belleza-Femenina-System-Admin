@extends('panel.panel')

@section('template_title')
    Productos
@endsection

@push('styles')
<link rel="stylesheet" href="{{ url('/css/categorias/index.css') }}">
<link rel="stylesheet" href="{{ url('/css/tablas/tablas.css') }}">
@endpush

@section('content')
    <div class="container-fluid py-4 px-5">
        <div class="row mx-1">
            <div class="col-12 px-2">
                <div class="card shadow-sm border-0 custom-card mb-4">
                    <div class="card-header custom-card-header py-3 px-4">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('Productos') }}
                            </span>
                             <div class="float-right">
                                <a href="{{ route('productos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        <th class="text-center px-4">Id Producto</th>
                                        <th class="text-center px-4">Nombre P</th>
                                        <th class="text-center px-4">Marca P</th>
                                        <th class="text-center px-4">Nombre Categoria</th>
                                        <th class="text-center px-4">Material</th>
                                        <th class="text-center px-4">Descripcion</th>
                                        <th class="text-center px-4">Precio</th>
                                        <th class="text-center px-4">Imagen</th>
                                        <th class="text-center px-4">Estado</th>
                                        <th class="text-center px-4">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productos as $producto)
                                        <tr class="custom-table-row">
                                            <td class="text-center px-4 py-3">{{ $producto->id_producto }}</td>
                                            <td class="text-center px-4 py-3">{{ $producto->nombre_p }}</td>
                                            <td class="text-center px-4 py-3">{{ $producto->marca_p }}</td>
                                            <td class="text-center px-4 py-3">{{ $producto->categoria->categoria ?? 'N/A' }}</td>
                                            <td class="text-center px-4 py-3">{{ $producto->material }}</td>
                                            <td class="text-center px-4 py-3">{{ $producto->descripcion }}</td>
                                            <td class="text-center px-4 py-3">{{ $producto->precio }}</td>
                                            <td class="text-center px-4 py-3">{{ $producto->imagen }}</td>
                                            <td class="text-center px-4 py-3">{{ $producto->estado }}</td>
                                            <td class="text-center px-4 py-3">
                                                <form action="{{ route('productos.destroy', $producto->id_producto) }}" method="POST" class="d-inline">
                                                    <div class="btn-group custom-btn-group">
                                                        <a class="btn btn-sm btn-success mx-1" href="{{ route('productos.show', $producto->id_producto) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                        <a class="btn btn-sm btn-success mx-1" href="{{ route('productos.edit', $producto->id_producto) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                <div class="custom-pagination py-3">
                    {!! $productos->withQueryString()->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection