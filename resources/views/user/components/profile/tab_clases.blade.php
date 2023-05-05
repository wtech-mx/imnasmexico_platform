<div class="row">
    <div class="col-12">
        <h2 class="title_curso">Mis Clases</h2>
        <h3 class="tittle_clases">Recuerda que las clases grabadas solo duran 72 Horas</h3>
    </div>

    @foreach ($usuario_compro as $video)
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
