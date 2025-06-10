@extends('layouts.app_cosmika')

@section('template_title')
    Workshop Reconocimiento
@endsection

@section('css_custom')
<link href="{{asset('assets/user/custom/tabs_ubicacion.css')}}" rel="stylesheet" />
<link href="{{asset('assets/user/custom/nosotros.css')}}" rel="stylesheet" />
{{-- css carrusel --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" />
@endsection

@section('content')

<section class="primario bg_overley" style="position:relative;background-image: url('{{asset('assets/user/utilidades/estrellas.png') }}')">
    <span class="" style="position: absolute;background-size: cover;background-position: center center;top: 0;left: 0;width: 100%;height: 100%;opacity: 0.6;background-color: #2D2034!important"></span>
    <div class="row margin_home_nav ">

        <div class="col-12 col-sm-12 col-md-4 index_superior my-auto">
           <p class="text-center">
            <img class="img_reality" src="{{asset('assets/user/icons/certificate.png') }}">
           </p>
        </div>

        <div class="col-12 col-sm-12 col-md-8 index_superior my-auto">
            <h1 class="text-white titulo space_title_instalaciones space_tiitle_slide mb-5" style="">
                Descarga tu reconocimiento
            </h1>

            <form id="diplomaForm" role="form" action="{{ route('reconocimiento_store.webinar') }}" method="POST">
                @csrf
                <input type="hidden" name="tipo_documento" value="Diploma Cosmica">

                <div class="row">
                    <div class="col-12">
                        <label class="text-white" for="nombre">Nombre completo *</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><img src="{{asset('assets/user/icons/mujer.png')}}" style="width: 40px"></span>
                            <input class="form-control" type="text" id="nombre" name="nombre" required>
                        </div>
                    </div>

                    <div class="col-2">
                        <button type="submit" id="btnDescargar" class="btn btn-success w-100">Descargar</button>
                    </div>
                </div>
            </form>

            {{-- iframe oculto para descargar sin salir --}}
            <iframe id="iframeDescarga" style="display:none;"></iframe>

            {{-- preloader --}}
            <div id="preloader" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; z-index:9999; background:rgba(0,0,0,0.7); text-align:center;">
                <div style="position:relative; top:45%;">
                    <div class="spinner-border text-light" role="status" style="width: 3rem; height: 3rem;">
                        <span class="visually-hidden">Cargando…</span>
                    </div>
                    <h5 class="text-white mt-3">Generando tu diploma, espera un momento…</h5>
                </div>
            </div>


        </div>

    </div>
</section>

@endsection

@section('js')
<script>
document.getElementById('diplomaForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const nombre = document.getElementById('nombre').value.trim();
    if (!nombre) {
        alert('Por favor ingresa un nombre');
        return;
    }

    // Mostrar preloader
    document.getElementById('preloader').style.display = 'block';
    document.getElementById('btnDescargar').disabled = true;

    // Construir la URL con datos del formulario
    const form = e.target;
    const formData = new FormData(form);

    fetch(form.action, {
        method: 'POST',
        body: formData
    })
    .then(response => {
        return response.blob();
    })
    .then(blob => {
        const blobUrl = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = blobUrl;
        a.download = 'diploma_cosmica_' + nombre.replace(/\s+/g, '_') + '.pdf';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);

        // Retraso para que dé tiempo de descargar y luego recargar
        setTimeout(() => {
            document.getElementById('preloader').style.display = 'none';
            window.location.reload();
        }, 5000);
    })
    .catch(err => {
        document.getElementById('preloader').style.display = 'none';
        document.getElementById('btnDescargar').disabled = false;
        alert('Hubo un error al generar el diploma. Intenta nuevamente.');
        console.error(err);
    });
});
</script>
@endsection



