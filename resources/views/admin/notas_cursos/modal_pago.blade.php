<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="examplePago{{$nota->id}}" tabindex="-1" role="dialog" aria-labelledby="examplePago" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">#{{$nota->id}} - {{$nota->User->name }}</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>

            </div>
            <form method="POST" action="{{ route('notas_cursos.update', $nota->id) }}" enctype="multipart/form-data" role="form">
                @csrf
                <input type="hidden" name="_method" value="PATCH">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="nota">Subtotal</label>
                                <input type="text" class="form-control" value="${{$nota->subtotal}}" disabled>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="nota">Descuento</label>
                                <input type="text" class="form-control" value="{{$nota->descuento}}%" disabled>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="nota">Total</label>
                                <input type="text" class="form-control" value="${{$nota->total}}" disabled>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="nota">Restante</label>
                                <input type="text" class="form-control" value="${{$nota->restante}}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="row text-center">
                            <div class="col-4" style="background-color: #bb546c; color: #fff;">Monto</div>
                            <div class="col-4" style="background-color: #bb546c; color: #fff;">Metodo de Pago</div>
                            <div class="col-4" style="background-color: #bb546c; color: #fff;">Fecha</div>
                        </div>
                        @foreach ($notas_pagos as $order_ticket)
                            <div class="row text-center mt-2">
                                <div class="col-4">{{$order_ticket->monto}}</div>
                                <div class="col-4">{{$order_ticket->metodo_pago}}</div>
                                <div class="col-4">{{$order_ticket->created_at}}</div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="row">
                        <div class="col-4">
                            <input id="monto" name="monto" type="number" class="form-control" placeholder="$ monto">
                        </div>
                        <div class="col-4">
                            <select name="metodo_pago" id="metodo_pago" class="form-select d-inline-block">
                                <option value="Efectivo">Efectivo</option>
                                <option value="Tarjeta">Tarjeta</option>
                                <option value="Transferencia">Transferencia</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                        </div>
                    </div>


                </div>
            </form>
        </div>
    </div>
</div>
