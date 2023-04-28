<!-- Modal -->
<div class="modal fade" id="update_cliente_{{ $cliente->id }}" tabindex="-1" role="dialog" aria-labelledby="update_cliente_{{ $cliente->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="update_cliente_{{ $cliente->id }}">{{ $cliente->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <form method="POST" action="{{ route('comentarios.update', $cliente->id) }}" enctype="multipart/form-data" role="form">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <div class="modal-body">


                    <ul class="nav nav-tabs" id="myTab_{{ $cliente->id }}" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="datos-tab" data-bs-toggle="tab" data-bs-target="#datos{{ $cliente->id }}" type="button" role="tab" aria-controls="datos{{ $cliente->id }}" aria-selected="true">Datos Generales</button>
                        </li>

                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="fact-tab" data-bs-toggle="tab" data-bs-target="#fact{{ $cliente->id }}" type="button" role="tab" aria-controls="fact{{ $cliente->id }}" aria-selected="false">Facturacion</button>
                        </li>

                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="documentos-tab" data-bs-toggle="tab" data-bs-target="#documentos{{ $cliente->id }}" type="button" role="tab{{ $cliente->id }}" aria-controls="documentos" aria-selected="false">Documentos</button>
                        </li>
                      </ul>

                      <div class="tab-content" id="myTab_{{ $cliente->id }}Content">
                        <div class="tab-pane fade show active" id="datos{{ $cliente->id }}" role="tabpanel" aria-labelledby="datos-tab">
                            <div class="row">
                                <div class="col-12 form-group">
                                    <label for="name">Nombre</label>
                                    <input id="name" name="name" type="text" class="form-control" disabled value="{{ $cliente->name }}">
                                </div>
                                <div class="col-6 form-group">
                                    <label for="name">Telefono</label>
                                    <input id="rfc" name="talefono" type="number" class="form-control" disabled value="{{ $cliente->telefono }}">
                                </div>
                                <div class="col-6 form-group">
                                    <label for="name">Correo</label>
                                    <input id="Correo" name="Correo" type="email" class="form-control" disabled value="{{ $cliente->email }}">
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="fact{{ $cliente->id }}" role="tabpanel" aria-labelledby="fact-tab">
                            <div class="row">
                                <div class="col-12 form-group">
                                    <label for="rfc">RFC</label>
                                    <input id="rfc" name="rfc" type="number" class="form-control" disabled value="{{ $cliente->rfc }}">
                                </div>
                                <div class="col-12 form-group">
                                    <label for="razon_social">Razon social</label>
                                    <input id="razon_social" name="razon_social" type="email" class="form-control" disabled value="{{ $cliente->razon_social }}">
                                </div>
                                <div class="col-12 form-group">
                                    <label for="cfdi">CFDI</label>
                                    <input id="cfdi" name="cfdi" type="text" class="form-control" disabled value="{{ $cliente->cfdi }}">
                                </div>
                                <div class="col-12 form-group">
                                    <label for="cfdi">direccion</label>
                                    <textarea class="form-control" name="" id="" cols="30" rows="3" disabled>
                                        {{ $cliente->direccion }}
                                    </textarea>
                                </div>

                            </div>
                        </div>

                        <div class="tab-pane fade" id="documentos{{ $cliente->id }}" role="tabpanel" aria-labelledby="documentos-tab">

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
