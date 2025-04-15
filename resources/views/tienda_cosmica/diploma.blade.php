@extends('layouts.app_tienda_cosmica')

@section('template_title')
    Genera tu Diploma
@endsection

@section('body_custom')
    bg_single_product
@endsection

@section('css_custom')
    <link href="{{asset('assets/user/custom/ecommerce_single.css')}}" rel="stylesheet" />
    <style>
        .custom-container {
            height: 70vh; /* Ocupa toda la altura de la ventana */
            display: flex; /* Activa Flexbox */
            justify-content: center; /* Centra horizontalmente */
            align-items: center; /* Centra verticalmente */
            margin: 0 auto; /* Centra el contenedor horizontalmente */
        }
    </style>
@endsection

@section('content')

<div class="container custom-container">

    <div class="row justify-content-center">
        <div class="col-12 p-4">
            <div class="mt-5 mb-5">
                <h2 class="text-center mb-5">Generar Diploma</h2>
                <form action="{{ route('diploma_tratamientos.generar') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nombre" class="form-label" style="font-size: 26px">Ingrese su Nombre Completo:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Escribe tu nombre completo" required>
                    </div>
                    <div class="text-center mt-5">
                        <button type="submit" class="btn btn-sm btn-success" style="background: #2D2432">Generar Diploma</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

@endsection

@section('js')

@endsection


