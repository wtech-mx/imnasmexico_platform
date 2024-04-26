<div class="row mb-4" style="    background: #ffffff7d;border-radius: 9px;padding: 5px;">
    <div class="col-4">
        <h3 style="color: #35a79e">Estandares</h3>
        <ul>
            <li ><h4>{{$estandar_item->estandar->estandar}}</h4></li>
        </ul>
    </div>

    <div class="col-4 ">
        <h3 style="color: #35a79e">Estatus</h3>
        <a type="button" data-bs-toggle="modal" data-bs-target="#modal_estatus_{{ $estandar_item->id }}" style="background: #3599a7;padding: 2px;border-radius: 6px;"><h5 style="color: #ffff;">Selecionar Estatus</h5></a>
        <div class="row">
            <div class="col-6">
                <p style=""><strong><h4>{{ $estandar_item->estatus }}</h4></strong></p>
            </div>
            <div class="col-6">

            </div>
        </div>
    </div>

    <div class="col-2 ">
        <h3 style="color: #35a79e">Evaluador</h3>
        <a class="mb-2" type="button" data-bs-toggle="modal" data-bs-target="#modal_evaluador_{{ $estandar_item->id }}" style="background: #a77235; color: #ffff; padding: 2px;border-radius: 6px;"><h5 style="color: #ffff;">Selecionar Evaluador</h5></a>

        @if( $estandar_item->evaluador == 'EC0002 Kay')
            <h4 style="background: #fff200;padding: 2px;border-radius: 6px;display:block;"><strong>{{ $estandar_item->evaluador }}</strong></h4>

        @elseif ( $estandar_item->evaluador == 'EC0040 Martin')
            <h4 style="background: #0062ff;padding: 2px;border-radius: 6px;display:inline-block;color:white"><strong>{{ $estandar_item->evaluador }}</strong></h4>

        @elseif ( $estandar_item->evaluador == 'EC0001 Carla')
            <h4 style="background: #2ab300;padding: 2px;border-radius: 6px;display:inline-block;color:white"><strong>{{ $estandar_item->evaluador }}</strong></h4>

        @endif

    </div>

    <div class="col-2">
        <h3 style="color: #35a79e">Acciones</h3>

        <a class="btn btn-sm" data-bs-toggle="collapse" href="#collapseFechas-{{ $estandar_item->id }}" role="button" aria-expanded="false" aria-controls="collapseExample" style="background: #a73548;padding: 2px;border-radius: 6px;">
            <h5 style="color: #ffff;"> Ver Estatus con fechas</h5>
        </a>
    </div>

    <div class="col-8">
        @include('admin.notas_cam.fechas_estatus')
    </div>
</div>
