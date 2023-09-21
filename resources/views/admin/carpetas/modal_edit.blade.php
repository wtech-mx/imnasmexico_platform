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

                   <form method="POST" action="{{ route('carpetas.update', $carpeta->id) }}" enctype="multipart/form-data" role="form">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="form-group col-6">
                            <label for="">Nomrbe</label>
                            <input id="nombre" name="nombre" type="text" class="form-control" value="{{$carpeta->nombre}}">
                        </div>

                        <div class="form-group col-6">
                            <label for="">Archivos</label>
                            <input  name="archivos[]" multiple  type="file" class="form-control" >
                        </div>

                        <div class="form-group col-6">
                            <label for="">Area</label>
                                <select name="area" id="area" class="form-select" required>
                                    <option value="">selecciona una opcion</option>
                                    <option value="Material">Material</option>
                                    <option value="Literatura">Literatura</option>
                                    <option value="Carta compromiso">Carta compromiso</option>
                                </select>
                        </div>

                        <div class="form-group col-6">
                            <label for="">Sub Area</label>
                                <select name="sub_area" id="sub_area" class="form-select">
                                    <option value="">selecciona una opcion</option>
                                    <option value="corporal">corporal</option>
                                    <option value="facial">facial</option>
                                </select>
                        </div>

                        <div class="form-group col-12">
                            <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Actualizar</button>
                        </div>
                   </form>

                   <div class="col-12 mt-3 mb-5">
                    <h3 class="text-center">Imagenes y/o documentos subidos</h3>
                   </div>
                        @foreach ($carpeta->CarpetaRecursos as $recurso)
                        <div class="col-6 col-lg-4">
                            @php
                                $file_info = new SplFileInfo($recurso->nombre);
                                $extension = $file_info->getExtension();
                            @endphp

                                @if ($extension === 'pdf')
                                <p class="text-center">
                                    <embed src="{{ asset('cursos/' . $carpeta->nombre . '/' . $recurso->nombre) }}" type="application/pdf" style="width: 120px; height: 120px;" />
                                </p>
                                @else
                                <p class="text-center">
                                    <img id="img_material_clase" src="{{asset('cursos/'. $carpeta->nombre . '/' . $recurso->nombre) }}" style="width: 100px; height: 100px;"/>
                                </p>
                                @endif
                            <p class="text-center">{{ $recurso->nombre }}</p>
                            <p class="text-center"><strong>Area:</strong>{{ $recurso->area }}</p>
                            <p class="text-center"><strong>Subarea:</strong>{{ $recurso->sub_area }}</p>

                            <p class="text-center">

                                <form id="delete-form" action="{{ route('carpetas.destroy', $recurso->id) }}" method="POST" style="">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                </form>
                            </p>
                        </div>
                        @endforeach
                </div>
        </div>
    </div>
</div>
