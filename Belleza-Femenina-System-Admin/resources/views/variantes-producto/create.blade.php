@extends('panel.panel')

@section('template_title')
    {{ __('Create') }} Variantes Producto
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
                <div class="card card-default custom-card">
                    <div class="card-header custom-card-header">
                        <span class="card-title">{{ __('Create') }} Variantes Producto</span>
                    </div>
                    <div class="card-body bg-white custom-card-body">
                        <form method="POST" action="{{ route('variantes-productos.store') }}" role="form" enctype="multipart/form-data">
                            @csrf
                            @include('variantes-producto.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection