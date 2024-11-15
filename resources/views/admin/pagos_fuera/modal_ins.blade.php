<!-- Modal -->

<div class="modal fade" id="showDataModal{{$pago_fuera->id}}" tabindex="-1" role="dialog" aria-labelledby="showDataModal{{$pago_fuera->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Ver Pago</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>

            </div>
                <div class="modal-body">

                    <div class="row">

                            <div class="form-group col-6">
                                <label for="">Fecha y hora de ingreso</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/cam/calenda.png') }}" alt="" width="30px">
                                    </span>
                                    <input id="fecha_hora_1" name="fecha_hora_1" type="text" class="form-control" value="{{ \Carbon\Carbon::parse($pago_fuera->fecha_hora_1)->translatedFormat('d \d\e F h:i a') }}" disabled>
                                </div>
                            </div>

                            <div class="form-group col-6">
                                <label for="">Usario que lo registro</label><br>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/cam/ine.png') }}" alt="" width="30px">
                                    </span>
                                    <input id="usuario" name="usuario" type="text" class="form-control" value="{{$pago_fuera->usuario}}" disabled>
                                </div>
                            </div>

                            <div class="form-group col-6">
                                <label for="">Nombre de cliente</label><br>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/cam/medico.png') }}" alt="" width="30px">
                                    </span>
                                    <input id="nombre" name="nombre" type="text" class="form-control" value="{{$pago_fuera->nombre}}" disabled>
                                </div>
                            </div>


                            <div class="form-group col-6">
                                <label for="">Correo</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/cam/correo-electronico.png') }}" alt="" width="30px">
                                    </span>
                                    <input id="correo" name="correo" type="email" class="form-control" value="{{$pago_fuera->correo}}" disabled>
                                </div>
                            </div>

                            <div class="form-group col-12">
                                <label for="">Curso</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/cam/acta.png') }}" alt="" width="30px">
                                    </span>
                                    <input id="" name="" type="text" class="form-control" value="{{$pago_fuera->curso}}" disabled>
                                </div>
                            </div>

                            <div class="form-group col-6">
                                <label for="">Forma de pago</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/cam/metodo-de-pago.png') }}" alt="" width="30px">
                                    </span>
                                    <input id="curso" name="curso" type="text" class="form-control" value="{{$pago_fuera->modalidad}}" disabled>
                                </div>
                            </div>

                            <div class="form-group col-6">
                                <label for="">Telefono</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/cam/llamar.png') }}" alt="" width="30px">
                                    </span>
                                    <input id="telefono" name="telefono" type="number" class="form-control" value="{{$pago_fuera->telefono}}" disabled>
                                </div>
                            </div>


                        <div class="col-2">
                            <label>Deudor</label>
                            <div class="form-check">
                                @if ($pago_fuera->deudor == '1')
                                    <input class="form-check-input" type="checkbox" id="deudor" name="deudor" checked disabled>
                                @else
                                    <input class="form-check-input" type="checkbox" id="deudor" name="deudor" disabled>
                                @endif
                            </div>
                        </div>

                        <div class="form-group col-4">
                            <label>Monto *</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="30px">
                                </span>
                                <input class="form-control" type="number" id="pago" name="pago" value="{{$pago_fuera->monto}}" disabled>
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="abono">Abono 1</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/cam/dar-dinero.png') }}" alt="" width="30px">
                                </span>
                                <input id="abono" name="abono" type="number" class="form-control" value="{{$pago_fuera->abono}}" disabled>
                            </div>
                        </div>

                        {{-- <div class="col-12">
                            <p class="text-left mt-3 mb-3"><strong>Comprobacion de pagos por transferencia o deposito</strong></p>
                        </div> --}}

                        {{-- campos para transferencia banxico api --}}

                        {{-- <div class="form-group col-6">
                            <label for="">Seleciona Clabe de rastreo o referencia *</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/cam/change.png') }}" alt="" width="35px">
                                </span>
                                <select name="tipoCriterio" class="form-select d-inline-block" >
                                    <option value="T">Clave de Rastreo</option>
                                    <option value="R">Referencia Numerica</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-6 mb-3">
                            <label for="">Clave o Referencia</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/cam/hastag.png') }}" alt="" width="35px">
                                </span>
                                <input class="form-control" type="text" name="criterio">
                            </div>
                        </div>

                        <div class="form-group col-4">
                            <label for="name">Fecha *</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/cam/calenda.png') }}" alt="" width="35px">
                                </span>
                                <input id="fecha" name="fecha" type="date" class="form-control" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>

                        <div class="col-4 mt-3">
                            <label for="">Emisor</label>
                            <select name="emisor" class="form-select emisor" id="">
                                <option value="">Selecionar Banco</option>
                                <option value="40138">ABC CAPITAL</option>
                                <option value="40133">ACTINVER</option>
                                <option value="40062">AFIRME</option>
                                <option value="90706">ARCUS</option>
                                <option value="90659">ASP INTEGRA OPC</option>
                                <option value="40128">AUTOFIN</option>
                                <option value="40127">AZTECA</option>
                                <option value="37166">BaBien</option>
                                <option value="40030">BAJIO</option>
                                <option value="40002">BANAMEX</option>
                                <option value="40154">BANCO COVALTO</option>
                                <option value="37006">BANCOMEXT</option>
                                <option value="40137">BANCOPPEL</option>
                                <option value="40160">BANCO S3</option>
                                <option value="40152">BANCREA</option>
                                <option value="37019">BANJERCITO</option>
                                <option value="40147">BANKAOOL</option>
                                <option value="40106">BANK OF AMERICA</option>
                                <option value="40159">BANK OF CHINA</option>
                                <option value="37009">BANOBRAS</option>
                                <option value="40072">BANORTE</option>
                                <option value="40058">BANREGIO</option>
                                <option value="40060">BANSI</option>
                                <option value="2001">BANXICO</option>
                                <option value="40129">BARCLAYS</option>
                                <option value="40145">BBASE</option>
                                <option value="40012">BBVA MEXICO</option>
                                <option value="40112">BMONEX</option>
                                <option value="90677">CAJA POP MEXICA</option>
                                <option value="90683">CAJA TELEFONIST</option>
                                <option value="90630">CB INTERCAM</option>
                                <option value="40143">CIBANCO</option>
                                <option value="90631">CI BOLSA</option>
                                <option value="90901">CLS</option>
                                <option value="90903">CoDi Valida</option>
                                <option value="40130">COMPARTAMOS</option>
                                <option value="40140">CONSUBANCO</option>
                                <option value="90652">CREDICAPITAL</option>
                                <option value="40126">CREDIT SUISSE</option>
                                <option value="90680">CRISTOBAL COLON</option>
                                <option value="40151">DONDE</option>
                                <option value="90616">FINAMEX</option>
                                <option value="90634">FINCOMUN</option>
                                <option value="90689">FOMPED</option>
                                <option value="90685">FONDO (FIRA)</option>
                                <option value="90601">GBM</option>
                                <option value="37168">HIPOTECARIA FED</option>
                                <option value="40021">HSBC</option>
                                <option value="40155">ICBC</option>
                                <option value="40036">INBURSA</option>
                                <option value="90902">INDEVAL</option>
                                <option value="40150">INMOBILIARIO</option>
                                <option value="40136">INTERCAM BANCO</option>
                                <option value="90686">INVERCAP</option>
                                <option value="40059">INVEX</option>
                                <option value="40110">JP MORGAN</option>
                                <option value="90653">KUSPIT</option>
                                <option value="90670">LIBERTAD</option>
                                <option value="90602">MASARI</option>
                                <option value="40042">MIFEL</option>
                                <option value="40158">MIZUHO BANK</option>
                                <option value="90600">MONEXCB</option>
                                <option value="40108">MUFG</option>
                                <option value="40132">MULTIVA BANCO</option>
                                <option value="90613">MULTIVA CBOLSA</option>
                                <option value="37135">NAFIN</option>
                                <option value="90638">NU MEXICO</option>
                                <option value="90710">NVIO</option>
                                <option value="90684">OPM</option>
                                <option value="40148">PAGATODO</option>
                                <option value="90620">PROFUTURO</option>
                                <option value="40156">SABADELL</option>
                                <option value="40014">SANTANDER</option>
                                <option value="40044">SCOTIABANK</option>
                                <option value="40157">SHINHAN</option>
                                <option value="90646">STP</option>
                                <option value="90648">TACTIV CB</option>
                                <option value="90656">UNAGRA</option>
                                <option value="90617">VALMEX</option>
                                <option value="90605">VALUE</option>
                                <option value="90608">VECTOR</option>
                                <option value="40113">VE POR MAS</option>
                                <option value="40141">VOLKSWAGEN</option>
                            </select>
                        </div>

                        <div class="col-4 mt-3">
                            <label for="">Receptor</label>
                            <select name="receptor" class="form-select receptor" id="">
                                <option value="40036">INBURSA</option>
                                <option value="40012">BBVA MEXICO</option>
                            </select>
                        </div>

                        <div class="form-group col-6">
                            <label for="">Cuenta *</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/cam/libreta-de-depositos.png') }}" alt="" width="35px">
                                </span>
                                <select name="cuenta" class="form-select d-inline-block" >
                                    <option value="036180500362597807">INBURSA (036180500362597807)</option>
                                    <option value="012180001208441792">BBVA  (012180001208441792)</option>
                                </select>
                            </div>
                        </div>

                        <input type="hidden" name="receptorParticipante" value="false">

                        <div class="form-group col-6 mb-3 mt-4">
                            <a href="" class="btn bt-xs btn-success">Comprobar</a>
                        </div> --}}

                        {{-- campos para transferencia banxico api --}}

                        <div class="col-12">
                            <p class="text-left mt-3 mb-3"><strong>Agregar restante del pago:</strong></p>
                        </div>

                        <form method="POST" action="{{ route('pagos.update_deudores', $pago_fuera->id) }}" enctype="multipart/form-data" role="form">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <input id="fecha_hora_2" name="fecha_hora_2" type="hidden"  value="{{ $fechaActual }}">

                            <div class="col-12">
                                <div class="col-12">
                                    <div class="form-group">
                                      <label for="comentario">Comentarios y/o Nota</label>
                                      <textarea class="form-control" name="comentario" id="comentario" cols="30" rows="3">{{$pago_fuera->comentario}}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="foto2">Comprobante</label>
                                        <input id="foto2" name="foto2" type="file" class="form-control" @if($pago_fuera->foto2) disabled @endif>
                                        @error('foto2') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="abono2">Abono 2</label>
                                        <input id="abono2" name="abono2" type="number" class="form-control" value="{{ $pago_fuera->abono2 ? $pago_fuera->abono2 : '' }}" @if($pago_fuera->abono2) disabled @endif>
                                    </div>
                                </div>

                                <div class="col-6">
                                    @if(!$pago_fuera->foto2 && !$pago_fuera->abono2)
                                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                                    @endif
                                </div>

                                <div class="col-6">
                                    <label for="abono2">Fecha y hora del abono 2</label>
                                    <input id="fecha_hora_2" name="fecha_hora_2" type="text" class="form-control" value="{{$pago_fuera->fecha_hora_2}}" disabled>
                                </div>
                            </div>
                        </form>

                        <div class="col-6">
                            <div class="form-group  mt-3">
                                <label for="foto">Comprobante 1</label> <br>
                                @if (pathinfo($pago_fuera->foto, PATHINFO_EXTENSION) === 'pdf')
                                    <iframe src="{{ asset('pago_fuera/'.$pago_fuera->foto) }}" width="100%" height="500px"></iframe>
                                @else
                                    <img id="blah" src="{{ asset('pago_fuera/'.$pago_fuera->foto) }}" alt="Imagen" style="width: 100%">
                                @endif
                            </div>
                        </div>

                        <div class="col-6">

                            <p class="d-inline-flex gap-1 mt-3">
                                <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    Comprobar pago Banxico <img src="https://www.banxico.org.mx/DIBM/resources/img/logoBM-Monograma.png" alt="" style="width: 20px">
                                </a>
                              </p>

                              <div class="collapse" id="collapseExample">
                                <div class="card card-body row" style="padding: 0 !important;border: solid 5px #836263;border-radius: 10px;">
                                    <div class="col-12">
                                        <iframe src="https://www.banxico.org.mx/cep/" frameborder="0" style="width: 100%;height: 600px;"></iframe>
                                    </div>
                                </div>
                              </div>

                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="foto">Comprobante 2</label> <br>
                                @if (pathinfo($pago_fuera->foto2, PATHINFO_EXTENSION) === 'pdf')
                                    <iframe src="{{ asset('pago_fuera/'.$pago_fuera->foto2) }}" width="100%" ></iframe>
                                @else
                                    <img id="blah" src="{{ asset('pago_fuera/'.$pago_fuera->foto2) }}" alt="Imagen" style="width: 100%">
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const deudorCheckbox = document.getElementById('deudor');
        const camposDeudor = document.getElementById('deudorCampos');

        function toggleCamposDeudor() {
            camposDeudor.style.display = deudorCheckbox.checked ? 'block' : 'none';
        }

        // Ejecutar al cargar la página
        toggleCamposDeudor();

        // Ejecutar cuando el checkbox cambie su estado
        deudorCheckbox.addEventListener('change', toggleCamposDeudor);
    });
</script>
