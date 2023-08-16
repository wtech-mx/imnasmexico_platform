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

        <div class="col-12 mb-5">
            <h1 class="text-center tittle_border_cam">Aprende los pasos que debes seguir <br> Evaluador Independiente</h3>
        </div>

        <div class="col-6">
            <h1 class="text-center tittle_bold_cam">
                CAPACITACION ESTANDAR EC0076
            </h3>
        </div>

        <div class="col-6">
            <video width="320" height="240" class="video" controls>
                <source src="https://www.cambyimnas.com/wp-content/uploads/2023/03/CAPACITACION%20ESTANDAR%20EC0076.mp4" type="video/mp4">
            </video>
        </div>

    </div>

</section>

@endsection


