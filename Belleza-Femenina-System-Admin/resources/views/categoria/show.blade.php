@extends('panel.panel')

@section('template_title')
    {{ $categoria->name ?? __('Show') . " " . __('Categoria') }}
@endsection

@push('styles')
<link rel="stylesheet" href="{{ url('/css/categorias/crearCategoria.css') }}">
@endpush

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Categoria</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-submit btn-sm" href="{{ route('categorias.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Id Cate:</strong>
                                    {{ $categoria->idCategoria }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Categoria:</strong>
                                    {{ $categoria->categoria }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Descripcion:</strong>
                                    {{ $categoria->descripcion }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
