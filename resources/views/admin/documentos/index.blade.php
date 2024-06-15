@extends('layouts.app_admin')

@section('template_title')
Reporte de Documentos
@endsection
@section('css')
<link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet">
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

</style>
@endsection
@section('content')

<div class="container-fluid mt-3">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="mb-3">Reporte Documentos </h3>
                    <a type="button" class="btn btn-sm bg-danger" data-bs-toggle="modal" data-bs-target="#manual_instrucciones" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                        ¿Como fucniona?
                    </a>
                    <a type="button" class="btn btn-sm bg-primary" onclick="openRightPanel()" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                        <i class="fa fa-fw fa-plus"></i> Crear
                    </a>
                </div>
            </div>
            @include('admin.documentos.modal_create')

            <form action="{{ route('advance_documentos.buscador') }}" method="GET" >

                <div class="card-body" style="padding-left: 1.5rem; padding-top: 1rem;">
                    <h5>Filtros</h5>
                        <div class="row">
                            <div class="col-3 ml-3">
                                <label class="form-label">Del</label>
                                <div class="input-group">
                                    <input name="fecha" class="form-control"
                                        type="date" required>
                                </div>
                            </div>
                            <div class="col-3">
                                <label class="form-label">Al</label>
                                <div class="input-group">
                                    <input  name="fecha2" type="date" class="form-control" required>
                                </div>
                            </div>

                            {{-- <div class="col-3">
                                <label class="form-label">Curso</label>
                                <div class="input-group">
                                    <input  name="curso" type="date" class="form-control">
                                </div>
                            </div> --}}

                            <div class="col-3">
                                <br>
                                <button class="btn btn-sm mb-0 mt-sm-0 mt-1" type="submit" style="background-color: #F82018; color: #ffffff;">Buscar</button>
                            </div>
                        </div>
                </div>
            </form>

            <div class="table-responsive">
                @if(Route::currentRouteName() != 'generar_documentos.index')
                <table class="table table-flush p-2" id="datatable-search">
                    <thead class="thead-light">
                        <tr>
                            <th>Alumn@</th>
                            <th>Curso</th>
                            <th>Documento</th>
                            <th>Fecha</th>
                            <th>Estatus</th>
                            <th>Personal</th>
                        </tr>
                    </thead>

                        @foreach ($bitacoras as $item)
                            @php

                                if ($item->tipo_documento == '1') {
                                    $item->tipo_documento = 'Diploma STPS General';
                                }elseif ($item->tipo_documento == '2') {
                                    $item->tipo_documento = 'RN-Cedula de identidad de papel General';
                                }elseif ($item->tipo_documento == '3') {
                                    $item->tipo_documento = 'RN - Titulo Honorifico Generico QRS';
                                }elseif ($item->tipo_documento == '4') {
                                    $item->tipo_documento = 'RN - Diploma Imnas';
                                }elseif ($item->tipo_documento == '5') {
                                    $item->tipo_documento = 'RN - Credencial General';
                                }elseif ($item->tipo_documento == '13') {
                                    $item->tipo_documento = 'Titulo Honorifico Online Qr Logo';
                                }

                            @endphp
                            <tr>
                                <td>
                                    @if ($item->id_usuario == NULL)
                                        {{ $item->cliente }}
                                    @else
                                        {{ $item->Alumno->name }}
                                    @endif
                                </td>
                                <td>
                                    @if ($item->id_curso == NULL)
                                        @php
                                            $nombreDelCurso2 = $item->curso;
                                            $nombreDelCurso2 = str_replace('Curso de ', '', $nombreDelCurso2);
                                            $nombreDelCurso2 = str_replace('Curso ', '', $nombreDelCurso2);

                                            $palabras = explode(' ', $nombreDelCurso2);

                                            // Inicializa la cadena formateada
                                            $nombre_formateado2 = '';
                                            $contador_palabras2 = 0;

                                            foreach ($palabras as $palabra) {
                                                // Agrega la palabra actual a la cadena formateada
                                                $nombre_formateado2 .= $palabra . ' ';

                                                // Incrementa el contador de palabras
                                                $contador_palabras2++;

                                                // Agrega un salto de línea después de cada tercera palabra
                                                if ($contador_palabras2 % 3 == 0) {
                                                    $nombre_formateado2 .= "<br>";
                                                }
                                            }
                                        @endphp
                                        {{ $nombre_formateado2 }}
                                    @else
                                        @php
                                            $nombreDelCurso = $item->Cursos->nombre;
                                            $nombreDelCurso = str_replace('Curso de ', '', $nombreDelCurso);
                                            $nombreDelCurso = str_replace('Curso ', '', $nombreDelCurso);

                                            $palabras = explode(' ', $nombreDelCurso);

                                            // Inicializa la cadena formateada
                                            $nombre_formateado = '';
                                            $contador_palabras = 0;

                                            foreach ($palabras as $palabra) {
                                                // Agrega la palabra actual a la cadena formateada
                                                $nombre_formateado .= $palabra . ' ';

                                                // Incrementa el contador de palabras
                                                $contador_palabras++;

                                                // Agrega un salto de línea después de cada tercera palabra
                                                if ($contador_palabras % 3 == 0) {
                                                    $nombre_formateado .= "<br>";
                                                }
                                            }
                                        @endphp
                                        {!! $nombre_formateado !!}
                                    @endif
                                </td>
                                <td>{{ $item->tipo_documento }} <br>
                                    {{ $item->folio }}
                                </td>

                                <td>
                                    @php
                                        $fecha = $item->created_at;
                                        $fecha_timestamp = strtotime($fecha);
                                        $fecha_formateada = date('d \d\e F \d\e\l Y', $fecha_timestamp);
                                    @endphp
                                    {{$fecha_formateada}}
                                </td>

                                <td>
                                    <!-- Button trigger modal -->

                                    <button type="button" class="btn  btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal_{{$item->id}}">
                                        {{ $item->estatus }}
                                    </button>
                                </td>

                                <td>
                                    <td>{{ $item->User->name }}</td>
                                </td>


                            </tr>
                            @include('admin.documentos.modal_estatus')

                        @endforeach

                </table>
                @endif
            </div>
          </div>
        </div>
      </div>
