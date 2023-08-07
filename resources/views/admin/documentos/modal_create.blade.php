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
                    <div class="col-12">

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
                                    <div class="col-12">

                                    </div>
                               </div>
                            </div>

                            <div class="tab-pane fade" id="sin_usuario" role="tabpanel" aria-labelledby="sin_usuario-tab">
                               <div class="row">
                                    <div class="col-12">

                                    </div>
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
