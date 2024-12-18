@extends('layouts.app_admin')

@section('template_title')
Notas CAM
@endsection

@section('content')

<style>
    #resultado {
    border: solid 3px red;
    color: white;
    font-weight: bold;
    width: 100%;
    border-radius: 10px;
    padding: 10px;
    font-size: 13px;
    margin-top: 1rem;
    }

    #resultado.ok {
        border: solid 3px GREEN;
        color: GREEN!IMPORTANT;
        font-weight: bold;
    }
</style>


    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header">

                        <div class="d-flex justify-content-between">

                            <h3 class="mb-3">Notas CAM</h3>

                            <a type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                                ¿Como funciona?
                            </a>
                            @can('nota-cam-create')
                            <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                Crear
                            </a>
                            @endcan
                            @include('cam.admin.notas.crear')
                        </div>
                    </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-flush" id="datatable-search">
                                    <thead class="thead">
                                        <tr>
                                            <th>No</th>
                                            <th>Nombre</th>
                                            <th>Tipo</th>
                                            <th>Fecha pago</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($notas_cam as $nota_cam)
                                            <tr>
                                                <td>{{$nota_cam->id}}</td>
                                                <td>
                                                    @if ($nota_cam->tipo == 'Centro Evaluación')

                                                    <a href="{{ route('expediente.edit_centro', $nota_cam->id) }}" style="text-decoration: underline;color:blue">
                                                        {{$nota_cam->Cliente->name}}
                                                    </a>
                                                    <br>{{$nota_cam->Cliente->telefono}}
                                                    @else

                                                    <a href="{{ route('expediente.edit', $nota_cam->id) }}" style="text-decoration: underline;color:blue">
                                                        {{$nota_cam->Cliente->name}}
                                                    </a>
                                                    <br>{{$nota_cam->Cliente->telefono}}
                                                    @endif

                                                <td>
                                                    @if ($nota_cam->tipo == 'Centro Evaluación')
                                                        <label class="badge badge-sm" style="color: #009ee3;background-color: #009ee340;">Centro Evaluación</label>
                                                    @else
                                                        <label class="badge badge-sm" style="color: #746AB0;background-color: #746ab061;">Evaluador Independiente</label>
                                                    @endif
                                                </td>
                                                <td>
                                                    @php
                                                        $fecha = $nota_cam->fecha_pago;
                                                        // Convertir a una marca de tiempo Unix
                                                        $timestamp = strtotime($fecha);
                                                        // Formatear la fecha
                                                        $fecha_formateada = strftime('%e de %B del %Y', $timestamp);
                                                        // Combinar fecha y hora
                                                        $fecha_hora_formateada = $fecha_formateada;
                                                    @endphp
                                                    @if ($nota_cam->fecha_pago == NULL)
                                                        <b>Sin fecha</b>
                                                    @else
                                                        {{ $fecha_hora_formateada}}
                                                    @endif

                                                </td>
                                                <td>
                                                    <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#EditexampleModal{{$nota_cam->id}}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                                        <i class="fa fa-fw fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @include('cam.admin.notas.edit_nuevos')
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
<script src="{{ asset('assets/admin/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('assets/admin/vendor/select2/dist/js/select2.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });

    $(document).ready(function() {
        $('.js-example-basic-multiple2').select2();
    });

    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
        deferRender:true,
        paging: true,
        pageLength: 10
    });
</script>

<script>
    // Obtén referencias a los elementos select, inputs y el contenedor de razon
    var selectTipo = document.getElementById('tipo');
    var selectCentroTipo = document.getElementById('centroTipo');
    var inputCosto = document.getElementById('costo');
    var inputMonto1 = document.getElementById('monto1');
    var inputMonto2 = document.getElementById('monto2');
    var inputRestante = document.getElementById('restante');
    var opcionesCentro = document.getElementById('opcionesCentro');
    var razonContainer = document.getElementById('razonContainer');

    // Define los costos y valores iniciales
    var costoEvaluador = 45000; // Cambia esto al costo real para un evaluador
    var preciosCentro = {
        Gold: 65000,      // Cambia esto al costo real para "Gold"
        Diamante: 95000   // Cambia esto al costo real para "Diamante"
    };
    var monto1 = 0;
    var monto2 = 0;

    // Agrega eventos de cambio a los campos monto1 y monto2
    inputMonto1.addEventListener('input', function() {
        monto1 = parseFloat(inputMonto1.value) || 0;
        actualizarRestante();
    });

    inputMonto2.addEventListener('input', function() {
        monto2 = parseFloat(inputMonto2.value) || 0;
        actualizarRestante();
    });

    // Agrega un evento de cambio al select de tipo
    selectTipo.addEventListener('change', function() {
        var opcionSeleccionada = selectTipo.value;
        if (opcionSeleccionada === 'Evaluador Independiente') {
            opcionesCentro.style.display = 'none';
            razonContainer.style.display = 'none';
            inputCosto.value = costoEvaluador;
        } else {
            opcionesCentro.style.display = 'block';
            razonContainer.style.display = 'block';
        }
        actualizarRestante();
    });

    // Agrega un evento de cambio al select de centroTipo
    selectCentroTipo.addEventListener('change', function() {
        var opcionSeleccionada = selectCentroTipo.value;
        inputCosto.value = preciosCentro[opcionSeleccionada] || '';
        actualizarRestante();
    });

    // Función para calcular y actualizar el campo restante
    function actualizarRestante() {
        var opcionSeleccionada = selectTipo.value;
        var costo = parseFloat(inputCosto.value) || 0;

        if (opcionSeleccionada === 'Evaluador Independiente') {
            costo = costoEvaluador;
        } else {
            var centroTipoSeleccionado = selectCentroTipo.value;
            costo = preciosCentro[centroTipoSeleccionado] || 0;
        }

        var total = costo - monto1 - monto2;
        inputRestante.value = total.toFixed(2);
    }

    // Llama a la función inicialmente para calcular el valor inicial del campo restante
    actualizarRestante();


    //Función para validar una CURP
function curpValida(curp) {
    var re = /^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/,
        validado = curp.match(re);

    if (!validado)  //Coincide con el formato general?
    	return false;

    //Validar que coincida el dígito verificador
    function digitoVerificador(curp17) {
        //Fuente https://consultas.curp.gob.mx/CurpSP/
        var diccionario  = "0123456789ABCDEFGHIJKLMNÑOPQRSTUVWXYZ",
            lngSuma      = 0.0,
            lngDigito    = 0.0;
        for(var i=0; i<17; i++)
            lngSuma = lngSuma + diccionario.indexOf(curp17.charAt(i)) * (18 - i);
        lngDigito = 10 - lngSuma % 10;
        if (lngDigito == 10) return 0;
        return lngDigito;
    }

    if (validado[2] != digitoVerificador(validado[1]))
    	return false;

    return true; //Validado
}


//Handler para el evento cuando cambia el input
//Lleva la CURP a mayúsculas para validarlo
function validarInput(input) {
    var curp = input.value.toUpperCase(),
        resultado = document.getElementById("resultado"),
        valido = "No válido";

    if (curpValida(curp)) { // ⬅️ Acá se comprueba
    	valido = "Válido";
        resultado.classList.add("ok");
    } else {
    	resultado.classList.remove("ok");
    }

    resultado.innerText = "CURP: " + curp + "\nFormato: " + valido;
}
</script>


@endsection
