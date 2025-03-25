@extends('layouts.app_admin')

@section('template_title')
    Lista de {{$curso->nombre}} / {{ \Illuminate\Support\Str::ucfirst(\Carbon\Carbon::parse($curso->fecha_inicial)->translatedFormat('l j \\de F \\de Y')) }} al {{ \Illuminate\Support\Str::ucfirst(\Carbon\Carbon::parse($curso->fecha_final)->translatedFormat('l j \\de F \\de Y')) }} - ( {{ $curso->modalidad }} )
@endsection
@section('css')
<link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet">
@endsection
<style>
    .estatus-doc-red {
        color: red;
    }

    .estatus-doc-green {
        color: green;
    }
</style>
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <a class="btn" id="regresar_btn" style="background: {{$configuracion->color_boton_close}}; color: #fff"><i class="fas fa-arrow-left"></i> Regresar </a>

                            <h3 class="mb-3">Lista de Curso</h3><br>
                            <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                Crear  <i class="fas fa-plus"></i>
                            </a>
                        </div>
                        <p class="text-sm">{{$curso->nombre}} / {{ \Illuminate\Support\Str::ucfirst(\Carbon\Carbon::parse($curso->fecha_inicial)->translatedFormat('l j \\de F \\de Y')) }} al {{ \Illuminate\Support\Str::ucfirst(\Carbon\Carbon::parse($curso->fecha_final)->translatedFormat('l j \\de F \\de Y')) }} - ( {{ $curso->modalidad }} )
                            <a class="btn btn-sm btn-info" href="{{ route('cursos.show',$curso->slug) }}" target="_blank"><i class="fas fa-external-link-alt"></i></a>
                        </p>
                        <h4>Inscritos :
                            @php
                                $contador = 0;
                            @endphp
                            @foreach ($ordenes as $order)
                                @if ($order->Orders->estatus == '1')
                                    @php
                                        $contador++;
                                    @endphp
                                @endif
                            @endforeach
                            {{ $contador }}
                        </h4>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-flush" id="orden_servicio">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Nombre</th>
                                        <th>Metodo de Pago</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $contador = 1;
                                    @endphp
                                    @foreach ($ordenes as $order)
                                        <tr class="{{ ($order->estatus_doc == 1 && $order->estatus_cedula == 1 && $order->estatus_titulo == 1 && $order->estatus_diploma == 1 && $order->estatus_credencial == 1 && $order->estatus_tira == 1) ? 'estatus-doc-green' : 'estatus-doc-red' }}">
                                            <td>{{ $contador++ }}</td>
                                            <td>
                                                <a href=" {{ route('perfil.show', $order->User->id) }} " target="_blank" rel="noopener noreferrer" style="text-decoration: revert;color: blue;">{{ $order->User->name }}</a><br>
                                                <p>{{ $order->User->telefono }}</p>
                                                <p>{{ $order->User->email }}</p>
                                            </td>
                                            <td>{{ $order->Orders->forma_pago }} <br> Subido por: <br>
                                                @if ($order->Orders->id_externo != NULL)
                                                <b>{{ $order->Orders->PagosFuera->usuario }}</b>
                                                @elseif ($order->Orders->id_admin != NULL)
                                                <b>{{ $order->Orders->Admin->name }}</b>
                                                @else
                                                <b>Pago por pagina</b>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-danger" href="{{ route('pagos.edit_pago',$order->Orders->id) }}"><i class="fa fa-newspaper" title="Ver Orden"></i> </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
@section('datatable')
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>

 <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
 <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap4.min.js"></script>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>



<script>
        $(document).ready(function() {
            $('#orden_servicio').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'print',
                        text: 'Imprimir',
                        exportOptions: {
                            columns: ':visible',
                            modifier: {
                                styles: {
                                    fontSize: '80px' // Tamaño de letra más grande para exportación PDF
                                }
                            }
                        },
                        title: function() {
                            var customText = '';
                            var titulo = 'Lista de {{$curso->nombre}} / {{ \Illuminate\Support\Str::ucfirst(\Carbon\Carbon::parse($curso->fecha_inicial)->translatedFormat('l j \\de F \\de Y')) }} al {{ \Illuminate\Support\Str::ucfirst(\Carbon\Carbon::parse($curso->fecha_final)->translatedFormat('l j \\de F \\de Y')) }} - ( {{ $curso->modalidad }} )';
                            // Agregar un texto personalizado antes del título de la página
                        }
                    },
                    'excel',
                    {
                        extend: 'pdfHtml5',
                        customize: function(doc) {
                            // Establecer el tamaño de fuente para el documento PDF
                            doc.defaultStyle.fontSize = 14;

                            // Establecer el tamaño de fuente para el encabezado
                            doc.content[0].fontSize = 20;

                        }
                    },
                    'colvis'
                ],
                responsive: false,
                stateSave: true,

                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
                },
                columnDefs: [
                    { type: 'num', targets: 0 } // Indica que la columna 0 (No) debe ser tratada como número
                ]
            });
        });
</script>



@endsection
