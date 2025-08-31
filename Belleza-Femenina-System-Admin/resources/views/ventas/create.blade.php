@extends('panel.panel')

@push('styles')
<link rel="stylesheet" href="{{ url('/css/categorias/index.css') }}">
<link rel="stylesheet" href="{{ url('/css/ventas/venta.css') }}">
@endpush

@section('template_title')
    Registrar Venta
@endsection

@section('content')
<div class="container-fluid py-3 px-4">
    <div class="row mx-0">
        <div class="col-12 px-0">
            <div class="card shadow-sm border-0 custom-card mb-3">
                <div class="card-header custom-card-header py-2 px-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">
                            <i class="fas fa-shopping-cart mr-2"></i> {{ __('Registro Venta') }}
                        </h6>
                    </div>
                </div>

                <div class="mt-2">
                    <form action="{{ route('ventas.store') }}" method="POST" id="formVenta">
                        @csrf

                        <!-- Fecha -->
                        <div class="mb-3">
                            <label>Fecha</label>
                            <input type="date" name="fecha" class="form-control" value="{{ now()->toDateString() }}" readonly>
                        </div>

                        <!-- Cliente -->
                        <div class="mb-3 position-relative">
                            <label>Cliente</label>
                            <input type="text" id="clienteInput" class="form-control" placeholder="Escriba el nombre del cliente" autocomplete="off" required>
                            <input type="hidden" name="idCliente" id="idCliente">
                            <div id="clientesList" class="list-group position-absolute w-100" style="z-index: 1000;"></div>
                        </div>

                        <!-- Producto / Variante / Cantidad -->
                        <div class="row mb-3">
                            <div class="col">
                                <label>Producto</label>
                                <select id="producto" class="form-control">
                                    <option value="">Seleccione</option>
                                    @foreach($productos as $producto)
                                        <option value="{{ $producto->idProducto }}"
                                            data-variantesproductos='@json($producto->variantesProductos)'
                                            data-precio="{{ $producto->precio }}">
                                            {{ $producto->nombreProducto }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col">
                                <label>Variante</label>
                                <select id="variante" class="form-control"></select>
                            </div>

                            <div class="col">
                                <label>Cantidad</label>
                                <input type="number" id="cantidad" class="form-control" min="1">
                            </div>

                            <div class="col d-flex align-items-end">
                                <button type="button" id="agregar" class="btn btn-primary w-100">Agregar</button>
                            </div>
                        </div>

                        <!-- Tabla -->
                        <table class="table" id="tablaDetalles">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Variante</th>
                                    <th>Cantidad</th>
                                    <th>Subtotal</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>

                        <!-- Total -->
                        <div class="mb-3">
                            <label>Total de la venta</label>
                            <input type="text" id="total" name="total" class="form-control" readonly value="0.00">
                        </div>

                        <input type="hidden" name="detalles" id="detallesInput">

                        <button type="submit" class="btn btn-success">Guardar Venta</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    let detalles = [];

    // Autocompletado de clientes
    const clientes = @json($clientes);
    const clienteInput = document.getElementById('clienteInput');
    const idClienteInput = document.getElementById('idCliente');
    const clientesList = document.getElementById('clientesList');

    clienteInput.addEventListener('input', function () {
        const query = this.value.toLowerCase();
        clientesList.innerHTML = '';

        if (!query) return;

        const filtered = clientes.filter(c => (c.nombre + ' ' + c.apellido).toLowerCase().includes(query));

        filtered.forEach(c => {
            const item = document.createElement('a');
            item.classList.add('list-group-item', 'list-group-item-action');
            item.textContent = `${c.nombre} ${c.apellido}`;
            item.href = "#";
            item.addEventListener('click', function (e) {
                e.preventDefault();
                clienteInput.value = `${c.nombre} ${c.apellido}`;
                idClienteInput.value = c.idCliente;
                clientesList.innerHTML = '';
            });
            clientesList.appendChild(item);
        });
    });

    // Cargar variantes al cambiar producto
    document.getElementById('producto').addEventListener('change', function () {
        const varianteSelect = document.getElementById('variante');
        varianteSelect.innerHTML = '<option value="">Seleccione una variante</option>';

        const raw = this.selectedOptions[0]?.dataset?.variantesproductos || '[]';
        let variantes = [];
        try { variantes = JSON.parse(raw); } catch (e) { variantes = []; }

        variantes.forEach(v => {
            const color = v.color ?? '';
            const tallaNombre = (v.talla && v.talla.talla) ? v.talla.talla : '';
            const texto = `Color: ${color} | Talla: ${tallaNombre}`;
            const precio = parseFloat(this.selectedOptions[0]?.dataset?.precio || 0);
            varianteSelect.innerHTML += `<option value="${v.idVariante}" data-stock="${v.stock}" data-precio="${precio}">${texto}</option>`;
        });
    });

    // Agregar detalle
    document.getElementById('agregar').addEventListener('click', function () {
        const productoSelect = document.getElementById('producto');
        const varianteSelect = document.getElementById('variante');
        const cantidad = parseInt(document.getElementById('cantidad').value);
        const stock = parseInt(varianteSelect.selectedOptions[0]?.dataset?.stock || 0);
        const precio = parseFloat(varianteSelect.selectedOptions[0]?.dataset?.precio || 0);

        if (!productoSelect.value) return alert('Seleccione un producto.');
        if (!varianteSelect.value) return alert('Seleccione una variante.');
        if (isNaN(cantidad) || cantidad <= 0) return alert('Ingrese una cantidad válida.');
        if (cantidad > stock) return alert(`No hay suficiente stock. Disponible: ${stock}`);

        const subtotal = cantidad * precio;
        const productoNombre = productoSelect.selectedOptions[0].text;
        const varianteNombre = varianteSelect.selectedOptions[0].text;

        detalles.push({
            idProducto: parseInt(productoSelect.value),
            idVarianteProducto: parseInt(varianteSelect.value),
            cantidad: cantidad,
            precioUnitario: precio, 
            subtotal: subtotal,
            _productoNombre: productoNombre,
            _varianteNombre: varianteNombre
        });

        renderTabla();
        limpiarCamposLinea();
    });

    // Renderizar tabla
    function renderTabla() {
        const tbody = document.querySelector('#tablaDetalles tbody');
        tbody.innerHTML = '';
        let total = 0;

        detalles.forEach((d, i) => {
            total += d.subtotal;
            tbody.innerHTML += `
                <tr>
                    <td>${d._productoNombre}</td>
                    <td>${d._varianteNombre}</td>
                    <td>${d.cantidad}</td>
                    <td>$${Number(d.subtotal).toFixed(2)}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm" onclick="eliminar(${i})">X</button>
                    </td>
                </tr>
            `;
        });

        document.getElementById('total').value = Number(total).toFixed(2);
        document.getElementById('detallesInput').value = JSON.stringify(detalles);
    }

    // Eliminar detalle
    function eliminar(index) {
        detalles.splice(index, 1);
        renderTabla();
    }

    // Limpiar campos
    function limpiarCamposLinea() {
        document.getElementById('cantidad').value = '';
        document.getElementById('variante').selectedIndex = 0;
    }
</script>
@endsection
