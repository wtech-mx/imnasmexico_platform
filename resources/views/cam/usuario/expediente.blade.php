@extends('layouts.app_cam')

@section('template_title')
    {{$expediente->tipo}}
@endsection

@section('css_custom')
    <link href="{{asset('assets/cam/estilos/custom.css')}}" rel="stylesheet" />
@endsection

@section('content')

<section class="cam_bg_users">

    <div class="row">

        <div class="col-12 mb-5">
            <h1 class="text-center tittle_bold_cam">Expediente <br> {{$expediente->tipo}}: </h1> <h3 class="text-center tittle_border_cam">{{ auth()->user()->name }}</h3>
            <div class="d-flex justify-content-center">
                <a class="text-center btn btn-lg btn-outline-light " href="{{ route('cam.index', auth()->user()->code) }}">Regresar al inicio</a>
            </div>
        </div>

        <div class="container-fluid py-4">
            <div class="row mt-3">
                <div class="d-flex justify-content-center">

                    <div class="col-12 col-md-6 ">
                        <div class="card h-100">
                            <div class="card-header pb-0 p-3">
                                    <h4 class="mb-0">Carpetas</h4>
                            </div>
                            <div class="card-body p-2">
                                <div class="row">
                                    <div class="col-4">
                                        <button class="btn btn-sm" id="btnArchivos1" onclick="mostrarArchivos('1')">
                                            <img src="{{asset('assets/user/icons/manual.png')}}" class="img-fluid" style="width: 40%;">
                                            <p class="text-sm"> <br>1. Manuales Digitales CONOCER</p>
                                        </button>
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-sm" id="btnArchivos2" onclick="mostrarArchivos('2')">
                                            <img src="{{asset('assets/user/icons/information.png')}}" class="img-fluid" style="width: 40%;">
                                            <p class="text-sm">2. Reglamento Y Manuales De Procedimientos IMNAS</p>
                                        </button>
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-sm" id="btnArchivos2" onclick="mostrarArchivos('estandares', {{ $expediente->id }}); mostrarCarpetasCompradas({{ $expediente->id }})">
                                            <img src="{{asset('assets/user/icons/documentos.png')}}" class="img-fluid" style="width: 40%;">
                                            <p class="text-sm"> <br>3. Formatos Estándares</p>
                                        </button>
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-sm" id="btnArchivos2" onclick="mostrarArchivos('3')">
                                            <img src="{{asset('assets/user/logotipos/sepconocer.png')}}" class="img-fluid" style="width: 65%;">
                                            <p class="text-sm"><br>4. Logo Conocer Evaluador Independiente</p>
                                        </button>
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-sm" id="btnArchivos2" onclick="mostrarArchivos('certificado', {{ $expediente->id }})">
                                            <img src="{{asset('assets/user/icons/certificacion.webp')}}" class="img-fluid" style="width: 40%;">
                                            <p class="text-sm"><br>5. Certificados Conocer</p>
                                        </button>
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-sm" id="btnArchivos2" onclick="mostrarArchivos('cedula', {{ $expediente->id }})">
                                            <img src="{{asset('assets/user/icons/cedula.png')}}" class="img-fluid" style="width: 40%;">
                                            <p class="text-sm"><br>6. Cedulas De Acreditación</p>
                                        </button>
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-sm" id="btnArchivos3" onclick="mostrarArchivos('4')">
                                            <img src="{{asset('assets/user/icons/book.png')}}" class="img-fluid" style="width: 40%;">
                                            <p class="text-sm"><br>7. Formatos Resolucion De Quejas</p>
                                        </button>
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-sm" id="btnArchivos3" onclick="mostrarArchivos('diplomas', {{ $expediente->id }})">
                                            <img src="{{asset('assets/user/icons/consent.png')}}" class="img-fluid" style="width: 40%;">
                                            <p class="text-sm"><br>8. Diplomas extras</p>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 ">
                        <div class="card h-100">
                            <div class="card-header pb-0 p-3">
                                <div class="row">
                                    <div class="col-md-8 d-flex align-items-center">
                                        <h4 class="mb-0">Documentos en carpetas</h4>
                                        <div class="col-md-4 text-end">
                                            <a href="javascript:;">
                                            <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Agregar"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-3">
                                <div id="contenedorSubirArchivos" style="display: none;">
                                    <form method="POST" action="{{ route('crear.nomb') }}" enctype="multipart/form-data" role="form">
                                        @csrf
                                        <input type="hidden" id="categoria" name="categoria" value="certificados">
                                        <input id="foto[]" name="foto[]" type="file" class="form-control" multiple>
                                        <input id="id_nota" name="id_nota" type="number" value="{{ $expediente->id }}" style="display: none">
                                        <input id="id_cliente" name="id_cliente" type="number" value="{{ $expediente->id_cliente }}" style="display: none">
                                        <button type="submit" class="btn btn-sm mt-2" style="background: #6EC1E4; color: #ffff;">Guardar</button>
                                    </form>
                                </div>
                                <div id="contenedorSubirArchivosCedula" style="display: none;">
                                    <form method="POST" action="{{ route('crear.nomb') }}" enctype="multipart/form-data" role="form">
                                        @csrf
                                        <input type="hidden" id="categoria" name="categoria" value="cedula">
                                        <input id="foto[]" name="foto[]" type="file" class="form-control" multiple>
                                        <input id="id_nota" name="id_nota" type="number" value="{{ $expediente->id }}" style="display: none">
                                        <input id="id_cliente" name="id_cliente" type="number" value="{{ $expediente->id_cliente }}" style="display: none">
                                        <button type="submit" class="btn btn-sm mt-2" style="background: #6EC1E4; color: #ffff;">Guardar</button>
                                    </form>
                                </div>
                                <div id="contenedorSubirArchivosDiplomas" style="display: none;">
                                    <form method="POST" action="{{ route('crear.nomb') }}" enctype="multipart/form-data" role="form">
                                        @csrf
                                        <input type="hidden" id="categoria" name="categoria" value="diplomas">
                                        <input id="foto[]" name="foto[]" type="file" class="form-control" multiple>
                                        <input id="id_nota" name="id_nota" type="number" value="{{ $expediente->id }}" style="display: none">
                                        <input id="id_cliente" name="id_cliente" type="number" value="{{ $expediente->id_cliente }}" style="display: none">
                                        <button type="submit" class="btn btn-sm mt-2" style="background: #6EC1E4; color: #ffff;">Guardar</button>
                                    </form>
                                </div>
                                <div id="contenedorArchivos" ></div>

                                <div id="contenedorCarpetas" class="row"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

</section>



@endsection
@section('datatable')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('assets/admin/js/plugins/countup.min.js') }}"></script>



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
        if (categoria === 'diplomas') {
            $('#contenedorSubirArchivosDiplomas').show();
        }
    }

    function mostrarCarpetasCompradas(notaId) {
        $.ajax({
            url: '{{ route("obtener.carpetas", ["notaId" => $expediente->id]) }}',
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

