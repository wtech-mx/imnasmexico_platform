@extends('layouts.app_admin')

@section('template_title')
    Configuraciones de Paquetes
@endsection

@section('content')
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <a class="btn" id="regresar_btn" style="background: {{$configuracion->color_boton_close}}; color: #fff"><i class="fas fa-arrow-left"></i> Regresar </a>
                            <h3 class="mb-3">Configuraciones de Paquetes</h3>
                            <a type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                                ¿Como funciona?
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">

                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="paquete1">
                                        <button class="nav-link active" id="pills-paquete1-tab" data-bs-toggle="pill" data-bs-target="#pills-paquete1" type="button" role="tab" aria-controls="pills-paquete1" aria-selected="true">
                                            Paquete 1
                                        </button>
                                    </li>
                                    <li class="nav-item" role="paquete2">
                                        <button class="nav-link" id="pills-paquete2-tab" data-bs-toggle="pill" data-bs-target="#pills-paquete2" type="button" role="tab" aria-controls="pills-paquete2" aria-selected="true">
                                            Paquete 2
                                        </button>
                                    </li>
                                    <li class="nav-item" role="paquete3">
                                        <button class="nav-link" id="pills-paquete3-tab" data-bs-toggle="pill" data-bs-target="#pills-paquete3" type="button" role="tab" aria-controls="pills-paquete3" aria-selected="true">
                                            Paquete 3
                                        </button>
                                    </li>
                                    <li class="nav-item" role="paquete3">
                                        <button class="nav-link" id="pills-paquete4-tab" data-bs-toggle="pill" data-bs-target="#pills-paquete4" type="button" role="tab" aria-controls="pills-paquete4" aria-selected="true">
                                            Paquete 4
                                        </button>
                                    </li>
                                    <li class="nav-item" role="paquete3">
                                        <button class="nav-link" id="pills-paquete5-tab" data-bs-toggle="pill" data-bs-target="#pills-paquete5" type="button" role="tab" aria-controls="pills-paquete5" aria-selected="true">
                                            Paquete 5
                                        </button>
                                    </li>
                                    <li class="nav-item" role="paquete3">
                                        <button class="nav-link" id="pills-paquete6-tab" data-bs-toggle="pill" data-bs-target="#pills-paquete6" type="button" role="tab" aria-controls="pills-paquete6" aria-selected="true">
                                            Paquete 6
                                        </button>
                                    </li>
                                </ul>

                                <form method="POST" action="{{ route('paquetes.update', 1) }}" enctype="multipart/form-data" role="form">
                                    @csrf
                                    <input type="hidden" name="_method" value="PATCH">
                                    <div class="tab-content" id="pills-tabContent">

                                        <div class="tab-pane fade show active" id="pills-paquete1" role="tabpanel" aria-labelledby="pills-paquete1-tab" tabindex="0">
                                            <div class="row">
                                                <h5 class="mb-3">Paquete 1</h5>

                                                <div class="form-check col-2">
                                                    <div class="form-group">
                                                        @if ($paquete->visible_1 == 1)
                                                            <input class="form-check-input" type="checkbox" value="1" id="visible_1" name="visible_1" checked>
                                                            <label for="nota">Paquete visible*</label>
                                                        @else
                                                            <input class="form-check-input" type="checkbox" value="1" id="visible_1" name="visible_1">
                                                            <label for="nota">Paquete visible*</label>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="">Precio Paquete 1*</label>
                                                        <input type="number" class="form-control" id="precio_1" name="precio_1" value="{{$paquete->precio_1}}"/>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Precio Descuento Paquete 1*</label>
                                                        <input type="number" class="form-control" id="precio_rebajado_1" name="precio_rebajado_1" value="{{$paquete->precio_rebajado_1}}"/>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <h5>Seleccionar cursos que incluye*</h5>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <select name="cursos1[]" class="form-select d-inline-block js-example-basic-multiple" style="width: 70%!important;" multiple="multiple">
                                                            @foreach ($cursosArray as $nombre)
                                                                <option value="{{ $nombre }}">{{$nombre}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <h5>Cursos incluidos actualmente</h5>
                                                @foreach ($paquete_incluye as $incluye)
                                                  @if ($incluye->num_paquete == 1)
                                                    <div class="col-10">
                                                        <p>{{$incluye->nombre_curso}}</p>
                                                    </div>

                                                    <div class="col-2">
                                                        Quitar
                                                    </div>
                                                  @endif
                                                @endforeach

                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="pills-paquete2" role="tabpanel" aria-labelledby="pills-paquete2-tab" tabindex="0">
                                            <div class="row">
                                                <h5 class="mb-3">Paquete 2</h5>

                                                <div class="form-check col-2">
                                                    <div class="form-group">
                                                        @if ($paquete->visible_2 == 1)
                                                            <input class="form-check-input" type="checkbox" value="1" id="visible_2" name="visible_2" checked>
                                                            <label for="nota">Paquete visible</label>
                                                        @else
                                                            <input class="form-check-input" type="checkbox" value="1" id="visible_2" name="visible_2">
                                                            <label for="nota">Paquete visible</label>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="">Precio Paquete 2</label>
                                                        <input type="number" class="form-control" id="precio_2" name="precio_2" value="{{$paquete->precio_2}}"/>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Precio Descuento Paquete 2</label>
                                                        <input type="number" class="form-control" id="precio_rebajado_2" name="precio_rebajado_2" value="{{$paquete->precio_rebajado_2}}"/>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <h5>Seleccionar cursos que incluye*</h5>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <select name="cursos2[]" class="form-select d-inline-block js-example-basic-multiple" style="width: 70%!important;" multiple="multiple">
                                                            @foreach ($cursosArray as $nombre)
                                                                <option value="{{ $nombre }}">{{$nombre}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <h5>Cursos incluidos actualmente</h5>
                                                @foreach ($paquete_incluye as $incluye)
                                                  @if ($incluye->num_paquete == 2)
                                                    <div class="col-10">
                                                        <p>{{$incluye->nombre_curso}}</p>
                                                    </div>

                                                    <div class="col-2">
                                                        Quitar
                                                    </div>
                                                  @endif
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="pills-paquete3" role="tabpanel" aria-labelledby="pills-paquete3-tab" tabindex="0">
                                            <div class="row">
                                                <h5 class="mb-3">Paquete 3</h5>

                                                <div class="form-check col-2">
                                                    <div class="form-group">
                                                        @if ($paquete->visible_3 == 1)
                                                            <input class="form-check-input" type="checkbox" value="1" id="visible_3" name="visible_3" checked>
                                                            <label for="nota">Paquete visible</label>
                                                        @else
                                                            <input class="form-check-input" type="checkbox" value="1" id="visible_3" name="visible_3">
                                                            <label for="nota">Paquete visible</label>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="">Precio Paquete 3</label>
                                                        <input type="number" class="form-control" id="precio_3" name="precio_3" value="{{$paquete->precio_3}}"/>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Precio Descuento Paquete 3</label>
                                                        <input type="number" class="form-control" id="precio_rebajado_3" name="precio_rebajado_3" value="{{$paquete->precio_rebajado_3}}"/>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <h5>Seleccionar cursos que incluye*</h5>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <select name="cursos3[]" class="form-select d-inline-block js-example-basic-multiple" style="width: 70%!important;" multiple="multiple">
                                                            @foreach ($cursosArray as $nombre)
                                                                <option value="{{ $nombre }}">{{$nombre}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <h5>Cursos incluidos actualmente</h5>
                                                @foreach ($paquete_incluye as $incluye)
                                                  @if ($incluye->num_paquete == 3)
                                                    <div class="col-10">
                                                        <p>{{$incluye->nombre_curso}}</p>
                                                    </div>

                                                    <div class="col-2">
                                                        Quitar
                                                    </div>
                                                  @endif
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="pills-paquete4" role="tabpanel" aria-labelledby="pills-paquete4-tab" tabindex="0">
                                            <div class="row">
                                                <h5 class="mb-3">Paquete 4</h5>

                                                <div class="form-check col-2">
                                                    <div class="form-group">
                                                        @if ($paquete->visible_4 == 1)
                                                            <input class="form-check-input" type="checkbox" value="1" id="visible_4" name="visible_4" checked>
                                                            <label for="nota">Paquete visible</label>
                                                        @else
                                                            <input class="form-check-input" type="checkbox" value="1" id="visible_4" name="visible_4">
                                                            <label for="nota">Paquete visible</label>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="">Precio Paquete 4</label>
                                                        <input type="number" class="form-control" id="precio_4" name="precio_4" value="{{$paquete->precio_4}}"/>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Precio Descuento Paquete 4</label>
                                                        <input type="number" class="form-control" id="precio_rebajado_4" name="precio_rebajado_4" value="{{$paquete->precio_rebajado_4}}"/>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <h5>Seleccionar cursos que incluye*</h5>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <select name="cursos4[]" class="form-select d-inline-block js-example-basic-multiple" style="width: 70%!important;" multiple="multiple">
                                                            @foreach ($cursosArray as $nombre)
                                                                <option value="{{ $nombre }}">{{$nombre}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <h5>Cursos incluidos actualmente</h5>
                                                @foreach ($paquete_incluye as $incluye)
                                                  @if ($incluye->num_paquete == 4)
                                                    <div class="col-10">
                                                        <p>{{$incluye->nombre_curso}}</p>
                                                    </div>

                                                    <div class="col-2">
                                                        Quitar
                                                    </div>
                                                  @endif
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="pills-paquete5" role="tabpanel" aria-labelledby="pills-paquete5-tab" tabindex="0">
                                            <div class="row">
                                                <h5 class="mb-3">Paquete 5</h5>
                                                <div class="form-check col-2">
                                                    <div class="form-group">
                                                        @if ($paquete->visible_5 == 1)
                                                            <input class="form-check-input" type="checkbox" value="1" id="visible_5" name="visible_5" checked>
                                                            <label for="nota">Paquete visible</label>
                                                        @else
                                                            <input class="form-check-input" type="checkbox" value="1" id="visible_5" name="visible_5">
                                                            <label for="nota">Paquete visible</label>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="">Precio Paquete 5</label>
                                                        <input type="number" class="form-control" id="precio_5" name="precio_5" value="{{$paquete->precio_5}}"/>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Precio Descuento Paquete 5</label>
                                                        <input type="number" class="form-control" id="precio_rebajado_5" name="precio_rebajado_5" value="{{$paquete->precio_rebajado_5}}"/>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <h5>Seleccionar cursos que incluye*</h5>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <select name="cursos5[]" class="form-select d-inline-block js-example-basic-multiple" style="width: 70%!important;" multiple="multiple">
                                                            @foreach ($cursosArray as $nombre)
                                                                <option value="{{ $nombre }}">{{$nombre}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <h5>Cursos incluidos actualmente</h5>
                                                @foreach ($paquete_incluye as $incluye)
                                                  @if ($incluye->num_paquete == 5)
                                                    <div class="col-10">
                                                        <p>{{$incluye->nombre_curso}}</p>
                                                    </div>

                                                    <div class="col-2">
                                                        Quitar
                                                    </div>
                                                  @endif
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="pills-paquete6" role="tabpanel" aria-labelledby="pills-paquete6-tab" tabindex="0">
                                            <div class="row">
                                                <h5 class="mb-3">Paquete 6 Personalizado</h5>

                                                <div class="form-check col-2">
                                                    <div class="form-group">
                                                        @if ($paquete->visible_1 == 1)
                                                            <input class="form-check-input" type="checkbox" value="1" id="visible_6" name="visible_6" checked>
                                                            <label for="nota">Paquete visible*</label>
                                                        @else
                                                            <input class="form-check-input" type="checkbox" value="1" id="visible_6" name="visible_6">
                                                            <label for="nota">Paquete visible*</label>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="">Precio Paquete 6*</label>
                                                        <input type="number" class="form-control" id="precio_6" name="precio_6" value="{{$paquete->precio_6}}"/>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Precio Descuento Paquete 6*</label>
                                                        <input type="number" class="form-control" id="precio_rebajado_6" name="precio_rebajado_6" value="{{$paquete->precio_rebajado_6}}"/>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <h5>Seleccionar cursos que incluye*</h5>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <select name="cursos6[]" class="form-select d-inline-block js-example-basic-multiple" style="width: 70%!important;" multiple="multiple">
                                                            @foreach ($cursosArray as $nombre)
                                                                <option value="{{ $nombre }}">{{$nombre}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <h5>Cursos incluidos actualmente</h5>
                                                @foreach ($paquete_incluye as $incluye)
                                                  @if ($incluye->num_paquete == 6)
                                                    <div class="col-10">
                                                        <p>{{$incluye->nombre_curso}}</p>
                                                    </div>

                                                    <div class="col-2">
                                                        Quitar
                                                    </div>
                                                  @endif
                                                @endforeach

                                            </div>
                                        </div>

                                        @can('pagina-edit')
                                        <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                                        @endcan
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('datatable')
<script src="{{ asset('assets/admin/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('assets/admin/vendor/select2/dist/js/select2.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>
@endsection
