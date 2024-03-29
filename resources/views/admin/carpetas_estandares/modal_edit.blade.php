<!-- Modal -->
<div class="modal fade" id="update_carpeta_{{ $carpeta->id }}" tabindex="-1" role="dialog" aria-labelledby="update_carpeta_{{ $carpeta->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="update_carpeta_{{ $carpeta->id }}">Carpeta {{ $carpeta->nombre }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

                <div class="modal-body row">

                   <form method="POST" action="{{ route('carpetas_estandares.update', $carpeta->id) }}" enctype="multipart/form-data" role="form">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="form-group col-6">
                            <label for="">Nombre</label>
                            <input id="nombre" name="nombre" type="text" class="form-control" value="{{$carpeta->nombre}}">
                        </div>

                        <div class="form-group col-6">
                            <label for="">Archivos</label>
                            <input  name="archivos[]" multiple  type="file" class="form-control" >
                        </div>

                        <div class="form-group col-12">
                            <label for="name">Guia: </label>
                            <select name="guia" id="guia" class="form-select">
                                <option value="">Seleciona una opcion</option>
                                <option value="">Sin Guia</option>
                                <option value="1">Con Guia</option>
                            </select>
                        </div>

                        <div class="form-group col-12">
                            <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Actualizar</button>
                        </div>
                   </form>

                   <div class="col-12 mt-3 mb-5">
                    <h3 class="text-center">Imagenes y/o documentos subidos</h3>
                   </div>
                        @foreach ($carpeta->CarpetaDocumentosEstandares as $recurso)
                        <div class="col-6 col-lg-4">
                            @php
                                $file_info = new SplFileInfo($recurso->nombre);
                                $extension = $file_info->getExtension();
                            @endphp

                                @if ($extension === 'pdf')
                                <p class="text-center">
                                    <embed src="{{ asset('carpetasestandares/' . $carpeta->nombre . '/' . $recurso->nombre) }}" type="application/pdf" style="width: 120px; height: 120px;" />
                                </p>
                                @else
                                <p class="text-center">
                                    <img id="img_material_clase" src="{{asset('carpetasestandares/'. $carpeta->nombre . '/' . $recurso->nombre) }}" style="width: 100px; height: 100px;"/>
                                </p>
                                @endif

                            <p class="text-center">{{ $recurso->nombre }}</p>

                            @if($recurso->guia == '1')
                                <strong><p class="text-center">Guia</p></strong>
                            @endif

                            <p class="text-center">
                                <a class="btn btn-sm btn-danger" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $recurso->id }}').submit();">
                                    <i class="fa fa-trash-o"></i>
                                </a>
                                <form id="delete-form-{{ $recurso->id }}" action="{{ route('carpetas_estandares.destroy', $recurso->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </p>
                        </div>
                        @endforeach
                </div>
        </div>
    </div>
</div>
