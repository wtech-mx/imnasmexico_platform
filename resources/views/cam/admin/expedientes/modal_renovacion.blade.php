<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModalRenovacion{{$pago_renovacion->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <div class="col-6">
                        <h4>Nota de Renovacion</h4>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">


                        <div class="col-6">
                            <div class="form-group">
                                <h6 for="name">Fecha de renovacion</h6>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/cam/calenda.png') }}" alt="" width="35px">
                                    </span>
                                    <input type="text" class="form-control" value="{{$fecha_formateada}}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <h6 for="name">Cantidad total</h6>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="35px">
                                    </span>
                                    <input type="text" class="form-control" value="{{$pago_renovacion->cantidad_total}}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <h6 for="name">Estandare(s)</h6>
                            <ul>
                                @foreach ($estandares_renovacion as $estandar_cam_comprado)
                                    @if ($estandar_cam_comprado->id_renovacion == $pago_renovacion->id)
                                        <li>{{$estandar_cam_comprado->Estandar->estandar}}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <h6 for="name">Ver comprobante de pago</h6>
                                <div class="input-group mb-3">
                                    <a target="_blank" href="{{asset('cam_pagos/'.$estandar_cam_comprado->comprobante_pago)}}">Ver comprobante</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
        </div>
    </div>
</div>
