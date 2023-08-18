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
                    <a class="text-center btn btn-lg btn-outline-light " href="{{ route('evaluador') }}">Regresar al inicio</a>
                </div>
            </div>

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
                <button class="btn btn-sm btn-outline-light">Video Terminado</button>
            </p>
        </div>

        <div class="col-6 d-flex align-items-center p-3">
            <p class="text-center tittle_bold_cam">
                <video width="320" height="240" class="video d-block" controls>
                    <source src="https://www.cambyimnas.com/wp-content/uploads/2023/03/1%20DIAGNOSTICO_EI.mp4" type="video/mp4">
                </video>
                <button class="btn btn-sm btn-outline-light">Video Terminado</button>

            </p>
        </div>

        <div class="col-6 d-flex align-items-center p-3">
            <h1 class="text-center tittle_bold_cam">
                DIAGNOSTICO
            </h1>
        </div>


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
                <button class="btn btn-sm btn-outline-light">Video Terminado</button>

            </p>
        </div>

        <div class="col-6 p-3">
            <p class="text-center tittle_bold_cam">
                <video width="320" height="240" class="video d-block" controls>
                    <source src="https://www.cambyimnas.com/wp-content/uploads/2023/03/3%20EVALUACION%20EI.mp4" type="video/mp4">
                </video>
                <button class="btn btn-sm btn-outline-light">Video Terminado</button>

            </p>
        </div>

        <div class="col-6 d-flex align-items-center p-3">
            <h1 class="text-center tittle_bold_cam">
                EVALUACION
            </h1>
        </div>


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
                <button class="btn btn-sm btn-outline-light">Video Terminado</button>

            </p>
        </div>

        <div class="col-6 p-3">
            <p class="text-center tittle_bold_cam">
                <video width="320" height="240" class="video d-block" controls>
                    <source src="https://www.cambyimnas.com/wp-content/uploads/2023/03/5%20VIDEO%20ENTREGA%20DE%20CERTIFICADO%20EI.mp4" type="video/mp4">
                </video>
                <button class="btn btn-sm btn-outline-light">Video Terminado</button>

            </p>
        </div>

        <div class="col-6 d-flex align-items-center p-3">
            <h1 class="text-center tittle_bold_cam">
                ENTREGA DE CERTIFICADOS
            </h1>
        </div>


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
                <button class="btn btn-sm btn-outline-light">Video Terminado</button>

            </p>
        </div>

        <div class="col-6 p-3">
            <p class="text-center tittle_bold_cam">
                <video width="320" height="240" class="video d-block" controls>
                    <source src="https://www.cambyimnas.com/wp-content/uploads/2023/03/7%20FOTOGRAFIA%20EI.mp4" type="video/mp4">
                </video>
                <button class="btn btn-sm btn-outline-light">Video Terminado</button>

            </p>
        </div>

        <div class="col-6 d-flex align-items-center p-3">
            <h1 class="text-center tittle_bold_cam">
                FOTOGRAFIA
            </h1>
        </div>

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
                <button class="btn btn-sm btn-outline-light">Video Terminado</button>

            </p>
        </div>

        <div class="col-6 p-3">
            <p class="text-center tittle_bold_cam">
                <video width="320" height="240" class="video d-block" controls>
                    <source src="https://www.cambyimnas.com/wp-content/uploads/2023/03/9%20CEDULA%20DE%20ACREDITACION%20EI.mp4" type="video/mp4">
                </video>
                <button class="btn btn-sm btn-outline-light">Video Terminado</button>

            </p>
        </div>

        <div class="col-6 d-flex align-items-center p-3">
            <h1 class="text-center tittle_bold_cam">
                CEDULA DE ACREDITACION
            </h1>
        </div>

    </div>

</section>

@endsection


