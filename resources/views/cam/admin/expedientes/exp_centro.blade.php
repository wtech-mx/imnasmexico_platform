@extends('layouts.app_admin')

@section('template_title')
Expediente {{$expediente->id}}
@endsection

@section('content')

<div class="container-fluid ">

    <form method="POST" action="{{ route('update_exp_user', $expediente->Nota->Cliente->id) }}" enctype="multipart/form-data" role="form">
        @csrf
        <input type="hidden" name="_method" value="PATCH">
            <div class="row mt-n2 mb-3">
                <div class="col-lg-8 col-12">
                    <div class="row">
                        <div class="col-lg-4 col-12">
                            @if ($expediente->Nota->Cliente->estatus_exp == '0' || $expediente->Nota->Cliente->estatus_exp == NULL)
                                <div class="card card-background card-background-mask-danger h-100">
                            @else
                                <div class="card card-background card-background-mask-success h-100">
                            @endif
                                <div class="full-background" style="background-image: url({{asset('assets/user/instalaciones/salon.jpg')}})"></div>
                                <div class="card-body pt-4 text-center">
                                    <h3 class="text-white mb-0">{{ $expediente->Nota->Cliente->num_user }}</h3>
                                    <h4 class="text-white">${{ $expediente->Nota->Cliente->costo_emi }}.00 mxn</h4>
                                    <span class="badge d-block bg-gradient-dark mb-2">{{ $expediente->Nota->Cliente->curp }}</span>
                                    @if ($expediente->Nota->Cliente->estatus_exp == '0' || $expediente->Nota->Cliente->estatus_exp == NULL)
                                        <h5 class="text-white mb-0">EN PROCESO. </h5>
                                    @else
                                        <h5 class="text-white mb-0">COMPLETO Y LISTO PARA LA OPERACIÓN. SE COMPARTÍO AL EVALUADOR INDEPENDIENTE TODOS LOS ARCHIVOS NECESARIOS PARA LA OPERACIÓN </h5>
                                    @endif
                                    {{-- <a href="javascript:;" class="btn btn-outline-white btn-sm px-5 mb-0">View more</a> --}}
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12 mt-4 mt-lg-0">
                            <div class="card">
                                <div class="card-body p-3">
                                <div class="d-flex">
                                    <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">No SEP</p>
                                    <input id="num_user" name="num_user" class="form-control" type="text" placeholder="numero usuario" value="{{ $expediente->Nota->Cliente->num_user }}">
                                    </div>
                                    <div class="icon icon-shape bg-gradient-dark text-center rounded-circle ms-auto">
                                    <i class="fa fa-id-card-o text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                                </div>
                            </div>

                            <div class="card mt-4">
                                <div class="card-body p-3">
                                <div class="d-flex">
                                    <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">User</p>
                                    <input id="usuario_eva" name="usuario_eva" class="form-control" type="text" value="{{ $expediente->Nota->Cliente->usuario_eva }}">
                                    </div>
                                    <div class="icon icon-shape bg-gradient-dark text-center rounded-circle ms-auto">
                                    <i class="fa fa-user text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12 mt-4 mt-lg-0">
                            <div class="card">
                                <div class="card-body p-3">
                                <div class="d-flex">
                                    <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Costo emisión</p>
                                    <input id="costo_emi" name="costo_emi" class="form-control" type="text" value="{{ $expediente->Nota->Cliente->costo_emi }}">
                                    </div>
                                    <div class="icon icon-shape bg-gradient-dark text-center rounded-circle ms-auto">
                                    <i class="fa fa-money text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                                </div>
                            </div>

                            <div class="card mt-4">
                                <div class="card-body p-3">
                                <div class="d-flex">
                                    <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Contraseña</p>
                                    <input id="contrasena_eva" name="contrasena_eva" class="form-control" type="text" value="{{ $expediente->Nota->Cliente->contrasena_eva }}">
                                    </div>
                                    <div class="icon icon-shape bg-gradient-dark text-center rounded-circle ms-auto">
                                    <i class="fa fa-key text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="card">

                        <div class="card-body p-3 pt-1 mt-2">
                            <h6>Inicio y fin de operaciones.</h6>
                                @php
                                    $fecha = $expediente->Nota->created_at;
                                    // Convertir a una marca de tiempo Unix
                                    $timestamp = strtotime($fecha);
                                    // Obtener la fecha con un año adicional
                                    $nueva_fecha_timestamp = strtotime('+1 year', $timestamp);
                                    // Formatear la fecha original
                                    $fecha_formateada = strftime('%e de %B del %Y', $timestamp);
                                    // Formatear la fecha con un año adicional
                                    $nueva_fecha_formateada = strftime('%e de %B del %Y', $nueva_fecha_timestamp);
                                    // Formatear la hora
                                    $hora_formateada = date('h:i A', $timestamp);
                                    // Combinar fecha y hora
                                    $fecha_hora_formateada = $fecha_formateada;
                                    // Combinar nueva fecha y hora (con un año adicional)
                                    $fecha_hora_fin = $nueva_fecha_formateada;
                                @endphp
                            <p class="text-sm">{{ $fecha_hora_formateada}}</p>
                            <p class="text-sm">{{ $fecha_hora_fin}}</p>

                            <span class="me-2 text-sm font-weight-bold text-capitalize">Progreso Videos</span>
                                @php
                                    $progress = 0;
                                    if ($video->check1 == NULL) {
                                        $progress = 0;
                                    }elseif ($video->check2 == NULL) {
                                        $progress = 10;
                                    }elseif ($video->check3 == NULL) {
                                        $progress = 20;
                                    }elseif ($video->check4 == NULL) {
                                        $progress = 30;
                                    }elseif ($video->check5 == NULL) {
                                        $progress = 40;
                                    }elseif ($video->check6 == NULL) {
                                        $progress = 50;
                                    }elseif ($video->check7 == NULL) {
                                        $progress = 60;
                                    }elseif ($video->check8 == NULL) {
                                        $progress = 70;
                                    }elseif ($video->check9 == NULL) {
                                        $progress = 80;
                                    }elseif ($video->check10 == NULL) {
                                        $progress = 90;
                                    }else {
                                        $progress = 100;
                                    }
                                @endphp
                                <span class="ms-auto text-sm font-weight-bold">{{ $progress }}%</span>
                            <div>
                                <div class="progress progress-md">
                                <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $progress }}%;"></div>
                                </div>
                            </div>

                            <div class="d-flex bg-gray-100 border-radius-lg p-3">
                                <button type="submit" class="btn btn-sm mt-2" style="background: #6EC1E4; color: #ffff;">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </form>

    <div class="card shadow-lg">
        <div class="card-body p-3">
        <div class="row gx-4">
            <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
                @if ($documentos->logo == NULL)
                    <img src="{{asset('assets/user/logotipos/sin-logo.jpg')}}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                @else
                    <img src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->logo)}}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                @endif
            </div>
            </div>
            <div class="col-auto my-auto">
            <div class="">
                <h3 class="mb-1">{{ $expediente->Nota->Cliente->num_user }}</h3>
                <h5 class="mb-0">
                    {{$expediente->Nota->Cliente->name}}
                </h5>
                <p class="mb-0 font-weight-bold text-sm">
                    {{$expediente->Nota->tipo}}
                </p>
            </div>
            </div>
            <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
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
        </div>


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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    function mostrarArchivos(categoria, expedienteId) {
        // Oculta el formulario y vacía el contenedor de archivos
        $('#contenedorSubirArchivos').hide();
        $('#contenedorArchivos').empty();

        // Establece el valor del campo "categoria" con la categoría seleccionada
        $('#categoria').val(categoria);

        // Limpia el contenedor de carpetas (estándares)
        $('#contenedorCarpetas').empty();

        if (categoria === 'estandares') {
            mostrarCarpetasCompradas(expedienteId);
        } else if (categoria === '11' || categoria === '12' || categoria === '13' || categoria === '14' || categoria === '15'  || categoria === '16'  || categoria === '17'  || categoria === '18'  || categoria === '19'  || categoria === '20') {
            // Muestra las imágenes o documentos con el número '2' en la columna 'tipo'
            mostrarArchivosSubidos(categoria);
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

    function mostrarArchivosSubidos(categoria) {
        console.log('Clic en mostrarArchivos: ' + categoria);
        // Oculta el formulario de carga y muestra el contenedor de archivos
        $('#formularioCarga').show();
        $('#contenedorArchivos').show();

        // Realiza una solicitud AJAX para obtener las imágenes o documentos con el número '2' en la columna 'tipo'
        $.ajax({
            url: '{{ route("obtener.docexp") }}', // Cambia a la ruta correcta en tu aplicación
            method: 'GET',
            data: { categoria: categoria },
            success: function (data) {
                var archivosHTML = '';

                if (data.length > 0) {
                    data.forEach(function(archivo) {
                        var extension = obtenerExtension(archivo.nombre);
                        var archivoURL = '{{ asset('cam_doc_exp/') }}/' + archivo.nombre;


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