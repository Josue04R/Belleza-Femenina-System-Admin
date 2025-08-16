@extends('panel.panel')

@section('template_title')
    {{ __('Update') }} Gastos Operativo
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Gastos Operativo</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('gastos-operativos.update', $gastosOperativo->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('gastos-operativo.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
