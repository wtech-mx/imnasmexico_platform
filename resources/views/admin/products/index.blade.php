@extends('layouts.app_admin')

@section('template_title')
    Products
@endsection

@section('content')

<div class="container-fluid mt-3">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="mb-3">Products</h3>
                   <!-- <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" class="form-control">
                        <br>
                        <button class="btn btn-success">Importar Products</button>
                    </form>-->
                    <a type="button" class="btn btn-sm bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#create_product" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                        <i class="fa fa-fw fa-edit"></i> Crear
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-flush" id="datatable-search">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Foto</th>
                            <th>Nombre</th>
                            <th>Precio Reb.</th>
                            <th>Precio Normal</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    @foreach ($products as $product)
                    @php
                        $precio_rebajado = number_format($product->precio_rebajado, 0, '.', ',');
                        $precio_normal = number_format($product->precio_normal, 0, '.', ',');
                    @endphp
                    <tr>
                        <td>{{ $product->id }}</td>
                        <th><img id="blah" src="{{$product->imagenes}}" alt="Imagen" style="width: 60px; height: 60px;"/></th>
                        <td>{{ $product->nombre }}</td>
                        <td>${{ $precio_rebajado }}</td>
                        <td>${{ $precio_normal }}</td>
                        <td>
                            <a type="button" class="btn btn-sm bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#update_product_{{ $product->id }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                <i class="fa fa-fw fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                    @include('admin.products.modal_update')
                    @endforeach

                </table>
            </div>
          </div>
        </div>
      </div>
</div>
@include('admin.products.modal_create')
@endsection

@section('datatable')

<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      searchable: true,
      fixedHeight: false
    });
</script>

@endsection
