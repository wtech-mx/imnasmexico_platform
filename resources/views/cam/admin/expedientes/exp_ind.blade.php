@extends('layouts.app_admin')

@section('template_title')
Expediente {{$expediente->id}}
@endsection

@section('content')
@php
$fecha = $expediente->Nota->fecha; // Suponiendo que $fecha es una cadena en formato 'Y-m-d'

// Crear un objeto DateTime desde la cadena de fecha
$fechaObj = new DateTime($fecha);

// Formatear la fecha en el formato "d de F del Y" (01 de Octubre del 2024)
$fecha_formateada = $fechaObj->format('d \d\e F \d\e\l Y');

// Clonar el objeto DateTime para la segunda fecha
$fechaObj2 = clone $fechaObj;

// Sumar un año a la segunda fecha
$fechaObj2->modify('+1 year');

// Formatear la segunda fecha en el mismo formato
$fecha_formateada2 = $fechaObj2->format('d \d\e F \d\e\l Y');

// Calcular la diferencia de días con la fecha actual
$hoy = new DateTime(); // Fecha actual
$diferencia = $fechaObj2->diff($hoy); // Diferencia entre las dos fechas
$diferencia_dias = $diferencia->days;

@endphp
<div class="container-fluid ">

    <div class="card shadow-lg mb-5">
        <div class="card-body p-3">
        <div class="row gx-4">
            <div class="col-2 my-auto">
                <div class="avatar avatar-xl position-relative">
                    <a type="button" data-bs-toggle="modal" data-bs-target="#modal_estatus">
                        @if ($documentos->logo == NULL)
                            <img src="{{asset('assets/user/logotipos/sin-logo.jpg')}}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                        @else
                            <img src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->logo)}}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                        @endif
                    </a>
                </div>
            </div>
            <div class="col-4 my-auto">
                <div class="">
                    <p class="mb-1 ">
                        <strong>Clave evaluador:</strong><br>
                        {{ $expediente->Nota->Cliente->num_user }}
                    </p>
                    <h5 class="mb-0">
                        {{$expediente->Nota->Cliente->name}}
                    </h5>
                    <p class="mb-0 font-weight-bold text-sm">
                        {{$expediente->Nota->tipo}}
                    </p>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 my-auto">
                <div class="nav-wrapper position-relative end-0">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item mb-0 px-0 py-1 active d-flex align-items-center justify-content-center" role="presentation">
                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Inicio</button>
                        </li>
                        <li class="nav-item mb-0 px-0 py-1 d-flex align-items-center justify-content-center" role="presentation">
                        <button class="nav-link " id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Documentación</button>
                        </li>
                        <li class="nav-item mb-0 px-0 py-1 d-flex align-items-center justify-content-center" role="presentation">
                            <button class="nav-link " id="pills-pagos-tab" data-bs-toggle="pill" data-bs-target="#pills-pagos" type="button" role="tab" aria-controls="pills-pagos" aria-selected="false">Pagos</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        </div>
    </div>

        <div class="tab-content " id="pills-tabContent" style="margin-top: 6rem">
            {{-- ==================== S E C C I O N  I N I C I O ==================== --}}
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                @include('cam.admin.expedientes.secciones_ind.seccion_inicio')
            </div>

            {{-- ==================== S E C C I O N  D O C U M E N T O S ==================== --}}
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                @include('cam.admin.expedientes.secciones_ind.seccion_documentos')
            </div>

            {{-- ==================== S E C C I O N  P A G O S ==================== --}}
            <div class="tab-pane fade" id="pills-pagos" role="tabpanel" aria-labelledby="pills-pagos-tab">
                @include('cam.admin.expedientes.seccion_pagos')
            </div>

        </div>

