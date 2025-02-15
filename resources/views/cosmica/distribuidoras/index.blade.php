@extends('layouts.app_admin')

@section('template_title')
    Cosmica Distribuidoras
@endsection

@section('css')
 <!-- Select2  -->
 <link rel="stylesheet" href="{{asset('assets/admin/vendor/select2/dist/css/select2.min.css')}}">
 <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css" rel="stylesheet">
 <link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet">
 @endsection

@php
    $fecha = date('Y-m-d');
    use Carbon\Carbon;

    // Establece la localización a español
    Carbon::setLocale('es');
@endphp
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <h2 class="mb-3">Cosmica Distribuidoras</h2>

                            <a type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                                ¿Como funciona?
                            </a>

                            @can('nota-productos-crear')

                                <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    <i class="fa fa-fw fa-edit"></i> Crear
                                </a>

                            @endcan
                        </div>

                        <a type="button" class="btn btn-primary position-relative" data-bs-toggle="modal" data-bs-target="#por_vencer">
                            <img src="{{ asset('assets/user/icons/bell.png') }}" alt="" width="30px">
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $usuarios_por_vencer ? $usuarios_por_vencer->count() : 0 }}
                            </span>
                        </a>

                        <a class="ml-5" href="{{ route('distribuidoras.index_distribuidoras') }}" target="_blank">Ver Pag de Distribuidoras</a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-flush" id="datatable-search">
                                <thead class="thead">
                                    <tr>
                                        <th>#</th>
                                        <th>Distribuidora</th>
                                        <th>Membrecia</th>
                                        <th>Puntos</th>
                                        <th>Meses Acumulados</th>
                                        <th>Protocolo</th>
                                        <th>Estatus</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($usercosmika as $item)
                                        <tr>
                                            <td>{{ $item->id }}

                                            </td>
                                        <td>
                                            @php
                                                $words = explode(' ', $item->User->name );
                                                $chunks = array_chunk($words, 3);
                                                foreach ($chunks as $chunk) {
                                                    echo implode(' ', $chunk) . '<br>';
                                                }
                                            @endphp
                                            <br>
                                            {{ $item->User->email }}
                                            <br>
                                            {{ $item->User->telefono }}
                                            <br>
                                            {{ $item->User->state }}

                                        </td>

                                        <td>
                                            {{ $item->membresia }}
                                        </td>

                                        <td>
                                            {{ $item->puntos_acomulados }}
                                        </td>

                                        <td>
                                            {{ $item->meses_acomulados }}
                                        </td>

                                        <td>
                                            <a href="" class="btn btn-outline-warning btn-sm btn-xs" data-bs-toggle="modal" data-bs-target="#exampleRevista_{{ $item->id }}">
                                                Accesos
                                            </a>
                                        </td>

                                        <td>
                                            @if ($item->puntos_faltantes > 0)
                                                <label class="badge" style="color: #b600e3;background-color: #ae00e340;">Dias Faltantes: <b> {{ $item->dias_restantes }} </b></label><br>
                                                Puntos faltantes: <b> {{ $item->puntos_faltantes }} </b>
                                            @else
                                                <label class="badge" style="color: #06a306;background-color: #00e3aa40;">Cumplio con la meta</label><br>
                                            @endif
                                        </td>

                                        <td>
                                            <a type="button" class="btn btn-primary btn-xs" data-bs-toggle="modal" data-bs-target="#staticBackdrop_{{ $item->id }}">
                                                <i class="fa fa-fw fa-edit"></i>
                                            </a>

                                            <form method="POST" class="" action="{{ route('distribuidoras.update_ocultar', $item->id) }}" enctype="multipart/form-data" role="form">
                                                @csrf
                                                <input type="hidden" name="_method" value="PATCH">

                                                <input type="hidden" name="ocultar" value="ocultar">

                                                <button type="submit"  class="btn btn-danger btn-xs">
                                                    <i class="fa fa-fw fa-trash"></i>
                                                </button>
                                            </form>

                                        </td>

                                    </tr>

                                        @include('cosmica.distribuidoras.modal_update')
                                        @include('cosmica.distribuidoras.modal_revista')

                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@include('cosmica.distribuidoras.modal_create')
@include('cosmica.distribuidoras.modal_por_vencer')
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
<script src="{{ asset('assets/admin/vendor/select2/dist/js/select2.min.js')}}"></script>

<script>

    document.addEventListener('DOMContentLoaded', function () {
        // Copiar enlace al portapapeles
        document.querySelectorAll('.copy-link').forEach(function(button) {
            button.addEventListener('click', function() {
                const link = this.getAttribute('data-link');
                const textarea = document.createElement('textarea');
                textarea.value = link;
                document.body.appendChild(textarea);
                textarea.select();
                document.execCommand('copy');
                document.body.removeChild(textarea);
                alert('Enlace copiado al portapapeles');
            });
        });

        // Enviar enlace por WhatsApp
        document.querySelectorAll('.whatsapp-link').forEach(function(button) {
            button.addEventListener('click', function() {
                const link = this.getAttribute('data-link');
                const whatsappUrl = `https://wa.me/?text=${encodeURIComponent(link)}`;
                window.open(whatsappUrl, '_blank');
            });
        });
    });


      </script>
<script type="text/javascript">

    $(document).ready(function() {

        $('.phone').select2();

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
            responsive: true,
            stateSave: true,

            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
            }
        });

    });
</script>
@endsection


