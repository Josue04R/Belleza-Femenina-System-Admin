@extends('panel.panel')

@section('template_title')
    {{ __('Update') }} Talla
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Talla</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('tallas.update', $talla->id_talla) }}"  role="form" enctype="multipart/form-data">
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
