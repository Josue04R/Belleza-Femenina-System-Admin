@extends('panel.panel')

@section('content')
<div class="container mt-4">
    <h2>Nueva Venta</h2>

    <form action="{{ route('ventas.store') }}" method="POST" id="venta-form">
    @csrf
    <input type="hidden" name="user_id" value="1">
    <input type="hidden" name="empleado_id" value="1">
    <input type="hidden" name="productos" id="productos-json">

    <!-- Aquí tu selección de producto, color, talla, cantidad -->
    <div class="row mb-3">
        <div class="col-md-4">
            <label>Producto</label>
            <select id="producto-select" class="form-control">
                <option value="">-- Seleccione un producto --</option>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id_producto }}"
                        data-variantes='@json($producto->variantesProductos->load("talla"))'>
                        {{ $producto->nombre_p }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <label>Color</label>
            <select id="color-select" class="form-control" disabled></select>
        </div>
        <div class="col-md-2">
            <label>Talla</label>
            <select id="talla-select" class="form-control" disabled></select>
        </div>
        <div class="col-md-2">
            <label>Cantidad</label>
            <input type="number" id="cantidad-input" class="form-control" value="1" min="1" disabled>
        </div>
        <div class="col-md-2">
            <label>&nbsp;</label><br>
            <button type="button" id="agregar-btn" class="btn btn-success" disabled>Agregar</button>
        </div>
    </div>

    <table class="table table-bordered" id="tabla-detalles">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Color</th>
                <th>Talla</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <h4 class="text-end">Total: $<span id="total">0.00</span></h4>
    <button type="submit" class="btn btn-primary">Guardar Venta</button>
</form>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(function() {
    let totalVenta = 0;
    let stockRestante = {};
    let productos = [];

    function resetSelects() {
        $('#color-select').html('').prop('disabled', true);
        $('#talla-select').html('').prop('disabled', true);
        $('#cantidad-input').val(1).prop('disabled', true);
        $('#agregar-btn').prop('disabled', true);
    }

    $('#producto-select').on('change', function() {
        resetSelects();
        let productoId = $(this).val();
        let variantes = $(this).find(':selected').data('variantes') || [];

        if (!stockRestante[productoId]) {
            stockRestante[productoId] = {};
            variantes.forEach(v => { stockRestante[productoId][v.id_variantes] = v.stock; });
        }

        let colores = [...new Set(variantes.map(v => v.color))];
        let opcionesColor = '<option value="">--Seleccione--</option>';
        colores.forEach(c => opcionesColor += `<option value="${c}">${c}</option>`);
        $('#color-select').html(opcionesColor).prop('disabled', false);
    });

    $('#color-select').on('change', function() {
        let color = $(this).val();
        let productoSelect = $('#producto-select');
        let productoId = productoSelect.val();
        let variantes = productoSelect.find(':selected').data('variantes') || [];
        let opcionesTalla = '<option value="">--Seleccione--</option>';

        variantes.filter(v => v.color === color).forEach(v => {
            opcionesTalla += `<option value="${v.id_variantes}" data-precio="${v.precio}">${v.talla.talla}</option>`;
        });

        $('#talla-select').html(opcionesTalla).prop('disabled', false);
        $('#cantidad-input').prop('disabled', true);
        $('#agregar-btn').prop('disabled', true);
    });

    $('#talla-select').on('change', function() {
        let opcion = $(this).find(':selected');
        if (!opcion.val()) { resetSelects(); return; }
        let idVariante = opcion.val();
        let productoId = $('#producto-select').val();
        let stock = stockRestante[productoId][idVariante];
        let precio = parseFloat(opcion.data('precio'));
        $('#cantidad-input').attr('max', stock).val(1).prop('disabled', false);
        $('#agregar-btn').prop('disabled', false);
    });

    $('#agregar-btn').on('click', function() {
        let productoSelect = $('#producto-select');
        let productoText = productoSelect.find('option:selected').text();
        let productoId = productoSelect.val();
        let color = $('#color-select').val();
        let tallaOption = $('#talla-select option:selected');
        let idVariante = tallaOption.val();
        let talla = tallaOption.text();
        let cantidad = parseInt($('#cantidad-input').val());
        let precio = parseFloat(tallaOption.data('precio'));

        let stock = stockRestante[productoId][idVariante];
        if (cantidad > stock) { alert('Cantidad supera stock'); return; }
        stockRestante[productoId][idVariante] -= cantidad;

        let subtotal = cantidad * precio;
        totalVenta += subtotal;

        // Guardar producto en array
        let producto = {
            producto_id: productoId,
            id_variante: idVariante,
            nombre: productoText,
            color: color,
            talla: talla,
            precio: precio,
            cantidad: cantidad,
            subtotal: subtotal
        };
        productos.push(producto);

        // Actualizar tabla
        let row = `<tr data-id-variante="${idVariante}" data-producto="${productoId}">
            <td>${productoText}</td>
            <td>${color}</td>
            <td>${talla}</td>
            <td>${precio}</td>
            <td>${cantidad}</td>
            <td>${subtotal.toFixed(2)}</td>
            <td><button type="button" class="btn btn-danger btn-sm eliminar-btn">Eliminar</button></td>
        </tr>`;
        $('#tabla-detalles tbody').append(row);
        $('#total').text(totalVenta.toFixed(2));

        // Actualizar input hidden con JSON
        $('#productos-json').val(JSON.stringify(productos));

        productoSelect.val('');
        resetSelects();
    });

    $('#tabla-detalles').on('click', '.eliminar-btn', function() {
        let row = $(this).closest('tr');
        let productoId = row.data('producto');
        let idVariante = row.data('id-variante');

        // Encontrar el producto en el array y eliminarlo
        productos = productos.filter(p => !(p.producto_id == productoId && p.id_variante == idVariante));

        // Actualizar total
        let subtotal = parseFloat(row.find('td').eq(5).text());
        totalVenta -= subtotal;
        $('#total').text(totalVenta.toFixed(2));

        // Actualizar JSON
        $('#productos-json').val(JSON.stringify(productos));

        // Restaurar stock
        let cantidad = parseInt(row.find('td').eq(4).text());
        stockRestante[productoId][idVariante] += cantidad;

        row.remove();
    });
});
</script>

@endsection
