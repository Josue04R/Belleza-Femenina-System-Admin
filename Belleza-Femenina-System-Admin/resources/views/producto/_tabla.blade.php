@if ($productos->count() > 0)
    <table class="table table-hover custom-table mb-0">
        <thead class="thead">
            <tr>
                <th class="text-center px-4">Producto</th>
                <th class="text-center px-4">Nombre</th>
                <th class="text-center px-4">Marca</th>
                <th class="text-center px-4">Categoria</th>
                <th class="text-center px-4">Material</th>
                <th class="text-center px-4">Descripcion</th>
                <th class="text-center px-4">Precio</th>
                <th class="text-center px-4">Estado</th>
                <th class="text-center px-4">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
                <tr class="custom-table-row">
                    <td class="text-center px-4 py-3">{{ $producto->idProducto }}</td>
                    <td class="text-center px-4 py-3">{{ $producto->nombreProducto }}</td>
                    <td class="text-center px-4 py-3">{{ $producto->marcaProducto }}</td>
                    <td class="text-center px-4 py-3">{{ $producto->categoria->categoria ?? 'N/A' }}</td>
                    <td class="text-center px-4 py-3">{{ $producto->material }}</td>
                    <td class="text-center px-4 py-3">{{ $producto->descripcion }}</td>
                    <td class="text-center px-4 py-3">{{ $producto->precio }}</td>
                    <td class="text-center px-4 py-3">{{ $producto->estado }}</td>
                    <td class="text-center px-4 py-3">
                        <form action="{{ route('productos.destroy', $producto->idProducto) }}" method="POST" class="d-inline">
                            <div class="btn-group custom-btn-group">
                                <a class="btn btn-sm btn-success mx-1" href="{{ route('productos.show', $producto->idProducto) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                <a class="btn btn-sm btn-success mx-1" href="{{ route('productos.edit', $producto->idProducto) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger mx-1" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
@else
    <div class="alert alert-warning text-center mt-3">
        No existe el producto.
    </div>
@endif
