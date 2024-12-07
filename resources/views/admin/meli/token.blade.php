@extends('layouts.app_user')

@section('template_title')
    Token Meli
@endsection

@section('css_custom')
<link href="{{asset('assets/user/custom/error.css')}}" rel="stylesheet" />
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center minh-100">
        <div class="col-12">
            <div class="container_error" style="background-image: url('{{asset('assets/user/utilidades/pattern.jpg')}}')">

                <p class="text-center">
                    <img src="https://http2.mlstatic.com/frontend-assets/ml-web-navigation/ui-navigation/6.6.92/mercadolibre/logo_large_25years_v2.png" alt="" class="img_errors">
                </p>

                <h2 class="text-center tittle_error mb-4">Token Meli</h2>

                <form method="POST"  action="{{ route('meli.updateToken') }}">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" id="meli-token-code" name="accesstoken" value="{{ old('accesstoken') }}">
                    </div>
                    <p class="text-center mt-4">
                        <button type="submit" class="btn btn-success btn-xs mt-3">Actualizar</button>
                    </p>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Verificar si estamos en la página final de redirección
        const currentUrl = window.location.href;
        const redirectUri = "https://plataforma.imnasmexico.com/mercado_libre_api";
        const paramKey = "code=";

        if (!currentUrl.includes(paramKey)) {
            // Redirigir a la página de autorización de Mercado Libre
            const authUrl = "https://auth.mercadolibre.com.mx/authorization?response_type=code&client_id=4791982421745244&redirect_uri=" + encodeURIComponent(redirectUri);
            window.location.href = authUrl;
        } else {
            // Extraer el valor del parámetro 'code' y ponerlo en el input del formulario
            const code = currentUrl.split(paramKey)[1];
            if (code) {
                document.getElementById("meli-token-code").value = code;
            }
        }
    });
</script>

@endsection
