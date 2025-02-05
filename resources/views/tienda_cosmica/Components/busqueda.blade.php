@extends('layouts.app_tienda_cosmica')

@section('template_title')
    Productos Faciales
@endsection

@section('body_custom')
    bg_productos
@endsection

@section('css_custom')

<link href="{{asset('assets/user/custom/ecommerce_productos.css')}}" rel="stylesheet" />

@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 mt-4 mt-sm-4 mt-md-3 mt-lg-4 mb-sm-2 mb-md-2 mb-lg-1">
            <h1 class="titulo">Productos Faciales</h1>
        </div>

        <div class="col-12 mt-4 mt-sm-4 mt-md-3 mt-lg-5 mb-sm-4 mb-md-3 mb-lg-5">
            <h2 class="subtitle_todas">Busqueda</h2>
            <div class="row">
                @foreach ( $products as $product)
                    @include('tienda_cosmica.Components.item_categorias')
                @endforeach
            </div>
        </div>
    </div>


</div>

@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const hash = window.location.hash; // Obtener el fragmento de la URL
        if (hash) {
            const tabButton = document.querySelector(`[data-bs-target="${hash}"]`);
            if (tabButton) {
                // Activar la pestaña
                const tab = new bootstrap.Tab(tabButton);
                tab.show();
            }
        }
    });
</script>
@endsection


