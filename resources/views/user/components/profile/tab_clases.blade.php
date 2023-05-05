<div class="row">
    <div class="col-12 mb-3">
        <h2 class="title_curso">Mis Clases</h2>
        <h3 class="tittle_clases">Recuerda que las clases grabadas solo duran 72 Horas</h3>
    </div>

    {{-- <div class="row">
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

                                </div>

                                <div class="tab-pane fade" id="nav-promociones{{$video->id_tickets}}" role="tabpanel" aria-labelledby="nav-promociones-tab" tabindex="0">

                                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">

                                        <div class="carousel-item active">
                                            @foreach ($publicidad as $item)
                                            @php
                                                $file_info = new SplFileInfo($item->nombre);
                                                $extension = $file_info->getExtension();
                                            @endphp
                                                @if ($extension != 'pdf')
                                                    <img src="{{asset('publicidad/'. $item->nombre) }}" class="d-block w-100"/>
                                                @endif
                                            @endforeach
                                        </div>

                                        </div>

                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                        </button>

                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>

                                </div>

                                <div class="tab-pane fade" id="nav-grabadas{{$video->id_tickets}}" role="tabpanel" aria-labelledby="nav-grabadas-tab" tabindex="0">

                                </div>
                            </div>

                        </div>
                    </div>
                    </div>
                @endforeach

              </div>

        </div>

    </div> --}}

    @foreach ($usuario_video as $video)
    <div class="col-12 col-lg-6">
        <h5 class="titile_clase_grabada mt-3 mb-5">{{$video->nombre}}  - <strong>Día 1</strong></h5>
        @php
            $url = $video->clase_grabada;
            preg_match('/\/file\/d\/(.+?)\//', $url, $matches);
            $id_link_drive = $matches[1];
        @endphp
        <iframe src="https://drive.google.com/file/d/{{ $id_link_drive }}/preview" class="iframe_clase"></iframe>
    </div>
    @if ( $video->clase_grabada2 != NULL)
    <div class="col-12 col-lg-6">
        <h5 class="titile_clase_grabada mt-3 mb-5">{{$video->nombre}} - <strong>Día 2</strong></h5>
        @php
            $url2 = $video->clase_grabada2;
            preg_match('/\/file\/d\/(.+?)\//', $url2, $matches2);
            $id_link_drive2 = $matches2[1];
        @endphp
        <iframe src="https://drive.google.com/file/d/{{ $id_link_drive2 }}/preview" class="iframe_clase"></iframe>
    </div>
@endif

@if ($video->clase_grabada3 != NULL)
    <div class="col-12 col-lg-6">
        <h5 class="titile_clase_grabada mt-3 mb-5">{{$video->nombre}} - <strong>Día 3</strong></h5>
        @php
            $url3 = $video->clase_grabada3;
            preg_match('/\/file\/d\/(.+?)\//', $url3, $matches3);
            $id_link_drive3 = $matches3[1];
        @endphp
        <iframe src="https://drive.google.com/file/d/{{ $id_link_drive3 }}/preview" class="iframe_clase"></iframe>
    </div>
@endif

@if ($video->clase_grabada4 != NULL)
    <div class="col-12 col-lg-6">
        <h5 class="titile_clase_grabada mt-3 mb-5">{{$video->nombre}} - <strong>Día 4</strong></h5>
        @php
            $url4 = $video->clase_grabada4;
            preg_match('/\/file\/d\/(.+?)\//', $url4, $matches4);
            $id_link_drive4 = $matches4[1];
        @endphp
        <iframe src="https://drive.google.com/file/d/{{ $id_link_drive4 }}/preview" class="iframe_clase"></iframe>
    </div>
@endif


    @if ($video->clase_grabada5 != NULL)
        <div class="col-12 col-lg-6">
            <h5 class="titile_clase_grabada mt-3 mb-5">{{$video->nombre}} - <strong>Día 5</strong></h5>
            @php
                $url5 = $video->clase_grabada5;
                preg_match('/\/file\/d\/(.+?)\//', $url5, $matches5);
                $id_link_drive5 = $matches5[1];
            @endphp
            <iframe src="https://drive.google.com/file/d/{{ $id_link_drive5 }}/preview" class="iframe_clase"></iframe>
        </div>
    @endif
    @endforeach
</div>
