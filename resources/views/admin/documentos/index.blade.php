@extends('layouts.app_admin')

@section('template_title')
Reporte de Documentos
@endsection
@section('css')
<link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet">
@endsection
@section('content')

<div class="container-fluid mt-3">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="mb-3">Generar Documentos </h3>
                    <a type="button" class="btn btn-sm bg-danger" data-bs-toggle="modal" data-bs-target="#manual_instrucciones" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                        ¿Como fucniona?
                    </a>
                    <a type="button" class="btn btn-sm bg-primary" data-bs-toggle="modal" data-bs-target="#create_manual" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                        <i class="fa fa-fw fa-plus"></i> Crear
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-flush" id="datatable-search">
                    <thead class="thead-light">
                        <tr>
                            <th>Folio</th>
                            <th>Alumn@</th>
                            <th>Curso</th>
                            <th>Fecha</th>
                            <th>Estatus</th>
                            <th>Personal</th>
                        </tr>
                    </thead>
                    @foreach ($bitacoras as $item)
                        <tr>
                            <td>{{ $item->folio }}</td>
                            <td>{{ $item->Alumno->name }}</td>
                            <td>
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
                            </td>
                            <td>
                                @php
                                $fecha = $item->created_at;
                                $fecha_timestamp = strtotime($fecha);
                                $fecha_formateada = date('d \d\e F \d\e\l Y', $fecha_timestamp);
                                @endphp
                                {{$fecha_formateada}}
                            </td>
                            <td>{{ $item->estatus }}</td>
                            <td>{{ $item->User->name }}</td>

                        </tr>
                    @endforeach
                </table>
            </div>
          </div>
        </div>
      </div>
</div>

@include('admin.documentos.modal_create')

@endsection
@section('datatable')
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>

 <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
 <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap4.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
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


<script>
        $(document).ready(function() {
            $('#datatable-search').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'print',
                        text: 'Imprimir',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    'excel',
                    'pdf',
                    'colvis'
                ],
                responsive: false,
                stateSave: true,

                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
                }
            });
        });

</script>

<script>
    const usuarioSelect = document.getElementById('usuarioSelect');
    const ordenesSelect = document.getElementById('ordenesSelect');

    usuarioSelect.addEventListener('change', function() {
        const usuarioId = this.value;

        if (usuarioId) {
            // Habilitar el segundo select
            ordenesSelect.removeAttribute('disabled');

            // Realizar la solicitud AJAX para obtener las órdenes del usuario
            fetch(`/obtener-ordenes/${usuarioId}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data); // Verifica si la relación "curso" se está cargando correctamente
                    ordenesSelect.innerHTML = '<option value="">Selecciona una orden</option>';
                    data.forEach(ordenTicket => {
                        console.log(ordenTicket.CursosTickets.nombre);
                        const option = document.createElement('option');
                        option.value = ordenTicket.id;
                        option.textContent = ordenTicket.CursosTickets ? ordenTicket.CursosTickets.nombre : 'Nombre no disponible';
                        ordenesSelect.appendChild(option);
                    });
            });
        } else {
            // Si no se selecciona un usuario, deshabilitar el segundo select
            ordenesSelect.innerHTML = '<option value="">Selecciona una orden</option>';
            ordenesSelect.setAttribute('disabled', true);
        }
    });
</script>

@endsection
