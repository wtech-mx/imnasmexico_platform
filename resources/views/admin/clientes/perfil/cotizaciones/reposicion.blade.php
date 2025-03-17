<form method="POST" action="{{ route('reposicion.create') }}" enctype="multipart/form-data" role="form" id="miFormulario">
    @csrf
    <div class="modal-body">
        <div class="row">
            <input id="tipo_cotizacion" name="tipo_cotizacion" type="hidden" class="form-control" value="Perfil Alumno">
                <input id="id_cliente" name="id_cliente" type="hidden" value="{{$cliente->id}}" >

            <div class="col-12 mt-2">
                <h4 style="color:#836262"><strong>Datos del cliente</strong> </h4>
            </div>

            <div class="row">
                <div class="form-group col-4">
                    <h4 for="name">Nombre *</h4>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="35px">
                        </span>
                        <input id="name" name="name" type="text" class="form-control" value="{{ $tipo == 'Usuario' ? $cliente->name : $cliente->nombre }}" required>
                    </div>
                </div>

                <div class="form-group col-4">
                    <h4 for="name">Correo</h4>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <img src="{{ asset('assets/cam/correo-electronico.png') }}" alt="" width="35px">
                        </span>
                        <input id="email" name="email" type="email" class="form-control" value="{{ $tipo == 'Usuario' ? $cliente->email : '' }}">
                    </div>
                </div>

                <div class="form-group col-4">
                    <h4 for="name">Telefono *</h4>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <img src="{{ asset('assets/cam/llamar.png') }}" alt="" width="35px">
                        </span>
                        <input type="number" id="telefono" name="telefono" class="form-control" value="{{$cliente->telefono}}" required>
                    </div>
                </div>

                <div class="col-6 mt-2">
                    <h4 style="color:#836262"><strong>Selecciona una opción</strong></h4>
                    <div class="form-group">
                        <select id="opcion" name="opcion" class="form-select" >
                            <option value="">Seleccione una opción</option>
                            <option value="Nas">Nas</option>
                            <option value="Cosmica">Cosmica</option>
                        </select>
                    </div>
                </div>

                 <!-- Select dinámico para las notas -->
                <div class="col-6 mt-2 d-none" id="notas-container">
                    <h4 style="color:#836262"><strong>Selecciona una nota</strong></h4>
                    <div class="form-group">
                        <select id="notas" name="notas" class="form-select">
                            <option value="">Seleccione una opción</option>
                        </select>
                    </div>
                </div>

                <!-- Contenedor para los productos -->
                <div class="row mt-4 d-none" id="productos-container">
                    <h4 style="color:#836262"><strong>Productos de la nota</strong></h4>
                    <div id="productos-list" class="col-12">
                        <!-- Aquí se llenarán los inputs dinámicamente -->
                    </div>
                </div>

                <!-- Contenedor para seleccionar el producto de reemplazo -->
                <div class="row mt-4 d-none" id="reemplazo-container">
                    <h4 style="color:#836262"><strong>Selecciona el producto de reemplazo</strong></h4>
                    <div class="form-group col-12">
                        <select id="productos-reemplazo" name="productos_reemplazo" class="form-select">
                            <option value="">Seleccione un producto</option>
                            <!-- Aquí se llenarán los productos dinámicamente -->
                        </select>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <h4 for="name">Comentario/nota</h4>
                        <textarea class="form-control" name="nota_reposicion" id="nota_reposicion" cols="30" rows="3"></textarea>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff; font-size: 17px;">Guardar</button>
    </div>
</form>
