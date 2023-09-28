<div class="card mt-3">
    <div class="card-header pb-0 p-3">
        <div class="row">
            <div class="col-md-4 d-flex align-items-center">
                <h6 class="mb-0">Estandares</h6>
            </div>
            <div class="col-md-8 text-end">
               <h6><strong>Costo emisión:</strong><br> ${{ $expediente->Nota->Cliente->costo_emi }}.00 mxn</h6>
            </div>
        </div>
    </div>
    <div class="card-body p-3">
        <ul class="list-group">

            <div class="table-responsive">
                <table class="table table-flush" id="datatable-search">
                    <thead class="thead-light">
                        <tr>
                            <th>Estatus</th>
                            <th>Estandar</th>
                            <th>Fecha evaluación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    @foreach ($estandares_usuario as $estandar_usuario)
                    <tr>
                        <td>
                            @if ($estandar_usuario->estatus == 'Programado')
                                <p class="border-radius-md shadow text-xs text-white" style="padding:5px;background-color: #05cdff;">Programado</p>
                            @elseif($estandar_usuario->estatus == 'Evaluado')
                                <p class="border-radius-md shadow text-xs text-white" style="padding:5px;background-color: #fbff05;">Evaluado</p>
                            @elseif($estandar_usuario->estatus == 'En proceso')
                                <p class="border-radius-md shadow text-xs text-white" style="padding:5px;background-color: #c05b21;">En proceso</p>
                            @elseif($estandar_usuario->estatus == 'Entregado')
                                <p class="border-radius-md shadow text-xs text-white" style="padding:5px;background-color: #63ac28;">Entregado</p>
                            @elseif($estandar_usuario->estatus == 'Sin estatus')
                                <p class="border-radius-md shadow text-xs text-white" style="padding:5px;background-color: #161616;">Sin estatus</p>
                            @endif
                        </td>

                        <td>{{$estandar_usuario->Estandar->estandar}}</td>
                        <td>{{$estandar_usuario->fecha_evaluar}}</td>
                        <td>
                            <a data-bs-toggle="modal" data-bs-target="#exampleModalEstatus{{$estandar_usuario->id}}" class="btn btn-link pe-3 ps-0 mb-0 ms-auto">Editar</a>
                        </td>
                    </tr>
                    @include('cam.admin.expedientes.modal_estatus')
                    @endforeach
                </table>
            </div>

        </ul>
    </div>
</div>
