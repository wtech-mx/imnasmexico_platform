@extends('layouts.app_admin')

@section('template_title')
    Notas Cotizacion
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('assets/admin/vendor/select2/dist/css/select2.min.css')}}">
 @endsection

@php
    $fecha = date('Y-m-d');
@endphp
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form id="myForm" method="POST" action="{{ route('notas_cursos.store') }}" enctype="multipart/form-data" role="form">
                            @csrf
                            <div class="modal-body">
                                <div class="row">

                                    <div class="col-12 mt-2">
                                        <h2 style="color:#836262"><strong>Datos del cliente</strong> </h2>
                                    </div>

                                    <div class="col-3">
                                        <label for="precio">Nuevo cliente</label><br>
                                        <button class="btn btn-success btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                            Agregar
                                        </button>
                                    </div>
                                    <div class="col-9">

                                        <div class="form-group">
                                            <label for="name">Cliente *</label>
                                            <div class="input-group mb-3">
                                                <select class="form-select cliente d-inline-block"  data-toggle="select" id="id_client" name="id_client" value="{{ old('id_client') }}">
                                                    <option value="">Seleccionar cliente</option>
                                                    @foreach ($client as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }} / {{ $item->telefono }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group col-12">
                                        <div class="collapse" id="collapseExample">
                                            <div class="card card-body">
                                                <div class="row">
                                                    <div class="form-group col-6">
                                                        <h4 for="name">Nombre</h4>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="35px">
                                                            </span>
                                                            <input id="name" name="name" type="text" class="form-control" placeholder="Nombre">
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-6">
                                                        <h4 for="name">Correo</h4>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img src="{{ asset('assets/cam/correo-electronico.png') }}" alt="" width="35px">
                                                            </span>
                                                            <input id="email" name="email" type="email" class="form-control" placeholder="Correo">
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-6">
                                                        <h4 for="name">Telefono</h4>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img src="{{ asset('assets/cam/llamar.png') }}" alt="" width="35px">
                                                            </span>
                                                            <input type="tel" id="telefono" name="telefono" class="form-control" placeholder="Telefono" pattern="[0-9]{10}"  minlength="10" maxlength="10">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <input id="fecha" name="fecha" type="date" class="form-control" value="{{$fecha}}" style="display: none">

                                    <div class="col-12 mt-5">
                                        <h2 style="color:#836262"><strong>Seleciona el/los Curso(s)</strong> </h2>
                                    </div>

                                    <div class="col-11">
                                        <div id="formulario" class="mt-4">
                                            <button type="button" class="clonar btn btn-secondary btn-sm">Agregar</button>
                                            <div class="clonars">
                                                <div class="row">
                                                    <div class="col-10">
                                                        <label for="">Curso</label>
                                                        <div class="form-group">
                                                            <select name="concepto[]" class="form-select d-inline-block select2">
                                                                <option value="">Seleccione curso</option>
                                                                @foreach ($cursos as $curso)
                                                                <option value="{{ $curso->id }}" data-precio_normal="{{ $curso->precio }}">{{ $curso->nombre }} - {{ $curso->Cursos->modalidad }} / {{ $curso->Cursos->fecha_inicial }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <label for="num_sesion">Subtotal</label>
                                                            <input  id="importe[]" name="importe[]" type="number" class="form-control importe" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-2 mb-3">
                                        <h2 style="color:#836262"><strong>Pago</strong> </h2>
                                    </div>

                                    <div class="col-4 ">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="toggleFactura" name="factura" value="1">
                                            <h4 class="form-check-h4" for="flexCheckDefault">
                                                <p class="" style="display: inline-block;font-size: 20px;padding: 5px;color: #3b8b00;">Si</p> <strong> (¿Factura?)</strong>
                                            </h4>
                                        </div>
                                    </div>

                                    <div class="form-group col-4">
                                        <h4 for="name">Descuento %</h4>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="35px">
                                            </span>
                                            <input class="form-control descuento" type="text" id="descuento" name="descuento">
                                        </div>
                                    </div>

                                    <div class="form-group col-4">
                                        <h4 for="name">Total</h4>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="35px">
                                            </span>
                                            <input class="form-control total" type="text" id="total" name="total" value="0" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group col-4">
                                        <h4 for="name">Restante</h4>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="35px">
                                            </span>
                                            <input type="text" class="form-control" id="restante" name="restante" value="0" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group col-4">
                                        <h4 for="name">Monto 1 *</h4>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="35px">
                                            </span>
                                            <input type="text" class="form-control" id="monto1" name="monto1" required>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="name">Metodo de Pago</label>
                                            <select name="metodo_pago" id="metodo_pago" class="form-select d-inline-block">
                                                <option value="Efectivo">Efectivo</option>
                                                <option value="Tarjeta">Tarjeta</option>
                                                <option value="Transferencia">Transferencia</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group col-4 ">
                                        <label for="name">Foto (Comprobante)</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/cam/camara.png') }}" alt="" width="35px">
                                            </span>
                                            <input id="foto" name="foto" type="file" class="form-control" placeholder="foto">
                                        </div>
                                    </div>

                                    <div class="form-group col-4">
                                        <h4 for="name">Monto 2 *</h4>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="35px">
                                            </span>
                                            <input type="text" class="form-control" id="monto2" name="monto2">
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="name">Metodo de Pago 2</label>
                                            <select name="metodo_pago2" id="metodo_pago2" class="form-select d-inline-block">
                                                <option value="">Selecciona una opcion</option>
                                                <option value="Efectivo">Efectivo</option>
                                                <option value="Tarjeta">Tarjeta</option>
                                                <option value="Transferencia">Transferencia</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div id="divFactura" style="display: none;">
                                        <div class="row">
                                            <h4>Factura</h4>

                                            <div class="form-group col-4">
                                                <h4 for="name">Situacion Fiscal</h4>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/user/icons/picture.png') }}" alt="" width="35px">
                                                    </span>
                                                    <input class="form-control" type="file" id="situacion_fiscal" name="situacion_fiscal">
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <h4 for="name">Nombre / Razon Social</h4>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/user/icons/firma-digital.png') }}" alt="" width="35px">
                                                    </span>
                                                    <input class="form-control" type="text" id="razon_social" name="razon_social">
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <h4 for="name">RFC</h4>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/user/icons/carta.png') }}" alt="" width="35px">
                                                    </span>
                                                    <input class="form-control" type="text" id="rfc" name="rfc">
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <h4 for="name">CFDI</h4>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/user/icons/monetary-policy.png') }}" alt="" width="35px">
                                                    </span>
                                                    <select class="form-select" name="cfdi" id="cfdi">
                                                        <option value="">Seleccione CFDI</option>
                                                        <option value="G01 Adquisicion de Mercancias">G01 Adquisicion de Mercancias</option>
                                                        <option value="G02 Devoluciones, Descuentos o Bonificaciones">G02 Devoluciones, Descuentos o Bonificaciones</option>
                                                        <option value="G03 Gastos en General">G03 Gastos en General</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <h4 for="name">Correo</h4>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/user/icons/email.png') }}" alt="" width="35px">
                                                    </span>
                                                    <input class="form-control" type="text" id="correo_fac" name="correo_fac">
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <h4 for="name">Telefono</h4>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/user/icons/complain.png') }}" alt="" width="35px">
                                                    </span>
                                                    <input class="form-control" type="number" id="telefono_fac" name="telefono_fac">
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <h4 for="name">Direccion de Factura</h4>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/user/icons/cp.png') }}" alt="" width="35px">
                                                    </span>
                                                    <input class="form-control" type="text" id="direccion_fac" name="direccion_fac">
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <h4 for="name">Comentario/nota</h4>
                                            <textarea class="form-control" name="nota" id="nota" cols="30" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn close-modal" id="saveButton" style="background: {{$configuracion->color_boton_save}}; color: #ffff; font-size: 17px;">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('datatable')
<script src="{{ asset('assets/admin/vendor/select2/dist/js/select2.min.js')}}"></script>
<script>
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
