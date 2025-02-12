<!-- Card Basic Info -->
<div class="card mt-4" id="basic-info">
    <div class="card-header">
        <h5>Cursos tomados</h5>
    </div>
    <div class="card-body pt-0">
        <div class="row">
            <table class="table table-flush" id="datatable-cursos">
                <thead class="thead">
                    <tr>
                        <th>Curso</th>
                        <th>Fecha</th>
                        <th>Modalidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cursos as $curso)
                        <tr>
                            <td>{{ $curso->id }}</td>
                            <th><img id="blah" src="{{asset('curso/'.$curso->foto) }}" alt="Imagen" style="width: 60px; height: 60px;"/></th>

                            @if ($curso->modalidad == "Online")
                                <td> <label class="badge badge-sm" style="color: #009ee3;background-color: #009ee340;">Online</label> </td>
                            @else
                                <td> <label class="badge badge-sm" style="color: #746AB0;background-color: #746ab061;">Presencial</label> </td>
                            @endif
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
                                    <a type="button" class="btn btn-sm btn-primary" href="{{ route('cursos.listas',$curso->id) }}" title="Listas de clase"><i class="fa fa-users"></i> {{ $curso->orderTicket->count() }}</a>
                                @endcan

                                @can('cursos-edit')
                                    <a class="btn btn-sm btn-success" href="{{ route('cursos.edit',$curso->id) }}" title="Editar"><i class="fa fa-fw fa-edit"></i> </a>
                                @endcan
                                <a class="btn btn-sm btn-info" href="{{ route('cursos.show',$curso->slug) }}" target="_blank" title="Acceso Rapido"><i class="fas fa-external-link-alt"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
