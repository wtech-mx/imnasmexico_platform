<!-- Modal -->
<div class="modal fade" id="ticket_cliente_{{ $cliente->id }}" tabindex="-1" role="dialog" aria-labelledby="ticket_cliente_{{ $cliente->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ticket_cliente_{{ $cliente->id }}">Ordenes compradas de : {{ $cliente->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-2 mb-2"><strong> Num. Pedido: </strong> </div>
                        <div class="col-2 mb-2"><strong> Fecha de Compra: </strong> </div>
                        <div class="col-2 mb-2"><strong> Total: </strong> </div>
                        <div class="col-2 mb-2"><strong> Curso/Diplomado: </strong> </div>
                        <div class="col-2 mb-2"><strong> Estado: </strong> </div>
                        <div class="col-2 mb-2"><strong> Acciones: </strong> </div>
                    </div>
                    <div class="row">
                            @if(!empty($orders))
                                @foreach($orders as $order)
                                @if(($order->id_usuario == $cliente->id))
                                        <div class="col-2">
                                            #{{$order->id}}
                                        </div>

                                        <div class="col-2">
                                            @php
                                            $fecha = $order->fecha;
                                            $fecha_timestamp = strtotime($fecha);
                                            $fecha_formateada = date('d \d\e F \d\e\l Y', $fecha_timestamp);
                                            @endphp

                                            {{$fecha_formateada}}
                                        </div>

                                        <div class="col-2">
                                            @php
                                                $precio = number_format($order->pago, 2, '.', ',');
                                            @endphp
                                            ${{$precio}} mxn
                                        </div>

                                        <div class="col-2">
                                            {{$order->forma_pago}}
                                        </div>

                                        <div class="col-2">
                                            @if ($order->estatus == '1')
                                                <p class="width: 100px;">Completado</p>
                                            @else
                                                <p class="width: 100px;">En espera</p>
                                            @endif
                                        </div>

                                        <div class="col-2">
                                            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#ticket_{{ $order->id }}" aria-expanded="false" aria-controls="ticket_{{ $order->id }}">
                                                <i class="fa fa-fw fa-eye"></i>
                                            </button>
                                        </div>

                                        <div class="col-12 ">
                                            <div class="collapse collapse-horizontal mb-3" id="ticket_{{ $order->id }}">
                                              <div class="card card-body" style="background: #836262;">
                                                <h5 class="text-white">Pedido Detallado #{{$order->id}}</h5>
                                                @foreach ($order_ticket as $tiket)
                                                @if ($order->id == $tiket->id_order)

                                                <div class="row">
                                                    <div class="col-6 mt-3">
                                                        <h6 class="text-white">Nombre Curso/Diplomado</h6>
                                                        <p class="text-white">{{$tiket->Cursos->nombre}}</p>
                                                    </div>
                                                    <div class="col-2 mt-3">
                                                        <h6 class="text-white">Precio</h6>
                                                        @php
                                                            $precio = number_format($tiket->CursosTickets->precio, 2, '.', ',');
                                                        @endphp
                                                        <p class="text-white">${{$precio}} mxn</p>
                                                    </div>
                                                    <div class="col-4 mt-3">
                                                        <h6 class="text-white">Fecha</h6>
                                                        @php
                                                        $fecha1 = $tiket->Cursos->fecha_inicial;
                                                        $fecha_timestamp1 = strtotime($fecha);
                                                        $fecha_formateada1 = date('d \d\e F \d\e\l Y', $fecha_timestamp);

                                                        $fecha2 = $tiket->Cursos->fecha_final;
                                                        $fecha_timestamp2 = strtotime($fecha);
                                                        $fecha_formateada2 = date('d \d\e F \d\e\l Y', $fecha_timestamp);
                                                        @endphp
                                                        <p class="text-white">{{$fecha_formateada2}} al {{$fecha_formateada2}}</p>
                                                    </div>
                                                </div>

                                                @endif
                                                @endforeach
                                              </div>
                                            </div>
                                        </div>
                                        @endif
                                @endforeach
                                @else
                                <p>Upps... aun no tiene compras de Curosos o Diplomados</p>
                            @endif
                        </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"style="background: {{$configuracion->color_boton_save}}; color: #ffff">Cerrar</button>
                </div>

        </div>
    </div>
</div>
