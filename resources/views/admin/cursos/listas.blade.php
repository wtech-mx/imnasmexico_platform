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

                        <p class="text-sm">
                            {{ $curso->nombre }} /
                            {{ $fechaIni }} al {{ $fechaFin }}
                            ({{ $curso->modalidad }})
                            <a class="btn btn-sm btn-info"
                                href="{{ route('cursos.show', $curso->slug) }}"
                                target="_blank">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                        </p>

                        <h4>Inscritos: {{ $inscritos }}</h4>

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
                                                SepConocer
                                            @endif
                                            @if ($ticket->Cursos->unam == '1')
                                                UNAM
                                            @endif
                                        @endif

                                    </h5>

                                    <div class="table-responsive">
                                    <table class="table table-flush" id="orden_servicio-{{ $ticket->id }}">
                                        <thead class="thead">
                                        <tr>
                                            <th>No</th>
                                            <th>Nombre</th>
                                            <th>Metodo de Pago</th>
                                            <th>Abono</th>
                                            <th>Nota</th>
                                            <th>Documentacion</th>
                                            <th>Deudor</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @php $counter = 1; @endphp
                                            @foreach($ordenes as $order)
                                                @if($order->id_tickets == $ticket->id && $order->orders->estatus == '1')
                                                    @include('admin.cursos.partials.row', [
                                                        'order'   => $order,
                                                        'ticket'  => $ticket,
                                                        'counter' => $counter++
                                                    ])
                                                @endif
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
    // Volcamos de golpe la configuración que armamos en el controller
    const tablaConfigs = @json($tablaConfigs);

$(function(){
  tablaConfigs.forEach(cfg => {
    $('#orden_servicio-' + cfg.id).DataTable({
      dom: 'Bfrtip',
      buttons: [
        {
          extend: 'print',
          text: 'Imprimir',
          title: cfg.titulo,
          exportOptions: { modifier: { page: 'all' } }
        },
        'excel',
        {
        extend: 'pdfHtml5',
        text: 'PDF',
        title: cfg.titulo,
        exportOptions: {
            modifier: { page: 'all' },
            columns: [0,1,2,3,4,5,6]
        },
        customize: function (doc) {
            doc.pageMargins = [20,20,20,20];
            doc.defaultStyle.fontSize = 12;
            doc.styles.tableHeader.fontSize = 13;
            var table = doc.content.find(d => d.table).table;
            table.widths = [
            '5%',  // Nombre
            '25%',  // Nombre
            '20%',  // Método de Pago
            '10%',  // Abono
            '10%',  // Deudor
            '20%',  // Documentación
            '10%'   // Nota
            ];
        }
        },

        'colvis'
      ],
      responsive: false,
      stateSave: true,
      language: { url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json' },
      columnDefs: [{ type: 'num', targets: 0 }]
    });
  });
});

  </script>

@endsection
