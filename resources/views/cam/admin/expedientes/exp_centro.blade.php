@extends('layouts.app_admin')

@section('template_title')
Expediente {{$expediente->id}}
@endsection

@section('content')

<div class="container-fluid ">
    @php
    $fecha = $expediente->Nota->fecha_concluyo; // Suponiendo que $fecha es una cadena en formato 'Y-m-d'

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
    <div class="card shadow-lg mb-3">
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
                        <strong>Clave centro evaluador:</strong><br>
                        {{ $expediente->Nota->Cliente->num_user }}
                    </p>
                    @if ($expediente->Nota->Cliente->nomb_centro == NULL)
                        <h5 class="mb-0">{{ $expediente->Nota->Cliente->num_user }}</h5>
                    @else
                        <h5 class="mb-0">{{ $expediente->Nota->Cliente->nomb_centro }}</h5>
                    @endif
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
                        <button class="nav-link " id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Expedientes</button>
                        </li>
                        <li class="nav-item mb-0 px-0 py-1 d-flex align-items-center justify-content-center" role="presentation">
                            <button class="nav-link " id="pills-pagos-tab" data-bs-toggle="pill" data-bs-target="#pills-pagos" type="button" role="tab" aria-controls="pills-pagos" aria-selected="false">Pagos</button>
                        </li>
                        <li class="nav-item mb-0 px-0 py-1 d-flex align-items-center justify-content-center" role="presentation">
                            <button class="nav-link " id="pills-info-tab" data-bs-toggle="pill" data-bs-target="#pills-info" type="button" role="tab" aria-controls="pills-info" aria-selected="false">Info Personal</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        </div>
    </div>

        <div class="tab-content" id="pills-tabContent">
            {{-- ==================== S E C C I O N  I N I C I O ==================== --}}
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                @include('cam.admin.expedientes.secciones_centro.seccion_inicio')
            </div>

            {{-- ==================== S E C C I O N  D O C U M E N T O S ==================== --}}
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                @include('cam.admin.expedientes.secciones_centro.seccion_documentos')
            </div>

            {{-- ==================== S E C C I O N  E X P E D I E N T E S ==================== --}}
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                @include('cam.admin.expedientes.secciones_centro.seccion_expedientes')
            </div>

            {{-- ==================== S E C C I O N  P A G O S ==================== --}}
            <div class="tab-pane fade" id="pills-pagos" role="tabpanel" aria-labelledby="pills-pagos-tab">
                @include('cam.admin.expedientes.seccion_pagos')
            </div>

            {{-- ==================== S E C C I O N  I N F O ==================== --}}
            <div class="tab-pane fade" id="pills-info" role="tabpanel" aria-labelledby="pills-info-tab">
                @include('cam.admin.expedientes.info')
            </div>
        </div>
        @include('cam.admin.expedientes.modal_estatus_expediente')

        <div class="row mt-4">
            <div class="col-12">
                <div class="card mb-4">
                <div class="card-header pb-0 p-3">
                    <h6 class="mb-1">Expedientes Evaluadores</h6>
                </div>
                <div class="card-body p-3">
                    <div class="row">
                        @foreach ($minis_exps->take(3) as $mini_exp)
                            <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                                <div class="card card-blog card-plain">
                                <div class="position-relative">
                                    <a class="d-block shadow-xl border-radius-xl">
                                        @if ($documentos->logo == NULL)
                                            <img src="{{asset('assets/user/logotipos/sin-logo.jpg')}}" alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
                                        @else
                                            <img src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->logo)}}" alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
                                        @endif
                                    </a>
                                </div>
                                <div class="card-body px-1 pb-0">
                                    <p class="text-gradient text-dark mb-2 text-sm">Expediente #{{ $loop->iteration }}</p>
                                    <a href="javascript:;">
                                    <h5>
                                        {{ $mini_exp->nombre }} {{ $mini_exp->apellido }}
                                    </h5>
                                    </a>
                                    <p class="mb-4 text-sm">
                                        {{ $mini_exp->email }} <br> {{ $mini_exp->celular }}
                                    </p>
                                    <div class="d-flex align-items-center justify-content-between">
                                    <a type="button" class="btn btn-outline-primary btn-sm mb-0" href="{{ route('edit.mini_exp', $mini_exp->id) }}">Ver Expediente</a>
                                    <div class="avatar-group mt-2">
                                        @if ($mini_exp->acta != NULL)
                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Acta de Nacimiento">
                                                <img alt="Image placeholder" src="{{asset('assets/user/icons/cheque-de-pago.png')}}">
                                            </a>
                                        @endif
                                        @if ($mini_exp->curp != NULL)
                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="CURP">
                                            <img alt="Image placeholder" src="{{asset('assets/user/icons/cedula.png')}}">
                                            </a>
                                        @endif
                                        @if ($mini_exp->ine != NULL)
                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="INE">
                                            <img alt="Image placeholder" src="{{asset('assets/user/icons/flag.png')}}">
                                            </a>
                                        @endif
                                        @if ($mini_exp->comprobante != NULL)
                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Comprobante de domicilio">
                                            <img alt="Image placeholder" src="{{asset('assets/user/icons/location-pointer.png')}}">
                                            </a>
                                        @endif
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                            <div class="card h-100 card-plain border">
                                <div class="card-body d-flex flex-column justify-content-center text-center">
                                    <a data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="fa fa-plus text-secondary mb-3"></i>
                                    <h5 class=" text-secondary"> Nuevo Expediente </h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @include('cam.admin.expedientes.modal_nuevo_expediente')
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
        $('#formularioCarga').hide();
        $('#contenedorArchivos').empty();
        //const notaId = {{ $expediente->Nota->id }};
        // Establece el valor del campo "categoria" con la categoría seleccionada
        $('#categoria').val(categoria);
        console.log('Clicfdg: ' + expedienteId);
        // Limpia el contenedor de carpetas (estándares)
        $('#contenedorCarpetas').empty();

        if (categoria === 'estandares') {
            mostrarCarpetasCompradas(expedienteId);
        } else if (categoria === 'cedula' || categoria === '11' || categoria === '12' || categoria === '13' || categoria === '14' || categoria === '15'  || categoria === '16'  || categoria === '17'  || categoria === '18'  || categoria === '19'  || categoria === '20') {
            // Muestra las imágenes o documentos con el número '2' en la columna 'tipo'
            mostrarArchivosSubidos(categoria, expedienteId);
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


                            if (extension === 'pdf' ) {
                                archivosHTML += '<div class="archivo">';
                                archivosHTML += '<embed src="' + archivoURL + '" type="application/pdf" style="width: 120px; height: 120px;" />';
                                archivosHTML += '<a href="' + archivoURL + '" target="_blank">Abrir PDF</a>';
                                archivosHTML += '</div>';
                            } else if (extension === 'jpg' || extension === 'png' || extension === 'jpeg') {
                                archivosHTML += '<div class="archivo">';
                                archivosHTML += '<img src="' + archivoURL + '" alt="' + archivo.nombre + '" style="width: 100px; height: 100px;">';
                                archivosHTML += '<a href="' + archivoURL + '" target="_blank">Abrir Imagen</a>';
                                archivosHTML += '</div>';
                            }else if (extension === 'docx') {
                                archivosHTML += '<div class="archivo">';
                                archivosHTML += '<a href="' + archivoURL + '" target="_blank">Abrir Documento</a>';
                                archivosHTML += '</div>';
                            }else if (extension === 'pptx') {
                                archivosHTML += '<div class="archivo">';
                                archivosHTML += '<a href="' + archivoURL + '" target="_blank">Abrir Presentacion</a>';
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

        if (categoria === 'nombramiento') {
            $('#contenedorSubirArchivos').show();
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
                        }else if (extension === 'docx') {
                                archivosHTML += '<div class="archivo">';
                                archivosHTML += '<a href="' + archivoURL + '" target="_blank">Abrir Documento</a>';
                                archivosHTML += '</div>';
                            }else if (extension === 'pptx') {
                                archivosHTML += '<div class="archivo">';
                                archivosHTML += '<a href="' + archivoURL + '" target="_blank">Abrir Presentacion</a>';
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

    function mostrarArchivosSubidos(categoria, expedienteId) {
        console.log('Clic en mostrarArchivos: ' + categoria);
        console.log('Clic: ' + expedienteId);
        // Oculta el formulario de carga y muestra el contenedor de archivos
        $('#formularioCarga').show();
        $('#contenedorArchivos').show();

        // Realiza una solicitud AJAX para obtener las imágenes o documentos con el número '2' en la columna 'tipo'
        $.ajax({
            url: '{{ route("obtener.docexp") }}', // Cambia a la ruta correcta en tu aplicación
            method: 'GET',
            data: { categoria: categoria,  expediente_id: expedienteId },
            success: function (data) {
                var archivosHTML = '';
                $('#contenedorArchivos').empty();
                if (data.length > 0) {
                    data.forEach(function(archivo) {
                        var extension = obtenerExtension(archivo.nombre);
                        var archivoURL = '{{ asset('cam_doc_exp/') }}/' + archivo.nombre;


                            if (extension === 'pdf' ) {
                                archivosHTML += '<div class="archivo">';
                                archivosHTML += '<embed src="' + archivoURL + '" type="application/pdf" style="width: 120px; height: 120px;" />';
                                archivosHTML += '<a href="' + archivoURL + '" target="_blank">Abrir PDF</a>';
                                archivosHTML += '</div>';
                            } else if (extension === 'jpg' || extension === 'png' || extension === 'jpeg') {
                                archivosHTML += '<div class="archivo">';
                                archivosHTML += '<img src="' + archivoURL + '" alt="' + archivo.nombre + '" style="width: 100px; height: 100px;">';
                                archivosHTML += '<a href="' + archivoURL + '" target="_blank">Abrir Imagen</a>';
                                archivosHTML += '</div>';
                            }else if (extension === 'docx') {
                                archivosHTML += '<div class="archivo">';
                                archivosHTML += '<a href="' + archivoURL + '" target="_blank">Abrir Documento</a>';
                                archivosHTML += '</div>';
                            }else if (extension === 'pptx') {
                                archivosHTML += '<div class="archivo">';
                                archivosHTML += '<a href="' + archivoURL + '" target="_blank">Abrir Presentacion</a>';
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
            error: function () {
                alert('Error al cargar los archivos.');
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
