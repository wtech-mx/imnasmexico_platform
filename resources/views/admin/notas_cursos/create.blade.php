<div id="rightPanel" class="right-panel">
    <div class="close-btn" onclick="closeRightPanel()">Cerrar</div>
    <div class="panel-content">
        <form method="POST" action="{{ route('notas_cursos.store') }}" enctype="multipart/form-data" role="form">
            @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-3">
                            <label for="precio">Nuevo cliente</label><br>
                            <button class="btn btn-success btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                Agregar
                            </button>
                        </div>
                        <div class="col-9">

                            <div class="form-group">
                                <label for="name">Cliente *</label>
                                <select class="form-select cliente d-inline-block"  data-toggle="select" id="id_client" name="id_client" value="{{ old('id_client') }}">
                                    <option>Seleccionar cliente</option>
                                    @foreach ($client as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }} / {{ $item->telefono }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-12">
                            <div class="collapse" id="collapseExample">
                                <div class="card card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">Nombre *</label>
                                                <input id="name" name="name" type="text" class="form-control" placeholder="Nombre">
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">Correo</label>
                                                <input id="email" name="email" type="email" class="form-control" placeholder="Correo">
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">Telefono *</label>
                                                <input id="telefono" name="telefono" type="tel" minlength="10" maxlength="10" class="form-control" placeholder="55-55-55-55-55">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-1">
                            <div class="form-group">
                                <label for="">-</label>
                                <button class="mt-3" type="button" id="agregarCampo" style="border-radius: 9px;width: 36px;height: 40px;">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Curso</label>
                                <div id="camposContainer">
                                    <div class="campo mt-3">
                                        <select name="campo[]" class="form-select d-inline-block curso" style="width: 70%!important;">
                                            <option value="">Seleccione Curso</option>
                                            @foreach ($cursos as $curso)
                                            <option value="{{ $curso->id }}" data-precio="{{ $curso->precio}}">{{ $curso->nombre }} - {{ $curso->Cursos->modalidad }} / {{ $curso->Cursos->fecha_inicial }}</option>
                                            @endforeach
                                        </select>
                                        <input type="text" name="precio[]" class="form-control d-inline-block precio" style="width: 20%!important;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- ================ P A G O ================ --}}

                <div class="modal-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="name">Subtotal</label>
                                <input class="form-control" type="text" id="total" name="total" readonly>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="name">Descuento</label>
                                <input class="form-control" type="number" id="descuento" name="descuento" value="0">
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="name">Total</label>
                                <input class="form-control" type="text" id="totalDescuento" name="totalDescuento" readonly>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="name">Monto</label>
                                <input class="form-control" type="number" id="monto" name="monto" value="$">
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="name">Metodo de Pago</label>
                                <select name="metodo_pago" id="metodo_pago" class="form-select d-inline-block">
                                    <option value="Efectivo">Efectivo</option>
                                    <option value="Tarjeta">Tarjeta</option>
                                    <option value="Transferencia">Transferencia</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="name">Fecha *</label>
                                <input id="created_at" name="created_at" type="datetime-local" class="form-control" value="{{$fechaHoraActualFormateada}}" required>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="name">Nota</label>
                                <textarea name="nota" id="nota" class="form-control" cols="5" rows="3"></textarea>
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

