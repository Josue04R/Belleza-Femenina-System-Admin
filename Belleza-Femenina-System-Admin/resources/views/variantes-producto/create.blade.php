@extends('panel.panel')

@section('template_title')
    {{ __('Create') }} Variantes Producto
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Variantes Producto</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('variantes-productos.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('variantes-producto.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
