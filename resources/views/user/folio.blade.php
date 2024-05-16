@extends('layouts.app_user')

@section('template_title')
    Nuestras Instalaciones
@endsection

@section('css_custom')
<link href="{{asset('assets/user/custom/instalaciones.css')}}" rel="stylesheet" />
<link href="{{asset('assets/user/custom/tabs_ubicacion.css')}}" rel="stylesheet" />
@endsection

@section('content')

<section class="primario bg_overley" style="background-color:#F5ECE4;">
    <div class="row">
        <div class="col-12 tittle_section2 espace_tittle_avales mb-3" style="margin-top:11rem;">
            <h2 class="titulo_alfa text-center">FOLIO</h2>
        </div>
    </div>
</section>

{{-- section unam --}}
<section class="primario bg_overley padding_avales_cont" style="background-color:#fff;">
    <div class="row">

        <div class="col-4"></div>

        <div class="col-4">

            <h3 class="text-center mt-4 mb-4">
                Ingresa el Folio de tus documentos
            </h3>

            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Ingresa Folio" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Buscar</button>
            </form>

        </div>

        <div class="col-4">

        </div>

        <div class="col-12">

            <h5 class="text-left mt-5 mb-3"><strong>Resultado de Busqueda del Folio : </strong></h5>

            <table class="table mt-3">
                <thead>
                  <tr>
                    <th scope="col">Folio</th>
                    <th scope="col">Nombre Completo</th>
                    <th scope="col">Curso ,Diplomado y/o Carrera</th>
                    <th scope="col">Modalidad</th>
                    <th scope="col">Fechas</th>
                    <th scope="col">Descargar</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>Otto</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                  </tr>
                  <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>Otto</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                  </tr>
                  <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>Otto</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                  </tr>
                </tbody>
              </table>

        </div>

    </div>
</section>


@endsection

@section('js')


@endsection


