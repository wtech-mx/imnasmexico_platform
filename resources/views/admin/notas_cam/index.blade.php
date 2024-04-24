@extends('layouts.app_admin')

@section('template_title')
    Notas Estandares
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header">

                        <div class="d-flex justify-content-between">

                            <a class="btn" id="regresar_btn" style="background: {{$configuracion->color_boton_close}}; color: #fff"><i class="fas fa-arrow-left"></i> Regresar </a>

                            <h3 class="mb-3">Notas Estandares</h3>

                            <a type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#modal_estandares_create">
                               Crea Nota
                            </a>

                        </div>

                    </div>

                    <div class="card-body">
                        <div class="row">
                            @foreach ( $notas as $item)
                                <div class="col-12 mb-4">
                                    <div class="comtainer_nota" style="background: #ddbba254;border-radius: 13px;box-shadow: 10px 10px 28px -25px rgba(0,0,0,0.73);padding: 15px;">
                                        <div class="row">

                                            <div class="col-4">
                                                <h4 style="font-size: 14px;">{{ $item->nombre_persona }}</h4>
                                                <h3 style="font-size: 18px">Estandares</h3>
                                                <ul>
                                                    <li></li>
                                                </ul>
                                            </div>

                                            <div class="col-4 mt-4">
                                                <h3 style="font-size: 18px">Estatus</h3>
                                            </div>

                                            <div class="col-2 mt-4">
                                                <h3 style="font-size: 18px">Evaluador</h3>
                                                <a type="button" data-bs-toggle="modal" data-bs-target="#modal_evaluador" style="font-size: 11px;background: #fff;padding: 2px;border-radius: 6px;">Selecionar Evaluador</a>

                                                @if( $item->evaluador == 'Kay')
                                                    <p style="font-size: 11px;background: #fff200;padding: 2px;border-radius: 6px;display:block;"><strong>{{ $item->evaluador }}</strong></p>

                                                @elseif ( $item->evaluador == 'Martin')
                                                    <p style="font-size: 11px;background: #0062ff;padding: 2px;border-radius: 6px;display:inline-block;color:white"><strong>{{ $item->evaluador }}</strong></p>

                                                @elseif ( $item->evaluador == 'Carla')
                                                    <p style="font-size: 11px;background: #2ab300;padding: 2px;border-radius: 6px;display:inline-block;color:white"><strong>{{ $item->evaluador }}</strong></p>

                                                @endif

                                            </div>

                                            <div class="col-2">
                                                <h4 style="font-size: 14px;"># Portafolio <strong>{{ $item->num_portafolio }}</strong></h4>
                                                <h3 style="font-size: 18px">Acciones</h3>
                                            </div>

                                            <div class="col-12">
                                                <p class="d-inline-flex gap-1">
                                                    <a class="btn btn-sm btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                      Mas informacion
                                                    </a>
                                                  </p>
                                                  <div class="collapse" id="collapseExample">
                                                    <div class="card card-body ">

                                                        <div class="row">
                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <label for="name">Fecha de evaluacion *</label>
                                                                    <div class="input-group mb-3">
                                                                        <span class="input-group-text" id="basic-addon1">
                                                                            <img src="{{ asset('assets/cam/calenda.png') }}" alt="" width="35px">
                                                                        </span>
                                                                        <input id="fecha" name="fecha" type="date" class="form-control" value="{{ $item->fecha }}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <label for="name">Hora *</label>
                                                                    <div class="input-group mb-3">
                                                                        <span class="input-group-text" id="basic-addon1">
                                                                            <img src="{{ asset('assets/user/icons/reloj.png') }}" alt="" width="35px">
                                                                        </span>
                                                                        <input id="time" name="time" type="time" class="form-control" value="{{ $item->time }}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <label for="name">Tipo *</label>
                                                                    <div class="input-group mb-3">
                                                                        <span class="input-group-text" id="basic-addon1">
                                                                            <img src="{{ asset('assets/cam/change.png') }}" alt="" width="35px">
                                                                        </span>
                                                                        <select name="tipo" id="tipo" class="form-select d-inline-block" >
                                                                            <option value="">{{ $item->tipo }}</option>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <label for="name">Modalidad *</label>
                                                                    <div class="input-group mb-3">
                                                                        <span class="input-group-text" id="basic-addon1">
                                                                            <img src="{{ asset('assets/cam/gestion-del-cambio.png') }}" alt="" width="35px">
                                                                        </span>
                                                                        <select name="tipo_modalidad" id="tipo_modalidad" class="form-select d-inline-block" >
                                                                            <option value="">{{ $item->tipo_modalidad }}</option>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <label for="name">Alumnos o externos *</label>
                                                                    <div class="input-group mb-3">
                                                                        <span class="input-group-text" id="basic-addon1">
                                                                            <img src="{{ asset('assets/user/icons/perfil.png') }}" alt="" width="35px">
                                                                        </span>
                                                                        <select name="tipo_alumno" id="tipo_alumno" class="form-select d-inline-block" >
                                                                            <option value="">{{ $item->tipo_alumno }}</option>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="name">Nombre del Centro</label>
                                                                    <div class="input-group mb-3">
                                                                        <span class="input-group-text" id="basic-addon1">
                                                                            <img src="{{ asset('assets/user/icons/letter.png') }}" alt="" width="35px">
                                                                        </span>
                                                                        <input id="nombre_centro" name="nombre_centro" type="number" class="form-control" value="{{ $item->nombre_centro }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                  </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            @include('admin.notas_cam.modal_evaluador')

                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@include('admin.notas_cam.modal_create')

@endsection

@section('datatable')
<script src="{{ asset('assets/admin/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('assets/admin/vendor/select2/dist/js/select2.min.js')}}"></script>
<script>
        const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      searchable: true,
      fixedHeight: false
    });

    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });

    $(document).ready(function() {
        $('.js-example-basic-multiple2').select2();
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
