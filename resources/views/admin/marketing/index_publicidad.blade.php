@extends('layouts.app_admin')

@section('template_title')
    Publicidad
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header">

                        <div class="d-flex justify-content-between">

                            <a class="btn" id="regresar_btn" style="background: {{$configuracion->color_boton_close}}; color: #fff"><i class="fas fa-arrow-left"></i> Regresar </a>


                            <h3 class="mb-3">Publicidad</h3>

                            <a type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                                ¿Como funciona?
                            </a>

                        </div>

                        <div class="row">
                            <div class="col-4   ">
                                @can('publicidad-agregar')
                                <form method="POST" action="{{ route('publicidad.store') }}" enctype="multipart/form-data" role="form">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="col-12">
                                            <input class="form-control" type="file" name="archivos[]" multiple>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Agregar</button>
                                    </div>
                                </form>
                            @endcan

                            </div>
                        </div>
                    </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-flush" id="datatable-search">
                                    <thead class="thead">
                                        <tr>
                                            <th>id</th>
                                            <th>Vista</th>
                                            <th>Nombre</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($publicidad as $recurso)
                                            @php
                                                $file_info = new SplFileInfo($recurso->nombre);
                                                $extension = $file_info->getExtension();
                                            @endphp
                                            <tr>
                                                <td>{{  $recurso->id }}</td>

                                                <td>
                                                    @if ($extension === 'pdf')
                                                        <iframe src="{{ asset('archivos/'.$recurso->nombre) }}" class=""></iframe>
                                                    @else
                                                        <img id="img_material_clase" src="{{asset('archivos/'. $recurso->nombre) }}" style="width: 100px; height: 100px;"/>
                                                    @endif
                                                    <a href="{{ asset('archivos/'.$recurso->nombre) }}" target="_blank" >
                                                        Ver
                                                    </a>
                                                </td>

                                                <td>{{ $recurso->nombre }}</td>

                                                <td>
                                                    @can('publicidad-eliminar')
                                                        <a class="btn btn-sm btn-danger" onclick="event.preventDefault(); document.getElementById('delete-form').submit();"><i class="fa fa-trash-o"></i></a>
                                                        <form id="delete-form" action="{{ route('publicidad.destroy', $recurso->id) }}" method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    @endcan
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
