@extends('layouts.app_admin')

@section('template_title')
    Pagos por Fuera
@endsection
<style>
    .right-panel {
        position: fixed;
        top: 0;
        right: -900px; /* Oculto inicialmente */
        width: 600px;
        height: 100%;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        transition: right 0.3s ease;
        z-index: 999;
        overflow-y: auto;
    }

    .panel-content {
        padding: 20px;
        /* Estilos adicionales para el contenido del panel */
    }

    .close-btn {
        cursor: pointer;
        padding: 10px;
        background-color: #ddd;
        text-align: center;
        margin-top: 65px;
    }

    .selected-row {
    background-color: #f8d7da !important; /* Color rojo claro */
}


</style>
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header">

                        <div class="d-flex justify-content-between">

                            <a class="btn" id="regresar_btn" style="background: {{$configuracion->color_boton_close}}; color: #fff"><i class="fas fa-arrow-left"></i> Regresar </a>


                            <h3 class="mb-3">Pendientes de  Revision Pago</h3>

                            <a type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                                ¿Como funciona?
                            </a>

                            <a type="button" class="btn bg-gradient-primary" onclick="openRightPanel()" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                Crear
                            </a>
                        </div>

                        <div class="row">
                            <div class="col-6 mt-5">
                                <p>
                                    <strong>¿Necesitas checar una transferencia?</strong> <br>
                                    <a target="_blank" href="https://www.banxico.org.mx/cep/">Ingresa a la pag de banxico CEP </a> <br>
                                    <a target="_blank" href="https://www.banxico.org.mx/cep/">Click aqui </a>
                                </p>
                            </div>
                        </div>
                    </div>

                        <div class="card-body">
                            @include('admin.pagos_fuera.create')
                            <div class="table-responsive">
                                <table class="table table-flush" id="datatable-search">
                                    <thead class="thead">
                                        <tr>
                                            <th>#</th>
                                            <th><img src="{{ asset('assets/cam/medico.png') }}" alt="" width="30px">Datos de Cliente</th>
                                            <th><img src="{{ asset('assets/cam/acta.png') }}" alt="" width="30px">Curso</th>
                                            <th><img src="{{ asset('assets/cam/metodo-de-pago.png') }}" alt="" width="30px">Forma de pago</th>
                                            <th><img src="{{ asset('assets/cam/contrato.png') }}" alt="" width="30px">¿Verificado?</th>
                                            <th><img src="{{ asset('assets/cam/carta_res.png') }}" alt="" width="30px">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pagos_fuera as $pago_fuera)
                                        @include('admin.pagos_fuera.modal_ins')
                                            <tr>
                                                <td>{{ $pago_fuera->id }}</td>
                                                <td>
                                                    @php
                                                        $words = explode(' ', $pago_fuera->nombre);
                                                        $chunks = array_chunk($words, 3);
                                                        foreach ($chunks as $chunk) {
                                                            echo implode(' ', $chunk) . '<br>';
                                                        }
                                                    @endphp
                                                    <br>
                                                    {{ $pago_fuera->correo }}
                                                    <br>
                                                    {{ $pago_fuera->telefono }}
                                                </td>

                                                <td>
                                                    @php
                                                        $words = explode(' ', $pago_fuera->curso);
                                                        $chunks = array_chunk($words, 3);
                                                        foreach ($chunks as $chunk) {
                                                            echo implode(' ', $chunk) . '<br>';
                                                        }
                                                    @endphp
                                                </td>
                                                <td>{{ $pago_fuera->modalidad }}</td>
                                                <td>
                                                    <input data-id="{{ $pago_fuera->id }}" class="toggle-class" type="checkbox"
                                                    data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                    data-on="Active" data-off="InActive" {{ $pago_fuera->pendiente ? 'checked' : '' }}>
                                                </td>
                                                <td>
                                                    <a type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#showDataModal{{$pago_fuera->id}}" style="color: #ffff">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
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
@endsection

@section('datatable')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('assets/admin/vendor/select2/dist/js/select2.min.js')}}"></script>

  <script type="text/javascript">

    $(document).ready(function() {
        $('.curso').select2();
    });

    $(document).ready(function() {
        $('.curso2').select2();
    });

    $(document).ready(function() {
        $('.curso3').select2();
    });

    $(document).ready(function() {
        $('.curso4').select2();
    });


  </script>

<script>
        function openRightPanel() {
            document.getElementById("rightPanel").style.right = "0";
        }

        function closeRightPanel() {
            document.getElementById("rightPanel").style.right = "-600px";
        }

    $(document).ready(function() {
                // Esconde el contenedor del campo "Abono" inicialmente
                $('#abono-container').hide();

                // Escucha el evento 'change' del checkbox 'Deudor'
                $('#deudor').change(function() {
                    // Si el checkbox 'Deudor' está seleccionado, muestra el contenedor del campo "Abono"
                    if ($(this).is(':checked')) {
                    $('#abono-container').show();
                    } else {
                    // Si el checkbox 'Deudor' está deseleccionado, oculta el contenedor del campo "Abono" y borra el valor ingresado
                    $('#abono-container').hide();
                    $('#abono').val('');
                    }
                });

                var table = $('#datatable-search').DataTable();

        // Manejar el clic en las filas
        $('#datatable-search tbody').on('click', 'tr', function () {
            // Remover la clase 'selected-row' de cualquier fila previamente seleccionada
            $('#datatable-search tbody tr').removeClass('selected-row');

            // Agregar la clase 'selected-row' a la fila seleccionada
            $(this).addClass('selected-row');
        });
    });

    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      searchable: true,
      fixedHeight: false
    });

    $(function() {
        // Asignar el evento a un elemento padre estático
        $('.table-responsive').on('change', '.toggle-class', function() {
            var pendiente = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');

            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('ChangePendienteStatus.pagos') }}',
                data: {
                    'pendiente': pendiente,
                    'id': id
                },
                success: function(data) {
                    console.log(data.success)
                }
            });
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('tuFormulario');
        var btnGuardar = document.getElementById('btnGuardar');

        btnGuardar.addEventListener('click', function() {
            // Habilitar el atributo 'required' en los campos del formulario
            var inputs = form.querySelectorAll('[data-required]');
            inputs.forEach(function(input) {
                input.setAttribute('required', 'required');
            });

            // Deshabilitar el botón
            this.setAttribute('disabled', 'disabled');

            // Verificar la validez del formulario antes de enviarlo
            if (form.checkValidity()) {
                form.submit();
            } else {
                // Habilitar nuevamente el botón si el formulario no es válido
                btnGuardar.removeAttribute('disabled');
            }
        });

        form.addEventListener('submit', function(event) {
            // Deshabilitar el atributo 'required' en los campos del formulario antes de enviarlo
            var inputs = form.querySelectorAll('[data-required]');
            inputs.forEach(function(input) {
                input.removeAttribute('required');
            });
        });
    });
</script>



@endsection
