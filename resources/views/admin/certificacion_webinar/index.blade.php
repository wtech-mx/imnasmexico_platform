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
                                        <li><strong>Nombre : </strong>{{$cliente->name}} </li>
                                        <li><strong>Telefono : </strong>{{$cliente->telefono}}</li>
                                        <li><strong>Correo : </strong>{{$cliente->email}}</li>
                                    </ul>
                                </td>

                                <td>
                                    <ul>
                                        <li><strong>Profesion : </strong>{{$cliente->puesto}}</li>
                                        <li><strong>Edad : </strong>{{$cliente->edad}}</li>
                                        <li><strong>Ciudad : </strong>{{$cliente->city}}</li>
                                    </ul>
                                </td>

                                <td>
                                    <ul>
                                        <li><strong>Especialidad : </strong>{{$cliente->especialidad}}</li>
                                        <li><strong>Sector de productividad : </strong>{{$cliente->sector_productividad}}</li>
                                        <li><strong>Como impartes Cursos : </strong>{{$cliente->manera_cursos}}</li>
                                        <li><strong>Modalidad : </strong>{{$cliente->modalidad_cursos}}</li>
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
