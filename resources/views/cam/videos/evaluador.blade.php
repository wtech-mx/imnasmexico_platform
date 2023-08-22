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
            <h1 class="text-center tittle_border_cam">Aprende los pasos que debes seguir <br> Evaluador Independiente</h3>
                <div class="d-flex justify-content-center">
                    <a class="text-center btn btn-lg btn-outline-light " href="{{ route('evaluador.index', auth()->user()->code) }}">Regresar al inicio</a>
                </div>
            </div>

        @if ($video->check1 == NULL)
            <div class="col-6 d-flex align-items-center p-3">
                <h1 class="text-center tittle_bold_cam">
                    CAPACITACION ESTANDAR EC0076
                </h1>

            </div>

            <div class="col-6 p-3">
                <p class="text-center tittle_bold_cam">
                    <video width="320" height="240" class="video d-block" controls>
                        <source src="https://www.cambyimnas.com/wp-content/uploads/2023/03/CAPACITACION%20ESTANDAR%20EC0076.mp4" type="video/mp4">
                    </video>
                    <form method="POST" action="{{ route('evaluador.update_videos', $video->id) }}" enctype="multipart/form-data" role="form">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="text" name="check1" id="check1" value="1" style="display: none">
                        <button type="submit" class="btn btn-sm btn-outline-light">Siguiente video</button>
                    </form>
                </p>
            </div>
        @endif

        @if ($video->check1 != NULL && $video->check2 == NULL)
            <div class="col-6 d-flex align-items-center p-3">
                <p class="text-center tittle_bold_cam">
                    <video width="320" height="240" class="video d-block" controls>
                        <source src="https://www.cambyimnas.com/wp-content/uploads/2023/03/1%20DIAGNOSTICO_EI.mp4" type="video/mp4">
                    </video>
                    <form method="POST" action="{{ route('evaluador.update_videos', $video->id) }}" enctype="multipart/form-data" role="form">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="text" name="check2" id="check2" value="1" style="display: none">
                        <button type="submit" class="btn btn-sm btn-outline-light">Siguiente video</button>
                    </form>

                </p>
            </div>

            <div class="col-6 d-flex align-items-center p-3">
                <h1 class="text-center tittle_bold_cam">
                    DIAGNOSTICO
                </h1>
            </div>
        @endif

        @if ($video->check2 != NULL && $video->check3 == NULL)
            <div class="col-6 d-flex align-items-center p-3">
                <h1 class="text-center tittle_bold_cam">
                    PLAN DE EVALUACION
                </h1>
            </div>

            <div class="col-6 p-3">
                <p class="text-center tittle_bold_cam">
                    <video width="320" height="240" class="video d-block" controls>
                        <source src="https://www.cambyimnas.com/wp-content/uploads/2023/03/2%20PLAN%20DE%20EVALUACION%20EI.mp4" type="video/mp4">
                    </video>
                    <form method="POST" action="{{ route('evaluador.update_videos', $video->id) }}" enctype="multipart/form-data" role="form">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="text" name="check3" id="check3" value="1" style="display: none">
                        <button type="submit" class="btn btn-sm btn-outline-light">Siguiente video</button>
                    </form>

                </p>
            </div>
        @endif

        @if ($video->check3 != NULL && $video->check4 == NULL)
            <div class="col-6 p-3">
                <p class="text-center tittle_bold_cam">
                    <video width="320" height="240" class="video d-block" controls>
                        <source src="https://www.cambyimnas.com/wp-content/uploads/2023/03/3%20EVALUACION%20EI.mp4" type="video/mp4">
                    </video>
                    <form method="POST" action="{{ route('evaluador.update_videos', $video->id) }}" enctype="multipart/form-data" role="form">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="text" name="check4" id="check4" value="1" style="display: none">
                        <button type="submit" class="btn btn-sm btn-outline-light">Siguiente video</button>
                    </form>

                </p>
            </div>

            <div class="col-6 d-flex align-items-center p-3">
                <h1 class="text-center tittle_bold_cam">
                    EVALUACION
                </h1>
            </div>
        @endif

        @if ($video->check4 != NULL && $video->check5 == NULL)
            <div class="col-6 d-flex align-items-center p-3">
                <h1 class="text-center tittle_bold_cam">
                    CEDULA DE EVALUACION
                </h1>
            </div>

            <div class="col-6 p-3">
                <p class="text-center tittle_bold_cam">
                    <video width="320" height="240" class="video d-block" controls>
                        <source src="https://www.cambyimnas.com/wp-content/uploads/2023/03/4%20CEDULA%20DE%20EVALUACION%20EI%20.mp4" type="video/mp4">
                    </video>
                    <form method="POST" action="{{ route('evaluador.update_videos', $video->id) }}" enctype="multipart/form-data" role="form">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="text" name="check5" id="check5" value="1" style="display: none">
                        <button type="submit" class="btn btn-sm btn-outline-light">Siguiente video</button>
                    </form>

                </p>
            </div>
        @endif

        @if ($video->check5 != NULL && $video->check6 == NULL)
            <div class="col-6 p-3">
                <p class="text-center tittle_bold_cam">
                    <video width="320" height="240" class="video d-block" controls>
                        <source src="https://www.cambyimnas.com/wp-content/uploads/2023/03/5%20VIDEO%20ENTREGA%20DE%20CERTIFICADO%20EI.mp4" type="video/mp4">
                    </video>
                    <form method="POST" action="{{ route('evaluador.update_videos', $video->id) }}" enctype="multipart/form-data" role="form">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="text" name="check6" id="check6" value="1" style="display: none">
                        <button type="submit" class="btn btn-sm btn-outline-light">Siguiente video</button>
                    </form>

                </p>
            </div>

            <div class="col-6 d-flex align-items-center p-3">
                <h1 class="text-center tittle_bold_cam">
                    ENTREGA DE CERTIFICADOS
                </h1>
            </div>
        @endif

        @if ($video->check6 != NULL && $video->check7 == NULL)
            <div class="col-6 d-flex align-items-center p-3">
                <h1 class="text-center tittle_bold_cam">
                    MODULO DE EVALUACION Y LOTES
                </h1>
            </div>

            <div class="col-6 p-3">
                <p class="text-center tittle_bold_cam">
                    <video width="320" height="240" class="video d-block" controls>
                        <source src="https://www.cambyimnas.com/wp-content/uploads/2023/03/6%20MODULO%20DE%20EVALUACION%20Y%20LOTES%20EI.mp4" type="video/mp4">
                    </video>
                    <form method="POST" action="{{ route('evaluador.update_videos', $video->id) }}" enctype="multipart/form-data" role="form">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="text" name="check7" id="check7" value="1" style="display: none">
                        <button type="submit" class="btn btn-sm btn-outline-light">Siguiente video</button>
                    </form>

                </p>
            </div>
        @endif

        @if ($video->check7 != NULL && $video->check8 == NULL)
            <div class="col-6 p-3">
                <p class="text-center tittle_bold_cam">
                    <video width="320" height="240" class="video d-block" controls>
                        <source src="https://www.cambyimnas.com/wp-content/uploads/2023/03/7%20FOTOGRAFIA%20EI.mp4" type="video/mp4">
                    </video>
                    <form method="POST" action="{{ route('evaluador.update_videos', $video->id) }}" enctype="multipart/form-data" role="form">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="text" name="check8" id="check8" value="1" style="display: none">
                        <button type="submit" class="btn btn-sm btn-outline-light">Siguiente video</button>
                    </form>

                </p>
            </div>

            <div class="col-6 d-flex align-items-center p-3">
                <h1 class="text-center tittle_bold_cam">
                    FOTOGRAFIA
                </h1>
            </div>
        @endif

        @if ($video->check8 != NULL && $video->check9 == NULL)
            <div class="col-6 d-flex align-items-center p-3">
                <h1 class="text-center tittle_bold_cam">
                    LOGOTIPO
                </h1>
            </div>

            <div class="col-6 p-3">
                <p class="text-center tittle_bold_cam">
                    <video width="320" height="240" class="video d-block" controls>
                        <source src="https://www.cambyimnas.com/wp-content/uploads/2023/03/8%20LOGOTIPO%20EVALUADOR%20INDEPENDIENTE_EI.mp4" type="video/mp4">
                    </video>
                    <form method="POST" action="{{ route('evaluador.update_videos', $video->id) }}" enctype="multipart/form-data" role="form">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="text" name="check9" id="check9" value="1" style="display: none">
                        <button type="submit" class="btn btn-sm btn-outline-light">Siguiente video</button>
                    </form>

                </p>
            </div>
        @endif

        @if ($video->check9 != NULL && $video->check10 == NULL)
            <div class="col-6 p-3">
                <p class="text-center tittle_bold_cam">
                    <video width="320" height="240" class="video d-block" controls>
                        <source src="https://www.cambyimnas.com/wp-content/uploads/2023/03/9%20CEDULA%20DE%20ACREDITACION%20EI.mp4" type="video/mp4">
                    </video>
                    <form method="POST" action="{{ route('evaluador.update_videos', $video->id) }}" enctype="multipart/form-data" role="form">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="text" name="check10" id="check10" value="1" style="display: none">
                        <button type="submit" class="btn btn-sm btn-outline-light">Siguiente video</button>
                    </form>

                </p>
            </div>

            <div class="col-6 d-flex align-items-center p-3">
                <h1 class="text-center tittle_bold_cam">
                    CEDULA DE ACREDITACION
                </h1>
            </div>
        @endif

        @if ($video->check10 != NULL)
            <div class="col-6 p-3">
                <p class="text-center tittle_bold_cam">
                    ¡Felicidades! has concluido con la fase de los tutoriales. <br> Un paso menos para convertirte en Evaluador Independiente. <br> Prosigue con la siguiente fase.
                    <button class="btn btn-sm btn-outline-light">Subir documentos</button>
                </p>
            </div>
        @endif
    </div>

</section>

@endsection


