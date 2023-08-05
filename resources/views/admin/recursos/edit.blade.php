<!-- Modal -->
<div class="modal fade" id="edit_recurso{{ $recurso->id }}" tabindex="-1" role="dialog" aria-labelledby="edit_recurso{{ $recurso->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >{{$recurso->nombre}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <form method="POST" action="{{ route('recursos.update', $recurso->id) }}" enctype="multipart/form-data" role="form">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <div class="modal-body row">
                    <div class="col-12">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-7">
                                    <label for="">Nombre</label>
                                    <div class="form-group">
                                        <input type="text" name="nombre" value="{{$recurso->nombre}}" class="form-control nombre">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label for="">Tipo</label>
                                    <select class="form-control" id="tipo" name="tipo" required>
                                        <option value="{{$recurso->tipo}}">{{$recurso->tipo}}</option>
                                        <option value="Online">Online</option>
                                        <option value="Presencial">Presencial</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="">Foto curso</label><br>
                                    <img id="blah" src="{{asset('curso/'.$recurso->foto) }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                                    <input type="file" id="foto" name="foto" value="{{$recurso->foto}}" class="form-control">
                                </div>
                                <div class="col-12">
                                    <label for="">Material de clase</label><br>
                                    <img id="blah" src="{{asset('materiales/'.$recurso->material) }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                                    <input type="file" id="material" name="material" value="{{$recurso->material}}" class="form-control">
                                </div>
                                <div class="col-12">
                                    <label for="">PDF</label><br>
                                    <iframe src="{{ asset('pdf/'.$recurso->pdf) }}" width="70%" height="150" class="img-fluid img-thumbnail" data-bs-dismiss="modal" aria-label="Seleccionar" onclick="selectPdf('{{ $recurso->pdf }}')">
                                    </iframe>
                                    <input type="file" id="pdf" name="pdf" value="{{$recurso->pdf}}" class="form-control">
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
