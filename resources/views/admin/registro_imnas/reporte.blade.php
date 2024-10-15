@extends('layouts.app_admin')

@section('template_title')
    Reporte Registro IMNAS
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="mb-3">Reporte Registros IMNAS</h3>

                            <a type="button" class="btn btn-sm bg-danger" data-bs-toggle="modal" data-bs-target="#manual_instrucciones" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                ¿Como fucniona?
                            </a>
                        </div>
                        <div class="col-12">
                            <form class="row mt-3 mb-3" action="{{ route('registro_imnas.buscador') }}" method="GET" >
                                @csrf
                                <div class="col-12">
                                    <h6>Filtro</h6>
                                </div>

                                <div class="col-6 col-md-4 col-lg-4 py-3">
                                    <label class="form-label tiitle_products">Fecha inicio</label>
                                    <div class="input-group">
                                        <span class="input-group-text span_custom_tab" >
                                            <img class="icon_span_tab" src="{{ asset('assets/media/icons/cero.webp') }}" alt="" >
                                        </span>
                                        <input id="fecha_inicio" name="fecha_inicio" type="date" class="form-control">
                                    </div>
                                </div>

                                <div class="col-6 col-md-4 col-lg-4 py-3">
                                    <label class="form-label tiitle_products">Fecha fin</label>
                                    <div class="input-group">
                                        <span class="input-group-text span_custom_tab" >
                                            <img class="icon_span_tab" src="{{ asset('assets/media/icons/cero.webp') }}" alt="" >
                                        </span>
                                        <input id="fecha_fin" name="fecha_fin" type="date" class="form-control">
                                    </div>
                                </div>

                                <div class="col-6 col-md-4 col-lg-4 py-3">
                                    <label class="form-label tiitle_products">-</label>
                                    <div class="input-group">
                                        <button class="btn btn_filter" type="submit" style="">Filtrar
                                        </button>
                                    </div>

                                </div>
                            </form>

                            <form class="row mt-3 mb-3" action="{{ route('registro_imnas.pdf') }}" method="GET" >
                                @csrf
                                <div class="col-3">
                                    <button class="btn btn-dark" type="submit" style="">Imprimir PDF</button>
                                </div>
                                @if(Route::currentRouteName() != 'registro_compras.reporte')
                                    <input type="date" name="fecha_inicial" value="{{ request('fecha_inicio') }}" style="display: none">
                                    <input type="date" name="fecha_inicial" value="{{ request('fecha_fin') }}" style="display: none">
                                @else
                                    <input type="date" name="fecha_inicial" value="{{ date('Y-m-d') }}" style="display: none">
                                    <input type="date" name="fecha_inicial" value="{{ date('Y-m-d') }}" style="display: none">
                                @endif
                            </form>
                        </div>
                    </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-flush" id="datatable-search">
                                    <thead class="thead">
                                        <tr>
                                            <th>No</th>
                                            <th>Cliente</th>
                                            <th>Curso</th>
                                            <th>tipo_documento</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($registros_imnas as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->cliente }}</td>
                                                <td>{{ $item->curso }}</td>
                                                <td>
                                                    @if ($item->tipo_documento == 1)
                                                    Diploma STPS General
                                                    @elseif ($item->tipo_documento == 2)
                                                    RN-Cedula de identidad de papel General
                                                    @elseif ($item->tipo_documento == 3)
                                                    RN - Titulo Honorifico QRS
                                                    @elseif ($item->tipo_documento == 4)
                                                    RN - Diploma Imnas
                                                    @elseif ($item->tipo_documento == 5)
                                                    RN - Credencial General
                                                    @elseif ($item->tipo_documento == 6)
                                                    CN - Tira de materias aparatologia
                                                    @elseif ($item->tipo_documento == 7)
                                                    CN - Tira de materias alasiados progresivos
                                                    @elseif ($item->tipo_documento == 8)
                                                    CN - Tira de materias cosmetologia facial y corporal
                                                    @elseif ($item->tipo_documento == 9)
                                                    CN - Tira de materias cosmeatria estetica avanzada
                                                    @elseif ($item->tipo_documento == 10)
                                                    CN - Tira de materias auxiliar en cuidados de atencion medica
                                                    @elseif ($item->tipo_documento == 11)
                                                    CN - Tira de materias masoterapia
                                                    @elseif ($item->tipo_documento == 12)
                                                    CN - Tira de materias Cosmetologia
                                                    @elseif ($item->tipo_documento == 15)
                                                    CN - Tira de materias drenaje linfatico
                                                    @elseif ($item->tipo_documento == 16)
                                                    Titulo honorifico Nuevo
                                                    @elseif ($item->tipo_documento == 17)
                                                    Formato DC-3
                                                    @elseif ($item->tipo_documento == 18)
                                                    Tira materias Afiliados
                                                    @endif
                                                </td>
                                                <td>{{ $item->created_at->format('d F h:i a') }}</td>
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
        deferRender:true,
        paging: true,
        pageLength: 10
    });
</script>

@endsection
