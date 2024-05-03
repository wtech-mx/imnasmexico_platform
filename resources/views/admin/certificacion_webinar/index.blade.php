@extends('layouts.app_admin')

@section('template_title')
    Certificacion webinar
@endsection

@section('content')

<div class="container-fluid mt-3">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
                <div class="d-flex justify-content-between">

                    <a class="btn" id="regresar_btn" style="background: {{$configuracion->color_boton_close}}; color: #fff"><i class="fas fa-arrow-left"></i> Regresar </a>

                    <h3 class="mb-3">Certificaciones Webinar</h3>

                    <a type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                        ¿Como funciona?
                    </a>

                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-flush" id="datatable-search">
                    <thead class="thead-light">
                        <tr>

                            <th>Datos Contacto</th>

                            <th>
                                Datos Personales
                            </th>

                            <th> Datos Academicos</th>

                            <th> Estatus</th>

                            <th> Acciones</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientes as $cliente)
                            <tr>
                                <td>
                                    <ul>
                                        <li><strong>Nombre : {{$cliente->name}} </strong></li>
                                        <li><strong>Telefono : {{$cliente->telefono}}</strong></li>
                                        <li><strong>Correo : {{$cliente->email}}</strong></li>
                                    </ul>
                                </td>

                                <td>
                                    <ul>
                                        <li><strong>Profesion : {{$cliente->puesto}}</strong></li>
                                        <li><strong>Edad : {{$cliente->edad}}</strong></li>
                                        <li><strong>Ciudad : {{$cliente->city}}</strong></li>
                                    </ul>
                                </td>

                                <td>
                                    <ul>
                                        <li><strong>Especialidad : {{$cliente->especialidad}}</strong></li>
                                        <li><strong>Sector de productividad : {{$cliente->sector_productividad}}</strong></li>
                                        <li><strong>Como impartes Cursos : {{$cliente->manera_cursos}}</strong></li>
                                        <li><strong>Modalidad : {{$cliente->modalidad_cursos}}</strong></li>
                                    </ul>
                                </td>

                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal_estatus{{$cliente->id}}">
                                        {{$cliente->estatus_constancia}}
                                    </button>
                                    <!-- Button trigger modal -->
                                </td>

                                <td></td>

                            </tr>
                            @include('admin.certificacion_webinar.modal_estatus')
                        @endforeach
                    </tbody>

                </table>
            </div>
          </div>
        </div>
      </div>
</div>

@endsection
@section('datatable')

<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      searchable: true,
      fixedHeight: false
    });
</script>

@endsection
