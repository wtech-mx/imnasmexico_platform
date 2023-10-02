@extends('layouts.app_cam')

@section('template_title')
    Evaluador independiente
@endsection

@section('css_custom')
    <link href="{{asset('assets/cam/estilos/custom.css')}}" rel="stylesheet" />
@endsection

@section('content')

<section class="cam_bg_users">

    <div class="row">

        <div class="col-12 mb-5">
            <h1 class="text-center tittle_bold_cam">Expediente <br> Evaluador independiente: </h1> <h3 class="text-center tittle_border_cam">{{ auth()->user()->name }}</h3>
            <div class="d-flex justify-content-center">
                <a class="text-center btn btn-lg btn-outline-light " href="{{ route('cam.index', auth()->user()->code) }}">Regresar al inicio</a>
            </div>
        </div>

        <div class="container-fluid py-4">
            <div class="row mt-3">
                <div class="d-flex justify-content-center">

                    <div class="col-12 col-sm-6 col-md-6 col-lg-6 p-5">
                        <div class="card h-100">
                            <div class="card-header p-3">
                                    <h6 class="mb-0">Carpetas</h6>
                            </div>
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-4">
                                        <button class="btn btn-sm" id="btnArchivos1" onclick="mostrarArchivos('7')">
                                            <img src="{{asset('assets/user/icons/manual.png')}}" class="img-fluid" style="width: 40%;"> <br> <br>
                                            <p class="text-center">1. Manuales Digitales CONOCER</p>
                                        </button>
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-sm" id="btnArchivos2" onclick="mostrarArchivos('8')">
                                            <img src="{{asset('assets/user/icons/information.png')}}" class="img-fluid" style="width: 40%;"> <br> <br>
                                            <p class="text-center">2. Reglamento Y Manuales De Procedimientos IMNAS</p>
                                        </button>
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-sm" id="btnArchivos2" onclick="mostrarArchivos('estandares', {{ $expediente->id }}); mostrarCarpetasCompradas({{ $expediente->id }})">
                                            <img src="{{asset('assets/user/icons/documentos.png')}}" class="img-fluid" style="width: 40%;"> <br> <br>
                                            <p class="text-center">3. Formatos Estándares</p>
                                        </button>
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-sm" id="btnArchivos2" onclick="mostrarArchivos('10')">
                                            <img src="{{asset('assets/user/icons/illustrator.png')}}" class="img-fluid" style="width: 40%;"> <br> <br>
                                            <p class="text-center">4. Logo Conocer Evaluador Independiente</p>
                                        </button>
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-sm" id="btnArchivos2" onclick="mostrarArchivos('certificado', {{ $expediente->id }})">
                                            <img src="{{asset('assets/user/icons/certificacion.webp')}}" class="img-fluid" style="width: 40%;"> <br> <br>
                                            <p class="text-center">5. Certificados Conocer</p>
                                        </button>
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-sm" id="btnArchivos2" onclick="mostrarArchivos('cedula', {{ $expediente->id }})">
                                            <img src="{{asset('assets/user/icons/cedula.png')}}" class="img-fluid" style="width: 40%;"> <br> <br>
                                            <p class="text-center">6. Cedulas De Acreditación</p>
                                        </button>
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-sm" id="btnArchivos2" onclick="mostrarArchivos('nombramiento', {{ $expediente->id }})">
                                            <img src="{{asset('assets/user/icons/certificate.png')}}" class="img-fluid" style="width: 40%;"> <br> <br>
                                            <p class="text-center">7. Nombramiento</p>
                                        </button>
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-sm" id="btnArchivos3" onclick="mostrarArchivos('9')">
                                            <img src="{{asset('assets/user/icons/book.png')}}" class="img-fluid" style="width: 40%;"> <br> <br>
                                            <p class="text-center">8. Formatos Resolucion De Quejas</p>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-6 col-lg-6 p-5">
                        <div class="card h-100">
                            <div class="card-header p-3">
                                <div class="row">
                                    <div class="col-md-8 d-flex align-items-center">
                                        <h6 class="mb-0">Documentos</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-3">

                                {{-- <div id="contenedorSubirArchivos" style="display: none;">
                                    <form method="POST" action="{{ route('crear.nomb') }}" enctype="multipart/form-data" role="form">
                                        @csrf
                                        <input id="foto[]" name="foto[]" type="file" class="form-control" multiple>
                                        <input id="id_nota" name="id_nota" type="number" value="{{ $expediente->id }}" style="display: none">
                                        <input id="id_cliente" name="id_cliente" type="number" value="{{ auth()->user()->id }}" style="display: none">
                                        <button type="submit" class="btn btn-sm" style="background: #6EC1E4; color: #ffff;">Guardar</button>
                                    </form>
                                </div> --}}

                                <div id="contenedorSubirCertificados" style="display: none;">
                                    <form method="POST" action="{{ route('evaluador.crear.certificados') }}" enctype="multipart/form-data" role="form">
                                        @csrf
                                        <input id="foto[]" name="foto[]" type="file" class="form-control" multiple>
                                        <input id="id_nota" name="id_nota" type="number" value="{{ $expediente->id }}" style="display: none">
                                        <input id="id_cliente" name="id_cliente" type="number" value="{{ auth()->user()->id }}" style="display: none">
                                        <button type="submit" class="btn btn-sm mt-3" style="background: #6EC1E4; color: #ffff;">Guardar</button>
                                    </form>
                                </div>

                                <div id="contenedorSubirCedulas" style="display: none;">
                                    <form method="POST" action="{{ route('evaluador.crear.cedulas') }}" enctype="multipart/form-data" role="form">
                                        @csrf
                                        <input id="foto[]" name="foto[]" type="file" class="form-control" multiple>
                                        <input id="id_nota" name="id_nota" type="number" value="{{ $expediente->id }}" style="display: none">
                                        <input id="id_cliente" name="id_cliente" type="number" value="{{ auth()->user()->id }}" style="display: none">
                                        <button type="submit" class="btn btn-sm mt-3" style="background: #6EC1E4; color: #ffff;">Guardar</button>
                                    </form>
                                </div>

                                <div id="contenedorArchivos" ></div>

                                <div id="contenedorCarpetas"></div>
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
    <script>
        function mostrarArchivos(categoria, expedienteId) {
            // Oculta el formulario y vacía el contenedor de archivos
            $('#contenedorSubirArchivos').hide();
            $('#contenedorSubirCertificados').hide();
            $('#contenedorSubirCedulas').hide();
            $('#contenedorArchivos').empty();

            // Limpia el contenedor de carpetas (estándares)
            $('#contenedorCarpetas').empty();

            if (categoria === 'estandares') {
                mostrarCarpetasCompradas(expedienteId);
            }

            $.ajax({
                url: '{{ route("evaluador.obtener.archivos") }}', // Cambiar a la ruta correcta en tu aplicación
                method: 'GET',
                data: { categoria: categoria,  expediente_id: expedienteId },
                success: function(data) {
                    var archivosHTML = '';

                    if (data.length > 0) {
                        archivosHTML += '<div class="row">'; // Inicia una fila Bootstrap
                        data.forEach(function(archivo) {
                            var extension = obtenerExtension(archivo.nombre);
                            var archivoURL = '{{ asset('cam_doc_general/') }}/' + archivo.nombre;

                                archivosHTML += '<div class="col-6 p-2">'; // Define las columnas (ajusta según tus necesidades)
                                if (extension === 'pdf') {
                                    archivosHTML += '<div class="archivo">';
                                    archivosHTML += '<embed src="' + archivoURL + '" type="application/pdf" style="width: 140px; height: 140px;" /><br>';
                                    archivosHTML += '<a class="text-center" href="' + archivoURL + '" target="_blank">Abrir PDF</a>';
                                    archivosHTML += '</div>';
                                } else if (extension === 'jpg' || extension === 'png' || extension === 'jpeg') {
                                    archivosHTML += '<div class="archivo">';
                                    archivosHTML += '<img src="' + archivoURL + '" alt="' + archivo.nombre + '" style="width: 100px; height: 100px;"><br>';
                                    archivosHTML += '<a class="text-center" href="' + archivoURL + '" target="_blank">Abrir Imagen</a>';
                                    archivosHTML += '</div>';
                                } else {
                                    archivosHTML += '<div class="archivo">' + archivo.nombre + '</div>';
                                }

                            archivosHTML += '</div>'; // Cierra la columna

                        });
                        archivosHTML += '</div>'; // Cierra la fila
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

            if (categoria === 'certificado') {
                $('#contenedorSubirCertificados').show();
            }

            if (categoria === 'cedula') {
                $('#contenedorSubirCedulas').show();
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
                        carpetasHTML += '<div class="col-6">';
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
        success: function(documentos) {
            var archivosHTML = '';

            if (documentos.length > 0) {
                archivosHTML += '<div class="row">'; // Inicia una fila Bootstrap

                documentos.forEach(function(archivo) {
                    var extension = obtenerExtension(archivo.nombre);
                    var archivoURL = '{{ asset('cam_doc_general/') }}/' + archivo.nombre;

                    archivosHTML += '<div class="col-6 p-2">'; // Define las columnas (ajusta según tus necesidades)

                    if (extension === 'pdf') {
                        archivosHTML += '<embed src="' + archivoURL + '" type="application/pdf" style="width: 140px; height: 140px;" /><br>';
                        archivosHTML += '<a class="text-center mt-1" href="' + archivoURL + '" target="_blank">Abrir PDF</a>';
                    } else if (extension === 'jpg' || extension === 'png' || extension === 'jpeg') {
                        archivosHTML += '<img src="' + archivoURL + '" alt="' + archivo.nombre + '" style="width: 100px; height: 100px;"><br>';
                        archivosHTML += '<a class="text-center mt-3 mb3" href="' + archivoURL + '" target="_blank">Abrir Imagen</a>';
                    } else {
                        archivosHTML += archivo.nombre;
                    }

                    archivosHTML += '</div>'; // Cierra la columna
                });

                archivosHTML += '</div>'; // Cierra la fila
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