</div>

@endsection

@section('datatable')


<script src="{{ asset('assets/admin/vendor/select2/dist/js/select2.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.curso').select2();
         $('.cliente').select2();

        const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
            searchable: true,
            fixedHeight: false
        });

        $('#id_client').on('change', function() {
            var clientId = $(this).val();
            if (clientId) {
                $.ajax({
                    url: '/getCursos/' + clientId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var cursos = data.cursos;
                        var ine = data.ine;
                        var curp = data.curp;
                        var foto_tam_titulo = data.foto_tam_titulo;
                        var foto_tam_infantil = data.foto_tam_infantil;
                        var firma = data.firma;

                        var cliente_telefono = data.cliente_telefono;

                        $('#id_curso').empty();
                        $('#id_curso').append('<option selected value="">Buscar Curso</option>');
                        $.each(cursos, function(key, value) {
                            $('#id_curso').append('<option value="'+ value.id +'" data-fecha_curso="'+ value.fecha_curso +'" data-duracion_hrs_curso="'+ value.duracion_hrs_curso +'">'+ value.nombre +'</option>');
                        });

                        // Mostrar imagen si existe INE
                        if (ine) {
                            $('#ine_image').attr('src', '/documentos/' + cliente_telefono + '/' + ine).show();
                        } else {
                            $('#ine_image').attr('src', '').hide(); // Ocultar y limpiar la imagen si no hay INE
                        }

                        if (curp) {
                            $('#curp_image').attr('src', '/documentos/' + cliente_telefono + '/' + curp).show();
                        } else {
                            $('#curp_image').attr('src', '').hide(); // Ocultar y limpiar la imagen si no hay INE
                        }

                        if (foto_tam_titulo) {
                            $('#foto_tam_titulo_image').attr('src', '/documentos/' + cliente_telefono + '/' + foto_tam_titulo).show();
                        } else {
                            $('#foto_tam_titulo_image').attr('src', '').hide(); // Ocultar y limpiar la imagen si no hay INE
                        }

                        if (foto_tam_infantil) {
                            $('#foto_tam_infantil_image').attr('src', '/documentos/' + cliente_telefono + '/' + foto_tam_infantil).show();
                        } else {
                            $('#foto_tam_infantil_image').attr('src', '').hide(); // Ocultar y limpiar la imagen si no hay INE
                        }

                        if (firma) {
                            $('#firma_image').attr('src', '/documentos/' + cliente_telefono + '/' + firma).show();
                        } else {
                            $('#firma_image').attr('src', '').hide(); // Ocultar y limpiar la imagen si no hay INE
                        }

                        console.log(cliente_telefono); // Para verificar que el teléfono del cliente cambió
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al obtener los cursos:', error);
                        $('#id_curso').empty();
                        $('#id_curso').append('<option selected value="">Buscar Curso</option>');
                        $('#ine_image').attr('src', '').hide(); // Ocultar y limpiar la imagen en caso de error
                        $('#curp_image').attr('src', '').hide(); // Ocultar y limpiar la imagen en caso de error
                        $('#foto_tam_titulo_image').attr('src', '').hide(); // Ocultar y limpiar la imagen en caso de error
                        $('#foto_tam_infantil_image').attr('src', '').hide(); // Ocultar y limpiar la imagen en caso de error
                        $('#firma_image').attr('src', '').hide(); // Ocultar y limpiar la imagen en caso de error

                    }
                });
            } else {
                $('#id_curso').empty();
                $('#id_curso').append('<option selected value="">Buscar Curso</option>');
                $('#ine_image').attr('src', '').hide(); // Ocultar y limpiar la imagen si no hay cliente seleccionado
                $('#curp_image').attr('src', '').hide(); // Ocultar y limpiar la imagen si no hay cliente seleccionado
                $('#foto_tam_titulo_image').attr('src', '').hide(); // Ocultar y limpiar la imagen si no hay cliente seleccionado
                $('#foto_tam_infantil_image').attr('src', '').hide(); // Ocultar y limpiar la imagen si no hay cliente seleccionado
                $('#firma_image').attr('src', '').hide(); // Ocultar y limpiar la imagen si no hay cliente seleccionado

            }
        });

        $('#id_curso').on('change', function() {
            var selectedOption = $(this).find(':selected');
            var fechaCurso = selectedOption.data('fecha_curso');

            if (fechaCurso) {
                $('#fecha_curso').val(fechaCurso);
            } else {
                $('#fecha_curso').val('');
            }

        });



    });

            // Funcion abrir a la izquierda
            function openRightPanel() {
            document.getElementById("rightPanel").style.right = "0";
        }

        function closeRightPanel() {
            document.getElementById("rightPanel").style.right = "-600px";
        }

        // Funcion nombre dividido en los 3 inputs
        function splitFullName() {
            // Obtener el valor del nombre completo
            var fullName = document.getElementById('nombre').value.trim();

            // Dividir el nombre completo en sus partes
            var parts = fullName.split(' ');

            // Obtener los inputs de nombre, apellido paterno y apellido materno
            var nombresInput = document.getElementById('nombres');
            var apellidoPaternoInput = document.getElementById('apellido_paterno');
            var apellidoMaternoInput = document.getElementById('apellido_materno');

            // Asignar las partes a los inputs correspondientes
            if (parts.length >= 1) {
                apellidoMaternoInput.value = parts.pop(); // Obtener el último elemento (apellido materno)
            }
            if (parts.length >= 1) {
                apellidoPaternoInput.value = parts.pop(); // Obtener el último elemento (apellido paterno)
            }
            nombresInput.value = parts.join(' '); // El resto se considera como nombres
        }

        // Funcion folio dinamico
        function generarFolio() {
            // Obtener el nombre del curso seleccionado
            var cursoSelect = document.getElementById('curso');
            var cursoNombre = cursoSelect.options[cursoSelect.selectedIndex].text.toUpperCase();

            // Obtener las iniciales de cada palabra en el nombre del curso (limitado a 5 letras)
            var cursoIniciales = cursoNombre.split(' ').map(word => word.charAt(0)).join('').substring(0, 4);

            // Obtener el último número base utilizado o establecerlo en 6000 si es la primera vez
            var ultimoNumeroBase = parseInt(localStorage.getItem('ultimoNumeroBase')) || 6000;

            // Incrementar el número base para el próximo folio
            var siguienteNumeroBase = ultimoNumeroBase + 1;

            // Guardar el nuevo número base para el próximo folio
            localStorage.setItem('ultimoNumeroBase', siguienteNumeroBase);

            // Construir el folio
            var folio = 'F' + cursoIniciales + '-' + siguienteNumeroBase;

            // Asignar el folio al input correspondiente
            document.getElementById('folio').value = folio;
        }

        //mostrar img automaticamente
        //foto
        function mostrarImagen(input) {
            // Verificar si se seleccionó una imagen
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    // Mostrar la imagen en el elemento img
                    var imagenSeleccionada = document.getElementById('imagen_seleccionada');
                    imagenSeleccionada.src = e.target.result;
                    imagenSeleccionada.style.display = 'block'; // Mostrar el elemento img
                }

                // Leer el contenido de la imagen seleccionada como una URL
                reader.readAsDataURL(input.files[0]);
            }
        }

        //firma
        function mostrarImagenFirma(input) {
            // Verificar si se seleccionó una imagen
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    // Mostrar la imagen en el elemento img
                    var imagenSeleccionadafirma = document.getElementById('imagen_seleccionada_firma');
                    imagenSeleccionadafirma.src = e.target.result;
                    imagenSeleccionadafirma.style.display = 'block'; // Mostrar el elemento img
                }

                // Leer el contenido de la imagen seleccionada como una URL
                reader.readAsDataURL(input.files[0]);
            }
        }
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {

        const radioSiMayo = document.getElementById('radioSiMayo');
        const radioNoMayo = document.getElementById('radioNoMayo');

        const precioMayoristaContainer = document.getElementById('precioMayoristaContainer');

        radioSiMayo.addEventListener('change', function() {
            if (radioSiMayo.checked) {
                precioMayoristaContainer.style.display = 'block';
            }
        });

        radioNoMayo.addEventListener('change', function() {
            if (radioNoMayo.checked) {
                precioMayoristaContainer.style.display = 'none';
        }
    });

        const curpOption = document.getElementById("curp_option");
        const tipoOption = document.getElementById("tipo");

        const curpContent = document.querySelector(".curp_content");

        const cnContent = document.querySelector(".gc_cn");
        const gcContent = document.querySelector(".gc_content");

    // Mostrar u ocultar los contenedores según la opción seleccionada
        curpOption.addEventListener("change", function () {
            if (curpOption.value === "Curp") {
                curpContent.style.display = "block";
                gcContent.style.display = "none";
            } else if (curpOption.value === "Generar curp") {
                curpContent.style.display = "none";
                gcContent.style.display = "block";
            }
        });

        tipoOption.addEventListener("change", function () {
            if (tipoOption.value == 5) {
                document.querySelectorAll(".number_4").forEach(element => {
                    element.style.display = "block";
                });
                cnContent.style.display = "block";
            } else if (tipoOption.value != 1) {
                document.querySelectorAll(".number_4").forEach(element => {
                    element.style.display = "none";
                });
                cnContent.style.display = "block";
            } else {
                document.querySelectorAll(".number_4").forEach(element => {
                    element.style.display = "none";
                });
                cnContent.style.display = "none";
            }
        });
    });

</script>

@endsection
