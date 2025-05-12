@extends('layouts.app_cotizador')

@section('template_title')
Cosmica
@endsection

<style>
    .img_header{
        widows: 150px;
    }

    .h3_subtitulos{
        font-size: 10px;
        color: #BB2E32;
    }
        /* color de fondo de toda la tabla */
    .table-custom {
        width: 100%;
        background: #F9F4F4;
        border-collapse: separate;
        border-spacing: 0;
    }

    /* bordes rojos y redondeados en cada celda */
    .table-custom th,
    .table-custom td {
        border: 1px solid #C2393B;
        border-radius: 9px;
        vertical-align: middle;
    }

    /* fila de sublínea: sin bordes laterales y con un poco de espacio */
    .sublinea-row td {
        background: transparent;
        border: none;
        font-weight: bold;
        padding-top: 1rem;
        padding-bottom: .5rem;
    }

    /* opcional: resaltar el thead */
    .table-custom thead th {
        background: #F9F4F4;
    }

    .table>:not(caption)>*>* {
        padding: .5rem .5rem;
        color: var(--bs-table-color-state, var(--bs-table-color-type, var(--bs-table-color)));
        background-color: #F9F4F4!important;
        border-bottom-width: var(--bs-border-width);
        box-shadow: inset 0 0 0 9999px var(--bs-table-bg-state, var(--bs-table-bg-type, var(--bs-table-accent-bg)));
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

{{-- Una sola tabla para todos los grupos --}}
    <table class="table table-custom mt-4">
        <thead class="">
            <tr>
                <th>Línea</th>
                <th>Producto</th>
                <th>Descripción</th>
                <th>Cantidad deseada</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productosPorSublinea as $sublinea => $lista)
                {{-- fila de título de sublínea --}}
                <tr class="sublinea-row">
                    <td colspan="4">{{ $sublinea ?: 'Sin sublínea' }}</td>
                </tr>
                @foreach($lista as $producto)
                <tr>
                    <td>{{ $producto->linea }}</td>
                    <td><img src="{{ $producto->imagenes }}" alt="" style="width: 45px"> {{ $producto->nombre }}</td>
                    <td>{{ Str::limit($producto->descripcion, 50) }}</td>
                    <td>
                        <input
                            type="number"
                            name="cantidad[{{ $producto->id }}]"
                            class="form-control"
                            min="0"
                            value="0"
                        >
                    </td>
                </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>

</div>

@endsection


@section('js_custom')

<script>


</script>

@endsection
