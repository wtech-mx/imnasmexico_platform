<!-- Modal -->
<div class="modal fade" id="showDataModal{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="showDataModal{{$order->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="showDataModalLabel">Pedido Detallado</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: #836262; color: #ffff">
                <span aria-hidden="true">X</span>
            </button>
        </div>
            <div class="modal-body">
                <div class="form-group">
                    @foreach ($order_ticket as $tiket)
                        @if ($order->id == $tiket->id_order)
                            <div class="row">
                                <div class="col-8 mt-3">
                                    <b><label>Nombre Curso/Diplomado</label></b><br>
                                    <label>{{$tiket->Cursos->nombre}}</label>
                                </div>
                                <div class="col-4 mt-3">
                                    <b><label>Precio</label></b><br>
                                    @php
                                        $precio = number_format($tiket->CursosTickets->precio, 2, '.', ',');
                                    @endphp
                                    <label>${{$precio}} mxn</label>
                                </div>
                                <div class="col-6 mt-3">
                                    <b><label>Fecha</label></b><br>
                                    <label>{{$tiket->Cursos->fecha_inicial}} - {{$tiket->Cursos->fecha_final}}</label>
                                </div>
                                <div class="col-6 mt-3">
                                    <b><label>Hora</label></b><br>
                                    <label>{{$tiket->Cursos->hora_inicial}} - {{$tiket->Cursos->hora_final}}</label>
                                </div>
                                <div class="col-12 mt-3">
                                    @if ($tiket->Cursos->modalidad == 'Online')
                                        <b><label>Liga de Clase</label></b><br>
                                        @if ($order->estatus == '1')
                                            <a href="{{$tiket->Cursos->recurso}}">{{$tiket->Cursos->recurso}}</a>
                                        @endif
                                    @else
                                        <b><label>Dirección</label></b><br>
                                        @if ($order->estatus == '1')
                                            <a class="" href="https://goo.gl/maps/WLa4tPsubCNvrLmD7" target="_blank">
                                                Castilla 136, Álamos, Benito Juárez, 03400 Ciudad de México
                                            </a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <hr>
                        @endif
                    @endforeach

                </div>
            </div>
    </div>
</div>
</div>
