@extends('layouts.app_admin')

@section('template_title')
    Cursos del Mes
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

                            <h3 class="mb-3">Cursos del mes</h3>

                            <a type="button" class="btn btn-sm bg-danger" data-bs-toggle="modal" data-bs-target="#manual_instrucciones" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                ¿Como fucniona?
                            </a>

                            @can('cursos-create')
                                <a class="btn btn-sm btn-success" href="{{ route('cursos.create') }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                    <i class="fa fa-fw fa-edit"></i> Crear
                                </a>
                            @endcan
                        </div>
                    </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-flush" id="datatable-search">
                                    <thead class="thead">
                                        <tr>
                                            <th>No</th>
                                            <th>Img</th>
                                            <th>Modalidad</th>
                                            <th>Nombre</th>
                                            <th>fecha inicio</th>
                                            <th>fecha final</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cursos as $curso)
                                            <tr class="{{ ($curso->orderTicket->where('estatus_doc', '!=', 1)->isEmpty() && $curso->orderTicket->where('estatus_cedula', '!=', 1)->isEmpty() && $curso->orderTicket->where('estatus_titulo', '!=', 1)->isEmpty() && $curso->orderTicket->where('estatus_diploma', '!=', 1)->isEmpty() && $curso->orderTicket->where('estatus_credencial', '!=', 1)->isEmpty() && $curso->orderTicket->where('estatus_tira', '!=', 1)->isEmpty()) ? 'estatus-doc-green' : 'estatus-doc-red' }}">
                                                <td>{{ $curso->id }}</td>
                                                <th><img id="blah" src="{{asset('curso/'.$curso->foto) }}" alt="Imagen" style="width: 60px; height: 60px;"/></th>

                                                @if ($curso->modalidad == "Online")
                                                    <td> <label class="badge badge-sm" style="color: #009ee3;background-color: #009ee340;">Online</label> </td>
                                                @else
                                                    <td> <label class="badge badge-sm" style="color: #746AB0;background-color: #746ab061;">Presencial</label> </td>
                                                @endif

                                                <td>

                                                    @php
                                                        $nombreDelCurso = $curso->nombre;
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
                                                    $fecha = $curso->fecha_inicial;
                                                    $fecha_timestamp = strtotime($fecha);
                                                    $fecha_formateada = date('d \d\e F \d\e\l Y', $fecha_timestamp);
                                                    @endphp
                                                    {{$fecha_formateada}}
                                                </td>
                                                <td>
                                                    @php
                                                    $fecha = $curso->fecha_final;
                                                    $fecha_timestamp = strtotime($fecha);
                                                    $fecha_formateada = date('d \d\e F \d\e\l Y', $fecha_timestamp);
                                                    @endphp
                                                    {{$fecha_formateada}}
                                                </td>

                                                <td>
                                                    @can('cursos-duplicar')
                                                        <button class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#duplicarModal{{ $curso->id }}" title="Duplicar">
                                                            <i class="fas fa-copy"></i>
                                                        </button>
                                                    @endcan

                                                    {{-- <a type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#recordatorio_modal_{{ $curso->id }}" title="Recordatorios">
                                                        <i class="fa fa-bell"></i> {{ $curso->RecordatoriosCursos->count()}}
                                                    </a> --}}

                                                    @can('cursos-ligas')
                                                        @if ($curso->modalidad == 'Online')
                                                            <a type="button" class="btn btn-sm btn-ligth" data-bs-toggle="modal" data-bs-target="#update_modal_{{ $curso->id }}" title="Ligas">
                                                                <i class="fab fa-google"></i>
                                                                {{-- <img id="blah" src="{{asset('assets/user/icons/meet.png') }}" alt="Imagen" style="width: 15px; height: 15px;"/> --}}
                                                            </a>
                                                        @endif
                                                    @endcan

                                                    @can('cursos-lista')
                                                        <a type="button" class="btn btn-sm btn-primary" href="{{ route('cursos.listas',$curso->id) }}" title="Listas de clase"><i class="fa fa-users"></i> {{ $curso->userCount }}</a>
                                                    @endcan

                                                    @can('cursos-edit')
                                                        <a class="btn btn-sm btn-success" href="{{ route('cursos.edit',$curso->id) }}" title="Editar"><i class="fa fa-fw fa-edit"></i> </a>
                                                    @endcan
                                                    <a class="btn btn-sm btn-info" href="{{ route('cursos.show',$curso->slug) }}" target="_blank" title="Acceso Rapido"><i class="fas fa-external-link-alt"></i></a>
                                                </td>
                                            </tr>
                                        @include('admin.cursos.modal_duplicar')
                                        @include('admin.cursos.modal_materialclase')
                                        {{-- @include('admin.cursos.modal_recordatorio') --}}
                                        @include('admin.cursos.modal_meet')
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

<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
        deferRender:true,
        paging: true,
        pageLength: 10
    });
</script>

@endsection
