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
                                        <input id="" name="" type="text" class="form-control" value="{{$nota_cam->Cliente->cam}}">
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
                                        <input id="fecha" name="fecha" type="date" class="form-control" value="{{$nota_cam->fecha}}">
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
                                        <select name="tipo" id="tipo" class="form-select d-inline-block" >
                                            <option value="{{$nota_cam->tipo}}">{{$nota_cam->tipo}}</option>
                                            <option value="Evaluador Independiente">Evaluador Independiente</option>
                                            <option value="Centro Evaluación">Centro Evaluación</option>
                                            {{-- <option value="Externo">Externo</option> --}}
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
                                        <select name="membresia" id="centroTipo" class="form-select d-inline-block">
                                            <option value="{{$nota_cam->membresia}}" selected>{{$nota_cam->membresia}}</option>
                                            <option value="Gold">Gold</option>
                                            <option value="Diamante">Diamante</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <h5>Datos personales</h5>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name">Nombre completo *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="name" name="name" type="text" class="form-control" value="{{$nota_cam->Cliente->name}}">
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
                                        <input id="celular" name="celular" type="tel" minlength="10" maxlength="10" class="form-control" value="{{$nota_cam->Cliente->telefono}}" >
                                    </div>
                                </div>

                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Celular (celular) *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/foldable-phone.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="celular" name="celular" type="tel" minlength="10" maxlength="10" class="form-control" value="{{$nota_cam->Cliente->telefono}}"  >
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Telefono (Local) *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/llamar.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="telefono" name="telefono" type="tel" minlength="10" maxlength="10" class="form-control" value="{{$nota_cam->Cliente->celular_casa}}" >
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
                                        <input id="email" name="email" type="email" class="form-control" value="{{$nota_cam->Cliente->email}}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">CURP</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/user/icons/letter.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="curp" name="curp" type="text" class="form-control" value="{{$nota_cam->Cliente->curp}}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-4" id="razonContainer" style="display: none;">
                                <div class="form-group">
                                    <label for="name">Razon Social</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/user/icons/firma-digital.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="razon_social" name="razon_social" type="text" class="form-control" value="{{$nota_cam->Cliente->razon_social}}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <h5>Datos de Direccion</h5>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Calle y Numero *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/streets.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="direccion" name="direccion" type="text" class="form-control" value="{{$nota_cam->Cliente->direccion}}" required>@error('instagram') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="name">Colonia *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/street-market.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="state" name="state" type="text" class="form-control" value="{{$nota_cam->Cliente->state}}" required>@error('instagram') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="name">Codigo Postal *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/cp.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="postcode" name="postcode" type="text" class="form-control" value="{{$nota_cam->Cliente->postcode}}" required>@error('instagram') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Alcaldia / municipio *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/ecuador.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="country" name="country" type="text" class="form-control" value="{{$nota_cam->Cliente->country}}" required>@error('instagram') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Estado/ciudad *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/skyscraper.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="city" name="city" type="text" class="form-control" value="{{$nota_cam->Cliente->city}}" required>@error('instagram') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <h5>Redes Sociales</h5>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Facebook</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/facebook.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="facebook" name="facebook" type="text" class="form-control" placeholder="naturalesainspa" value="{{$nota_cam->Cliente->facebook}}">@error('facebook') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">TikTok</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/tiktok.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="tiktok" name="tiktok" type="text" class="form-control" value="{{$nota_cam->Cliente->tiktok}}">@error('tiktok') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Instagram</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/instagram.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="instagram" name="instagram" type="text" class="form-control" value="{{$nota_cam->Cliente->instagram}}">@error('instagram') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Página Web</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/web-link.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="pagina_web" name="pagina_web" type="text" class="form-control" placeholder="imnasmexico.com" value="{{$nota_cam->Cliente->pagina_web}}">@error('pagina_web') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Otro</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/heart.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="otra_red" name="otra_red" type="text" class="form-control" placeholder="naturalesainspa" value="{{$nota_cam->Cliente->otra_red}}">@error('otra_red') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Profesion</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/medico.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="puesto" name="puesto" type="text" class="form-control" value="{{$nota_cam->Cliente->puesto}}">@error('otra_red') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <h5>Seleccionar Estándares *</h5>
                            </div>

                            @php
                                use App\Models\Cam\CamNotEstandares;
                                $estandares = CamNotEstandares::where('id_nota','=', $nota_cam->id)->Where('operables','=', null)->Where('ya_contaba','=',null)->get();
                            @endphp

                            <div class="col-12">
                                <div class="form-group">
                                    <select name="estandares[]" class="form-select d-inline-block js-example-basic-multiple" style="width: 70%!important;" multiple="multiple">
                                        @foreach ($estandares as $estandar_cam)

                                            <option value="{{ $estandar_cam->id }}" selected>
                                               {{$estandar_cam->Estandar->nombre}}
                                            </option>

                                        @endforeach
                                    </select>

                                </div>
                            </div>

                            <div class="col-12">
                                <h5>Estándares operables *</h5>
                            </div>

                            @php
                                $estandaresOperables = CamNotEstandares::where('id_nota','=', $nota_cam->id)->Where('operables','=','1')->get();
                            @endphp

                            <div class="col-12">
                                <div class="form-group">
                                    <select name="estandares[]" class="form-select d-inline-block js-example-basic-multiple" style="width: 70%!important;" multiple="multiple">
                                        @foreach ($estandaresOperables as $estandar_cam)

                                            <option value="{{ $estandar_cam->id }}" selected>
                                               {{$estandar_cam->Estandar->nombre}}
                                            </option>

                                        @endforeach
                                    </select>

                                </div>
                            </div>

                            <div class="col-12">
                                <h5>Estándares con los que ya cuenta</h5>
                            </div>

                            @php
                                $estandaresContados = CamNotEstandares::where('id_nota','=', $nota_cam->id)->Where('ya_contaba','=', '1')->get();
                            @endphp

                            <div class="col-12">
                                <div class="form-group">
                                    <select name="estandares[]" class="form-select d-inline-block js-example-basic-multiple" style="width: 70%!important;" multiple="multiple">
                                        @foreach ($estandaresContados as $estandar_cam)

                                            <option value="{{ $estandar_cam->id }}" selected>
                                               {{$estandar_cam->Estandar->nombre}}
                                            </option>

                                        @endforeach
                                    </select>

                                </div>
                            </div>

                            <h4>Sección de pago</h4>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Precio *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><img src="{{ asset('assets/user/icons/order.webp') }}" alt="" width="35px" style="margin-right: 1rem">$</span>
                                        <input class="form-control" type="text" id="costo" name="costo"  value="{{$nota_cam->costo}}">
                                        <span class="input-group-text">.00</span>
                                      </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Restante *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><img src="{{ asset('assets/user/icons/bolsa-de-dinero.png') }}" alt="" width="35px" style="margin-right: 1rem">$</span>
                                        <input class="form-control" type="number" id="restante" name="restante" value="{{$nota_cam->restante}}">
                                        <span class="input-group-text">.00</span>
                                      </div>
                                </div>
                            </div>

                            <div class="col-4">

                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Monto *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="35px">
                                        </span>
                                        <input class="form-control" type="text" id="monto1" name="monto1" value="{{$nota_cam->monto1}}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Método de Pago *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/metodo-de-pago.png') }}" alt="" width="35px">
                                        </span>
                                        <select name="metodo_pago" id="metodo_pago" class="form-select d-inline-block">
                                            <option value="{{$nota_cam->metodo_pago}}">{{$nota_cam->metodo_pago}}</option>
                                            {{-- <option value="Efectivo">Efectivo</option>
                                            <option value="Tarjeta">Tarjeta</option>
                                            <option value="Transferencia">Transferencia</option> --}}
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Foto</label><br>
                                    <a class="text-dark d-block" href="{{ asset('cam_notas/'. $nota_cam->comprobante) }}" target="_blank" >
                                        Ver Comprobante
                                    </a>
                                </div>
                            </div>

                            <div class="col-6 mt-3">
                                <button class="btn btn-secondary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    Agregar otro metodo de pago
                                </button>
                            </div>

                            <div class="col-12">
                                <div class="collapse " id="collapseExample">
                                    <div class="row">
                                        <span for="">Método de pago 2</span>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="name">Monto *</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="35px">
                                                    </span>
                                                    <input class="form-control" type="text" id="monto2" name="monto2" value="{{$nota_cam->monto2}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="name">Método de Pago *</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/cam/metodo-de-pago.png') }}" alt="" width="35px">
                                                    </span>
                                                    <select name="metodo_pago2" id="metodo_pago2" class="form-select d-inline-block">
                                                        <option value="{{$nota_cam->metodo_pago2}}">{{$nota_cam->metodo_pago2}}</option>
                                                        <option value="Efectivo">Efectivo</option>
                                                        <option value="Tarjeta">Tarjeta</option>
                                                        <option value="Transferencia">Transferencia</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-4" id="fotoContainer2" style="display: none;">
                                            <div class="form-group">
                                                <label for="name">Foto</label><br>
                                                <input id="comprobante2" name="comprobante2" type="file" class="form-control" placeholder="foto">
                                                <a class="text-dark d-block" href="{{ asset('cam_notas/'. $nota_cam->comprobante2) }}" target="_blank" >
                                                    Ver Comprobante
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-8">
                                <div class="form-group">
                                    <label for="name">Info del cliente</label><br>
                                    <textarea  class="form-control" name="nota" id="nota" cols="20" rows="2">{{$nota_cam->nota}}</textarea>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Como nos conocieron *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/refer.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="referencia" name="referencia" type="text" class="form-control" placeholder="Referencia" value="{{$nota_cam->referencia}}" required>@error('referencia') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                <div class="modal-footer">
                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Atualizar</button>
                </div>

            </form>

        </div>
    </div>
</div>
