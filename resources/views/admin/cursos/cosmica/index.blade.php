@extends('layouts.app_admin')

@section('template_title')
    Eventos Cosmica
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header">

                        <div class="d-flex justify-content-between">

                            <h3 class="mb-3">Eventos Cosmica</h3>

                        </div>
                    </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-flush" id="datatable-search">
                                    <thead class="thead">
                                        <tr>
                                            <th>No</th>
                                            <th>Modalidad</th>
                                            <th>Nombre</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cursos as $curso)
                                                <tr>
                                                    <td>{{ $curso->id }}</td>
                                                    {{-- <th><img id="blah" src="{{$curso_imnas->imagenes}}" alt="Imagen" style="width: 60px; height: 60px;"/></th> --}}

                                                    <td> <label class="badge badge-sm" style="color: #009ee3;background-color: #009ee340;">Online</label> </td>

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
                                                    {{-- <td>
                                                        @php
                                                        $fecha = $curso_imnas->fecha_inicial;
                                                        $fecha_timestamp = strtotime($fecha);
                                                        $fecha_formateada = date('d \d\e F \d\e\l Y', $fecha_timestamp);
                                                        @endphp
                                                        {{$fecha_formateada}}
                                                    </td> --}}

                                                    <td>
                                                        {{-- @can('cursos-duplicar')
                                                            <button class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#duplicarModal{{ $curso->id }}" title="Duplicar">
                                                                <i class="fas fa-copy"></i>
                                                            </button>
                                                        @endcan

                                                        @can('cursos-ligas')
                                                            @if ($curso->modalidad == 'Online')
                                                                <a type="button" class="btn btn-sm btn-ligth" data-bs-toggle="modal" data-bs-target="#update_modal_{{ $curso->id }}" title="Ligas">
                                                                    <i class="fab fa-google"></i>
                                                                </a>
                                                            @endif
                                                        @endcan --}}

                                                        <a type="button" class="btn btn-sm btn-primary" href="{{ route('eventos_cosmica.listas',$curso->id) }}" title="Listas de clase"><i class="fa fa-users"></i> {{ $curso->userCount }}</a>

                                                        {{-- @can('cursos-edit')
                                                            <a class="btn btn-sm btn-success" href="{{ route('cursos.edit',$curso->id) }}" title="Editar"><i class="fa fa-fw fa-edit"></i> </a>
                                                        @endcan --}}
                                                    </td>
                                                </tr>
                                                @include('admin.cursos.modal_duplicar')
                                                @include('admin.cursos.modal_materialclase')
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
