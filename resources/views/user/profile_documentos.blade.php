<nav>
    <div class="d-flex justify-content-center">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-login-tab" data-bs-toggle="tab" data-bs-target="#nav-login" type="button" role="tab" aria-controls="nav-login" aria-selected="true">
                Oficiales
            </button>

            <button class="nav-link" id="nav-register-tab" data-bs-toggle="tab" data-bs-target="#nav-register" type="button" role="tab" aria-controls="nav-register" aria-selected="false">
                Estandares
            </button>
        </div>
    </div>
</nav>

<div class="tab-content" id="nav-tabContent" style="">

<div class="tab-pane fade show active" id="nav-login" role="tabpanel" aria-labelledby="nav-login-tab" tabindex="0" style="min-height: auto!important;">
    <form method="POST" action="{{ route('clientes.update_documentos_cliente', $cliente->id) }}" enctype="multipart/form-data" role="form">
        @csrf
        <input type="hidden" name="_method" value="PATCH">

        <div class="modal-body row">
            @php
                $tiene_documentos = false;
            @endphp
            @foreach($documentos as $documento)
                    @php
                        $tiene_documentos = true;
                    @endphp
                    <div class="col-6 form-group">
                        <label for="ine">INE </label>
                        <input id="ine" name="ine" type="file" class="form-control" >
                        <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->ine) }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                    </div>

                    <div class="col-6 form-group">
                        <label for="curp">CURP</label>
                        <input id="curp" name="curp" type="file" class="form-control" >
                        <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->curp) }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                    </div>

                    <div class="col-6 form-group">
                        <label for="foto_tam_titulo">Foto tamaño titulo</label>
                        <input id="foto_tam_titulo" name="foto_tam_titulo" type="file" class="form-control" >
                        <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_titulo) }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                    </div>

                    <div class="col-6 form-group">
                        <label for="foto_tam_infantil">Foto tamaño Infantil</label>
                        <input id="foto_tam_infantil" name="foto_tam_infantil" type="file" class="form-control" >
                        <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_infantil) }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                    </div>

                    <div class="col-6 form-group">
                        <label for="carta_compromiso">Carta Compromiso</label>
                        <input id="carta_compromiso" name="carta_compromiso" type="file" class="form-control" >
                        <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->carta_compromiso) }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                    </div>

                    <div class="col-6 form-group">
                        <label for="firma">Firma</label>
                        <input id="firma" name="firma" type="file" class="form-control" >
                        <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->firma) }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                    </div>
            @endforeach

            @if($tiene_documentos)
                <!-- Si el usuario tiene documentos, no mostramos el formulario -->
            @else
                <!-- Si el usuario no tiene documentos, mostramos el formulario -->
                <div class="col-6 form-group">
                    <label for="ine">INE </label>
                    <input id="ine" name="ine" type="file" class="form-control" >
                </div>

                <div class="col-6 form-group">
                    <label for="curp">CURP</label>
                    <input id="curp" name="curp" type="file" class="form-control" >
                </div>

                <div class="col-6 form-group">
                    <label for="foto_tam_titulo">Foto tamaño titulo</label>
                    <input id="foto_tam_titulo" name="foto_tam_titulo" type="file" class="form-control" >
                </div>

                <div class="col-6 form-group">
                    <label for="foto_tam_infantil">Foto tamaño Infantil</label>
                    <input id="foto_tam_infantil" name="foto_tam_infantil" type="file" class="form-control" >
                </div>

                <div class="col-6 form-group">
                    <label for="carta_compromiso">Carta Compromiso</label>
                    <input id="carta_compromiso" name="carta_compromiso" type="file" class="form-control" >
                </div>

                <div class="col-6 form-group">
                    <label for="firma">Firma</label>
                    <input id="firma" name="firma" type="file" class="form-control" >
                </div>
            @endif

        </div>

        <div class="modal-footer">
            <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
        </div>

    </form>
</div>

<div class="tab-pane fade" id="nav-register" role="tabpanel" aria-labelledby="nav-register-tab" tabindex="0" style="min-height: auto!important;">
    @php
        $tiene_documentos_estandar = false;
    @endphp
    <ul>
        @foreach($documentos_estandares as $documento)
                @php
                    $tiene_documentos = true;
                @endphp
                <li>{{ $documento->documento }} </li>
        @endforeach
    </ul>

    @if($tiene_documentos)
        <!-- Si el usuario tiene documentos, no mostramos el formulario -->
        @else
        <p>No se han subido archivos aún.</p>
    @endif

    <form method="POST" action="{{ route('documentos.store_cliente', $cliente->id) }}" enctype="multipart/form-data" role="form">
        @csrf
        <input type="file" name="archivos[]" multiple>
        <button type="submit">Subir archivos</button>
    </form>
</div>
</div>
