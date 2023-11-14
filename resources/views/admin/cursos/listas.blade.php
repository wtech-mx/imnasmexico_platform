@extends('layouts.app_admin')

@section('template_title')
    Lista de {{$curso->nombre}} / {{ \Illuminate\Support\Str::ucfirst(\Carbon\Carbon::parse($curso->fecha_inicial)->translatedFormat('l j \\de F \\de Y')) }}
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
                            <h3 class="mb-3">Lista de Curso</h3>
                            <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                Crear
                            </a>
                        </div>
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

                    <ul class="nav nav-pills nav-fill p-1" id="pills-tab" role="tablist">
                        @foreach ($tickets as $ticket)
                            <li class="nav-item" role="presentation">
                                <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="#pills-home{{$ticket->id}}" role="tab" aria-controls="pills-home" aria-selected="true" id="pills-home-tab{{$ticket->id}}">
                                    <i class="ni ni-folder-17 text-sm me-2"></i> {{$ticket->nombre}} -
                                    @if ($ticket->descuento == NULL)
                                        ${{$ticket->precio}}
                                        @else
                                        <del>${{$ticket->precio}}</del> <strong>${{$ticket->descuento}}</strong>
                                    @endif
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        @foreach ($tickets as $ticket)
                        @include('admin.cursos.add_lista')
                            <div class="tab-pane fade show active" id="pills-home{{$ticket->id}}" role="tabpanel" aria-labelledby="pills-home-tab{{$ticket->id}}">
                                <div class="card-body">

                                    <h5>{{$ticket->nombre}}</h5>

                                    <h5>Diploma y/o Certificaciones:
                                        @if ($ticket->descripcion == 'Con opción a Documentos de certificadora IMNAS')
                                            IMNAS
                                        @elseif ($ticket->descripcion == 'Opción a certificación a masaje holístico EC0900')
                                            Certificación a masaje holístico
                                        @else
                                            @if ($ticket->Cursos->imnas == '1' && $ticket->Cursos->titulo_hono == NULL)
                                                IMNAS
                                            @endif
                                            @if ($ticket->Cursos->imnas == '1' && $ticket->Cursos->titulo_hono == '1')
                                                Titulo Honorifico -
                                            @endif
                                            @if ($ticket->Cursos->stps == '1')
                                                STPS
                                            @endif
                                            @if ($ticket->Cursos->redconocer == '1')
                                                RedConocer
                                            @endif
                                            @if ($ticket->Cursos->unam == '1')
                                                UNAM
                                            @endif
                                        @endif

                                    </h5>

                                    <div class="table-responsive">
                                        <table class="table table-flush" id="orden_servicio-{{$ticket->id}}">
                                            <thead class="thead">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nombre</th>
                                                    <th>Metodo de Pago</th>
                                                    <th>Costo</th>
                                                    <th>Deudor</th>
                                                    <th>Nota</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($ordenes as $order)
                                                        @if ($order->id_tickets == $ticket->id && $order->Orders->estatus == '1')
                                                            <tr class="{{ ($order->estatus_doc == 1 && $order->estatus_cedula == 1 && $order->estatus_titulo == 1 && $order->estatus_diploma == 1 && $order->estatus_credencial == 1 && $order->estatus_tira == 1) ? 'estatus-doc-green' : 'estatus-doc-red' }}">
                                                                <td>{{ $order->Orders->id }}</td>
                                                                <td>
                                                                    <a href=" {{ route('perfil.show', $order->User->id) }} " target="_blank" rel="noopener noreferrer" style="text-decoration: revert;color: blue;">{{ $order->User->name }}</a><br>
                                                                    <p>{{ $order->User->telefono }}</p>
                                                                    <p>{{ $order->User->email }}</p>
                                                                </td>
                                                                <td>{{ $order->Orders->forma_pago }}</td>
                                                                <td>
                                                                        {{ $order->Orders->pago }}
                                                                </td>
                                                                <td>

                                                                </td>
                                                                <td>
                                                                    @if ($order->Orders->id_externo == 0 || $order->Orders->id_externo == null)
                                                                        @else

                                                                    {{$order->Orders->id_externo }}
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($order->CursosTickets->descripcion == 'Con opción a Documentos de certificadora IMNAS')
                                                                    <a class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modal_imnas_documentos_{{ $order->User->id }}">
                                                                        <i class="fa fa-file"></i>
                                                                    </a>
                                                                    @elseif ($ticket->descripcion == 'Opción a certificación a masaje holístico EC0900')
                                                                    <a class="btn btn-sm btn-success">
                                                                        <i class="fa fa-file"></i>
                                                                    </a>
                                                                    @else
                                                                    <a class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modal_documentos_{{ $order->User->id }}">
                                                                        <i class="fa fa-file"></i>
                                                                    </a>
                                                                    @endif

                                                                    <form method="POST" action="{{ route('cursos.correo' ,$order->id) }}" enctype="multipart/form-data" role="form" style="display: inline-block">
                                                                        @csrf
                                                                        <input type="hidden" name="email" id="email" value="{{ $order->User->email }}">
                                                                        <input type="hidden" name="ticket" id="ticket" value="{{ $order->id_tickets }}">
                                                                        <input type="hidden" name="id_usuario" id="id_usuario" value="{{ $order->id_usuario }}">
                                                                        <input type="hidden" name="curso" id="curso" value="{{ $order->id_curso }}">
                                                                        <button type="submit" class="btn btn-sm btn-primary" title="Enviar liga"><i class="fas fa-envelope"></i></button>
                                                                    </form>

                                                                    <a class="btn btn-sm btn-warning" href="{{ route('pagos.edit_pago',$order->Orders->id) }}"><i class="fa fa-money" title="Ver Orden"></i> </a>
                                                                </td>
                                                            </tr>
                                                        @endif

                                                    @if ($order->Orders->PagosFuera != NULL)
                                                        @if ($order->id_tickets == $ticket->id && ($order->Cursos->modalidad == 'Presencial' && $order->Orders->PagosFuera->deudor == '1'))
                                                            <tr class="{{ ($order->estatus_doc == 1 && $order->estatus_cedula == 1 && $order->estatus_titulo == 1 && $order->estatus_diploma == 1 && $order->estatus_credencial == 1 && $order->estatus_tira == 1) ? 'estatus-doc-green' : 'estatus-doc-red' }}">
                                                                <td>{{ $order->Orders->id }}</td>
                                                                <td>
                                                                    <a href=" {{ route('perfil.show', $order->User->id) }} " target="_blank" rel="noopener noreferrer" style="text-decoration: revert;color: blue;">{{ $order->User->name }}</a><br>
                                                                    <p>{{ $order->User->telefono }}</p>
                                                                    <p>{{ $order->User->email }}</p>
                                                                </td>
                                                                <td>{{ $order->Orders->forma_pago }}</td>
                                                                <td>
                                                                        {{ $order->Orders->pago }}
                                                                </td>
                                                                <td>
                                                                    @if ($order->Orders->id_externo == 0 || $order->Orders->id_externo == null)
                                                                        @else
                                                                        @if ($order->Cursos->modalidad == 'Presencial')
                                                                            @if ($order->Orders->PagosFuera->deudor == '1')
                                                                                <input class="form-check-input" type="checkbox" id="deudor" name="deudor" disabled checked>
                                                                            @else
                                                                                <input class="form-check-input" type="checkbox" id="deudor" name="deudor" disabled>
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($order->Orders->id_externo == 0 || $order->Orders->id_externo == null)
                                                                        @else

                                                                    {{$order->Orders->id_externo }}
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <a class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modal_documentos_{{ $order->User->id }}">
                                                                        <i class="fa fa-file"></i>
                                                                    </a>

                                                                    <form method="POST" action="{{ route('cursos.correo' ,$order->id) }}" enctype="multipart/form-data" role="form" style="display: inline-block">
                                                                        @csrf
                                                                        <input type="hidden" name="email" id="email" value="{{ $order->User->email }}">
                                                                        <input type="hidden" name="ticket" id="ticket" value="{{ $order->id_tickets }}">
                                                                        <input type="hidden" name="id_usuario" id="id_usuario" value="{{ $order->id_usuario }}">
                                                                        <input type="hidden" name="curso" id="curso" value="{{ $order->id_curso }}">
                                                                        <button type="submit" class="btn btn-sm btn-primary" title="Enviar liga"><i class="fas fa-envelope"></i></button>
                                                                    </form>

                                                                    <a class="btn btn-sm btn-warning" href="{{ route('pagos.edit_pago',$order->Orders->id) }}"><i class="fa fa-money" title="Ver Orden"></i> </a>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endif
                                                        @include('admin.cursos.modal_imnas_documentos')
                                                        @include('admin.cursos.modal_documentos')
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
    @foreach ($tickets as $ticket)
        $(document).ready(function() {
            $('#orden_servicio-{{$ticket->id}}').DataTable({
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
                }
            });
        });
    @endforeach
</script>


@endsection
