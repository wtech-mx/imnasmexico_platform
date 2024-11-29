<!-- Modal -->
<div class="modal fade" id="comision_{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="comision_{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="background:#F5ECE4!important;">
        <div class="modal-content">
            <div class="modal-header" style="background:#F5ECE4!important;">
                <h5 class="modal-title" id="comision_{{ $item->id }}">Comision: {{$item->name}}</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>

            </div>
            <div class="modal-body" style="background:#F5ECE4!important;">
                <h3 style="color: #836262"><strong>NAS</strong></h3>
                @foreach ($notasAprobadasNASComision as $notas)
                    @if ($notas->id_admin == $item->id && $notas->id_admin_venta == $item->id)
                    <div class="card p-3 ml-2 mb-3" style="box-shadow: 6px 6px 15px -10px rgb(0 0 0 / 50%);">
                            <label style="color:rgb(24, 160, 184)">Venta individual</label>
                            <div class="form-group col-3">
                                <label class="" for="nombre">{{$notas->folio}}</label>
                            </div>

                            <div class="form-group col-3">
                                <label class="" for="nombre">${{$notas->tipo}}</label>
                            </div>

                            <div class="form-group col-3">
                                <label class="" for="nombre">{{$notas->restante}}%</label>
                            </div>

                            <div class="form-group col-3">
                                <label class="" for="nombre">${{$notas->total}}</label>
                            </div>

                            <ul style="list-style:none;">
                                @if ($notas->id_kit != NULL)
                                    <li><b>Kit:</b> {{$notas->cantidad_kit}} - {{$notas->Kit->nombre}}</li>
                                @endif
                                @if ($notas->id_kit2 != NULL)
                                    <li><b>Kit:</b> {{$notas->cantidad_kit2}} - {{$notas->Kit2->nombre}}</li>
                                @endif
                                @if ($notas->id_kit3 != NULL)
                                    <li><b>Kit:</b> {{$notas->cantidad_kit3}} - {{$notas->Kit3->nombre}}</li>
                                @endif
                                @if ($notas->id_kit4 != NULL)
                                    <li><b>Kit:</b> {{$notas->cantidad_kit4}} - {{$notas->Kit4->nombre}}</li>
                                @endif
                                @if ($notas->id_kit5 != NULL)
                                    <li><b>Kit:</b> {{$notas->cantidad_kit5}} - {{$notas->Kit5->nombre}}</li>
                                @endif
                                @if ($notas->id_kit6 != NULL)
                                    <li><b>Kit:</b> {{$notas->cantidad_kit6}} - {{$notas->Kit6->nombre}}</li>
                                @endif
                            </ul>
                    </div>
                    @endif
                    @if ($notas->id_admin == $item->id && $notas->id_admin_venta !== $item->id)
                        <div class="card p-3 ml-2 mb-3" style="box-shadow: 6px 6px 15px -10px rgb(0 0 0 / 50%);">
                            <div class="row">
                                <label style="color:blueviolet">Venta compartida</label>
                                <div class="form-group col-3">
                                    <label class="" for="nombre">{{$notas->folio}}</label>
                                </div>
                                <div class="form-group col-3">
                                    <label class="" for="nombre">${{$notas->tipo}}</label>
                                </div>
                                <div class="form-group col-3">
                                    <label class="" for="nombre">{{$notas->restante}}%</label>
                                </div>
                                <div class="form-group col-3">
                                    <label class="" for="nombre">${{$notas->total}}</label>
                                </div>
                                <ul style="list-style:none;">
                                    @if ($notas->id_kit != NULL)
                                        <li><b>Kit:</b> {{$notas->cantidad_kit}} - {{$notas->Kit->nombre}}</li>
                                    @endif
                                    @if ($notas->id_kit2 != NULL)
                                        <li><b>Kit:</b> {{$notas->cantidad_kit2}} - {{$notas->Kit2->nombre}}</li>
                                    @endif
                                    @if ($notas->id_kit3 != NULL)
                                        <li><b>Kit:</b> {{$notas->cantidad_kit3}} - {{$notas->Kit3->nombre}}</li>
                                    @endif
                                    @if ($notas->id_kit4 != NULL)
                                        <li><b>Kit:</b> {{$notas->cantidad_kit4}} - {{$notas->Kit4->nombre}}</li>
                                    @endif
                                    @if ($notas->id_kit5 != NULL)
                                        <li><b>Kit:</b> {{$notas->cantidad_kit5}} - {{$notas->Kit5->nombre}}</li>
                                    @endif
                                    @if ($notas->id_kit6 != NULL)
                                        <li><b>Kit:</b> {{$notas->cantidad_kit6}} - {{$notas->Kit6->nombre}}</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    @endif
                    @if ($notas->id_admin !== $item->id && $notas->id_admin_venta == $item->id)
                    <div class="card p-3 ml-2 mb-3" style="box-shadow: 6px 6px 15px -10px rgb(0 0 0 / 50%);">
                        <div class="row">
                            <label style="color:blueviolet">Venta compartida</label>
                            <div class="form-group col-3">
                                <label class="" for="nombre">{{$notas->folio}}</label>
                            </div>
                            <div class="form-group col-3">
                                <label class="" for="nombre">${{$notas->tipo}}</label>
                            </div>
                            <div class="form-group col-3">
                                <label class="" for="nombre">{{$notas->restante}}%</label>
                            </div>
                            <div class="form-group col-3">
                                <label class="" for="nombre">${{$notas->total}}</label>
                            </div>
                            <ul style="list-style:none;">
                                @if ($notas->id_kit != NULL)
                                    <li><b>Kit:</b> {{$notas->cantidad_kit}} - {{$notas->Kit->nombre}}</li>
                                @endif
                                @if ($notas->id_kit2 != NULL)
                                    <li><b>Kit:</b> {{$notas->cantidad_kit2}} - {{$notas->Kit2->nombre}}</li>
                                @endif
                                @if ($notas->id_kit3 != NULL)
                                    <li><b>Kit:</b> {{$notas->cantidad_kit3}} - {{$notas->Kit3->nombre}}</li>
                                @endif
                                @if ($notas->id_kit4 != NULL)
                                    <li><b>Kit:</b> {{$notas->cantidad_kit4}} - {{$notas->Kit4->nombre}}</li>
                                @endif
                                @if ($notas->id_kit5 != NULL)
                                    <li><b>Kit:</b> {{$notas->cantidad_kit5}} - {{$notas->Kit5->nombre}}</li>
                                @endif
                                @if ($notas->id_kit6 != NULL)
                                    <li><b>Kit:</b> {{$notas->cantidad_kit6}} - {{$notas->Kit6->nombre}}</li>
                                @endif
                            </ul>
                            <hr style="border-top: 2px solid blueviolet">
                        </div>
                    </div>
                @endif
                @endforeach

                <h3 style="color: #551580"><strong>Cosmica</strong></h3>

                @foreach ($notasAprobadasCosmicaComision as $notas)
                    @if ($notas->id_admin == $item->id && $notas->id_admin_venta == $item->id)
                        <div class="card p-3 ml-2 mb-3" style="box-shadow: 6px 6px 15px -10px rgb(0 0 0 / 50%);">
                            <div class="row">
                            <label style="color:rgb(24, 160, 184)">Venta individual</label>
                            <div class="form-group col-3">
                                <label class="" for="nombre">{{$notas->folio}}</label>
                            </div>
                            <div class="form-group col-3">
                                <label class="" for="nombre">${{$notas->tipo}}</label>
                            </div>
                            <div class="form-group col-3">
                                <label class="" for="nombre">{{$notas->restante}}%</label>
                            </div>
                            <div class="form-group col-3">
                                <label class="" for="nombre">${{$notas->total}}</label>
                            </div>
                            <ul style="list-style:none;">
                                @if ($notas->id_kit != NULL)
                                    <li><b>Kit:</b> {{$notas->cantidad_kit}} - {{$notas->Kit->nombre}}</li>
                                @endif
                                @if ($notas->id_kit2 != NULL)
                                    <li><b>Kit:</b> {{$notas->cantidad_kit2}} - {{$notas->Kit2->nombre}}</li>
                                @endif
                                @if ($notas->id_kit3 != NULL)
                                    <li><b>Kit:</b> {{$notas->cantidad_kit3}} - {{$notas->Kit3->nombre}}</li>
                                @endif
                                @if ($notas->id_kit4 != NULL)
                                    <li><b>Kit:</b> {{$notas->cantidad_kit4}} - {{$notas->Kit4->nombre}}</li>
                                @endif
                                @if ($notas->id_kit5 != NULL)
                                    <li><b>Kit:</b> {{$notas->cantidad_kit5}} - {{$notas->Kit5->nombre}}</li>
                                @endif
                                @if ($notas->id_kit6 != NULL)
                                    <li><b>Kit:</b> {{$notas->cantidad_kit6}} - {{$notas->Kit6->nombre}}</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                @endif
                    @if ($notas->id_admin == $item->id && $notas->id_admin_venta !== $item->id)
                    <div class="card p-3 ml-2 mb-3" style="box-shadow: 6px 6px 15px -10px rgb(0 0 0 / 50%);">
                        <div class="row">
                                <label style="color:blueviolet">Venta compartida</label>
                            <div class="form-group col-3">
                                <label class="" for="nombre">{{$notas->folio}}</label>
                            </div>
                            <div class="form-group col-3">
                                <label class="" for="nombre">${{$notas->tipo}}</label>
                            </div>
                            <div class="form-group col-3">
                                <label class="" for="nombre">{{$notas->restante}}%</label>
                            </div>
                            <div class="form-group col-3">
                                <label class="" for="nombre">${{$notas->total}}</label>
                            </div>
                            <ul style="list-style:none;">
                                @if ($notas->id_kit != NULL)
                                    <li><b>Kit:</b> {{$notas->cantidad_kit}} - {{$notas->Kit->nombre}}</li>
                                @endif
                                @if ($notas->id_kit2 != NULL)
                                    <li><b>Kit:</b> {{$notas->cantidad_kit2}} - {{$notas->Kit2->nombre}}</li>
                                @endif
                                @if ($notas->id_kit3 != NULL)
                                    <li><b>Kit:</b> {{$notas->cantidad_kit3}} - {{$notas->Kit3->nombre}}</li>
                                @endif
                                @if ($notas->id_kit4 != NULL)
                                    <li><b>Kit:</b> {{$notas->cantidad_kit4}} - {{$notas->Kit4->nombre}}</li>
                                @endif
                                @if ($notas->id_kit5 != NULL)
                                    <li><b>Kit:</b> {{$notas->cantidad_kit5}} - {{$notas->Kit5->nombre}}</li>
                                @endif
                                @if ($notas->id_kit6 != NULL)
                                    <li><b>Kit:</b> {{$notas->cantidad_kit6}} - {{$notas->Kit6->nombre}}</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    @endif
                    @if ($notas->id_admin !== $item->id && $notas->id_admin_venta == $item->id)
                    <div class="card p-3 ml-2 mb-3" style="box-shadow: 6px 6px 15px -10px rgb(0 0 0 / 50%);">
                        <div class="row">

                            <label style="color:blueviolet">Venta compartida</label>
                            <div class="form-group col-3">
                                <label class="" for="nombre">{{$notas->folio}}</label>
                            </div>
                            <div class="form-group col-3">
                                <label class="" for="nombre">${{$notas->tipo}}</label>
                            </div>
                            <div class="form-group col-3">
                                <label class="" for="nombre">{{$notas->restante}}%</label>
                            </div>
                            <div class="form-group col-3">
                                <label class="" for="nombre">${{$notas->total}}</label>
                            </div>
                            <ul style="list-style:none;">
                                @if ($notas->id_kit != NULL)
                                    <li><b>Kit:</b> {{$notas->cantidad_kit}} - {{$notas->Kit->nombre}}</li>
                                @endif
                                @if ($notas->id_kit2 != NULL)
                                    <li><b>Kit:</b> {{$notas->cantidad_kit2}} - {{$notas->Kit2->nombre}}</li>
                                @endif
                                @if ($notas->id_kit3 != NULL)
                                    <li><b>Kit:</b> {{$notas->cantidad_kit3}} - {{$notas->Kit3->nombre}}</li>
                                @endif
                                @if ($notas->id_kit4 != NULL)
                                    <li><b>Kit:</b> {{$notas->cantidad_kit4}} - {{$notas->Kit4->nombre}}</li>
                                @endif
                                @if ($notas->id_kit5 != NULL)
                                    <li><b>Kit:</b> {{$notas->cantidad_kit5}} - {{$notas->Kit5->nombre}}</li>
                                @endif
                                @if ($notas->id_kit6 != NULL)
                                    <li><b>Kit:</b> {{$notas->cantidad_kit6}} - {{$notas->Kit6->nombre}}</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    @endif
                @endforeach
                @php
                    $suma_comisiones_indv = $comision + $comision_cosmica;
                    $suma_comisiones_comp = $comision_uno + $comision_uno_cosmica;
                    $suma_comisiones = $comision + $comision_uno + $comision_cosmica + $comision_uno_cosmica;
                @endphp
                Comision individual = ${{$suma_comisiones_indv}} <br>
                Comision compartida = ${{$suma_comisiones_comp}}<br>
                <b>Total = ${{$suma_comisiones}}</b>
            </div>
            <div class="modal-footer" style="background:#F5ECE4!important;">
                <a class="btn btn-warning" href="{{ route('comision_kit.imprimir', $item->id) }}" target="_blank">Imprimir</a>
            </div>
        </div>
    </div>
</div>
