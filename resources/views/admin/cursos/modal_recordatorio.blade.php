<!-- Modal -->
<div class="modal fade" id="recordatorio_modal_{{ $curso->id }}" tabindex="-1" role="dialog" aria-labelledby="recordatorio_modal_{{ $curso->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="recordatorio_modal_{{ $curso->id }}">Recordatorios</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

                <div class="modal-body row">
                    <div class="d-flex justify-content-around">
                        <span class="badge badge-success  badge-sm">Enviado</span>
                        <span class="badge badge-warning badge-sm">No enviado</span>
                        <span class="badge badge-danger badge-sm">Interesado</span>
                    </div>

                    <div class="col-12">
                        <div class="d-flex justify-content-center">
                            <nav class="mt-3 mb-3">
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-interesados-tab{{ $curso->id }}" data-bs-toggle="tab" data-bs-target="#nav-interesados{{ $curso->id }}" type="button" role="tab" aria-controls="nav-interesados" aria-selected="true">
                                    Interesados
                                </button>

                                <button class="nav-link" id="nav-registrar-tab{{ $curso->id }}" data-bs-toggle="tab" data-bs-target="#nav-registrar{{ $curso->id }}" type="button" role="tab" aria-controls="nav-registrar" aria-selected="false">
                                    Registrar
                                </button>
                                </div>
                            </nav>
                        </div>

                          <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-interesados{{ $curso->id }}" role="tabpanel" aria-labelledby="nav-interesados-tab{{ $curso->id }}" tabindex="0">
                                <div class="row">
                                            @foreach ($curso->RecordatoriosCursos as $recordatorio)
                                            <div class="col-3 mt-2 mb-2">
                                                {{ $recordatorio->nombre }}
                                            </div>

                                            <div class="col-3 mt-2 mb-2">
                                                {{ $recordatorio->telefono }}
                                            </div>

                                            <div class="col-3 mt-2 mb-2">
                                                @if ($recordatorio->estatus == 'No enviado')
                                                <span class="badge badge-warning badge-sm">---</span>
                                                @elseif ($recordatorio->estatus == 'Enviado')
                                                <span class="badge badge-success badge-sm">---</span>
                                                @elseif ($recordatorio->estatus == 'Interesado')
                                                <span class="badge badge-danger badge-sm">---</span>
                                                @endif
                                            </div>

                                            <div class="col-3 mt-2 mb-2">
                                                <a type="button" class="btn btn-sm" target="_blank"href="https://wa.me/52{{$recordatorio->telefono}}?text=Hola%20{{$recordatorio->nombre}}"
                                                        style="background: #00BB2D; color: #ffff">
                                                        <i class="fa fa-whatsapp"></i></a>
                                            </div>
                                            @endforeach
                                </div>
                            </div>

                            <div class="tab-pane fade" id="nav-registrar{{ $curso->id }}" role="tabpanel" aria-labelledby="nav-registrar-tab{{ $curso->id }}" tabindex="0">
                                <form method="POST" action="{{ route('recordatorio.store') }}" enctype="multipart/form-data" role="form">
                                    @csrf
                                    <input id="id_curso" name="id_curso" type="hidden" value="{{$curso->id}}">

                                    <div class="row">
                                        <div class="col-12 form-group">
                                            <label for="nombre">Nombre completo</label>
                                            <input id="nombre" name="nombre" type="text" class="form-control" required>
                                        </div>

                                        <div class="col-6 form-group">
                                            <label for="email">Correo</label>
                                            <input id="email" name="email" type="email" class="form-control">
                                        </div>

                                        <div class="col-6 form-group">
                                            <label for="name">Telefono</label>
                                            <input id="telefono" name="telefono" type="text" class="form-control" required>
                                        </div>

                                        <div class="col-12 form-group">
                                            <label for="name">Nota</label>
                                            <textarea name="nota" id="nota" cols="30" rows="3" class="form-control"></textarea>
                                        </div>

                                        <div class="col-6 form-group">
                                            <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                          </div>
                    </div>
                </div>

                <div class="modal-footer">
                </div>

        </div>
    </div>
</div>
