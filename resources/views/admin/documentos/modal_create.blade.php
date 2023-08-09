<!-- Modal -->
<div class="modal fade" id="create_manual" tabindex="-1" role="dialog" aria-labelledby="create_manual" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="create_manual">Crear Manual</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <form method="POST" action="{{ route('documentos.store') }}" enctype="multipart/form-data" role="form">
                @csrf

                <div class="modal-body row">
                        <div class="form-group col-12">
                            <label for="name">Curso</label>
                            <input id="curso" name="curso" type="text" class="form-control" required >
                        </div>

                        <div class="form-group col-7">
                            <label for="name">Tipo de documento</label>
                            <select name="tipo" id="tipo" class="form-select" required>
                                <option value="Cedula de indetidad">CN - Cedula de identidad papel</option>
                                <option value="Credencial">CN - Credencial plastico</option>
                                <option value="Diploma">CN - Diploma</option>
                                <option value="Titulo Honorifico con QR">CN - Titulo Honorifico con QR</option>
                                <option value="Titulo Honorifico con QR">CN - Titulo Honorifico CFC</option>
                                <option value="Tira de materias">CN - Tira de materias</option>
                                <option value="Diploma_STPS">Diploma STPS</option>
                            </select>
                        </div>

                        <div class="form-group col-5">
                            <label for="name">Fecha</label>
                            <input id="fecha" name="fecha" type="date" class="form-control" required >
                        </div>


                        <div class="d-flex justify-content-center">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="usuario-tab" data-bs-toggle="tab" data-bs-target="#usuario" type="button" role="tab" aria-controls="usuario" aria-selected="true">Con usuario</button>
                                </li>

                                <li class="nav-item" role="presentation">
                                <button class="nav-link" id="sin_usuario-tab" data-bs-toggle="tab" data-bs-target="#sin_usuario" type="button" role="tab" aria-controls="sin_usuario" aria-selected="false">Sin usario</button>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="usuario" role="tabpanel" aria-labelledby="usuario-tab">
                               <div class="row">
                                    <label for="name">Alumno</label>
                                    <select name="id_usuario" id="usuarioSelect" class="form-select">
                                        @foreach ($alumnos as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>

                                    <label for="name">Cursos</label>
                                    <select id="ordenesSelect" disabled>
                                        <option value="">Selecciona una orden</option>
                                        <!-- Opciones de órdenes aquí -->
                                    </select>
                               </div>
                            </div>

                            <div class="tab-pane fade" id="sin_usuario" role="tabpanel" aria-labelledby="sin_usuario-tab">
                               <div class="row">
                                    <div class="form-group col-6">
                                        <label for="name">Nombre</label>
                                        <input id="name" name="name" type="text" class="form-control" required >
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="name">Apellidos</label>
                                        <input id="apellido" name="apellido" type="text" class="form-control" required >
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="name">Correo</label>
                                        <input id="email" name="email" type="email" class="form-control" required >
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="name">Telefono</label>
                                        <input id="telefono" name="telefono" type="number" class="form-control" required >
                                    </div>
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
