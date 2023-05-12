<!-- Modal -->
<div class="modal fade" id="productos_nota_{{ $nota->id }}" tabindex="-1" role="dialog" aria-labelledby="productos_nota_{{ $nota->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Crear nota</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

                <div class="modal-body">
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

                <div class="modal-footer">
                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
