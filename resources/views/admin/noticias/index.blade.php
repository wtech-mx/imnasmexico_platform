@extends('layouts.app_admin')

@section('template_title')
    Noticias
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header">

                        <div class="d-flex justify-content-between">

                            <h3 class="mb-3">Noticias</h3>

                            <a type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                                ¿Como funciona?
                            </a>

                            <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#create_noticia" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                Crear Noticias
                            </a>

                        </div>
                    </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-flush" id="datatable-search">
                                    <thead class="thead">
                                        <tr>
                                            <th>No</th>
                                            <th>Img / Video</th>
                                            <th>Titulo</th>
                                            <th>Descripcion</th>
                                            <th>Estatus</th>
                                            <th>Orden</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($noticias as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>

                                                <th>
                                                    <img id="blah" src="{{asset('noticias/'.$item->multimedia) }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                                                </th>

                                                <td>{{ $item->titulo }}</td>

                                                <td>{{ $item->descripcion }}</td>

                                                <td>{{ $item->estatus }}</td>

                                                <td>{{ $item->orden }}</td>

                                                <td>
                                                    <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#edit_noticia{{$item->id}}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                                        <i class="fa fa-fw fa-edit"></i>
                                                    </a>
                                                </td>

                                            </tr>
                                            @include('admin.noticias.edit')
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.noticias.create')
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
