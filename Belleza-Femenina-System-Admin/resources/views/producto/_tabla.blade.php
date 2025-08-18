@if ($productos->count() > 0)
    <table class="table table-hover custom-table mb-0">
        <thead class="thead">
            <tr>
                <th class="text-center px-4">Id Producto</th>
                <th class="text-center px-4">Nombre P</th>
                <th class="text-center px-4">Marca P</th>
                <th class="text-center px-4">Nombre Categoria</th>
                <th class="text-center px-4">Material</th>
                <th class="text-center px-4">Descripcion</th>
                <th class="text-center px-4">Precio</th>
                <th class="text-center px-4">Imagen</th>
                <th class="text-center px-4">Estado</th>
                <th class="text-center px-4">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
                <tr class="custom-table-row">
                    <td class="text-center px-4 py-3">{{ $producto->id_producto }}</td>
                    <td class="text-center px-4 py-3">{{ $producto->nombre_p }}</td>
                    <td class="text-center px-4 py-3">{{ $producto->marca_p }}</td>
                    <td class="text-center px-4 py-3">{{ $producto->categoria->categoria ?? 'N/A' }}</td>
                    <td class="text-center px-4 py-3">{{ $producto->material }}</td>
                    <td class="text-center px-4 py-3">{{ $producto->descripcion }}</td>
                    <td class="text-center px-4 py-3">{{ $producto->precio }}</td>
                    <td class="text-center px-4 py-3">{{ $producto->imagen }}</td>
                    <td class="text-center px-4 py-3">{{ $producto->estado }}</td>
                    <td class="text-center px-4 py-3">
                        <form action="{{ route('productos.destroy', $producto->id_producto) }}" method="POST" class="d-inline">
                            <div class="btn-group custom-btn-group">
                                <a class="btn btn-sm btn-success mx-1" href="{{ route('productos.show', $producto->id_producto) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                <a class="btn btn-sm btn-success mx-1" href="{{ route('productos.edit', $producto->id_producto) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
