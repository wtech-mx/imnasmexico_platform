@extends('layouts.app_cotizador')

@section('template_title')
Cosmica
@endsection

<style>
    .img_header{
        widows: 150px;
    }
</style>

@section('cotizador')

<div class="container-xxl">
    <div class="row mt-5">
        <div class="col-4">
            <img class="img_header" src="{{ asset('cosmika/logo_cosmica_cotizador.png') }}" alt="">
        </div>

        <div class="col-4">
            <img class="img_header" src="{{ asset('cosmika/lista_img.png') }}" alt="">
        </div>

        <div class="col-4">
            <img class="img_header" src="{{ asset('cosmika/duo_amor.png') }}" alt="">
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <p class="d-inline mr-5" style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                Nombre :
            </p>
            <input value="" type="text" class="form-control" style="display: inline-block;width: 50%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;" >
        </div>

        <div class="col-6">
            <p class="d-inline mr-5" style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                WhatasApp :
            </p>
            <input value="" type="number" class="form-control" style="display: inline-block;width: 50%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;" >
        </div>
    </div>

    <div class="row">
        <div class="col-4"></div>
        <div class="col-4"></div>
        <div class="col-4"></div>
    </div>
</div>

@endsection


@section('js_custom')

<script>


</script>

@endsection
