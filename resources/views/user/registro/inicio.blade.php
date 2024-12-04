@extends('layouts.app_registro')

@section('template_title')
    Inicio
@endsection

@section('section_pag')

<section id="inicio" class="">

    <div class="row">

        <div class="col-12 col-md-12 col-md-6 col-lg-6">
            <h3 class="text-center titulo_custom"><strong>BIENVENIDO</strong></h3>
            <h5  class="text-center texto_pag"> Registro Nacional de Certificación IMNAS</h5>

            <form id="searchForm" class="" role="search">
                <div class="row">

                    <div class="col-12 text-center">
                        <label class="text-center mt-3 mt-md-3 mt-lg-5" for="" style="    font-size: 30px;">Emisiones</label> <br>
                        <input class="mt-3 input_redoundedos " type="text" placeholder="Ingresa Folio del alumno" name="folio" id="folio">
                        <button class="submit_buttom text-white"  type="submit">verificar</button>
                    </div>

                    {{-- <div class="col-12 text-center mt-3 mt-md-3 mt-lg-5">
                        <label class="text-center" for="">Afiliaciones</label> <br>
                        <input class="mt-3 input_redoundedos " type="text" placeholder="Ingresa nombre de la escuela o institución">
                        <button class="submit_buttom text-white"  type="submit">buscar </button>
                    </div> --}}
                </div>
            </form>
        </div>

        <div class="col-12 col-md-12 col-md-6 col-lg-6 mt-5 mt-md-0 mt-lg-0 ">
            <div class="card card_redoundead">
                <form method="POST" action="{{ route('login_cam.custom') }}">
                    @csrf
                    <div class="row p-3">
                        <div class="col-12">
                            <h3 class="text-center titulo_custom mt-3 mb-3">Accede</h3>
                        </div>

                        <div class="col-12 text-center">
                            <input id="username" name="username" type="text" placeholder="Celular" class="input_redoundedos_login w-100 mb-5 @error('username') is-invalid @enderror" value="{{ old('username') }}" required >

                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <input id="password" type="password" placeholder="*******" class="input_redoundedos_login w-100 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-12 mt-5 mb-4 text-center">
                            <button type="submit" class="submit_buttom text-white">Iniciar sesión</button>
                        </div>

                    </div>

                </form>
            </div>
        </div>

        <div class="col-12">
            <div id="resultsContainer" class="p-0 p-md-2 p-lg-2"></div>
        </div>

    </div>
</section>

@endsection



