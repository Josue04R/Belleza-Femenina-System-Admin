@extends('panel.panel') 

@push('styles')
<link rel="stylesheet" href="{{ asset('/css/categorias/index.css') }}">
<link rel="stylesheet" href="{{ asset('/css/compras/compra.css') }}">
@endpush

@section('template_title')
    Registrar Compra
@endsection

@section('content')
    <div class="container-fluid py-3 px-4">
        <div class="row mx-0">
            <div class="col-12 px-0">
                <div class="card shadow-sm border-0 custom-card mb-3">
                    <div class="card-header custom-card-header py-2 px-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">
                                <i class="fas fa-key mr-2"></i> {{ __('Registro Compra') }}
                            </h6>
                        </div>
                    </div>

                    <div class="mt-2">
                        <form action="{{ route('compras.store') }}" method="POST" id="formCompra">
                            @csrf

                            <!-- Fecha -->
                            <div class="mb-3">
                                <label>Fecha</label>
                                <input type="date" name="fecha" class="form-control" value="{{ now()->toDateString() }}" readonly>
                            </div>

                            <!-- Producto / Variante / Cantidad / Subtotal -->
                            <div class="row mb-3">
                                <div class="col">
                                    <label>Producto</label>
                                    <select id="producto" class="form-control">
                                        <option value="">Seleccione</option>
                                        @foreach($productos as $producto)
                                            <option value="{{ $producto->idProducto }}"
                                                {{-- Nota: la propiedad del dataset debe llamarse "variantesproductos" --}}
                                                data-variantesproductos='@json($producto->variantesProductos)'>
                                                {{ $producto->nombreProducto }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col">
                                    <label>Variante</label>
                                    <select id="variante" class="form-control">
                                    </select>
                                </div>

                                <div class="col">
                                    <label>Cantidad</label>
                                    <input type="number" id="cantidad" class="form-control" min="1">
                                </div>

                                <div class="col">
                                    <label>Subtotal</label>
                                    <input type="number" id="subtotal" class="form-control" step="0.01" min="0">
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
                                <label>Total de la compra</label>
                                <input type="text" id="total" name="total" class="form-control" readonly value="0.00">
                            </div>

                            <input type="hidden" name="detalles" id="detallesInput">

                            <button type="submit" class="btn btn-success">Guardar Compra</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        let detalles = [];

        // Cargar variantes al cambiar producto
        document.getElementById('producto').addEventListener('change', function () {
            const varianteSelect = document.getElementById('variante');
            varianteSelect.innerHTML = '<option value="">Seleccione una variante</option>';

            // OJO: el nombre en dataset debe ser "variantesproductos"
            const raw = this.selectedOptions[0]?.dataset?.variantesproductos || '[]';
            let variantes = [];
            try { variantes = JSON.parse(raw); } catch (e) { variantes = []; }

            // Cada variante debe mostrar: Color + Talla; el value: id_variantes
            variantes.forEach(v => {
                const color = v.color ?? '';
                const tallaNombre = (v.talla && v.talla.talla) ? v.talla.talla : '';
                const texto = `Color: ${color} | Talla: ${tallaNombre}`;
                // v.id_variantes es la PK de variantes_productos según tu migración
                varianteSelect.innerHTML += `<option value="${v.idVariante}">${texto}</option>`;
            });
        });

        // Agregar fila a la tabla
        document.getElementById('agregar').addEventListener('click', function () {
            const productoSelect = document.getElementById('producto');
            const varianteSelect = document.getElementById('variante');
            const cantidad = parseInt(document.getElementById('cantidad').value);
            const subtotal = parseFloat(document.getElementById('subtotal').value);

            if (!productoSelect.value) {
                alert('Seleccione un producto.');
                return;
            }
            if (!varianteSelect.value) {
                alert('Seleccione una variante.');
                return;
            }
            if (isNaN(cantidad) || cantidad <= 0) {
                alert('Ingrese una cantidad válida.');
                return;
            }
            if (isNaN(subtotal) || subtotal < 0) {
                alert('Ingrese un subtotal válido.');
                return;
            }

            // Guardamos una "foto" de los textos mostrados al usuario
            const productoNombre = productoSelect.selectedOptions[0].text;
            const varianteNombre = varianteSelect.selectedOptions[0].text;

            detalles.push({
                idProducto: parseInt(productoSelect.value),
                idVarianteProducto: parseInt(varianteSelect.value),
                cantidad: cantidad,
                subtotal: subtotal,
                _productoNombre: productoNombre,
                _varianteNombre: varianteNombre
            });

            renderTabla();
            limpiarCamposLinea();
        });

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

        function eliminar(index) {
            detalles.splice(index, 1);
            renderTabla();
        }

        function limpiarCamposLinea() {
            document.getElementById('cantidad').value = '';
            document.getElementById('subtotal').value = '';
            // Mantengo selección de producto/variante por si agregas otra línea del mismo
        }
    </script>
@endsection
