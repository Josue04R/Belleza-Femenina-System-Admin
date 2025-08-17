@extends('panel.panel')

@section('template_title')
    {{ __('Create') }} Producto
@endsection

@push('styles')
<link rel="stylesheet" href="{{ url('/css/categorias/crearCategoria.css') }}">
<link rel="stylesheet" href="{{ url('/css/producto/crear.css') }}">
@endpush

@section('content')
    <br>
    <br>
    <section class="content container-fluid product-form-container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <div class="card card-default product-form-card">
                    <div class="card-header product-form-header">
                        <span class="card-title product-form-title">{{ __('Create') }} Producto</span>
                    </div>
                    <div class="card-body bg-white product-form-body">
                        <form method="POST" action="{{ route('productos.store') }}" role="form" enctype="multipart/form-data" class="product-form">
                            @csrf
                            @include('producto.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection