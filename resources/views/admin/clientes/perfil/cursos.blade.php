<!-- Card Basic Info -->
<div class="card mt-4" id="basic-info">
    <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
        Crear nota curso
    </a>

    <div class="collapse" id="collapseExample">
        <div class="card card-body">
          @include('admin.clientes.perfil.cotizaciones.crear_curso')
        </div>
    </div>
</div>
<div class="card mt-4" id="basic-info">
    <nav class="nav nav-tabs" id="myTab" role="tablist">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Notas</button>
            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Cursos tomados</button>
        </div>
    </nav>

    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="card-header">
                <h5>Notas</h5>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <table class="table table-flush" id="datatable-cursos">
                        <thead class="thead">
                            <tr>
                                <th>Curso</th>
                                <th>Fecha</th>
                                <th>Modalidad</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notas as $nota)
                                @if ($nota->paquete == NULL)
                                    <tr style="background-color: #d51d1d70;">
                                @else
                                    @if ($nota->Order->estatus == '0')
                                        <tr style="background-color: #d51d1d70;">
                                    @else
                                            <tr>
                                    @endif
                                @endif
                                    <td>{{ $nota->id }}</td>
                                    <td>{{ $nota->User->name }}</td>

                                    <td>
                                        @php
                                        $fecha = $nota->fecha;
                                        $fecha_timestamp = strtotime($fecha);
                                        $fecha_formateada = date('d \d\e F \d\e\l Y', $fecha_timestamp);
                                        @endphp
                                        {{$fecha_formateada}}
                                    </td>
                                    <td>
                                        @if ($nota->paquete != NULL)
                                            <a class="btn btn-sm btn-warning" href="{{ route('pagos.edit_pago',$nota->paquete) }}" target="_blank">Ver orden</a>
                                        @endif

                                        @if ($nota->paquete == NULL)
                                            <a class="btn btn-xs btn-info text-white" target="_blank" href="{{ route('notas_cursos.imprimir_canceladas', $nota->id) }}">
                                                <i class="fa fa-file"></i>
                                            </a>
                                        @else
                                            @if ($nota->Order->estatus == '0')
                                                <a class="btn btn-xs btn-info text-white" target="_blank" href="{{ route('notas_cursos.imprimir_canceladas', $nota->id) }}">
                                                    <i class="fa fa-file"></i>
                                                </a>
                                            @else
                                                <a class="btn btn-xs btn-info text-white" target="_blank" href="{{ route('notas_cursos.imprimir', $nota->id) }}">
                                                    <i class="fa fa-file"></i>
                                                </a>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <div class="card-header">
                <h5>Cursos tomados</h5>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <table class="table table-flush" id="datatable-cursos">
                        <thead class="thead">
                            <tr>
                                <th>Curso</th>
                                <th>Fecha</th>
                                <th>Modalidad</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cursos as $curso)
                                <tr>
                                    <th>
                                        <img id="blah" src="{{asset('curso/'.$curso->Cursos->foto) }}" alt="Imagen" style="width: 60px; height: 60px;"/> <br>
                                        {{ $curso->Cursos->nombre }}
                                    </th>

                                    <th>
                                        @php
                                        $fecha = $curso->Cursos->fecha_inicial;
                                        $fecha_timestamp = strtotime($fecha);
                                        $fecha_formateada = date('d \d\e F \d\e\l Y', $fecha_timestamp);

                                        $fecha2 = $curso->Cursos->fecha_final;
                                        $fecha_timestamp2 = strtotime($fecha2);
                                        $fecha_formateada2 = date('d \d\e F \d\e\l Y', $fecha_timestamp2);
                                        @endphp
                                    Del: {{$fecha_formateada}} <br>
                                    Al: {{$fecha_formateada2}}
                                    </th>

                                    @if ($curso->Cursos->modalidad == "Online")
                                        <td> <label class="badge badge-sm" style="color: #009ee3;background-color: #009ee340;">Online</label> </td>
                                    @else
                                        <td> <label class="badge badge-sm" style="color: #746AB0;background-color: #746ab061;">Presencial</label> </td>
                                    @endif
                                    <td>
                                        <a type="button" class="btn btn-sm btn-primary" href="{{ route('cursos.listas',$curso->Cursos->id) }}" title="Listas de clase"><i class="fa fa-users"></i> {{ $curso->Cursos->orderTicket->count() }}</a>
                                        <a class="btn btn-sm btn-danger" href="{{ route('pagos.edit_pago',$curso->Orders->id) }}"><i class="fa fa-newspaper" title="Ver Orden"></i> </a>
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
@section('datatable')
<script src="{{ asset('assets/admin/vendor/select2/dist/js/select2.min.js')}}"></script>
    <script>
        const dataTableTiendita = new simpleDatatables.DataTable("#datatable-cursos", {
            deferRender:true,
            paging: true,
            pageLength: 10
        });

        $(document).ready(function() {
            $('.cliente').select2();

            function initializeSelect2($container) {
                $container.find('.select2').select2();
            }

            initializeSelect2($('#formulario'));

            $(document).on('change', '.select2', function() {
                var precioNormal = $(this).find('option:selected').data('precio_normal');
                $(this).closest('.row').find('.importe').val(precioNormal);
                calcularSuma();
            });

            $(document).on('click', '.clonar', function() {
                var $clone = $('.clonars').first().clone();
                $clone.find('select.select2').removeClass('select2-hidden-accessible').next().remove();
                $clone.find('select.select2').select2();

                $clone.find(':input').each(function() {
                    if ($(this).is('select')) {
                        this.selectedIndex = 0;
                    } else {
                        this.value = '';
                    }
                });

                $clone.appendTo('#formulario');

                $clone.find('.select2').on('change', function() {
                    var precioNormal = $(this).find('option:selected').data('precio_normal');
                    $(this).closest('.row').find('.importe').val(precioNormal);
                    calcularSuma();
                });

                $clone.find('input[name="importe[]"]').on('input', function() {
                    calcularSuma();
                });
            });

            function calcularSuma() {
                var sumaTotal = 0;

                $('.importe').each(function () {
                    var valor = parseFloat($(this).val()) || 0;
                    sumaTotal += valor;
                });

                // Guarda el total original en un atributo de datos para cálculos futuros
                $('#total').data('originalTotal', sumaTotal);
                $('#total').val(sumaTotal.toFixed(2));

                aplicarDescuento();
            }

            function aplicarDescuento() {
                var totalOriginal = parseFloat($('#total').data('originalTotal')) || 0;
                var descuento = parseFloat($('#descuento').val()) || 0;

                // Calcula el total con descuento
                var totalConDescuento = totalOriginal * (1 - (descuento / 100));
                $('#total').val(totalConDescuento.toFixed(2));

                calcularRestante();
            }

            $('#descuento').on('input', function () {
                aplicarDescuento();
            });

            $('#toggleFactura').on('change', function () {
                var totalConDescuento = parseFloat($('#total').data('originalTotal')) || 0;
                var descuento = parseFloat($('#descuento').val()) || 0;
                totalConDescuento = totalConDescuento * (1 - (descuento / 100));

                if ($(this).is(':checked')) {
                    // Calcular el 16% y sumarlo al total con descuento
                    var iva = totalConDescuento * 0.16;
                    var totalConIva = totalConDescuento + iva;
                    $('#total').val(totalConIva.toFixed(2));

                    // Mostrar el div
                    $('#divFactura').show();
                } else {
                    // Si se desmarca, calcular solo el total con descuento
                    $('#total').val(totalConDescuento.toFixed(2));

                    // Ocultar el div
                    $('#divFactura').hide();
                }

                calcularRestante(); // Actualiza el restante con el nuevo total
            });

            function calcularRestante() {
                var total = parseFloat($('#total').val()) || 0;
                var monto1 = parseFloat($('#monto1').val()) || 0;
                var monto2 = parseFloat($('#monto2').val()) || 0;

                var restante = total - (monto1 + monto2);
                $('#restante').val(restante.toFixed(2));
            }

            $('#monto1, #monto2').on('input', function () {
                calcularRestante();
            });

            calcularSuma();

            $('#myForm').on('submit', function () {
                $('#saveButton').prop('disabled', true);
            });

            $(document).on('keydown', function (event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                }
            });
        });
    </script>
@endsection
