@extends('layouts.app')

@section('template_title')
    Permisos
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Permisos') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('permisos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        <th>No</th>
                                        
									<th >Idpermiso</th>
									<th >Nombrepermiso</th>
									<th >Categoriaproductos</th>
									<th >Productos</th>
									<th >Tallas</th>
									<th >Variantesproducto</th>
									<th >Empleados</th>
									<th >Permisos</th>
									<th >Registroventas</th>
									<th >Ventas</th>
									<th >Compras</th>
									<th >Pedidos</th>
									<th >Gastosoperativos</th>
									<th >Inventario</th>
									<th >Clientes</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permisos as $permiso)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
										<td >{{ $permiso->idPermiso }}</td>
										<td >{{ $permiso->nombrePermiso }}</td>
										<td >{{ $permiso->categoriaProductos }}</td>
										<td >{{ $permiso->productos }}</td>
										<td >{{ $permiso->tallas }}</td>
										<td >{{ $permiso->variantesProducto }}</td>
										<td >{{ $permiso->empleados }}</td>
										<td >{{ $permiso->permisos }}</td>
										<td >{{ $permiso->registroVentas }}</td>
										<td >{{ $permiso->ventas }}</td>
										<td >{{ $permiso->compras }}</td>
										<td >{{ $permiso->pedidos }}</td>
										<td >{{ $permiso->gastosOperativos }}</td>
										<td >{{ $permiso->inventario }}</td>
										<td >{{ $permiso->clientes }}</td>

                                            <td>
                                                <form action="{{ route('permisos.destroy', $permiso->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('permisos.show', $permiso->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('permisos.edit', $permiso->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $permisos->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
