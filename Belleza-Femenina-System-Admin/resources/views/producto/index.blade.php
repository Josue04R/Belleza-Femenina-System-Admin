@extends('panel.panel')

@section('template_title')
    Productos
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Productos') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('productos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
									<th >Id Producto</th>
									<th >Nombre P</th>
									<th >Marca P</th>
									<th >Nombre Categoria</th>
									<th >Material</th>
									<th >Descripcion</th>
									<th >Precio</th>
									<th >Imagen</th>
									<th >Estado</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productos as $producto)
                                        <tr>
                                           
                                            
										<td >{{ $producto->id_producto }}</td>
										<td >{{ $producto->nombre_p }}</td>
										<td >{{ $producto->marca_p }}</td>
										<td >{{ $producto->categoria->categoria ?? 'N/A' }}</td>
										<td >{{ $producto->material }}</td>
										<td >{{ $producto->descripcion }}</td>
										<td >{{ $producto->precio }}</td>
										<td >{{ $producto->imagen }}</td>
										<td >{{ $producto->estado }}</td>

                                            <td>
                                                <form action="{{ route('productos.destroy', $producto->id_producto) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('productos.show', $producto->id_producto) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('productos.edit', $producto->id_producto) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $productos->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
