@extends('layouts.app_admin')

@section('template_title')
    Notas Cursos
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
@php
    $fecha = date('Y-m-d');
    $fechaHoraActual = new DateTime();
    $fechaHoraActualFormateada = $fechaHoraActual->format('Y-m-d\TH:i');
@endphp
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <a class="btn" id="regresar_btn" style="background: {{$configuracion->color_boton_close}}; color: #fff"><i class="fas fa-arrow-left"></i> Regresar </a>

                            <h3 class="mb-3">Notas Cursos</h3>

                                <a type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                                    ¿Como funciona?
                                </a>

                            @can('nota-cursos-paquetes')
                                <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#examplePaquete" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                    Paquetes
                                </a>
                            @endcan

                            @can('nota-cursos-crear')
                                <a type="button" class="btn bg-gradient-primary" onclick="openRightPanel()" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                    Crear
                                </a>

                                <a  class="btn bg-gradient-primary" href="{{ route('notas_cursos.crear') }}">
                                    Crear Individual
                                </a>
                            @endcan
                        </div>
                    </div>

                        <div class="card-body">


                            <form method="POST" action="{{ route('notas_cursos.store') }}" enctype="multipart/form-data" role="form">
                                @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-3">
                                                <label for="precio">Nuevo cliente</label><br>
                                                <button class="btn btn-success btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                                    Agregar
                                                </button>
                                            </div>
                                            <div class="col-9">

                                                <div class="form-group">
                                                    <label for="name">Cliente *</label>
                                                    <select class="form-select cliente d-inline-block"  data-toggle="select" id="id_client" name="id_client" value="{{ old('id_client') }}">
                                                        <option>Seleccionar cliente</option>
                                                        @foreach ($client as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }} / {{ $item->telefono }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group col-12">
                                                <div class="collapse" id="collapseExample">
                                                    <div class="card card-body">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="name">Nombre *</label>
                                                                    <input id="name" name="name" type="text" class="form-control" placeholder="Nombre">
                                                                </div>
                                                            </div>

                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="name">Correo</label>
                                                                    <input id="email" name="email" type="email" class="form-control" placeholder="Correo">
                                                                </div>
                                                            </div>

                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="name">Telefono *</label>
                                                                    <input id="telefono" name="telefono" type="tel" minlength="10" maxlength="10" class="form-control" placeholder="55-55-55-55-55">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-1">
                                                <div class="form-group">
                                                    <label for="">-</label>
                                                    <button class="mt-3" type="button" id="agregarCampo" style="border-radius: 9px;width: 36px;height: 40px;">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="col-12">

                                                <div class="form-group">
                                                    <label for="">Curso</label>
                                                    <div id="camposContainer">
                                                        <div class="campo mt-3">
                                                            <select name="campo[]" class="form-select d-inline-block curso" style="width: 70%!important;">
                                                                <option value="">Seleccione Curso</option>
                                                                @foreach ($cursos as $curso)
                                                                <option value="{{ $curso->id }}" data-precio="{{ $curso->precio}}">{{ $curso->nombre }} - {{ $curso->Cursos->modalidad }} / {{ $curso->Cursos->fecha_inicial }}</option>
                                                                @endforeach
                                                            </select>
                                                            <input type="text" name="precio[]" class="form-control d-inline-block precio" style="width: 20%!important;">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    {{-- ================ P A G O ================ --}}

                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="name">Subtotal</label>
                                                    <input class="form-control" type="text" id="total" name="total" readonly>
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="name">Descuento</label>
                                                    <input class="form-control" type="number" id="descuento" name="descuento" value="0">
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="name">Total</label>
                                                    <input class="form-control" type="text" id="totalDescuento" name="totalDescuento" readonly>
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="name">Monto</label>
                                                    <input class="form-control" type="number" id="monto" name="monto" value="">
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

                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="name">Fecha *</label>
                                                    <input id="created_at" name="created_at" type="datetime-local" class="form-control" value="{{$fechaHoraActualFormateada}}" required>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="name">Nota</label>
                                                    <textarea name="nota" id="nota" class="form-control" cols="5" rows="3"></textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                                </div>

                            </form>

                        </div>
                </div>

            </div>
        </div>
    </div>

    @include('admin.notas_cursos.create_paquete')
@endsection

@section('select2')
<script src="{{ asset('assets/admin/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('assets/admin/vendor/select2/dist/js/select2.min.js')}}"></script>
<script>

document.addEventListener('DOMContentLoaded', function() {

var agregarCampoBtn = document.getElementById('agregarCampo');
var camposContainer = document.getElementById('camposContainer');
var campoExistente = camposContainer.querySelector('.campo');
var descuentoInput = document.getElementById('descuento');
var totalInput = document.getElementById('total');
var totalDescuentoInput = document.getElementById('totalDescuento');

// Inicializar Select2 en los selects existentes
$('.cliente').select2();

agregarCampoBtn.addEventListener('click', function() {
    var nuevoCampo = campoExistente.cloneNode(true);
    console.log('Nuevo campo clonado:', nuevoCampo);

    var nuevoSelect = nuevoCampo.querySelector('select');
    var nuevoPrecioInput = nuevoCampo.querySelector('input[name="precio[]"]');
    nuevoSelect.value = '';
    nuevoPrecioInput.value = '';

    // Agregar el nuevo campo al contenedor
    camposContainer.appendChild(nuevoCampo);
    console.log('Campo agregado al contenedor:', camposContainer);

    // Inicializar Select2 en el nuevo select
    $(nuevoSelect).select2();
    console.log('Select2 inicializado en el nuevo select:', nuevoSelect);

    // Enlazar el evento de cambio al nuevo select
    nuevoSelect.addEventListener('change', function(event) {
        console.log('Select cambiado en nuevo campo:', nuevoSelect);

        var precio = nuevoSelect.options[nuevoSelect.selectedIndex].getAttribute('data-precio');
        console.log('Precio obtenido del select:', precio);

        if (precio) {
            nuevoPrecioInput.value = precio;
            console.log('Precio asignado al input:', nuevoPrecioInput.value);
        } else {
            console.warn('No se encontró el atributo data-precio para la opción seleccionada en el nuevo campo');
        }

        actualizarTotal();
    });

    console.log('Se añadió el evento de cambio al nuevo select.');
});

// Manejar el evento de cambio en el select inicial
camposContainer.addEventListener('change', function(event) {
    if (event.target.classList.contains('curso')) {
        var select = event.target;
        var precioInput = select.parentNode.querySelector('input[name="precio[]"]');
        var precio = select.options[select.selectedIndex].getAttribute('data-precio');
        console.log('Precio obtenido del select:', precio);
        precioInput.value = precio || '';
        actualizarTotal();
    }
});

function actualizarTotal() {
    var precios = document.querySelectorAll('input[name="precio[]"]');
    var total = 0;

    precios.forEach(function(precioInput) {
        var valor = parseFloat(precioInput.value) || 0;
        total += valor;
    });

    totalInput.value = total.toFixed(2);
    aplicarDescuento();
}

function aplicarDescuento() {
    var total = parseFloat(totalInput.value) || 0;
    var descuento = parseFloat(descuentoInput.value) || 0;
    var descuentoAmount = (descuento / 100) * total;
    var totalConDescuento = total - descuentoAmount;

    totalDescuentoInput.value = totalConDescuento.toFixed(2);
}

// Inicializar el valor del total y el total con descuento
actualizarTotal();
aplicarDescuento();
});




</script>
@endsection
