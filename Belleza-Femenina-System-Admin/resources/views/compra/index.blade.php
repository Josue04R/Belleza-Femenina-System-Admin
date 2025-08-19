@extends('panel.panel') 

@push('styles')
<link rel="stylesheet" href="{{ url('/css/categorias/index.css') }}">
<link rel="stylesheet" href="{{ url('/css/compras/compra.css') }}">
@endpush

@section('template_title')
    Compras
@endsection
@section('content')
    <div class="container-fluid py-3 px-4">
        <div class="row mx-0">
            <div class="col-12 px-0">
                <div class="card shadow-sm border-0 custom-card mb-3">
                    <div class="card-header custom-card-header py-2 px-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">
                                <i class="fas fa-key mr-2"></i> {{ __('Compras') }}
                            </h6>
                            <a href="{{ route('compras.create') }}" class="btn btnNuevaCompra">
                                <i class="fas fa-plus mr-1"></i> {{ __('Nueva Compra') }}
                            </a>
                        </div>
                    </div>

                    <div class="tablaCompraContainer mt-3">
                        <table class="tablaCompraCompleta">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Registrado por</th>
                                    <th>Total</th>
                                    <th>Fecha</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach($compras as $compra)
                                        <tr>
                                            <td>{{$compra->idCompra}}</td>
                                            <td>{{$compra->empleado->nombre}}</td>
                                            <td>{{$compra->total}}</td>
                                            <td>{{$compra->fecha}}</td>
                                            <td class="columna-acciones-fija">
                                                <div class="btn-group btnGrupoCompacto">
                                                    <a href="{{url('/detalleCompra',$compra->idCompra)}}" class="btn btn-success btn-sm">
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
                    
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success mx-3 mt-2 mb-2 custom-alert">
                            <p class="mb-0">{{ $message }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection