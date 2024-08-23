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
                        <form method="POST" action="{{ route('notas_cotizacion.store') }}" enctype="multipart/form-data" role="form">
                            @csrf
                            <div class="modal-body">
                                <div class="row">

                                    <div class="col-12 mt-2">
                                        <h2 style="color:#836262"><strong>Datos del cliente</strong> </h2>
                                    </div>

                                    <div class="form-group col-6">
                                        <h4 for="name">Nombre *</h4>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="35px">
                                            </span>
                                            <input id="name" name="name" type="text" class="form-control" placeholder="Nombre" required>
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
                                        <h4 for="name">Telefono *</h4>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/cam/llamar.png') }}" alt="" width="35px">
                                            </span>
                                            <input type="tel" id="telefono" name="telefono" class="form-control" placeholder="Telefono" pattern="[0-9]{10}"  minlength="10" maxlength="10" required>
                                        </div>
                                    </div>

                                    <div class="form-group col-6">
                                        <h4 for="name">Fecha *</h4>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/cam/calenda.png') }}" alt="" width="35px">
                                            </span>
                                            <input id="fecha" name="fecha" type="date" class="form-control" value="{{$fecha}}" required>
                                        </div>
                                    </div>

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
                                                                <option value="{{ $curso->nombre }}" data-precio_normal="{{ $curso->precio }}">{{ $curso->nombre }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <label for="num_sesion">Subtotal</label>
                                                            <input  id="importe[]" name="importe[]" type="number" class="form-control importe" >
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
                                        <h4 for="name">Subtotal *</h4>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="35px">
                                            </span>
                                            <input class="form-control total" type="text" id="total" name="total" value="0" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group col-4">
                                        <h4 for="name">Descuento</h4>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/user/icons/descuento.png') }}" alt="" width="35px">
                                            </span>
                                            <input class="form-control" type="number" id="descuento" name="descuento" value="0">
                                        </div>
                                    </div>

                                    <div class="form-group col-4">
                                        <h4 for="name">Total</h4>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/user/icons/bolsa-de-dinero.png') }}" alt="" width="35px">
                                            </span>
                                            <input class="form-control" type="text" id="totalDescuento" name="totalDescuento" readonly>
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
                                <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff; font-size: 17px;">Guardar</button>
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
    function initializeSelect2($container) {
        $container.find('.select2').select2();
    }

    // Inicializa Select2 en todos los elementos .select2 existentes
    initializeSelect2($('#formulario'));

    // Asocia un evento de cambio al campo de concepto
    $(document).on('change', '.select2', function() {
        // Obtiene el precio normal del producto seleccionado
        var precioNormal = $(this).find('option:selected').data('precio_normal');

        // Encuentra el campo de importe correspondiente y establece su valor
        $(this).closest('.row').find('.importe').val(precioNormal);

        // Actualiza la suma total
        calcularSuma();
    });

    // Clonar el div cuando se haga clic en el botón "Clonar"
    $(document).on('click', '.clonar', function() {
        var $clone = $('.clonars').first().clone();
        $clone.find('select.select2').removeClass('select2-hidden-accessible').next().remove();
        $clone.find('select.select2').select2();

        // Borra los valores de los inputs clonados
        $clone.find(':input').each(function() {
            if ($(this).is('select')) {
                this.selectedIndex = 0;
            } else {
                this.value = '';
            }
        });

        // Agrega lo clonado al final del formulario
        $clone.appendTo('#formulario');

        // Asocia el evento de cambio al campo de concepto clonado
        $clone.find('.select2').on('change', function() {
            var precioNormal = $(this).find('option:selected').data('precio_normal');
            $(this).closest('.row').find('.importe').val(precioNormal);

            // Actualiza la suma total
            calcularSuma();
        });

        // Asocia el evento 'input' al campo clonado
        $clone.find('input[name="importe[]"]').on('input', function() {
            calcularSuma();
        });
    });

    // Función para calcular la suma total de todos los campos importe
    function calcularSuma() {
        var sumaTotal = 0;

        // Recorre todos los campos de importe y suma sus valores
        $('.importe').each(function() {
            var valor = parseFloat($(this).val()) || 0;
            sumaTotal += valor;
        });

        // Coloca la suma total en el input de total
        $('#total').val(sumaTotal.toFixed(2));
    }

    // Calcula la suma total al inicio en caso de que haya valores precargados
    calcularSuma();
});


</script>
@endsection
