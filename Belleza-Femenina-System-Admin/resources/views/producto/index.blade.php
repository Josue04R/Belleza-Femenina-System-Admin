@extends('panel.panel')

@section('template_title')
    Productos
@endsection

@push('styles')
<link rel="stylesheet" href="{{ url('/css/categorias/index.css') }}">
<link rel="stylesheet" href="{{ url('/css/tablas/tablas.css') }}">
<link rel="stylesheet" href="{{ url('/css/pagination/pagination.css') }}">
@endpush

@section('content')
    <div class="container-fluid py-4 px-5">
        <div class="row mx-1">
            <div class="col-12 px-2">
                <div class="card shadow-sm border-0 custom-card mb-4">
                    <div class="card-header custom-card-header py-3 px-4">
                        <form action="{{ route('productos.index') }}" method="GET" class="d-flex">
                            <input type="text" id="search" class="form-control mb-3" placeholder="Buscar productos...">
                        </form>

                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('Productos') }}
                            </span>
                            <div class="float-right">
                                <a href="{{ route('productos.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                                    {{ __('Create New') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success mx-4 mt-3 mb-3 custom-alert">
                            <p class="mb-0">{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body bg-white px-4 py-3">
                        <div class="table-responsive" id="productos-table">
                            @include('producto._tabla', ['productos' => $productos])
                        </div>
                    </div>
                </div>
                
                <div class="cusmtonPagination py-3">
                    <div class="paginationInfo">
                        Showing {{ $productos->firstItem() }} to {{ $productos->lastItem() }} of {{ $productos->total() }} results
                    </div>
                    <div class="paginationLinks">
                        @if ($productos->onFirstPage())
                            <span class="paginationDisabled">« Previous</span>
                        @else
                            <a href="{{ $productos->previousPageUrl() }}" class="paginationLink">« Previous</a>
                        @endif

                        @foreach ($productos->getUrlRange(1, $productos->lastPage()) as $page => $url)
                            @if ($page == $productos->currentPage())
                                <span class="pagination-active">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="paginationLink">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if ($productos->hasMorePages())
                            <a href="{{ $productos->nextPageUrl() }}" class="paginationLink">Next »</a>
                        @else
                            <span class="paginationDisabled">Next »</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('search').addEventListener('keyup', function() {
            let query = this.value;
            clearTimeout(this.timer);
            
            this.timer = setTimeout(() => {
                fetch("{{ route('productos.index') }}?search=" + query, {
                    headers: { 
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'text/html'
                    }
                })
                .then(response => response.text())
                .then(html => {
                    document.getElementById('productos-table').innerHTML = html;
                });
            }, 300);
        });
    </script>
@endsection