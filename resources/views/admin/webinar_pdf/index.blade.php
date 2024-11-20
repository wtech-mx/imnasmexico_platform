@extends('layouts.app_user')

@section('template_title')
workshop
@endsection


@section('content')
    <section class="primario bg_overley " style="background-color:#F5ECE4;">
        <form role="form" action="{{ route('reconocimiento_store.webinar') }}" method="post" enctype="multipart/form-data" style="margin-top: 20% !important;">
            @csrf

            <div class="row">
                <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                    <h3 class="text-center titulomin_alfa mb-3">Descarga tu reconocimiento</h3>

                        <div class="mb-3 col-12">
                            <label for="basic-url" class="form-label">Nombre completo *</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon3"><img src="{{asset('assets/user/icons/aprender-en-linea.webp')}}" style="width: 40px">
                                </span>
                                <input class="form-control" type="text" id="nombre" name="nombre" required>
                            </div>

                            <button type="submit mt-5" class="btn btn-success w-100">Descargar</button>
                        </div>
                </div>
            </div>

        </form>
    </section>
@endsection

@section('js')

@endsection

