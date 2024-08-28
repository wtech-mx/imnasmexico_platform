<!-- Modal -->
<div class="modal fade" id="registro_imnas_temario_{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="registro_imnas_temario_{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4>{{ $item->especialidad }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

                <div class="modal-body">
                    <div class="row">
                        @foreach ($temario as $materias)
                            @if ($item->id == $materias->id_materia)
                                <div class="col-12 form-group">
                                    <label for="name">Materia</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/user/icons/book.png') }}" alt="" width="35px" style="margin-right: 1rem">
                                        </span>
                                        <input id="name" name="name" type="text" class="form-control" value=" {{ $materias->subtema }}" disabled>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

        </div>
    </div>
</div>
