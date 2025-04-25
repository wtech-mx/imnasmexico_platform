<div class="row mt-3">
    <div class="col-12 col-md-12 mt-3 ">
        <div class="card h-100 p-2">
            <form method="POST" action="{{ route('update.notas', $expediente->Nota->id) }}" enctype="multipart/form-data" role="form">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                    <div class="modal-body">
                        <div class="row">

                            {{-- <div class="col-12">
                                <div class="form-group">
                                    <label for="name">Contraseña *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/user/icons/password.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="" name="" type="text" class="form-control" value="{{$expediente->Nota->Cliente->cam}}" readonly>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Fecha *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/calenda.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="fecha" name="fecha" type="date" class="form-control" value="{{$expediente->Nota->fecha}}" readonly>
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
                                            <option value="{{$expediente->Nota->tipo}}">{{$expediente->Nota->tipo}}</option>
                                            {{-- <option value="Evaluador Independiente">Evaluador Independiente</option>
                                            <option value="Centro Evaluación">Centro Evaluación</option>
                                            <option value="Externo">Externo</option> --}}
                                        </select>
                                    </div>
                                </div>
                            </div>

                            @if ($expediente->Nota->tipo == 'Centro Evaluación')
                                <div class="col-4" id="opcionesCentro" style="">
                                    <div class="form-group">
                                        <label for="name">Membresía *</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/cam/membership.png') }}" alt="" width="35px">
                                            </span>
                                            <select name="membresia" id="centroTipo" class="form-select d-inline-block" readonly>
                                                <option value="{{$expediente->Nota->membresia}}" selected>{{$expediente->Nota->membresia}}</option>
                                                {{-- <option value="Gold">Gold</option>
                                                <option value="Diamante">Diamante</option> --}}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="col-12">
                                <h5>Datos personales</h5>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Nombre completo*</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="name" name="name" type="text" class="form-control" value="{{$expediente->Nota->Cliente->name}}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Celular (WhatasApp) *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/user/icons/whatsapp.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="celular" name="celular" type="tel" minlength="10" maxlength="10" class="form-control" value="{{$expediente->Nota->Cliente->telefono}}" >
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
                                        <input id="celular" name="celular" type="tel" minlength="10" maxlength="10" class="form-control" value="{{$expediente->Nota->Cliente->telefono}}"  >
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
                                        <input id="telefono" name="telefono" type="tel" minlength="10" maxlength="10" class="form-control" value="{{$expediente->Nota->Cliente->celular_casa}}" >
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
                                        <input id="email" name="email" type="email" class="form-control" value="{{$expediente->Nota->Cliente->email}}">
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
                                        <input id="curp" name="curp" type="text" class="form-control" value="{{$expediente->Nota->Cliente->curp}}">
                                    </div>
                                </div>
                            </div>

                            @if ($expediente->Nota->tipo == 'Centro Evaluación')
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="name">Razon Social</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/user/icons/firma-digital.png') }}" alt="" width="35px">
                                            </span>
                                            <input id="razon_social" name="razon_social" type="text" class="form-control" value="{{$expediente->Nota->Cliente->razon_social}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="name">RFC</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/user/icons/firma-digital.png') }}" alt="" width="35px">
                                            </span>
                                            <input id="rfc" name="rfc" type="text" class="form-control" value="{{$expediente->Nota->Cliente->rfc}}">
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="col-12">
                                <h5>Datos Encargado</h5>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Nombre completo*</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="nombre_encargado" name="nombre_encargado" type="text" class="form-control" value="{{$expediente->Nota->nombre_encargado}}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Telefono *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/llamar.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="telefono_encargado" name="telefono_encargado" type="tel" minlength="10" maxlength="10" class="form-control" value="{{$expediente->Nota->telefono_encargado}}" >
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
                                        <input id="correo_encargado" name="correo_encargado" type="email" class="form-control" value="{{$expediente->Nota->correo_encargado}}">
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
                                        <input id="direccion" name="direccion" type="text" class="form-control" value="{{$expediente->Nota->Cliente->direccion}}" required>@error('instagram') <span class="error text-danger">{{ $message }}</span> @enderror
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
                                        <input id="state" name="state" type="text" class="form-control" value="{{$expediente->Nota->Cliente->state}}" required>@error('instagram') <span class="error text-danger">{{ $message }}</span> @enderror
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
                                        <input id="postcode" name="postcode" type="text" class="form-control" value="{{$expediente->Nota->Cliente->postcode}}" required>@error('instagram') <span class="error text-danger">{{ $message }}</span> @enderror
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
                                        <input id="country" name="country" type="text" class="form-control" value="{{$expediente->Nota->Cliente->country}}" required>@error('instagram') <span class="error text-danger">{{ $message }}</span> @enderror
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
                                        <input id="city" name="city" type="text" class="form-control" value="{{$expediente->Nota->Cliente->city}}" required>@error('instagram') <span class="error text-danger">{{ $message }}</span> @enderror
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
                                        <input id="facebook" name="facebook" type="text" class="form-control" placeholder="naturalesainspa" value="{{$expediente->Nota->Cliente->facebook}}">@error('facebook') <span class="error text-danger">{{ $message }}</span> @enderror
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
                                        <input id="tiktok" name="tiktok" type="text" class="form-control" value="{{$expediente->Nota->Cliente->tiktok}}">@error('tiktok') <span class="error text-danger">{{ $message }}</span> @enderror
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
                                        <input id="instagram" name="instagram" type="text" class="form-control" value="{{$expediente->Nota->Cliente->instagram}}">@error('instagram') <span class="error text-danger">{{ $message }}</span> @enderror
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
                                        <input id="pagina_web" name="pagina_web" type="text" class="form-control" placeholder="imnasmexico.com" value="{{$expediente->Nota->Cliente->pagina_web}}">@error('pagina_web') <span class="error text-danger">{{ $message }}</span> @enderror
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
                                        <input id="otra_red" name="otra_red" type="text" class="form-control" placeholder="naturalesainspa" value="{{$expediente->Nota->Cliente->otra_red}}">@error('otra_red') <span class="error text-danger">{{ $message }}</span> @enderror
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
                                        <input id="puesto" name="puesto" type="text" class="form-control" value="{{$expediente->Nota->Cliente->puesto}}">@error('otra_red') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <h4>Sección de pago</h4>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Precio *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><img src="{{ asset('assets/user/icons/order.webp') }}" alt="" width="35px" style="margin-right: 1rem">$</span>
                                        <input readonly class="form-control" type="text" id="costo" name="costo"  value="{{$expediente->Nota->costo}}">
                                        <span class="input-group-text">.00</span>
                                      </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Restante *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><img src="{{ asset('assets/user/icons/bolsa-de-dinero.png') }}" alt="" width="35px" style="margin-right: 1rem">$</span>
                                        <input readonly class="form-control" type="number" id="restante" name="restante" value="{{$expediente->Nota->restante}}">
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
                                        <input readonly class="form-control" type="text" id="monto1" name="monto1" value="{{$expediente->Nota->monto1}}">
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
                                            <option value="{{$expediente->Nota->metodo_pago}}">{{$expediente->Nota->metodo_pago}}</option>
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
                                    <a class="text-dark d-block" href="{{ asset('cam_notas/'. $expediente->Nota->comprobante) }}" target="_blank" >
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
                                                    <input class="form-control" type="text" id="monto2" name="monto2" value="{{$expediente->Nota->monto2}}">
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
                                                        <option value="{{$expediente->Nota->metodo_pago2}}">{{$expediente->Nota->metodo_pago2}}</option>
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
                                                <a class="text-dark d-block" href="{{ asset('cam_notas/'. $expediente->Nota->comprobante2) }}" target="_blank" >
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
                                    <textarea class="form-control" name="nota" id="nota" cols="20" rows="2">{{$expediente->Nota->nota}}</textarea>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Como nos conocieron *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/refer.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="referencia" name="referencia" type="text" class="form-control" placeholder="Referencia" value="{{$expediente->Nota->referencia}}" required>@error('referencia') <span class="error text-danger">{{ $message }}</span> @enderror
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
