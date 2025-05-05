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
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <h1 class="text-center tittle_bold_cam">Expediente <br> {{$expediente->tipo}}: </h1> <h3 class="text-center tittle_border_cam">{{ auth()->user()->name }}</h3>
            <div class="d-flex justify-content-center">
                <a class="text-center btn btn-lg btn-outline-light " href="{{ route('cam.index', auth()->user()->code) }}">Regresar al inicio</a>
            </div>
        </div>

        <div class="container-fluid py-4">
            <div class="row mt-3">
                <div class="d-flex justify-content-center">

                    <div class="col-12 col-md-6 ">
                        <div class="card ">
                            <div class="card-header pb-0 p-3">
                                    <h4 class="mb-0">Carpetas</h4>
                            </div>
                            <div class="card-body p-2">
                                <div class="row">
                                    <div class="col-4">
                                        <button class="btn btn-sm" id="btnArchivos1" onclick="mostrarArchivos('1', {{ $expediente->id }})">
                                            <img src="{{asset('assets/user/icons/manual.png')}}" class="img-fluid" style="width: 10%;">
                                            <p for=""><br>1. Manuales Digitales CONOCER</p>
                                        </button>
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-sm" id="btnArchivos2" onclick="mostrarArchivos('11', {{ $expediente->id }})">
                                            <img src="{{asset('assets/user/icons/information.png')}}" class="img-fluid" style="width: 10%;">
                                            <p for="">2. Reglamento Y Manuales De Procedimientos D_N Servicios</p>
                                        </button>
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-sm" id="btnArchivos2" onclick="mostrarArchivos('estandares', {{ $expediente->id }}); mostrarCarpetasCompradas({{ $expediente->id }})">
                                            <img src="{{asset('assets/user/icons/documentos.png')}}" class="img-fluid" style="width: 10%;">
                                            <p for=""><br>3. Formatos Estándares</p>
                                        </button>
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-sm" id="btnArchivos2" onclick="mostrarArchivos('3', {{ $expediente->id }})">
                                            <img src="{{asset('assets/user/logotipos/sepconocer.png')}}" class="img-fluid" style="width: 20%;">
                                            <p for=""><br>4. Logo Conocer Centro de Evaluación</p>
                                        </button>
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-sm" id="btnArchivos3" onclick="mostrarArchivos('4', {{ $expediente->id }})">
                                            <img src="{{asset('assets/user/icons/book.png')}}" class="img-fluid" style="width: 10%;">
                                            <p for=""><br>5. Formatos Resolucion De Quejas</p>
                                        </button>
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-sm" id="btnArchivos2" onclick="mostrarArchivos('cedula', {{ $expediente->id }})">
                                            <img src="{{asset('assets/user/icons/cedula.png')}}" class="img-fluid" style="width: 10%;">
                                            <p for="">6. Cedulas De Acreditación</p>
                                        </button>
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-sm" id="btnArchivos2" onclick="mostrarArchivos('5', {{ $expediente->id }})">
                                            <img src="{{asset('assets/user/icons/aprender-en-linea.webp')}}" class="img-fluid" style="width: 10%;">
                                            <p for=""><br>Acreditación CE o EI</p>
                                        </button>
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-sm" id="btnArchivos2" onclick="mostrarArchivos('12', {{ $expediente->id }})">
                                            <img src="{{asset('assets/user/icons/cheque-de-pago.png')}}" class="img-fluid" style="width: 10%;">
                                            <p for=""><br>Acta Constitutiva</p>
                                        </button>
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-sm" id="btnArchivos2" onclick="mostrarArchivos('13', {{ $expediente->id }})">
                                            <img src="{{asset('assets/user/icons/picture.png')}}" class="img-fluid" style="width: 10%;">
                                            <p for=""><br>Caratulas</p>
                                        </button>
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-sm" id="btnArchivos2" onclick="mostrarArchivos('15', {{ $expediente->id }})">
                                            <img src="{{asset('assets/user/icons/monetary-policy.png')}}" class="img-fluid" style="width: 10%;">
                                            <p for=""><br>Constancia de situacion fiscal</p>
                                        </button>
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-sm" id="btnArchivos2" onclick="mostrarArchivos('16', {{ $expediente->id }})">
                                            <img src="{{asset('assets/user/icons/contract.png')}}" class="img-fluid" style="width: 10%;">
                                            <p for=""><br>Contrato de arrendamiento</p>
                                        </button>
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-sm" id="btnArchivos2" onclick="mostrarArchivos('17', {{ $expediente->id }})">
                                            <img src="{{asset('assets/user/icons/satisfaction.png')}}" class="img-fluid" style="width: 10%;">
                                            <p for=""><br>Encuestas de Calidad</p>
                                        </button>
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-sm" id="btnArchivos2" onclick="mostrarArchivos('18', {{ $expediente->id }})">
                                            <img src="{{asset('assets/user/icons/stamp.png')}}" class="img-fluid" style="width: 10%;">
                                            <p for=""><br>Formato Sol. de acreditación</p>
                                        </button>
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-sm" id="btnArchivos2" onclick="mostrarArchivos('6', {{ $expediente->id }})">
                                            <img src="{{asset('assets/user/icons/perfil.png')}}" class="img-fluid" style="width: 10%;">
                                            <p for=""><br>Especificaciónes Fotografia</p>
                                        </button>
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-sm" id="btnArchivos2" onclick="mostrarArchivos('7', {{ $expediente->id }})">
                                            <img src="{{asset('assets/user/icons/aprender-en-linea-1.webp')}}" class="img-fluid" style="width: 10%;">
                                            <p for=""><br> Operación CE</p>
                                        </button>
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-sm" id="btnArchivos2" onclick="mostrarArchivos('8', {{ $expediente->id }})">
                                            <img src="{{asset('assets/user/icons/clase.webp')}}" class="img-fluid" style="width: 10%;">
                                            <p for=""><br> Presentación</p>
                                        </button>
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-sm" id="btnArchivos2" onclick="mostrarArchivos('20', {{ $expediente->id }})">
                                            <img src="{{asset('assets/user/icons/certificacion.webp')}}" class="img-fluid" style="width: 10%;">
                                            <p for=""><br> Solicitud de acreditación</p>
                                        </button>
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-sm" id="btnArchivos2" onclick="mostrarArchivos('9', {{ $expediente->id }})">
                                            <img src="{{asset('assets/user/icons/consent.png')}}" class="img-fluid" style="width: 10%;"><br>
                                            <p for=""><br>Triptico</p>
                                        </button>
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-sm" id="btnArchivos2" onclick="mostrarArchivos('10', {{ $expediente->id }})">
                                            <img src="{{asset('assets/user/icons/stack-of-books.png')}}" class="img-fluid" style="width: 10%;">
                                            <p for=""><br>Tutoriales de apoyo</p>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 ">
                        <div class="card ">
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
                                        <input id="foto[]" name="foto[]" type="file" class="form-control" multiple>
                                        <input id="id_nota" name="id_nota" type="number" value="{{ $expediente->id }}" style="display: none">
                                        <input id="id_cliente" name="id_cliente" type="number" value="{{ $expediente->id_cliente }}" style="display: none">
                                        <button type="submit" class="btn btn-sm" style="background: #6EC1E4; color: #ffff;">Guardar</button>
                                    </form>
                                </div>
                                <div id="formularioCarga" style="display: none;">
                                    <form method="POST" action="{{ route('crear.docexp') }}" enctype="multipart/form-data" role="form">
                                        @csrf
                                        <input type="file" name="archivos[]" multiple>
                                        <input type="hidden" id="categoria" name="categoria" value="">
                                        <input id="id_nota" name="id_nota" type="hidden" value="{{ $expediente->id }}">
                                        <input id="id_cliente" name="id_cliente" type="hidden" value="{{ $expediente->id_cliente }}">
                                        <button type="submit" class="btn btn-sm" style="background: #6EC1E4; color: #ffff;">Guardar</button>
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

<script src="{{ asset('assets/admin/vendor/jquery/dist/jquery.min.js')}}"></script>
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
        $('#formularioCarga').hide();
        $('#contenedorArchivos').empty();
        //const notaId = {{ $expediente->id }};
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

