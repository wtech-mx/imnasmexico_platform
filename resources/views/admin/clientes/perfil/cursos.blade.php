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
                            <th>
                                <img id="blah" src="{{asset('curso/'.$curso->Cursos->foto) }}" alt="Imagen" style="width: 60px; height: 60px;"/> <br>
                                {{ $curso->Cursos->nombre }}
                            </th>

                            <th>
                                @php
                                $fecha = $curso->Cursos->fecha_inicial;
                                $fecha_timestamp = strtotime($fecha);
                                $fecha_formateada = date('d \d\e F \d\e\l Y', $fecha_timestamp);

                                $fecha2 = $curso->Cursos->fecha_final;
                                $fecha_timestamp2 = strtotime($fecha2);
                                $fecha_formateada2 = date('d \d\e F \d\e\l Y', $fecha_timestamp2);
                                @endphp
                               Del: {{$fecha_formateada}} <br>
                               Al: {{$fecha_formateada2}}
                            </th>

                            @if ($curso->Cursos->modalidad == "Online")
                                <td> <label class="badge badge-sm" style="color: #009ee3;background-color: #009ee340;">Online</label> </td>
                            @else
                                <td> <label class="badge badge-sm" style="color: #746AB0;background-color: #746ab061;">Presencial</label> </td>
                            @endif
                            <td>
                                <a type="button" class="btn btn-sm btn-primary" href="{{ route('cursos.listas',$curso->Cursos->id) }}" title="Listas de clase"><i class="fa fa-users"></i> {{ $curso->Cursos->orderTicket->count() }}</a>
                                <a class="btn btn-sm btn-danger" href="{{ route('pagos.edit_pago',$curso->Orders->id) }}"><i class="fa fa-newspaper" title="Ver Orden"></i> </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@section('datatable')
    <script>
        const dataTableTiendita = new simpleDatatables.DataTable("#datatable-cursos", {
            deferRender:true,
            paging: true,
            pageLength: 10
        });
    </script>
@endsection
