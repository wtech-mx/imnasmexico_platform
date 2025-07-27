@extends('layouts.app_admin')

@section('template_title')
    Asistencia Expo Sabado
@endsection
@section('css')
<link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet">
@endsection
@section('content')

    <div class="container-fluid">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <div style="display: flex; justify-content: space-between; align-items: center;">

                                    <h2 class="mb-3">Asistencia Party Sabado</h2>

                                    <a type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                                        ¿Como funciona?
                                    </a>

                                    @can('nota-productos-crear')
                                        <a class="btn btn-sm btn-success" href="{{ route('corizacion_expo.create') }}" style="background: #322338; color: #ffff; font-size: 20px;">
                                            <i class="fa fa-fw fa-edit"></i> Crear
                                        </a>
                                    @endcan
                                </div>
                                <div class="row">
                                    <div class="col6">
                                        <a href="{{ route('asistencia_expo.index') }}" class="btn bg-danger text-white" >
                                            Sabado
                                        </a>
                                    </div>

                                    <div class="col6">
                                        <a href="{{ route('asistencia_expo_domingo.index') }}" class="btn bg-primary text-white" >
                                            Domingo
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6 text-center">
                                        <label>Total de Registros: </label>
                                        <h5>{{$totalRegistros}}</h5>
                                    </div>

                                    <div class="col-6 text-center">
                                        <label>Total de Personas: </label>
                                        <h5>{{$totalPersonas}}</h5>
                                    </div>

                                    <div class="col-6 text-center" style="background-color:#81e31e57">
                                        <label>Asistencia: </label>
                                        <h5>{{$asistencia + $asistencia_nas}}</h5>
                                    </div>

                                    <div class="col-6 text-center" style="background-color: #9b1ee357">
                                        <label>Inasistencia: </label>
                                        <h5>{{$inasistencia}}</h5>
                                    </div>
                                </div>

                                <div class="table-responsive">

                                    <table class="table table-flush" id="orden_servicio">
                                        <thead class="thead">
                                            <tr>
                                                <th>WhatsApp Number(with country code)</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Other</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($ordenes_basico as $order)
                                                <tr>
                                                    <td>+52{{ $order->Nota->User->telefono }}</td>
                                                    <td>{{ $order->Nota->User->name }}</td>
                                                    <td>{{ $order->Nota->User->id }}</td>
                                                    <th>WAPI Sender Support</th>
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

<script type="text/javascript">
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
                            var titulo = 'Lista de ';
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


