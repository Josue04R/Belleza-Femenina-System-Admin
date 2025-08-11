@extends('layouts.app')

@section('template_title')
    {{ $log->name ?? __('Show') . " " . __('Log') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Log</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('logs.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Idlog:</strong>
                                    {{ $log->idLog }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Idempleado:</strong>
                                    {{ $log->idEmpleado }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Accion:</strong>
                                    {{ $log->accion }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Descripcion:</strong>
                                    {{ $log->descripcion }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
