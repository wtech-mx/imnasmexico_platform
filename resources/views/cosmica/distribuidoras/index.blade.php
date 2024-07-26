@extends('layouts.app_admin')

@section('template_title')
    Cosmica Distribuidoras
@endsection

@section('css')
 <!-- Select2  -->
 <link rel="stylesheet" href="{{asset('assets/admin/vendor/select2/dist/css/select2.min.css')}}">
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
                                                <i class="fa fa-fw fa-edit"></i> Editar
                                            </a>
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

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
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

        const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
            searchable: true,
            fixedHeight: false
        });

    });
</script>
@endsection


