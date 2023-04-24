@extends('layouts.app_admin')

@section('template_title')
    Revoes
@endsection

@section('content')

<div class="container-fluid mt-3">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->


            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="mb-3">RVOES</h3>

                    @can('usuarios-create')
                    <a class="btn" href="" style="background: {{$configuracion->color_boton_add}}; color: #ffff">Crear Revoe</a>
                    @endcan

                </div>
            </div>

            @can('usuarios-create')
            <div class="table-responsive">
                <table class="table table-flush" id="datatable-search">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Num de Revoe</th>
                            <th width="280px">Acciones</th>
                        </tr>
                    </thead>


                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <a class="btn btn-sm btn-success" href="{"><i class="fa fa-fw fa-edit"></i> </a>
                            </td>
                        </tr>


                </table>
                </div>
            @endcan

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
