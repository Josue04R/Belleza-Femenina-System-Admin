@extends('panel.panel')
@section('template_title')
    {{ __('Create') }} Gastos Operativo
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Gastos Operativo</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('gastos-operativos.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('gastos-operativo.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
