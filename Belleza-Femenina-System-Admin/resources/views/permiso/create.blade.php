@extends('panel.panel')

@section('template_title')
    {{ __('Create') }} Permiso
@endsection

@push('styles')
<link rel="stylesheet" href="{{ url('/css/categorias/crearCategoria.css') }}">
@endpush

@section('content')
    <br>
    <br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Permiso</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('permisos.store') }}" role="form" enctype="multipart/form-data">
                            @csrf

                            @include('permiso.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
