<div class="card-header">
    <div class="d-flex justify-content-between">
        <a class="btn" id="regresar_btn" style="background: {{$configuracion->color_boton_close}}; color: #fff"><i class="fas fa-arrow-left"></i> Regresar </a>

        <h3 class="mb-3">Products</h3>

        <a type="button" class="btn btn-sm bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">¿Como fucniona?</a>

        @can('productos-create')
            <a href="{{ route('bundle.create') }}" class="btn btn-sm bg-gradient-primary"  style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                <i class="fa fa-fw fa-edit"></i> Crear Paquete / Kit
            </a>

            <a type="button" class="btn btn-sm bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#create_product" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                <i class="fa fa-fw fa-edit"></i> Crear
            </a>
        @endcan

        <a type="button" class="btn btn-sm bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#create_categoria" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
            <i class="fa fa-fw fa-edit"></i> Categorias
        </a>

    </div>
</div>

<div class="d-flex justify-content-around">
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

            <li class="nav-item" >
                <a class="nav-link text-white active"  href="{{ route('products.index') }}" style="background: #836262">
                     NAS  <img src="{{ asset('ecommerce/logo_nas.png') }}" alt="" width="35px">
                </a>
            </li>

            <li class="nav-item" >
                <a class="nav-link"  href="{{ route('products.index_cosmica') }}"  style="background: #FBD7CC">
                    Cosmica  <img src="https://plataforma.imnasmexico.com/cosmika/menu/logo.png" alt="" width="35px">
                </a>
            </li>

            <li class="nav-item" >
                <a class="nav-link" href="{{ route('products.index_tiendita') }}" style="background: #6ec7d1a3">
                    Tiendita  <img src="{{ asset('assets/user/icons/marketplace.png') }}" alt="" width="35px">
                </a>
            </li>

            <li class="nav-item" >
                <a class="nav-link" href="{{ route('bundle.index') }}" style="background: #86ff61a3">
                    Kits  <img src="{{ asset('assets/user/icons/productos.png') }}" alt="" width="35px">
                </a>
            </li>

            <li class="nav-item" >
                <a class="nav-link" href="{{ route('index_categrias') }}" style="background: #9affffa3">
                    Categorias
                </a>
            </li>

            <li class="nav-item" >
                <a class="nav-link" href="{{ route('products_insumos_castilla.index') }}" style="background: #fcc154a3">
                    Insumos
                </a>
            </li>
    </ul>
</div>

@include('admin.products.modal_categorias')
