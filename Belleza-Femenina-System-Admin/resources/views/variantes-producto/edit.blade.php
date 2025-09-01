@extends('panel.panel')

@section('template_title')
    {{ __('Update') }} Variantes Producto
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('/css/categorias/crearCategoria.css') }}">
@endpush

@section('content')
    <br>
    <br>
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Variantes Producto</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('variantes-productos.update', $variantesProducto->idVariante) }}" class="form-edit" role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('variantes-producto.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection