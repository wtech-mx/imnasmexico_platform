<!-- Modal -->
<div class="modal fade" id="manual_instrucciones" tabindex="-1" role="dialog" aria-labelledby="manual_instrucciones" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="manual_instrucciones">
                    @if ($manuales)
                    {{ $manuales->nombre }}
                    @else
                    @endif
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body row">
                @if ($manuales)
                <div class="col-12">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

                        <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-generales-tab" data-bs-toggle="pill" data-bs-target="#pills-generales" type="button" role="tab" aria-controls="pills-generales" aria-selected="true">Generales</button>
                        </li>

                       @if($manuales->step1_name != null)
                       <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-pasos-tab" data-bs-toggle="pill" data-bs-target="#pills-pasos" type="button" role="tab" aria-controls="pills-pasos" aria-selected="false">Pasos</button>
                        </li>
                       @endif

                        <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-video-tab" data-bs-toggle="pill" data-bs-target="#pills-video" type="button" role="tab" aria-controls="pills-video" aria-selected="false">video</button>
                        </li>

                    </ul>
                </div>

                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-generales" role="tabpanel" aria-labelledby="pills-generales-tab" tabindex="0">

                        <div class="row">
                            <div class="col-12">
                                <p>{{ $manuales->descripcion }}</p>
                                <img id="blah" src="{{ asset('manual/'.$manuales->imagen_portada) }}" alt="Imagen" style="width:100%;">
                            </div>
                        </div>

                    </div>

                    <div class="tab-pane fade" id="pills-pasos" role="tabpanel" aria-labelledby="pills-pasos-tab" tabindex="0">
                        <div class="row">
                            @if($manuales->step1_name != null)
                                <div class="col-12">
                                    <h5>{{ $manuales->step1_name }}</h5>
                                    <img id="blah" src="{{ asset('manual/'.$manuales->foto1) }}" alt="Imagen" style="width:100%;">
                                </div>
                            @endif

                            @if($manuales->step2_name != null)
                                <div class="col-12">
                                    <h5>{{ $manuales->step2_name }}</h5>
                                    <img id="blah" src="{{ asset('manual/'.$manuales->foto2) }}" alt="Imagen" style="width:100%;">
                                </div>
                            @endif
                            @if($manuales->step3_name != null)
                                <div class="col-12">
                                    <h5>{{ $manuales->step3_name }}</h5>
                                    <img id="blah" src="{{ asset('manual/'.$manuales->foto3) }}" alt="Imagen" style="width:100%;">
                                </div>
                            @endif

                            @if($manuales->step4_name != null)
                                <div class="col-12">
                                    <h5>{{ $manuales->step4_name }}</h5>
                                    <img id="blah" src="{{ asset('manual/'.$manuales->foto4) }}" alt="Imagen" style="width:100%;">
                                </div>
                            @endif
                            @if($manuales->step5_name != null)
                                <div class="col-12">
                                    <h5>{{ $manuales->step5_name }}</h5>
                                    <img id="blah" src="{{ asset('manual/'.$manuales->foto5) }}" alt="Imagen" style="width:100%;">
                                </div>
                            @endif

                            @if($manuales->step6_name != null)
                                <div class="col-12">
                                    <h5>{{ $manuales->step6_name }}</h5>
                                    <img id="blah" src="{{ asset('manual/'.$manuales->foto6) }}" alt="Imagen" style="width:100%;">
                                </div>
                            @endif

                            @if($manuales->step7_name != null)
                                <div class="col-12">
                                    <h5>{{ $manuales->step7_name }}</h5>
                                    <img id="blah" src="{{ asset('manual/'.$manuales->foto7) }}" alt="Imagen" style="width:100%;">
                                </div>
                            @endif

                            @if($manuales->step8_name != null)
                                <div class="col-12">
                                    <h5>{{ $manuales->step8_name }}</h5>
                                    <img id="blah" src="{{ asset('manual/'.$manuales->foto8) }}" alt="Imagen" style="width:100%;">
                                </div>
                            @endif

                            @if($manuales->step9_name != null)
                                <div class="col-12">
                                    <h5>{{ $manuales->step9_name }}</h5>
                                    <img id="blah" src="{{ asset('manual/'.$manuales->foto9) }}" alt="Imagen" style="width:100%;">
                                </div>
                            @endif

                            @if($manuales->step10_name != null)
                                <div class="col-12">
                                    <h5>{{ $manuales->step10_name }}</h5>
                                    <img id="blah" src="{{ asset('manual/'.$manuales->foto10) }}" alt="Imagen" style="width:100%;">
                                </div>
                            @endif
                        </div>
                    </div>


                    <div class="tab-pane fade" id="pills-video" role="tabpanel" aria-labelledby="pills-video-tab" tabindex="0">
                        <video  controls style="width: 100%">
                            <source src="{{ asset('manual/'.$manuales->video) }}" type="video/mp4">
                        </video>
                    </div>

                </div>


                @else
                    <p>No se encontró manual para esta página.</p>
                @endif

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
