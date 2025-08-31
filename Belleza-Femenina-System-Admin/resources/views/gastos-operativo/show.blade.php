@extends('panel.panel')

@section('template_title')
    {{ $gastosOperativo->name ?? __('Show') . " " . __('Gastos Operativo') }}
@endsection

@push('styles')
<link rel="stylesheet" href="{{ url('/css/categorias/crearCategoria.css') }}">
@endpush

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card custom-card">
                    <div class="card-header custom-card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Gastos Operativo</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-submit btn-sm" href="{{ route('gastos-operativos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white custom-card-body">
                        <div class="form-group mb-2 mb20">
                            <strong>Idgasto:</strong>
                            {{ $gastosOperativo->idGasto }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Fecha:</strong>
                            {{ $gastosOperativo->fecha }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Categoria:</strong>
                            {{ $gastosOperativo->categoria }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Descripcion:</strong>
                            {{ $gastosOperativo->descripcion }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Monto:</strong>
                            {{ $gastosOperativo->monto }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Metodo Pago:</strong>
                            {{ $gastosOperativo->metodoPago }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Idempleado:</strong>
                            {{ $gastosOperativo->idEmpleado }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Observaciones:</strong>
                            {{ $gastosOperativo->observaciones }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection