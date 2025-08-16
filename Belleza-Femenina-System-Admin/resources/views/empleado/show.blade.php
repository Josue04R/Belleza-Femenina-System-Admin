@extends('panel.panel')

@section('template_title')
    {{ $empleado->name ?? __('Show') . " " . __('Empleado') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Empleado</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('empleados.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Idempleado:</strong>
                                    {{ $empleado->idEmpleado }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Nombre:</strong>
                                    {{ $empleado->nombre }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Apellido:</strong>
                                    {{ $empleado->apellido }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Telefono:</strong>
                                    {{ $empleado->telefono }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Usuario:</strong>
                                    {{ $empleado->usuario }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Contrasenia:</strong>
                                    {{ $empleado->contrasenia }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Idpermiso:</strong>
                                    {{ $empleado->idPermiso }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
