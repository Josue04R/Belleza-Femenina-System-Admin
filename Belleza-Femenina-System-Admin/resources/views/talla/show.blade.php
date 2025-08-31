@extends('panel.panel')

@section('template_title')
    {{ $talla->name ?? __('Show') . " " . __('Talla') }}
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
                            <span class="card-title">{{ __('Show') }} Talla</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-submit btn-sm" href="{{ route('tallas.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white custom-card-body">
                        <div class="form-group mb-2 mb20">
                            <strong>Id Talla:</strong>
                            {{ $talla->idTalla }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Talla:</strong>
                            {{ $talla->talla }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection