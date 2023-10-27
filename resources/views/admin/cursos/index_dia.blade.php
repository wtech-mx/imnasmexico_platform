@extends('layouts.app_admin')

@section('template_title')
    Cursos  de Dia
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

                            <h3 class="mb-3">Cursos de Dia</h3>

                            <a type="button" class="btn btn-sm bg-danger" data-bs-toggle="modal" data-bs-target="#manual_instrucciones" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                ¿Como fucniona?
                            </a>
                        </div>
                    </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-flush" id="datatable-search">
                                    <thead class="thead">
                                        <tr>
                                            <th>No</th>
                                            <th>Img</th>
                                            <th>Nombre</th>
                                            <th>fecha inicio</th>
                                            <th>fecha final</th>
                                            <th>modalidad</th>

                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cursos as $curso)
                                            <tr class="{{ ($curso->orderTicket->where('estatus_doc', '!=', 1)->isEmpty() && $curso->orderTicket->where('estatus_cedula', '!=', 1)->isEmpty() && $curso->orderTicket->where('estatus_titulo', '!=', 1)->isEmpty() && $curso->orderTicket->where('estatus_diploma', '!=', 1)->isEmpty() && $curso->orderTicket->where('estatus_credencial', '!=', 1)->isEmpty() && $curso->orderTicket->where('estatus_tira', '!=', 1)->isEmpty()) ? 'estatus-doc-green' : 'estatus-doc-red' }}">
                                                <td>{{ $curso->id }}</td>
                                                <th><img id="blah" src="{{asset('curso/'.$curso->foto) }}" alt="Imagen" style="width: 60px; height: 60px;"/></th>

                                                <td>{{ $curso->nombre }}</td>
                                                <td>{{ $curso->fecha_inicial }}</td>
                                                <td>{{ $curso->fecha_final }}</td>
                                                @if ($curso->modalidad == "Online")
                                                    <td> <label class="badge" style="color: #009ee3;background-color: #009ee340;">Online</label> </td>
                                                @else
                                                    <td> <label class="badge" style="color: #746AB0;background-color: #746ab061;">Presencial</label> </td>
                                                @endif

                                                <td>
                                                    @can('cursos-lista')
                                                        <a type="button" class="btn btn-sm btn-primary" href="{{ route('cursos.listas',$curso->id) }}"><i class="fa fa-users"></i> {{ $curso->orderTicket->count() }}</a>
                                                    @endcan
                                                    @if ($curso->modalidad == 'Online')
                                                        <a type="button" class="btn btn-sm btn-ligth" data-bs-toggle="modal" data-bs-target="#update_modal_{{ $curso->id }}" title="Ligas">
                                                            <i class="fab fa-google"></i>
                                                            {{-- <img id="blah" src="{{asset('assets/user/icons/meet.png') }}" alt="Imagen" style="width: 15px; height: 15px;"/> --}}
                                                        </a>
                                                    @endif
                                                    @can('cursos-edit')
                                                        <a class="btn btn-sm btn-success" href="{{ route('cursos.edit',$curso->id) }}"><i class="fa fa-fw fa-edit"></i> </a>
                                                    @endcan
                                                    <a class="btn btn-sm btn-info" href="{{ route('cursos.show',$curso->slug) }}" target="_blank"><i class="fas fa-external-link-alt"></i></a>
                                                </td>
                                            </tr>
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
