@extends('panel.panel')

@section('template_title')
    {{ __('Update') }} Talla
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('/css/categorias/crearCategoria.css') }}">
@endpush

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">
                <div class="card card-default custom-card">
                    <div class="card-header custom-card-header">
                        <span class="card-title">{{ __('Update') }} Talla</span>
                    </div>
                    <div class="card-body bg-white custom-card-body">
                        <form method="POST" action="{{ route('tallas.update', $talla->idTalla) }}" role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf
                            @include('talla.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection