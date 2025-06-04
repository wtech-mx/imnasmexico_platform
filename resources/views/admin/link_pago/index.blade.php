@extends('layouts.app_admin')

@section('template_title')
    Link Pago
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">

                {{-- — Header: “Regresar”, “Crear” (abre modal) — --}}
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <a class="btn" id="regresar_btn" style="background: {{ $configuracion->color_boton_close }}; color: #fff">
                            <i class="fas fa-arrow-left"></i> Regresar
                        </a>

                        <h3 class="mb-0">Link Pago</h3>

                        <button
                            type="button"
                            class="btn btn-sm btn-success"
                            id="btn-abrir-crear"
                            style="background: {{ $configuracion->color_boton_add }}; color: #fff">
                            <i class="fa fa-fw fa-plus"></i> Crear
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table
                            class="table table-striped table-hover table-bordered align-middle text-center"
                            id="datatable-search">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Cliente</th>
                                    <th>Título</th>
                                    <th>Descripción</th>
                                    <th>Estatus</th>
                                    <th>Monto</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($linkPagos as $item)
                                    <tr data-id="{{ $item->id }}">
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->cliente }}</td>
                                        <td>{{ $item->titulo }}</td>
                                        <td>{{ $item->descripcion }}</td>
                                        <td>{{ $item->estatus }}</td>
                                        <td>${{ number_format($item->monto, 2) }}</td>
                                        <td>
                                            <button
                                                class="btn btn-sm btn-primary btn-editar"
                                                data-id="{{ $item->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button
                                                class="btn btn-sm btn-danger btn-eliminar"
                                                data-id="{{ $item->id }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@include('admin.link_pago.modal')
@endsection

@section('datatable')
<script>
    $(document).ready(function () {
        // 1) Inicializamos Simple-DataTables
        const dataTable = new simpleDatatables.DataTable("#datatable-search", {
            deferRender: true,
            paging: true,
            pageLength: 10
        });

        // 2) Referencias al modal y formulario
        const modalLinkPago = new bootstrap.Modal(document.getElementById('modalLinkPago'));
        const $form          = $('#formLinkPago');
        const $formLabel     = $('#modalLinkPagoLabel');
        const $formMethod    = $('#formMethod');
        const $inputId       = $('#linkPago_id');
        const $inputCliente  = $('#cliente');
        const $inputTitulo   = $('#titulo');
        const $inputDesc     = $('#descripcion');
        const $selectEstatus = $('#estatus');
        const $inputMonto    = $('#monto');
        const $btnGuardar    = $('#btnGuardar');
        const $formErrors    = $('#formErrors');
        const $tbody         = $('#datatable-search tbody');

        /**
         *  Limpia el formulario y errores
         */
        function limpiarFormulario() {
            $formErrors.addClass('d-none').empty();
            $inputId.val('');
            $inputCliente.val('');
            $inputTitulo.val('');
            $inputDesc.val('');
            $selectEstatus.val('');
            $inputMonto.val('');
            $formMethod.val('POST');
            $btnGuardar.text('Guardar');
        }

        /**
         *  Genera el HTML de una fila <tr> dado un objeto linkPago
         */
        function construirFila(linkPago) {
            return `
            <tr data-id="${linkPago.id}">
                <td>${linkPago.id}</td>
                <td>${linkPago.cliente}</td>
                <td>${linkPago.titulo}</td>
                <td>${linkPago.descripcion || ''}</td>
                <td>${linkPago.estatus}</td>
                <td>$${parseFloat(linkPago.monto).toFixed(2)}</td>
                <td>
                    <button class="btn btn-sm btn-primary btn-editar" data-id="${linkPago.id}">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn btn-sm btn-danger btn-eliminar" data-id="${linkPago.id}">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
            </tr>`;
        }

        /**
         *  Muestra errores de validación (Laravel) dentro del modal
         */
        function mostrarErrores(errors) {
            $formErrors.removeClass('d-none').empty();
            $.each(errors, function (campo, mensajes) {
                mensajes.forEach(msg => {
                    $formErrors.append(`<p>${msg}</p>`);
                });
            });
        }

        // —————— BOTÓN “Crear” — abrir modal en blanco ——————
        $('#btn-abrir-crear').on('click', function (e) {
            e.preventDefault();
            limpiarFormulario();
            $formLabel.text('Crear Link de Pago');
            $formMethod.val('POST');
            modalLinkPago.show();
        });

        // —————— BOTONES “Editar” (delegación de eventos) ——————
        $tbody.on('click', '.btn-editar', function () {
            const id = $(this).data('id');
            limpiarFormulario();

            $.ajax({
                url: `{{ url('admin/link/pagos/mercado') }}/${id}/edit`,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    if (data.success) {
                        const lp = data.linkPago;
                        $formLabel.text('Editar Link de Pago');
                        $formMethod.val('PUT');
                        $inputId.val(lp.id);
                        $inputCliente.val(lp.cliente);
                        $inputTitulo.val(lp.titulo);
                        $inputDesc.val(lp.descripcion);
                        $selectEstatus.val(lp.estatus);
                        $inputMonto.val(lp.monto);
                        modalLinkPago.show();
                    } else {
                        alert('Registro no encontrado.');
                    }
                },
                error: function () {
                    alert('Error al obtener datos.');
                }
            });
        });

        // —————— BOTONES “Eliminar” (delegación de eventos) ——————
        $tbody.on('click', '.btn-eliminar', function () {
            const id = $(this).data('id');
            if (!confirm('¿Seguro que deseas eliminar este registro?')) {
                return;
            }
            $.ajax({
                url: `{{ url('admin/link/pagos/mercado') }}/${id}`,
                type: 'DELETE',
                data: { _token: '{{ csrf_token() }}' },
                dataType: 'json',
                success: function (data) {
                    if (data.success) {
                        // 1) Eliminar la fila del DOM
                        $tbody.find(`tr[data-id="${id}"]`).remove();
                        // 2) Volver a refrescar Simple-DataTables
                        dataTable.refresh();
                        alert(data.message);
                        location.reload();
                    } else {
                        alert(data.message || 'Error al eliminar.');
                    }
                },
                error: function () {
                    alert('Error al eliminar.');
                }
            });
        });

        // —————— ENVÍO DE FORMULARIO (store o update) vía AJAX ——————
        $form.on('submit', function (e) {
            e.preventDefault();
            $formErrors.addClass('d-none').empty();

            const idRegistro = $inputId.val();
            let url   = '{{ route("link_pago.store") }}';
            let type  = 'POST';

            if ($formMethod.val() === 'PUT') {
                url  = `{{ url('admin/link/pagos/mercado') }}/${idRegistro}`;
                type = 'PUT';
            }

            $.ajax({
                url: url,
                type: type,
                data: $form.serialize(),
                dataType: 'json',
                success: function (data) {
                    const lp = data.linkPago;

                    if (type === 'POST') {
                        // 1) Insertar nueva fila en DOM
                        $tbody.append(construirFila(lp));
                    } else {
                        // 1) Actualizar celdas de la fila existente
                        const $filaExistente = $tbody.find(`tr[data-id="${lp.id}"]`);
                        $filaExistente.html(`
                            <td>${lp.id}</td>
                            <td>${lp.cliente}</td>
                            <td>${lp.titulo}</td>
                            <td>${lp.descripcion || ''}</td>
                            <td>${lp.estatus}</td>
                            <td>$${parseFloat(lp.monto).toFixed(2)}</td>
                            <td>
                                <button class="btn btn-sm btn-primary btn-editar" data-id="${lp.id}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger btn-eliminar" data-id="${lp.id}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        `);
                    }

                    // 2) Volver a refrescar Simple-DataTables (relee el DOM)
                    dataTable.refresh();
                    modalLinkPago.hide();
                    alert(data.message);
                    location.reload();

                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        mostrarErrores(xhr.responseJSON.errors);
                    } else {
                        alert('Error inesperado.');
                    }
                }
            });
        });
    });
</script>
@endsection
