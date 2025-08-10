@extends('panel.panel')

@section('template_title')
    {{ $producto->name ?? __('Show') . " " . __('Producto') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Producto</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('productos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Id Producto:</strong>
                                    {{ $producto->id_producto }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Nombre P:</strong>
                                    {{ $producto->nombre_p }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Marca P:</strong>
                                    {{ $producto->marca_p }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Id Cate:</strong>
                                    {{ $producto->id_cate }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Material:</strong>
                                    {{ $producto->material }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Descripcion:</strong>
                                    {{ $producto->descripcion }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Precio:</strong>
                                    {{ $producto->precio }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Imagen:</strong>
                                    {{ $producto->imagen }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Estado:</strong>
                                    {{ $producto->estado }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
