<!-- Modal -->
<div class="modal fade" id="productos_nota_{{ $nota->id }}" tabindex="-1" role="dialog" aria-labelledby="productos_nota_{{ $nota->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Productos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

                <div class="modal-body">
                    <div class="d-flex justify-content-center">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                              <button class="nav-link active" id="actualizar-tab" data-bs-toggle="tab" data-bs-target="#actualizar-tab-pane" type="button" role="tab" aria-controls="actualizar-tab-pane" aria-selected="true">Actualizar</button>
                            </li>

                            <li class="nav-item" role="presentation">
                              <button class="nav-link" id="eliminar-tab" data-bs-toggle="tab" data-bs-target="#eliminar-tab-pane" type="button" role="tab" aria-controls="eliminar-tab-pane" aria-selected="false">Eliminar</button>
                            </li>
                          </ul>
                    </div>


                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="actualizar-tab-pane" role="tabpanel" aria-labelledby="actualizar-tab" tabindex="0">
                            <div class="row">
                                <form class="form" action="{{ route('notas_productos.productos') }}" method="POST">
                                    @csrf
                                    @foreach ($nota->ProductosNotasId as $productos)
                                    <div class="col-6">
                                        <label for="">Nombre</label>
                                        <input type="text" name="productos[{{ $productos->id }}][producto]" class="form-control d-inline-block" value="{{ $productos->producto }}">
                                    </div>

                                    <div class="col-3">
                                        <label for="">Precio</label>
                                        <input type="number" name="productos[{{ $productos->id }}][price]" class="form-control d-inline-block" value="{{ $productos->price }}">
                                    </div>

                                    <div class="col-3">
                                        <label for="">Cantidad</label>
                                        <input type="number" name="productos[{{ $productos->id }}][cantidad]" class="form-control d-inline-block" style="width: 65%;" value="{{ $productos->cantidad }}">
                                    </div>
                                    @endforeach

                                    <div class="col-12 mt-2">
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>

                        <div class="tab-pane fade" id="eliminar-tab-pane" role="tabpanel" aria-labelledby="eliminar-tab" tabindex="0">
                            <div class="row">
                                @foreach ($nota->ProductosNotasId as  $productos)
                                <form class="form" action="{{ route('notas_productos.delete', $productos->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                <div class="col-6">
                                    <label for="">Nombre</label>
                                    <input type="text" name="producto" class="form-control d-inline-block" value="{{ $productos->producto }}">
                                </div>

                                <div class="col-3">
                                    <label for="">Precio</label>
                                    <input type="number" name="price" class="form-control d-inline-block" value="{{ $productos->price }}">

                                </div>

                                <div class="col-3">
                                    <label for="">Cantidad</label>
                                    <input type="number" name="cantidad" class="form-control d-inline-block" style="width: 65%;" value="{{ $productos->cantidad }}">
                                    <button type="submit" class="" style="border-radius: 9px;margin-left: 0.2rem;">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                                </form>
                                @endforeach
                            </div>
                        </div>
                      </div>



                </div>

            </form>
        </div>
    </div>
</div>
