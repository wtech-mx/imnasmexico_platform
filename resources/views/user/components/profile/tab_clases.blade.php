
    <div class="row">
        <div class="col-12">
            <div class="accordion" id="accordionExample">
                @foreach ($usuario_compro as $video)
                    <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{$video->id_tickets}}" aria-expanded="true" aria-controls="collapseOne{{$video->id}}" style="background-color: #836262;">
                            <img class="icon_nav_course" src="{{asset('assets/user/icons/aprender-en-linea.webp')}}" alt=""> {{$video->Cursos->nombre}}
                        </button>
                    </h2>
                    <div id="collapseOne{{$video->id_tickets}}" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">

                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist" style="border: solid 1px transparent;">
                                <button class="nav-link active" id="nav-material-tab" data-bs-toggle="tab" data-bs-target="#nav-material{{$video->id_tickets}}" type="button" role="tab" aria-controls="nav-material" aria-selected="true" style="position: relative">
                                <img class="icon_nav_course" src="{{asset('assets/user/icons/libros.png')}}" alt=""> <strong>Material de clase</strong>
                                <img class="click_docmuentos" src="{{asset('assets/user/icons/clic2.png')}}" alt="" >
                                </button>

                                <button class="nav-link" id="nav-promociones-tab" data-bs-toggle="tab" data-bs-target="#nav-promociones{{$video->id_tickets}}" type="button" role="tab" aria-controls="nav-promociones" aria-selected="false" style="position: relative">
                                    <img class="icon_nav_course" src="{{asset('assets/user/icons/promocion.png')}}" alt=""> <strong>Promociones y descuentos</strong>
                                    <img class="click_docmuentos" src="{{asset('assets/user/icons/clic2.png')}}" alt="" >
                                </button>

                                <button class="nav-link" id="nav-grabadas-tab" data-bs-toggle="tab" data-bs-target="#nav-grabadas{{$video->id_tickets}}" type="button" role="tab" aria-controls="nav-grabadas" aria-selected="false" style="position: relative">
                                    <img class="icon_nav_course" src="{{asset('assets/user/icons/clase.webp')}}" alt=""> <strong>Clases grabadas</strong>
                                    <img class="click_docmuentos" src="{{asset('assets/user/icons/clic2.png')}}" alt="" >
                                </button>
                                </div>
                            </nav>

                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-material{{$video->id_tickets}}" role="tabpanel" aria-labelledby="nav-material-tab" tabindex="0">
                                    <div class="row">
                                    @if ($carpetas != NULL)
                                        @foreach ($carpetas as $carpeta)
                                            @php
                                                $file_info = new SplFileInfo($carpeta->nombre_recurso);
                                                $extension = $file_info->getExtension();
                                            @endphp
                                            @if ($carpeta->id_carpeta == $video->Cursos->carpeta)
                                                @if ($extension === 'pdf')
                                                <div class="col-12 col-md-12 col-lg-6 col-xl-4">
                                                    <p class="text-center">
                                                    <embed class="embed_pdf" src="{{ asset('cursos/' . $carpeta->nombre_carpeta . '/' . $carpeta->nombre_recurso) }}" type="application/pdf"  />
                                                        <a class="text-dark" href="{{ asset('cursos/' . $carpeta->nombre_carpeta . '/' . $carpeta->nombre_recurso) }}" target="_blank" >Ver PDF</a>
                                                    </p>
                                                </div>
                                                @else
                                                <div class="col-12 col-md-12 col-lg-6 col-xl-4 mt-xl-5 mt-lg-3 mt-md-2">
                                                    <p class="text-center">
                                                    <img class="img_material_clase_pc" id="img_material_clase" src="{{asset('cursos/'. $carpeta->nombre_carpeta . '/' . $carpeta->nombre_recurso) }}" />
                                                    </p>
                                                </div>
                                                @endif
                                            @endif
                                        @endforeach
                                    @endif
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="nav-promociones{{$video->id_tickets}}" role="tabpanel" aria-labelledby="nav-promociones-tab" tabindex="0">

                                    <div id="carrousel_publicidad" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                          @foreach ($publicidad as $item)
                                            @php
                                                $file_info = new SplFileInfo($item->nombre);
                                                $extension = $file_info->getExtension();
                                            @endphp
                                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                                @if ($extension == 'jpg')
                                                <p class="text-center">
                                                <img class="img_material_clase_pc" src="{{asset('publicidad/'. $item->nombre) }}" class="d-block" alt="{{ $item->nombre }}">
                                                </p>
                                                @elseif ($extension == 'png')
                                                <p class="text-center">
                                                <img class="img_material_clase_pc" src="{{asset('publicidad/'. $item->nombre) }}" class="d-block" alt="{{ $item->nombre }}">
                                                </p>
                                                @elseif ($extension == 'jpeg')
                                                <p class="text-center">
                                                <img class="img_material_clase_pc" src="{{asset('publicidad/'. $item->nombre) }}" class="d-block" alt="{{ $item->nombre }}">
                                                </p>
                                                @elseif ($extension == 'pdf')
                                                <embed class="embed_pdf_publicidad" src="{{asset('publicidad/'. $item->nombre) }}" type="application/pdf"  />
                                                @elseif ($extension == 'mp4')
                                                <video class="video_publicidad" src="{{asset('publicidad/'. $item->nombre) }}" controls></video>
                                                @endif
                                            </div>
                                          @endforeach
                                        </div>

                                        <button class="carousel-control-prev" type="button" data-bs-target="#carrousel_publicidad" data-bs-slide="prev">
                                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                          <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carrousel_publicidad" data-bs-slide="next">
                                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                          <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>

                                </div>

                                <div class="tab-pane fade" id="nav-grabadas{{$video->id_tickets}}" role="tabpanel" aria-labelledby="nav-grabadas-tab" tabindex="0">
                                    <div class="row">
                                        @foreach($usuario_video as $user_video)
                                            @if ($video->Cursos->id == $user_video->id_curso)
                                                <div class="col-12 col-lg-6">
                                                    <h5 class="titile_clase_grabada mt-3 mb-5">{{$user_video->nombre}}  - <strong>Día 1</strong></h5>
                                                    @php
                                                        $url = $user_video->clase_grabada;
                                                        preg_match('/\/file\/d\/(.+?)\//', $url, $matches);
                                                        $id_link_drive = $matches[1];
                                                    @endphp
                                                    <iframe src="https://drive.google.com/file/d/{{ $id_link_drive }}/preview" class="iframe_clase"></iframe>
                                                    <a class="text-dark" href="{{$user_video->clase_grabada}}" target="_blank" >Ver Video</a>
                                                </div>
                                                @if ( $user_video->clase_grabada2 != NULL)
                                                    <div class="col-12 col-lg-6">
                                                        <h5 class="titile_clase_grabada mt-3 mb-5">{{$user_video->nombre}} - <strong>Día 2</strong></h5>
                                                        @php
                                                            $url2 = $user_video->clase_grabada2;
                                                            preg_match('/\/file\/d\/(.+?)\//', $url2, $matches2);
                                                            $id_link_drive2 = $matches2[1];
                                                        @endphp
                                                        <iframe src="https://drive.google.com/file/d/{{ $id_link_drive2 }}/preview" class="iframe_clase"></iframe>
                                                        <a class="text-dark" href="{{$user_video->clase_grabada2}}" target="_blank" >Ver Video</a>
                                                    </div>
                                                @endif

                                                @if ($user_video->clase_grabada3 != NULL)
                                                    <div class="col-12 col-lg-6">
                                                        <h5 class="titile_clase_grabada mt-3 mb-5">{{$user_video->nombre}} - <strong>Día 3</strong></h5>
                                                        @php
                                                            $url3 = $user_video->clase_grabada3;
                                                            preg_match('/\/file\/d\/(.+?)\//', $url3, $matches3);
                                                            $id_link_drive3 = $matches3[1];
                                                        @endphp
                                                        <iframe src="https://drive.google.com/file/d/{{ $id_link_drive3 }}/preview" class="iframe_clase"></iframe>
                                                        <a class="text-dark" href="{{$user_video->clase_grabada3}}" target="_blank" >Ver Video</a>
                                                    </div>
                                                @endif

                                                @if ($user_video->clase_grabada4 != NULL)
                                                    <div class="col-12 col-lg-6">
                                                        <h5 class="titile_clase_grabada mt-3 mb-5">{{$user_video->nombre}} - <strong>Día 4</strong></h5>
                                                        @php
                                                            $url4 = $user_video->clase_grabada4;
                                                            preg_match('/\/file\/d\/(.+?)\//', $url4, $matches4);
                                                            $id_link_drive4 = $matches4[1];
                                                        @endphp
                                                        <iframe src="https://drive.google.com/file/d/{{ $id_link_drive4 }}/preview" class="iframe_clase"></iframe>
                                                        <a class="text-dark" href="{{$user_video->clase_grabada4}}" target="_blank" >Ver Video</a>
                                                    </div>
                                                @endif

                                                @if ($user_video->clase_grabada5 != NULL)
                                                    <div class="col-12 col-lg-6">
                                                        <h5 class="titile_clase_grabada mt-3 mb-5">{{$user_video->nombre}} - <strong>Día 5</strong></h5>
                                                        @php
                                                            $url5 = $user_video->clase_grabada5;
                                                            preg_match('/\/file\/d\/(.+?)\//', $url5, $matches5);
                                                            $id_link_drive5 = $matches5[1];
                                                        @endphp
                                                        <iframe src="https://drive.google.com/file/d/{{ $id_link_drive5 }}/preview" class="iframe_clase"></iframe>
                                                        <a class="text-dark" href="{{$user_video->clase_grabada5}}" target="_blank" >Ver Video</a>
                                                    </div>
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    </div>
                @endforeach

            </div>

        </div>

    </div>

