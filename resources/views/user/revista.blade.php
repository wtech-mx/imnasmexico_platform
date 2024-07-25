@extends('layouts.app_cosmika')

@section('template_title')
   Revista
@endsection

@section('css_custom')

    <style type="text/css">
      .container {
        height: 93vh;
        width: 100%;
      }
    </style>

    <link href="{{asset('assets/user/custom/nosotros.css')}}" rel="stylesheet" />
@endsection

@section('content')

<section class="primario bg_overley" style="">
    @if(session('show_iframe') || $show_iframe)
        <div class="d-flex justify-content-center">
            <iframe src="https://cosmicaskin.com/protocolo/" frameborder="0" class="container" style="margin-top: 6rem"></iframe>
        </div>
    @else
        <div class="container" id="container1" style="margin-top: 6rem">
            <div class="d-flex justify-content-center">
                <form action="{{ route('distribuidoras.validate_protocolo', $distribuidora->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <p class="text-center text-white mt-4">
                            <strong>Ingrese su clave de acceso</strong>
                        </p>
                        <input type="text" class="form-control" id="claves_protocolo" name="claves_protocolo" placeholder="*******" required>
                        @error('claves_protocolo')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <p class="text-center mt-4">
                        <button type="submit" class="btn btn-primary" style="background-color: #2D2034 ;border-radius:9px;border:solid 3px #fff;">Ingresar</button>
                    </p>
                </form>
            </div>
        </div>
    @endif
</section>

@endsection
