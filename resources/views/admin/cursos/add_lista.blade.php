<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Agregar</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>

            </div>
            <form method="POST" action="{{ route('orden.pay_externo') }}" enctype="multipart/form-data" role="form">
                @csrf
                <div class="modal-body">
                    <input id="curso" name="curso" type="hidden" class="form-control" value="{{$ticket->id_curso}}">
                    <input id="precio" name="precio" type="hidden" class="form-control" value="{{$ticket->precio}}">
                    <div class="form-group">
                        <label for="name">Ticket</label>
                        <select id="ticket" name="ticket" class="form-control">
                            @foreach ($tickets as $ticket)
                            <option value="{{$ticket->id}}">{{$ticket->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input id="name" name="name" type="text" class="form-control" placeholder="Nombre" required>@error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Correo</label>
                        <input id="email" name="email" type="email" class="form-control" placeholder="Correo" required>@error('email') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">Telefono</label>
                        <input id="telefono" name="telefono" type="number" class="form-control" placeholder="Telefono" required>@error('telefono') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
