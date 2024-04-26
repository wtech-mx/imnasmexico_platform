<div class="collapse" id="collapseFechas-{{ $estandar_item->id }}">
    <div class="card card-body ">
        <div class="row">
            <div class="col-1">
                <span  id="basic-addon1">
                    <img src="{{ asset('assets/cam/ine.png') }}" alt="" width="35px">
                </span>
            </div>
            <div class="col-5">
                <h4> 1- Cedula</h4>
            </div>

            <div class="col-1">
                <span  id="basic-addon1">
                    <img src="{{ asset('assets/cam/calenda.png') }}" alt="" width="35px">
                </span>
            </div>
            <div class="col-5">
                <h4>{{ $estandar_item->fecha_cedula }}</h4>
            </div>

            <div class="col-1">
                <span id="basic-addon1">
                    <img src="{{ asset('assets/cam/usuario.png') }}" alt="" width="35px">
                </span>
            </div>
            <div class="col-5">
                <h4> 2- Subir Portafolio</h4>
            </div>

            <div class="col-1">
                <span id="basic-addon1">
                    <img src="{{ asset('assets/cam/calenda.png') }}" alt="" width="35px">
                </span>
            </div>
            <div class="col-5">
                <h4>{{ $estandar_item->fecha_portafolio }}</h4>
            </div>

            <div class="col-1">
                <span id="basic-addon1">
                    <img src="{{ asset('assets/cam/expediente.png') }}" alt="" width="35px">
                </span>
            </div>
            <div class="col-5">
                <h4>3- Crear Lote</h4>
            </div>

            <div class="col-1">
                <span id="basic-addon1">
                    <img src="{{ asset('assets/cam/calenda.png') }}" alt="" width="35px">
                </span>
            </div>
            <div class="col-5">
                <h4>{{ $estandar_item->fecha_lote }}</h4>
            </div>

            <div class="col-1">
                <span id="basic-addon1">
                    <img src="{{ asset('assets/cam/solicitud.png') }}" alt="" width="35px">
                </span>
            </div>
            <div class="col-5">
                <h4>4- Dictamen</h4>
            </div>

            <div class="col-1">
                <span id="basic-addon1">
                    <img src="{{ asset('assets/cam/calenda.png') }}" alt="" width="35px">
                </span>
            </div>
            <div class="col-5">
                <h4>{{ $estandar_item->fecha_dictamen }}</h4>
            </div>

            <div class="col-1">
                <span id="basic-addon1">
                    <img src="{{ asset('assets/cam/contrato.png') }}" alt="" width="35px">
                </span>
            </div>
            <div class="col-5">
                <h4>5- Certificacion</h4>
            </div>

            <div class="col-1">
                <span id="basic-addon1">
                    <img src="{{ asset('assets/cam/calenda.png') }}" alt="" width="35px">
                </span>
            </div>
            <div class="col-5">
                <h4>{{ $estandar_item->fecha_certificacion }}</h4>
            </div>

        </div>
    </div>
</div>
