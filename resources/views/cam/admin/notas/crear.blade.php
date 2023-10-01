<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel"># Nota:{{$siguienteId}}</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <form method="POST" action="{{ route('crear.notas') }}" enctype="multipart/form-data" role="form">
                @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Fecha *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/calenda.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="fecha" name="fecha" type="date" class="form-control" value="{{$fecha}}" required>
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
                                        <select name="tipo" id="tipo" class="form-select d-inline-block" required>
                                            <option value="">Seleccione una opción</option>
                                            <option value="Evaluador Independiente" {{ old('tipo') == 'Evaluador Independiente' ? 'selected' : '' }}>Evaluador Independiente</option>
                                            <option value="Centro Evaluación" {{ old('tipo') == 'Centro Evaluación' ? 'selected' : '' }}>Centro Evaluación</option>
                                            <option value="Externo" {{ old('tipo') == 'Externo' ? 'selected' : '' }}>Externo</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-4" id="opcionesCentro" style="display: none;">
                                <div class="form-group">
                                    <label for="name">Membresía *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/membership.png') }}" alt="" width="35px">
                                        </span>
                                        <select name="membresia" id="centroTipo" class="form-select d-inline-block">
                                            <option value="">Seleccione una opción</option>
                                            <option value="Gold" {{ old('membresia') == 'Gold' ? 'selected' : '' }}>Gold</option>
                                            <option value="Diamante" {{ old('membresia') == 'Diamante' ? 'selected' : '' }}>Diamante</option>
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
                                        <input id="name" name="name" type="text" class="form-control" placeholder="Nombre" required value="{{old('name')}}">@error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Apellidos *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/etiqueta.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="apellido" name="apellido" type="text" class="form-control" placeholder="Apellidos" required value="{{old('apellido')}}">@error('apellido') <span class="error text-danger">{{ $message }}</span> @enderror
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
                                        <input id="celular" name="celular" type="tel" minlength="10" maxlength="10" class="form-control" placeholder="5500550055" required value="{{old('celular')}}">@error('celular') <span class="error text-danger">{{ $message }}</span> @enderror
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
                                        <input id="telefono" name="telefono" type="tel" minlength="10" maxlength="10" class="form-control" placeholder="5500550055" required value="{{old('telefono')}}" >@error('telefono') <span class="error text-danger">{{ $message }}</span> @enderror
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
                                        <input id="telefono" name="telefono" type="tel" minlength="10" maxlength="10" class="form-control" placeholder="5500550055" required value="{{old('telefono')}}">@error('telefono') <span class="error text-danger">{{ $message }}</span> @enderror
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
                                        <input id="email" name="email" type="email" class="form-control" placeholder="Correo" value="{{old('email')}}">@error('email') <span class="error text-danger">{{ $message }}</span> @enderror
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
                                        <input id="curp" name="curp" type="text" class="form-control" oninput="validarInput(this)" value="{{old('curp')}}">
                                        @error('curp') <span class="error text-danger">{{ $message }}</span> @enderror
                                       <span class="error text-danger" id="resultado"></span>

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
                                        <input id="razon_social" name="razon_social" type="text" class="form-control" value="{{old('razon_social')}}">
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
                                        <input id="direccion" name="direccion" type="text" class="form-control" required value="{{old('direccion')}}">@error('direccion') <span class="error text-danger">{{ $message }}</span> @enderror
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
                                        <input id="state" name="state" type="text" class="form-control" required value="{{old('state')}}">@error('state') <span class="error text-danger">{{ $message }}</span> @enderror
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
                                        <input id="postcode" name="postcode" type="text" class="form-control" required value="{{old('postcode')}}">@error('postcode') <span class="error text-danger">{{ $message }}</span> @enderror
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
                                        <input id="country" name="country" type="text" class="form-control" required value="{{old('country')}}">@error('country') <span class="error text-danger">{{ $message }}</span> @enderror
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
                                        <input id="country" name="city" type="text" class="form-control" required value="{{old('city')}}">@error('country') <span class="error text-danger">{{ $message }}</span> @enderror
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
                                        <input id="facebook" name="facebook" type="text" class="form-control" value="{{old('facebook')}}" placeholder="naturalesainspa">@error('facebook') <span class="error text-danger">{{ $message }}</span> @enderror
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
                                        <input id="tiktok" name="tiktok" type="text" class="form-control"  value="{{old('tiktok')}}" placeholder="naturalesainspa">@error('tiktok') <span class="error text-danger">{{ $message }}</span> @enderror
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
                                        <input id="instagram" name="instagram" type="text" class="form-control" value="{{old('instagram')}}" placeholder="naturalesainspaoficial">@error('instagram') <span class="error text-danger">{{ $message }}</span> @enderror
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
                                        <input id="pagina_web" name="pagina_web" type="text" class="form-control" placeholder="imnasmexico.com" value="{{old('pagina_web')}}">@error('pagina_web') <span class="error text-danger">{{ $message }}</span> @enderror
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
                                        <input id="otra_red" name="otra_red" type="text" class="form-control" placeholder="naturalesainspa" value="{{old('otra_red')}}">@error('otra_red') <span class="error text-danger">{{ $message }}</span> @enderror
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
                                        <input id="puesto" name="puesto" type="text" class="form-control" value="{{old('puesto')}}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <h5>Seleccionar Estándares *</h5>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                        <select name="estandares[]" class="form-select d-inline-block js-example-basic-multiple" style="width: 70%!important;" multiple="multiple" required>
                                            @foreach ($estandares_cam as $estandar_cam)
                                                <option value="{{ $estandar_cam->id }}" {{ in_array($estandar_cam->id, old('estandares', [])) ? 'selected' : '' }}>
                                                    {{$estandar_cam->estandar}}
                                                </option>
                                            @endforeach
                                        </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <h5>Estándares operables *</h5>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                        <select name="estandares_operables[]" class="form-select d-inline-block js-example-basic-multiple" style="width: 70%!important;" multiple="multiple" required>
                                            @foreach ($estandares_cam as $estandar_cam)
                                                <option value="{{ $estandar_cam->id }}" {{ in_array($estandar_cam->id, old('estandares_operables', [])) ? 'selected' : '' }}>
                                                    {{$estandar_cam->estandar}}
                                                </option>
                                            @endforeach
                                        </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <h5>Estándares con los que ya cuenta</h5>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                        <select name="estandares_afines[]" class="form-select d-inline-block js-example-basic-multiple2" style="width: 70%!important;" multiple="multiple" >
                                            @foreach ($estandares_cam as $estandar_cam)
                                                <option value="{{ $estandar_cam->id }}" {{ in_array($estandar_cam->id, old('estandares_afines', [])) ? 'selected' : '' }}>
                                                    {{$estandar_cam->estandar}}
                                                </option>
                                            @endforeach
                                        </select>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- ================ P A G O ================ --}}

                    <div class="modal-body">
                        <div class="row">
                            <h4>Sección de pago</h4>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Precio *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><img src="{{ asset('assets/user/icons/order.webp') }}" alt="" width="35px" style="margin-right: 1rem">$</span>
                                        <input class="form-control" type="text" id="costo" name="costo"  value="{{old('costo')}}">
                                        <span class="input-group-text">.00</span>
                                      </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Restante *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><img src="{{ asset('assets/user/icons/bolsa-de-dinero.png') }}" alt="" width="35px" style="margin-right: 1rem">$</span>
                                        <input class="form-control" type="number" id="restante" name="restante" value="{{old('restante')}}">
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
                                        <span class="input-group-text"><img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="35px" style="margin-right: 1rem">$</span>
                                        <input class="form-control" type="number" id="monto1" name="monto1" required  value="{{old('monto1')}}">
                                        <span class="input-group-text">.00</span>
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
                                        <select name="metodo_pago" id="metodo_pago" class="form-select d-inline-block"  value="{{old('metodo_pago')}}">
                                            <option value="Efectivo" {{ old('metodo_pago') == 'Efectivo' ? 'selected' : '' }}>Efectivo</option>
                                            <option value="Tarjeta" {{ old('metodo_pago') == 'Tarjeta' ? 'selected' : '' }}>Tarjeta</option>
                                            <option value="Transferencia" {{ old('metodo_pago') == 'Transferencia' ? 'selected' : '' }}>Transferencia</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-4" id="fotoContainer" style="">

                                <div class="form-group">
                                    <label for="name">Foto del pago</label><br>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/camara.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="comprobante" name="comprobante" type="file" class="form-control" placeholder="foto">
                                    </div>
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
                                                    <span class="input-group-text"><img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="35px" style="margin-right: 1rem">$</span>
                                                    <input class="form-control" type="number" id="monto2" name="monto2" value="{{old('monto2')}}">
                                                    <span class="input-group-text">.00</span>
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
                                                        <option value="Efectivo" {{ old('metodo_pago2') == 'Efectivo' ? 'selected' : '' }}>Efectivo</option>
                                                        <option value="Tarjeta" {{ old('metodo_pago2') == 'Tarjeta' ? 'selected' : '' }}>Tarjeta</option>
                                                        <option value="Transferencia" {{ old('metodo_pago2') == 'Transferencia' ? 'selected' : '' }}>Transferencia</option>
                                                    </select>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-4" id="fotoContainer2" style="">
                                            <div class="form-group">
                                                <label for="name">Foto del pago</label><br>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/cam/camara.png') }}" alt="" width="35px">
                                                    </span>
                                                <input id="comprobante2" name="comprobante2" type="file" class="form-control" placeholder="foto">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-8">
                                <div class="form-group">
                                    <label for="name">Observaciones</label><br>
                                    <textarea class="form-control" name="nota" id="nota" cols="20" rows="2">{{ old('nota') }}</textarea>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Como nos conocieron *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/refer.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="referencia" name="referencia" type="text" class="form-control" placeholder="Referencia" required  value="{{old('referencia')}}">@error('referencia') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                <div class="modal-footer">
                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                </div>

            </form>

        </div>
    </div>
</div>
