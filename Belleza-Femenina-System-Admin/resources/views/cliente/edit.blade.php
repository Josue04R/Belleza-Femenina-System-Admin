@extends('panel.panel')

@section('template_title')
    {{ __('Update') }} Cliente
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
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span class="card-title">{{ __('Update') }} Cliente</span>
                        <a class="btn btn-submit btn-sm" href="{{ route('clientes.index') }}"> {{ __('Back') }}</a>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('clientes.update', $cliente->idCliente) }}" role="form" enctype="multipart/form-data">
                            @method('PATCH')
                            @csrf

                            @include('cliente.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
