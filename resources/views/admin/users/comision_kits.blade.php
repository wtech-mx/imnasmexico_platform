<!-- Modal -->
<div class="modal fade" id="comision_{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="comision_{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="comision_{{ $item->id }}">Comision: {{$item->name}}</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>

            </div>
            <div class="modal-body row">
                @foreach ($notasAprobadasNASComision as $notas)
                    @if ($notas->id_admin == $item->id && $notas->id_admin_venta == $item->id)
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
                        <ul>
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
                        <hr style="border-top: 2px solid rgb(24, 160, 184)">
                    @endif
                    @if ($notas->id_admin == $item->id && $notas->id_admin_venta !== $item->id)
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
                        <ul>
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
                    @endif
                    @if ($notas->id_admin !== $item->id && $notas->id_admin_venta == $item->id)
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
                        <ul>
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
                    @endif
                @endforeach
                
                @if ($comision)
                    @php
                        $suma_comisiones = $comision + $comision_uno;
                    @endphp
                    Comision individual = ${{$comision}} <br>
                    Comision compartida = ${{$comision_uno}}<br>
                    <b>Total = ${{$suma_comisiones}}</b>
                @else
                    No hay venta
                @endif
            </div>
        </div>
    </div>
</div>