</div>

    <!-- Modal -->
  <div class="modal fade" id="modal_estatus" tabindex="-1" aria-labelledby="modal_estatusLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">


        <form method="POST" action="{{ route('estatus_expediente.update', $expediente->Nota->Cliente->id) }}" enctype="multipart/form-data" role="form">
            @csrf

            <input type="hidden" name="_method" value="PATCH">


            <div class="modal-header">
            <h1 class="modal-title fs-5" id="modal_estatusLabel">Cambiar Estatus</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body row">
            <div class="col-12 form-group">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">
                        <img src="{{ asset('assets\cam\gestion-del-cambio.png') }}" alt="" width="35px">
                    </span>
                    <select class="form-select" name="estatus_exp" id="estatus_exp">
                        <option value="">Selciona un opcion</option>
                        <option value="">Pendiente</option>
                        <option value="1">Listo para Evaluar</option>
                    </select>
                </div>
            </div>
            </div>

            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
            </div>

        </form>

      </div>
    </div>

  </div>

@endsection

@section('datatable')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('assets/admin/vendor/select2/dist/js/select2.min.js')}}"></script>
<script src="{{ asset('assets/admin/js/plugins/countup.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>

<script>
    $(document).ready(function() {
        // Escucha los cambios en los campos "portafolios" y "costo_emi"
        $('#portafolios, #costo_emi').on('input', function() {
            // Obtiene los valores de los campos
            var portafolios = parseFloat($('#portafolios').val()) || 0;
            var costo_emi = parseFloat($('#costo_emi').val()) || 0;

            // Calcula el producto
            var cantidad_total_emision = portafolios * costo_emi;

            // Muestra el resultado en el campo "cantidad_total_emision"
            $('#cantidad_total_emision').val(cantidad_total_emision.toFixed(2)); // Ajusta la cantidad de decimales según tus necesidades
        });
    });
</script>

