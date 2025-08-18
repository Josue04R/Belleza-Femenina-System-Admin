@extends('panel.panel')

@section('template_title')
    {{ __('Update') }} Gastos Operativo
@endsection

@push('styles')
<link rel="stylesheet" href="{{ url('/css/categorias/crearCategoria.css') }}">
<link rel="stylesheet" href="{{ url('/css/tablas/tablas.css') }}">
@endpush

@section('content')
    <br>
    <br>
    <section class="content container-fluid">
        <div class="row mx-1">
            <div class="col-12 px-2">
                <div class="card shadow-sm border-0 custom-card mb-4">
                    <div class="card-header custom-card-header py-3 px-4">
                        <span class="card-title">{{ __('Update') }} Gastos Operativo</span>
                    </div>
                    <div class="card-body bg-white px-4 py-3">
                        <form method="POST" action="{{ route('gastos-operativos.update', $gastosOperativo->id) }}" class="form-edit" role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('gastos-operativo.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection