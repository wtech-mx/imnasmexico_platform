<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Crear nota</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <form method="POST" action="{{ route('notas_cursos.store') }}" enctype="multipart/form-data" role="form">
                @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Nombre *</label>
                                    <input id="name" name="name" type="text" class="form-control" placeholder="Nombre" required>@error('nombre') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Correo</label>
                                    <input id="email" name="email" type="email" class="form-control" placeholder="Correo">@error('email') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Telefono *</label>
                                    <input id="telefono" name="telefono" type="number" class="form-control" placeholder="Telefono" required>@error('telefono') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Fecha *</label>
                                    <input id="fecha" name="fecha" type="date" class="form-control" value="{{$fecha}}" required>@error('fecha') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name">Nota</label>
                                    <textarea name="nota" id="nota" class="form-control" cols="5" rows="3"></textarea>
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

                            <div class="col-11">
                                <div class="form-group">
                                    <label for="">Curso</label>
                                    <div id="camposContainer">
                                        <div class="campo mt-3">
                                            <select name="campo[]" class="form-select d-inline-block cliente" style="width: 70%!important;" onchange="updatePrecio(this)" multiple="multiple">
                                                <option value="">Seleccione Curso</option>
                                                @foreach ($cursos as $curso)
                                                <option value="{{ $curso->id }}" data-precio="{{ $curso->precio }}">{{ $curso->nombre }} - {{ $curso->Cursos->modalidad }} / {{ $curso->Cursos->fecha_inicial }}</option>
                                                @endforeach
                                            </select>
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

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Monto</label>
                                    <input class="form-control" type="number" id="monto" name="monto" value="$">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Metodo de Pago</label>
                                    <select name="metodo_pago" id="metodo_pago" class="form-select d-inline-block">
                                        <option value="Efectivo">Efectivo</option>
                                        <option value="Tarjeta">Tarjeta</option>
                                        <option value="Transferencia">Transferencia</option>
                                    </select>
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