<script>

    if (document.getElementById('state1')) {
      const countUp = new CountUp('state1', document.getElementById("state1").getAttribute("countTo"));
      if (!countUp.error) {
        countUp.start();
      } else {
        console.error(countUp.error);
      }
    }

    if (document.getElementById('state2')) {
      const countUp = new CountUp('state2', document.getElementById("state2").getAttribute("countTo"));
      if (!countUp.error) {
        countUp.start();
      } else {
        console.error(countUp.error);
      }
    }

    function mostrarArchivos(categoria, expedienteId) {
        // Oculta el formulario y vacía el contenedor de archivos
        $('#contenedorSubirArchivos').hide();
        $('#contenedorSubirArchivosCedula').hide();
        $('#contenedorArchivos').empty();

        // Limpia el contenedor de carpetas (estándares)
        $('#contenedorCarpetas').empty();

        if (categoria === 'estandares') {
            mostrarCarpetasCompradas(expedienteId);
        }

        $.ajax({
            url: '{{ route("obtener.archivos") }}', // Cambiar a la ruta correcta en tu aplicación
            method: 'GET',
            data: { categoria: categoria,  expediente_id: expedienteId },
            success: function(data) {
                var archivosHTML = '';

                if (data.length > 0) {
                    data.forEach(function(archivo) {
                        var extension = obtenerExtension(archivo.nombre);
                        var archivoURL = '{{ asset('cam_doc_general/') }}/' + archivo.nombre;


                            if (extension === 'pdf') {
                                archivosHTML += '<div class="archivo">';
                                archivosHTML += '<embed src="' + archivoURL + '" type="application/pdf" style="width: 120px; height: 120px;" />';
                                archivosHTML += '<a href="' + archivoURL + '" target="_blank">Abrir PDF</a>';
                                archivosHTML += '</div>';
                            } else if (extension === 'jpg' || extension === 'png' || extension === 'jpeg') {
                                archivosHTML += '<div class="archivo">';
                                archivosHTML += '<img src="' + archivoURL + '" alt="' + archivo.nombre + '" style="width: 100px; height: 100px;">';
                                archivosHTML += '<a href="' + archivoURL + '" target="_blank">Abrir Imagen</a>';
                                archivosHTML += '</div>';
                            } else {
                                archivosHTML += '<div class="archivo">' + archivo.nombre + '</div>';
                            }

                    });
                } else {
                    archivosHTML = '<p>No hay archivos disponibles.</p>';
                }

                $('#contenedorArchivos').html(archivosHTML);
            },
            error: function() {
                alert('Error al cargar los archivos.');
            }
        });

        if (categoria === 'certificado') {
            $('#contenedorSubirArchivos').show();
        }
        if (categoria === 'cedula') {
            $('#contenedorSubirArchivosCedula').show();
        }
    }

    function mostrarCarpetasCompradas(notaId) {
        $.ajax({
            url: '{{ route("obtener.carpetas", ["notaId" => $expediente->Nota->id]) }}',
            method: 'GET',
            success: function(data) {
                var carpetasHTML = '';

                data.forEach(function(carpeta, index) {
                    console.log('Nombre de Carpeta:', carpeta); // Agrega esta línea para verificar el nombre
                    carpetasHTML += '<div class="col-4">';
                    carpetasHTML += '<button class="btn btn-sm btnCarpeta" data-nombre_carpeta="' + carpeta + '">';
                    carpetasHTML += '<img src="{{ asset('assets/user/icons/folder.png') }}" class="img-fluid" style="width: 40%;">';
                    carpetasHTML += '<label for="">' + (index + 1) + '. ' + carpeta + '</label>';
                    carpetasHTML += '</button>';
                    carpetasHTML += '</div>';
                });


                $('#contenedorCarpetas').html(carpetasHTML);

                // Asignar evento de clic a los botones de carpeta
                $('.btnCarpeta').click(function() {
                    var nombreCarpeta = $(this).data('nombre_carpeta');
                    console.log(nombreCarpeta);
                    mostrarArchivosCarpetas(nombreCarpeta);
                });
            },
            error: function() {
                alert('Error al obtener las carpetas compradas.');
            }
        });
    }

    function mostrarArchivosCarpetas(nombreCarpeta) {
        $('#contenedorArchivos').empty();

        $.ajax({
            url: '{{ route("obtener.archivos.carp") }}',
            method: 'GET',
            data: { nombre_carpeta: nombreCarpeta },
            success: function(documentos) { // Cambia 'data' por 'documentos'
                var archivosHTML = '';

                if (documentos.length > 0) {
                    documentos.forEach(function(archivo) {
                        var extension = obtenerExtension(archivo.nombre);
                        var archivoURL = '{{ asset('cam_doc_general/') }}/' + archivo.nombre;

                        if (extension === 'pdf') {
                            archivosHTML += '<div class="archivo">';
                            archivosHTML += '<embed src="' + archivoURL + '" type="application/pdf" style="width: 120px; height: 120px;" />';
                            archivosHTML += '<a href="' + archivoURL + '" target="_blank">Abrir PDF</a>';
                            archivosHTML += '</div>';
                        } else if (extension === 'jpg' || extension === 'png' || extension === 'jpeg') {
                            archivosHTML += '<div class="archivo">';
                            archivosHTML += '<img src="' + archivoURL + '" alt="' + archivo.nombre + '" style="width: 100px; height: 100px;">';
                            archivosHTML += '<a href="' + archivoURL + '" target="_blank">Abrir Imagen</a>';
                            archivosHTML += '</div>';
                        } else {
                            archivosHTML += '<div class="archivo">' + archivo.nombre + '</div>';
                        }
                    });
                } else {
                    archivosHTML = '<p>No hay archivos disponibles.</p>';
                }

                $('#contenedorArchivos').html(archivosHTML);
            },
            error: function() {
                alert('Error al cargar los archivos de la carpeta.');
            }
        });
    }



    function obtenerExtension(nombreArchivo) {
        var partes = nombreArchivo.split('.');
        if (partes.length > 1) {
            return partes[partes.length - 1].toLowerCase();
        } else {
            return '';
        }
    }
</script>
@endsection
