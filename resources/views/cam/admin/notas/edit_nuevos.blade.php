<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="EditexampleModal{{$nota_cam->id}}" tabindex="-1" role="dialog" aria-labelledby="EditexampleModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel"># Nota:{{$nota_cam->id}}</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <form method="POST" action="" enctype="multipart/form-data" role="form">
                @csrf
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name">Contraseña *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/user/icons/password.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="" name="" type="text" class="form-control" value="{{$nota_cam->Cliente->cam}}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Fecha *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/calenda.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="fecha" name="fecha" type="date" class="form-control" value="{{$nota_cam->fecha}}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Tipo *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/change.png') }}" alt="" width="35px">
                                        </span>
                                        <select name="tipo" id="tipo" class="form-select d-inline-block" readonly >
                                            <option value="{{$nota_cam->tipo}}">{{$nota_cam->tipo}}</option>
                                            {{-- <option value="Evaluador Independiente">Evaluador Independiente</option>
                                            <option value="Centro Evaluación">Centro Evaluación</option>
                                            <option value="Externo">Externo</option> --}}
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-4" id="opcionesCentro" style="">
                                <div class="form-group">
                                    <label for="name">Membresía *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/membership.png') }}" alt="" width="35px">
                                        </span>
                                        <select name="membresia" id="centroTipo" class="form-select d-inline-block" readonly>
                                            <option value="{{$nota_cam->membresia}}" selected>{{$nota_cam->membresia}}</option>
                                            {{-- <option value="Gold">Gold</option>
                                            <option value="Diamante">Diamante</option> --}}
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <h5>Datos personales</h5>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Nombre(s) *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="35px">
                                        </span>
                                        <input readonly id="name" name="name" type="text" class="form-control" value="{{$nota_cam->Cliente->name}}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Celular (WhatasApp) *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/user/icons/whatsapp.png') }}" alt="" width="35px">
                                        </span>
                                        <input readonly id="celular" name="celular" type="tel" minlength="10" maxlength="10" class="form-control" value="{{$nota_cam->Cliente->telefono}}" >
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Correo *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/correo-electronico.png') }}" alt="" width="35px">
                                        </span>
                                        <input readonly id="email" name="email" type="email" class="form-control" value="{{$nota_cam->Cliente->email}}">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                <div class="modal-footer">
                    {{-- <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Atualizar</button> --}}
                </div>

            </form>

        </div>
    </div>
</div>
