@extends('layouts.app_admin')

@section('template_title')
    Agregar archivos - {{$carpeta->nombre}}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header">

                        <div class="d-flex justify-content-between">

                            <h3 class="mb-3">Agregar archivos - {{$carpeta->nombre}}</h3>
                            <form method="POST" action="{{ route('crear.documentos') }}" enctype="multipart/form-data" role="form">
                                @csrf
                                <div class="modal-body">
                                    <div class="col-12">
                                        <input class="form-control" type="file" name="archivos[]" multiple>
                                    </div>
                                </div>
                                <input id="id_carpdoc" name="id_carpdoc" type="text" class="form-control" value="{{$carpeta->id}}" style="display: none">
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
                                        @foreach ($documentos as $documento)
                                            @php
                                                $file_info = new SplFileInfo($documento->nombre);
                                                $extension = $file_info->getExtension();

                                                $nombreCompleto = $documento->nombre;
                                                $nuevoNombre = substr($nombreCompleto, 13);
                                            @endphp
                                            <tr>
                                                @if ($documento->categoria == 'FORMATOS ESTANDARES')
                                                    <td>
                                                        @if ($extension === 'pdf')
                                                            <embed src="{{ asset('cam_doc/'. $documento->nombre) }}" type="application/pdf" style="width: 120px; height: 120px;" />
                                                        @else
                                                            <img id="img_material_clase" src="{{asset('cam_doc/'. $documento->nombre) }}" style="width: 100px; height: 100px;"/>
                                                        @endif
                                                    </td>
                                                @else
                                                    <td>
                                                        @if ($extension === 'pdf')
                                                            <embed src="{{ asset('cam_doc_general/'. $documento->nombre) }}" type="application/pdf" style="width: 120px; height: 120px;" />
                                                        @else
                                                            <img id="img_material_clase" src="{{asset('cam_doc_general/'. $documento->nombre) }}" style="width: 100px; height: 100px;"/>
                                                        @endif
                                                    </td>
                                                @endif

                                                <td>{{ $nuevoNombre }}</td>
                                                <td>
                                                    {{-- <a class="btn btn-sm btn-danger" onclick="event.preventDefault(); document.getElementById('delete-form').submit();"><i class="fa fa-trash-o"></i></a>
                                                    <form id="delete-form" action="{{ route('carpetas_estandares.destroy', $documento->id) }}" method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form> --}}
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
