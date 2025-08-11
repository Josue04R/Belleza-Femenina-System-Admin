@extends('panel.panel')

@section('template_title')
    Variantes Productos
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Variantes Productos') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('variantes-productos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                    
									<th >Nombre Producto</th>
									<th >Talla</th>
									<th >Color</th>
									<th >Stock</th>
									<th >Precio</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($variantesProductos as $variantesProducto)
                                        <tr>
                                           
										<td>{{ $variantesProducto->producto?->nombre_p }}</td>
                                        <td>{{ $variantesProducto->talla?->talla }}</td>
										<td >{{ $variantesProducto->color }}</td>
										<td >{{ $variantesProducto->stock }}</td>
										<td >{{ $variantesProducto->precio }}</td>

                                            <td>
                                                <form action="{{ route('variantes-productos.destroy', $variantesProducto->id_variantes) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('variantes-productos.show', $variantesProducto->id_variantes) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('variantes-productos.edit', $variantesProducto->id_variantes) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $variantesProductos->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
