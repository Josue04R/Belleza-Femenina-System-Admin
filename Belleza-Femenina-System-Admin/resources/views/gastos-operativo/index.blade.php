@extends('panel.panel')

@section('template_title')
    Gastos Operativos
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Gastos Operativos') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('gastos-operativos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
									<th >Fecha</th>
									<th >Categoria</th>
									<th >Descripcion</th>
									<th >Monto</th>
									<th >Metodo Pago</th>
									<th >Idempleado</th>
									<th >Observaciones</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($gastosOperativos as $gastosOperativo)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
										<td >{{ $gastosOperativo->fecha }}</td>
										<td >{{ $gastosOperativo->categoria }}</td>
										<td >{{ $gastosOperativo->descripcion }}</td>
										<td >{{ $gastosOperativo->monto }}</td>
										<td >{{ $gastosOperativo->metodo_pago }}</td>
										<td >{{ $gastosOperativo->idEmpleado }}</td>
										<td >{{ $gastosOperativo->observaciones }}</td>

                                            <td>
                                                <form action="{{ route('gastos-operativos.destroy', $gastosOperativo->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('gastos-operativos.show', $gastosOperativo->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('gastos-operativos.edit', $gastosOperativo->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $gastosOperativos->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
