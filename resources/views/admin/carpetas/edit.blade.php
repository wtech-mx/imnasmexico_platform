@extends('layouts.app_admin')

@section('template_title')
    Editar Carpeta
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header">

                        <div class="d-flex justify-content-between">

                            <h3 class="mb-3">Editar Carpeta</h3>
                            <form method="POST" action="{{ route('carpetas.update', $carpetas->id) }}" enctype="multipart/form-data" role="form">
                                @csrf
                                <input type="hidden" name="_method" value="PATCH">
                                <div class="form-group">
                                    <input id="nombre" name="nombre" type="text" class="form-control" value="{{$carpetas->nombre}}">
                                </div>
                                <div class="modal-body">
                                    <div class="col-12">
                                        <input class="form-control" type="file" name="archivos[]" multiple>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Actualizar</button>
                                </div>
                            </form>
                        </div>
                    </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-flush" id="datatable-search">
                                    <thead class="thead">
                                        <tr>
                                            <th>Vista</th>
                                            <th>Nombre</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($carpeta_recursos as $recurso)
                                            @php
                                                $file_info = new SplFileInfo($recurso->nombre);
                                                $extension = $file_info->getExtension();
                                            @endphp
                                            <tr>
                                                <td>
                                                    @if ($extension === 'pdf')
                                                        <embed src="{{ asset('cursos/' . $carpetas->nombre . '/' . $recurso->nombre) }}" type="application/pdf" style="width: 120px; height: 120px;" />
                                                    @else
                                                        <img id="img_material_clase" src="{{asset('cursos/'. $carpetas->nombre . '/' . $recurso->nombre) }}" style="width: 100px; height: 100px;"/>
                                                    @endif
                                                </td>
                                                <td>{{ $recurso->nombre }}</td>
                                                <td>
                                                    <a class="btn btn-sm btn-danger" onclick="event.preventDefault(); document.getElementById('delete-form').submit();"><i class="fa fa-trash-o"></i></a>
                                                    <form id="delete-form" action="{{ route('carpetas.destroy', $recurso->id) }}" method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
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

<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      searchable: true,
      fixedHeight: false
    });
</script>

@endsection
