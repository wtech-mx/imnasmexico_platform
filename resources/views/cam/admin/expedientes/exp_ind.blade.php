@extends('layouts.app_admin')

@section('template_title')
Expediente {{$expediente->id}}
@endsection

@section('content')

<div class="container-fluid ">

    <div class="card shadow-lg mb-5">
        <div class="card-body p-3">
        <div class="row gx-4">
            <div class="col-2 my-auto">
                <div class="avatar avatar-xl position-relative">
                    @if ($documentos->logo == NULL)
                        <img src="{{asset('assets/user/logotipos/sin-logo.jpg')}}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                    @else
                        <img src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->logo)}}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                    @endif
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
                        {{-- <li class="nav-item mb-0 px-0 py-1 d-flex align-items-center justify-content-center" role="presentation">
                        <button class="nav-link " id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Expedientes</button>
                        </li> --}}
                    </ul>
                </div>
            </div>
        </div>
        </div>
    </div>

    <form method="POST" action="{{ route('update_exp_user', $expediente->Nota->Cliente->id) }}" enctype="multipart/form-data" role="form">
        @csrf
        <input type="hidden" name="_method" value="PATCH">
            <div class="row mt-n2 mb-3">
                <div class="col-lg-8 col-12">
                    <div class="row">
                        <div class="col-lg-4 col-12">
                            @if ($expediente->Nota->Cliente->estatus_exp == '0' || $expediente->Nota->Cliente->estatus_exp == NULL)
                                <div class="card card-background card-background-mask-danger">
                            @else
                                <div class="card card-background card-background-mask-success">
                            @endif
                                <div class="full-background" style="background-image: url({{asset('assets/user/instalaciones/salon.jpg')}})"></div>
                                <div class="card-body pt-4 text-center">

                                    <p class="text-white mb-0"><strong>Clave evaluador:</strong><br>
                                        {{ $expediente->Nota->Cliente->num_user }}
                                    </p>
                                    <p class="text-white">
                                        <strong>Costo emisión:</strong><br>
                                        ${{ $expediente->Nota->Cliente->costo_emi }}.00 mxn
                                    </p>
                                    <span class="badge d-block bg-gradient-dark mb-2">
                                        <strong>CURP:</strong><br>
                                        {{ $expediente->Nota->Cliente->curp }}
                                    </span>
                                    @if ($expediente->Nota->Cliente->estatus_exp == '0' || $expediente->Nota->Cliente->estatus_exp == NULL)
                                        <p class="text-white mb-0">
                                            EN PROCESO.
                                        </p>
                                    @else
                                        <p class="text-white mb-0">
                                            COMPLETO Y LISTO PARA LA OPERACIÓN. SE COMPARTÍO AL EVALUADOR INDEPENDIENTE TODOS LOS ARCHIVOS NECESARIOS PARA LA OPERACIÓN
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12 mt-4 mt-lg-0">
                            <div class="form-group">
                                <label for="name" >Clave evaluador</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets\user\icons\letter.png') }}" alt="" width="35px">
                                    </span>
                                    <input id="num_user" name="num_user" class="form-control" type="text" placeholder="numero usuario" value="{{ $expediente->Nota->Cliente->num_user }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" >Usuario SII</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets\cam\nombre.png') }}" alt="" width="35px">
                                    </span>
                                    <input id="usuario_eva" name="usuario_eva" class="form-control" type="text" value="{{ $expediente->Nota->Cliente->usuario_eva }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12 mt-4 mt-lg-0">

                            <div class="form-group">
                                <label for="name" >Costo emisión</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets\user\icons\bolsa-de-dinero.png') }}" alt="" width="35px">
                                    </span>
                                    <input id="costo_emi" name="costo_emi" class="form-control" type="text" value="{{ $expediente->Nota->Cliente->costo_emi }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" >Contraseña SII</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets\user\icons\password.png') }}" alt="" width="35px">
                                    </span>
                                    <input id="contrasena_eva" name="contrasena_eva" class="form-control" type="text" value="{{ $expediente->Nota->Cliente->contrasena_eva }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-sm mt-2" style="background: #6EC1E4; color: #ffff;">Guardar</button>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="card">

                        <div class="card-body p-3 pt-1 mt-2">
                            <h6 class="text-success">Inicio de operaciones.</h6>
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
                            <h6 class="text-danger">Fin de Operaciones</h6>
                            <p class="text-sm">{{ $fecha_hora_fin}}</p>

                        </div>
                    </div>
                </div>

                <div class="col-8">
                    <div class="card">
                        <div class="card-body p-3 pt-1 mt-2">
                            <h6 class="text-dark mb-3">Progreso de Videos</h6>
                            <div class="row">
                                @foreach ($videos_dinamicos as $item)
                                    <div class="col-3">
                                        @if ($item->orden == 1 || ($video->{"check" . ($item->orden - 1)} !== null && $video->{"check" . ($item->orden - 1)} !== ""))

                                        <p class="text-sm text-center">{{ $item->orden }}- {{ $item->nombre }}</p>
                                        <p  class="text-center">
                                            <img src="{{ asset('assets\cam\loading.png') }}" alt="" width="35">
                                        </p>
                                        @else
                                        <p class="text-sm text-center">Aun no has visto el video anterior</p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>

                                <span class="ms-auto text-sm font-weight-bold">%</span>
                            <div>
                                <div class="progress progress-md">
                                <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: %;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card h-100">
                        <div class="card-header pb-0 p-3">
                                <h6 class="mb-0">Información {{$expediente->Nota->tipo}}</h6>
                        </div>
                        <div class="card-body p-3">
                            <p class="text-sm">
                                {{$expediente->Nota->nota}}
                            </p>
                            <hr class="horizontal gray-light my-2">
                            <ul class="list-group">
                            <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Nombre:</strong> &nbsp; {{$expediente->Nota->Cliente->name}}</li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Celular:</strong> &nbsp; {{$expediente->Nota->Cliente->telefono}}</li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Correo:</strong> &nbsp; {{$expediente->Nota->Cliente->email}}</li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Referencia:</strong> &nbsp; {{$expediente->Nota->referencia}}</li>
                            <li class="list-group-item border-0 ps-0 pb-0">
                                <strong class="text-dark text-sm">Social:</strong> &nbsp;
                                <a class="btn btn-facebook btn-simple mb-0 ps-1 pe-1 py-0" href="https://www.facebook.com/{{$expediente->Nota->Cliente->facebook}}" target="_blank">
                                <i class="fab fa-facebook fa-lg"></i>
                                </a>
                                <a class="btn btn-twitter btn-simple mb-0 ps-1 pe-1 py-0" href="https://www.tiktok.com/{{$expediente->Nota->Cliente->tiktok}}" target="_blank">
                                <i class="fab fa-tiktok fa-lg"></i>
                                </a>
                                <a class="btn btn-instagram btn-simple mb-0 ps-1 pe-1 py-0" href="https://www.instagram.com/{{$expediente->Nota->Cliente->instagram}}" target="_blank">
                                <i class="fab fa-instagram fa-lg"></i>
                                </a>
                                <a class="btn btn-twitter btn-simple mb-0 ps-1 pe-1 py-0" href="https://{{$expediente->Nota->Cliente->pagina_web}}" target="_blank">
                                    <i class="fa fa-globe fa-lg"></i>
                                </a>
                                <a class="btn btn-instagram btn-simple mb-0 ps-1 pe-1 py-0" href="https://{{$expediente->Nota->Cliente->otra_red}}" target="_blank">
                                    <i class="fa fa-heart fa-lg"></i>
                                </a>
                            </li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
    </form>


        <div class="tab-content" id="pills-tabContent">
            {{-- ==================== S E C C I O N  I N I C I O ==================== --}}
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                @include('cam.admin.expedientes.secciones_ind.seccion_inicio')
            </div>

            {{-- ==================== S E C C I O N  D O C U M E N T O S ==================== --}}
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                @include('cam.admin.expedientes.secciones_ind.seccion_documentos')
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
