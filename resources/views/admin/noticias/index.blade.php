@extends('layouts.app_admin')

@section('template_title')
    Noticias y Videos
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header">

                        <div class="d-flex justify-content-between">

                            <a class="btn" id="regresar_btn" style="background: {{$configuracion->color_boton_close}}; color: #fff"><i class="fas fa-arrow-left"></i> Regresar </a>


                            <h3 class="mb-3">Noticias y Videos</h3>

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
                                            <th>Orden</th>
                                            <th>Img / Video</th>
                                            <th>Titulo</th>
                                            <th>Descripcion</th>
                                            <th>Estatus</th>
                                            <th>Seccion</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($noticias as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>

                                                <td>{{ $item->orden }}</td>

                                                <th>
                                                    <img id="blah" src="{{asset('noticias/'.$item->multimedia) }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                                                </th>

                                                <td>
                                                    @php
                                                        $nombreDelCurso = $item->titulo;

                                                        $palabras = explode(' ', $nombreDelCurso);

                                                        // Inicializa la cadena formateada
                                                        $titulo_formateado = '';
                                                        $contador_palabras = 0;

                                                        foreach ($palabras as $palabra) {
                                                            // Agrega la palabra actual a la cadena formateada
                                                            $titulo_formateado .= $palabra . ' ';

                                                            // Incrementa el contador de palabras
                                                            $contador_palabras++;

                                                            // Agrega un salto de línea después de cada tercera palabra
                                                            if ($contador_palabras % 3 == 0) {
                                                                $titulo_formateado .= "<br>";
                                                            }
                                                        }
                                                    @endphp

                                                    {!! $titulo_formateado !!}

                                                </td>

                                                <td>

                                                    @php
                                                        $descripDelCurso = $item->descripcion;

                                                        $palabras = explode(' ', $descripDelCurso);

                                                        // Inicializa la cadena formateada
                                                        $descrip_formateado = '';
                                                        $contador_palabras = 0;

                                                        foreach ($palabras as $palabra) {
                                                            // Agrega la palabra actual a la cadena formateada
                                                            $descrip_formateado .= $palabra . ' ';

                                                            // Incrementa el contador de palabras
                                                            $contador_palabras++;

                                                            // Agrega un salto de línea después de cada tercera palabra
                                                            if ($contador_palabras % 3 == 0) {
                                                                $descrip_formateado .= "<br>";
                                                            }
                                                        }
                                                    @endphp

                                                    {!! $descrip_formateado !!}

                                                </td>

                                                <td>{{ $item->estatus }}</td>

                                                <td>{{ $item->seccion }}</td>

                                                <td>
                                                    <a type="button" class="btn btn-sm bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#edit_noticia{{$item->id}}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
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
