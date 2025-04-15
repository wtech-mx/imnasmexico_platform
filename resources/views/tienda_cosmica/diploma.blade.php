@extends('layouts.app_tienda_cosmica')

@section('template_title')
    Genera tu Diploma
@endsection

@section('body_custom')
    bg_single_product
@endsection


@section('css_custom')
    <link href="{{asset('assets/user/custom/ecommerce_single.css')}}" rel="stylesheet" />
@endsection

@section('content')

<div class="container ">

    <div class="row">
        <div class="col-3"></div>
        <div class="col-6 p-3 p-sm-2 p-md-3 p-lg-3">
            <div class="mt-5 mb-5">
                <h2 class="text-center">Generar Diploma</h2>
                <form action="{{ route('diploma_tratamientos.generar') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Ingresa su Nombre Completo:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Escribe tu nombre completo" required>
                    </div>
                    <button type="submit" class="btn btn-sm btn-success">Generar Diploma</button>
                </form>
            </div>
        </div>
        <div class="col-3"></div>

    </div>

</div>


@endsection

@section('js')

@endsection


