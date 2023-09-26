@extends('layouts.app_cam')

@section('template_title')
    Centro evaluador
@endsection

@section('css_custom')
    <link href="{{asset('assets/cam/estilos/custom.css')}}" rel="stylesheet" />
@endsection

@section('content')

<section class="cam_bg_videos" style="background-color: #6EC1E4; ">

    <div class="row">

        <div class="col-12 mb-5 mt-5">
            <h1 class="text-center tittle_border_cam">Aprende los pasos que debes seguir <br>
                @if($usuario->cliente == '4')
                    Centro Evaluador
                @else
                    Evaluador independiente
                @endif
            </h3>
                <div class="d-flex justify-content-center">
                    <a class="text-center btn btn-lg btn-outline-light " href="{{ route('cam.index', $usuario->code) }}">Regresar al inicio</a>
                </div>
        </div>

        @foreach ($camvideos as $item)

        <div class="col-12 col-md-6  d-flex align-items-center p-3">
            <h1 class="text-center tittle_bold_cam">
                {{ $item->nombre }}
            </h1>
        </div>

        <div class="col-12 col-md-6  p-3">
            <p class="text-center tittle_bold_cam">

                @if ($item->orden == 1 || ($video->{"check" . ($item->orden - 1)} !== null && $video->{"check" . ($item->orden - 1)} !== ""))

                <video width="320" height="240" class="video d-block" controls>
                    <source src="{{ $item->video_url }}" type="video/mp4">
                </video>

                <form method="POST" action="{{ route('evaluador.update_videos', $video->id) }}" enctype="multipart/form-data" role="form">
                    @csrf
                    <input type="hidden" name="_method" value="PATCH">
                    <input type="text" name="check{{ $item->orden }}" id="check{{ $item->orden }}" value="1" style="display: none">
                    <button type="submit" class="btn btn-sm btn-outline-light">Siguiente video</button>
                </form>

                @else
                <h5>Aun no has visto el video anterior</h5>
                @endif

            </p>
        </div>

    @endforeach

    </div>

</section>

@endsection


