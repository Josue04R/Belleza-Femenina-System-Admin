@extends('panel.panel')

@section('template_title')
    {{ __('Create') }} Producto
@endsection

@push('styles')
<link rel="stylesheet" href="{{ url('/css/categorias/crearCategoria.css') }}">
<link rel="stylesheet" href="{{ url('/css/producto/crear.css') }}">
@endpush

@section('content')
<section class="content container-fluid">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header">
                <span class="card-title">{{ __('Create') }} Producto</span>
            </div>
            <div class="card-body bg-white">
                <form method="POST" action="{{ route('productos.store') }}" role="form" enctype="multipart/form-data">
                    @csrf
                    @include('producto.form')
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
