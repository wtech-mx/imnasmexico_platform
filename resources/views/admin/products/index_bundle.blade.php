@extends('layouts.app_admin')

@section('template_title')
    Products
@endsection
@section('css')

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

                    <h3 class="mb-3">Products</h3>

                    <a type="button" class="btn btn-sm bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                        ¿Como fucniona?
                    </a>

                    @can('productos-create')
                        <a href="{{ route('bundle.create') }}" class="btn btn-sm bg-gradient-primary"  style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                            <i class="fa fa-fw fa-edit"></i> Crear Paquete / Kit
                        </a>

                        <a type="button" class="btn btn-sm bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#create_product" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                            <i class="fa fa-fw fa-edit"></i> Crear
                        </a>
                    @endcan

                </div>
            </div>

            <div class="d-flex justify-content-around">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="pills-producto-tab" href="{{ route('products.index'),'#pills-producto' }}" >
                                Producto  <img src="{{ asset('assets/user/icons/limpieza.png') }}" alt="" width="35px">
                            </a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-tiendita-tab" href="{{ route('products.index') }}" >
                                Tiendita  <img src="{{ asset('assets/user/icons/marketplace.png') }}" alt="" width="35px">
                            </a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-kits-tab" data-bs-toggle="pill" data-bs-target="#pills-kits" type="button" role="tab" aria-controls="pills-kits" aria-selected="false" style="background: #86ff61a3">
                                Kits  <img src="{{ asset('assets/user/icons/productos.png') }}" alt="" width="35px">
                            </button>
                        </li>
                </ul>
            </div>

            <div class="table-responsive p-4" style="border:solid 5px #86ff61a3">
                <table class="table table-flush" id="datatable-search">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Foto</th>
                            <th>Nombre</th>
                            <th>Precio Normal</th>
                            <th>Categoria</th>
                            <th>Stock</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    @foreach ($productsKit as $product)
                    @php
                        $precio_rebajado = number_format($product->precio_rebajado, 0, '.', ',');
                        $precio_normal = number_format($product->precio_normal, 0, '.', ',');
                    @endphp
                    <tr id="productRow{{ $product->id }}">
                        <td>{{ $product->id }}</td>
                        <th><img id="blah" src="{{$product->imagenes}}" alt="Imagen" style="width: 60px; height: 60px;"/></th>
                        <td>{{ $product->nombre }}</td>
                        <td>${{ $precio_normal }}</td>
                        <td>{{ $product->categoria }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>

                                <a type="button" class="btn btn-sm btn-primary editProductBtn d-inline" data-id="{{ $product->id }}">
                                    <i class="fa fa-fw fa-edit"></i>
                                </a>
                            @can('productos-edit')
                                <form class="OcultarProductForm d-inline" data-id="{{ $product->id }}">
                                    @csrf
                                    <input type="hidden" name="_method" value="PATCH">
                                    <input type="hidden" name="categoria" value="Ocultar">

                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa fa-fw fa-trash"></i>
                                    </button>
                                </form>

                            @endcan
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

@endsection

@section('datatable')

<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
        deferRender:true,
        paging: true,
        pageLength: 10
    });
</script>

@endsection
