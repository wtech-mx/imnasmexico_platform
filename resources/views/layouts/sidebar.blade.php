
@can('menu-cursos')
    <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
        <div class="sidenav-header mt-4">
            <a class="nav-link active" id="pills-imnas-tab" data-bs-toggle="pill" data-bs-target="#pills-imnas" type="button" role="tab" aria-controls="pills-imnas" aria-selected="true">
                <img src="{{asset('assets/user/logotipos/imnas.webp')}}" class="navbar-brand-img h-100" alt="main_logo">
            </a>
        </div>

        <hr class="horizontal dark mt-0">
        <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link {{ (Request::is('dashboard*') ? 'active' : '') }}" href="{{ route('dashboard') }}">
                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-home text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                    </div>
                    <span class="nav-link-text ms-1">Inicio</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ (Request::is('peril/cliente/*') ? 'active' : '') }}" href="{{ route('peril_cliente.index') }}">
                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-female text-sm opacity-10" style="color: #344767"></i>
                    </div>
                    <span class="nav-link-text ms-1">Perfil Cliente</span>
                </a>
            </li>

            {{-- <li class="nav-item">
                <a class="nav-link {{ (Request::is('cotizacion/expo/*') ? 'active' : '') }}" href="{{ route('corizacion_expo.index') }}">
                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-gift text-sm opacity-10" style="color: #673467"></i>
                    </div>
                    <span class="nav-link-text ms-1">Cotizaciones Expo</span>
                </a>
            </li> --}}

            <li class="nav-item">
                <a class="nav-link {{ (Request::is('/asistencia/expo/*') ? 'active' : '') }}" href="{{ route('asistencia_expo.index') }}">
                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-gift text-sm opacity-10" style="color: #673467"></i>
                    </div>
                    <span class="nav-link-text ms-1">Asisencia Party</span>
                </a>
            </li>

            @can('contratos-cam')
                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('cam/notas/*') ? 'active' : '') }}" href="{{ route('cam_users.index') }}">
                        <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-home text-sm opacity-10" style="color: #6EC1E4"></i>
                        </div>
                        <span class="nav-link-text ms-1">CAM</span>
                    </a>
                </li>
            @endcan

            @can('laboratorio-cosmica-menu')
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#pagaLabCosmica" class="nav-link {{ (Request::is('/cosmica/laboratorio/envases*') ? 'active' : '') }}" aria-controls="pagaLabCosmica" role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fa fa-flask text-sm opacity-10" style="color:#7849e6"></i>
                    </div>
                    <span class="nav-link-text ms-1">Laboratorio Cosmica</span>
                    </a>
                    <div class="collapse " id="pagaLabCosmica">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                @can('lab-cosmica-pedidos')
                                <a class="nav-link {{ (Request::is('admin/productos/stock*') ? 'active' : '') }}" href="{{ route('laboratorio.cosmica') }}">
                                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                                        <i class="fa fa-file text-sm opacity-10" style="color:#7849e6"></i>
                                    </div>
                                    <span class="nav-link-text ms-1">Pedidos</span>
                                </a>
                                @endcan

                                <a class="nav-link {{ (Request::is('/cosmica/laboratorio/envases') ? 'active' : '') }}" href="{{ route('envases.index') }}">
                                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                                        <i class="fa fa-cube text-sm opacity-10" style="color: #7849e6"></i>
                                    </div>
                                    <span class="nav-link-text ms-1">Envases</span>
                                </a>

                                <a class="nav-link {{ (Request::is('/cosmica/laboratorio/granel') ? 'active' : '') }}" href="{{ route('granel.index') }}">
                                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                                        <i class="fa fa-cubes text-sm opacity-10" style="color:#7849e6"></i>
                                    </div>
                                    <span class="nav-link-text ms-1">Granel</span>
                                </a>

                                <a class="nav-link {{ (Request::is('/cosmica/laboratorio/etiqueta') ? 'active' : '') }}" href="{{ route('etiqueta.index') }}">
                                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                                        <i class="fa fa-barcode text-sm opacity-10" style="color:#7849e6"></i>
                                    </div>
                                    <span class="nav-link-text ms-1">Etiqueta</span>
                                </a>

                                @can('lab-cosmica-stock')
                                <a class="nav-link {{ (Request::is('admin/productos/stock') ? 'active' : '') }}" href="{{ route('laboratorio_producto.cosmica') }}">
                                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                                        <i class="fa fa-cubes text-sm opacity-10" style="color:#7849e6"></i>
                                    </div>
                                    <span class="nav-link-text ms-1">Stock</span>
                                </a>
                                @endcan
                            </li>
                        </ul>
                    </div>
                </li>
            @endcan

            @can('lab-nas-menu')
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#pageLabNas" class="nav-link {{ (Request::is('admin/productos/stock*') ? 'active' : '') }}" aria-controls="pageLabNas" role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fa fa-flask text-sm opacity-10" style="color:#DABA7E"></i>
                    </div>
                    <span class="nav-link-text ms-1">Labora NAS</span>
                    <span class="badge rounded-pill bg-danger">
                        {{ $count_pedidos ? $count_pedidos->count() : 0 }}
                    </span>
                    </a>
                    <div class="collapse " id="pageLabNas">
                        <ul class="nav ms-4">
                            <li class="nav-item ">

                                @can('lab-nas-pedidos')
                                <a class="nav-link {{ (Request::is('laboratorio/nas/*') ? 'active' : '') }}" href="{{ route('laboratorio.nas') }}">
                                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                                        <i class="fa fa-file text-sm opacity-10" style="color:#DABA7E"></i>
                                    </div>
                                    <span class="nav-link-text ms-1">Pedidos</span>
                                </a>
                                @endcan

                                <a class="nav-link {{ (Request::is('/nas/laboratorio/envases') ? 'active' : '') }}" href="{{ route('envases_nas.index') }}">
                                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                                        <i class="fa fa-cube text-sm opacity-10" style="color: #DABA7E"></i>
                                    </div>
                                    <span class="nav-link-text ms-1">Envases</span>
                                </a>

                                <a class="nav-link {{ (Request::is('/nas/laboratorio/granel') ? 'active' : '') }}" href="{{ route('granel_nas.index') }}">
                                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                                        <i class="fa fa-cubes text-sm opacity-10" style="color:#DABA7E"></i>
                                    </div>
                                    <span class="nav-link-text ms-1">Granel</span>
                                </a>

                                <a class="nav-link {{ (Request::is('/nas/laboratorio/etiqueta') ? 'active' : '') }}" href="{{ route('etiqueta_nas.index') }}">
                                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                                        <i class="fa fa-barcode text-sm opacity-10" style="color:#DABA7E"></i>
                                    </div>
                                    <span class="nav-link-text ms-1">Etiqueta</span>
                                </a>

                                @can('lab-nas-stock')
                                <a class="nav-link {{ (Request::is('admin/productos/stock') ? 'active' : '') }}" href="{{ route('laboratorio_producto.nas') }}">
                                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                                        <i class="fa fa-cubes text-sm opacity-10" style="color:#DABA7E"></i>
                                    </div>
                                    <span class="nav-link-text ms-1">Stock</span>
                                </a>
                                @endcan
                            </li>
                        </ul>
                    </div>
                </li>
            @endcan

            {{-- @can('reportes-ventas')
                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('reporte/ventas') ? 'active' : '') }}" href="{{ route('reporte_ventas.index') }}">
                        <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-area-chart text-sm opacity-10" style="color: #e6b449"></i>
                        </div>
                        <span class="nav-link-text ms-1">Ventas Gloabales</span>
                    </a>
                </li>
            @endcan --}}

            @can('envia-menu')
                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('reporte/ventas') ? 'active' : '') }}" href="{{ route('shipments.index') }}">
                        <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                            <img src="{{ asset('assets/admin/img/icons/envia.webp') }}"width="30px" >
                        </div>
                        <span class="nav-link-text ms-1">Envia </span>
                    </a>
                </li>
            @endcan

            @can('scaner-nota')
                <a class="nav-link {{ (Request::is('admin/scanner/notas') ? 'active' : '') }}" href="{{ route('scanner_notas.index') }}">
                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-camera text-sm opacity-10" style="color:#e6b449"></i>
                    </div>
                    <span class="nav-link-text ms-1">Scanner</span>
                </a>
            @endcan

            @can('bodega-menu')
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#pageBodega" class="nav-link {{ (Request::is('admin/productos/stock*') ? 'active' : '') }}" aria-controls="pageBodega" role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fa fa-industry text-sm opacity-10" style="color:#e6b449"></i>
                    </div>
                    <span class="nav-link-text ms-1">Bodega</span>
                    </a>
                    <div class="collapse " id="pageBodega">
                    <ul class="nav ms-4">
                        <li class="nav-item ">

                            <a class="nav-link {{ (Request::is('admin/scanner/') ? 'active' : '') }}" href="{{ route('scanner.index') }}">
                                <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                                    <i class="fa fa-camera text-sm opacity-10" style="color:#e6b449"></i>
                                </div>
                                <span class="nav-link-text ms-1">Scanner</span>
                            </a>

                            @can('ordenes-bodega')
                                <a class="nav-link {{ (Request::is('bodega/preparacion') ? 'active' : '') }}" href="{{ route('index_preparacion.bodega') }}">
                                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                                        <i class="fa fa-box text-sm opacity-10" style="color:#e6b449"></i>
                                    </div>
                                    <span class="nav-link-text ms-1">Bodega</span>
                                </a>
                            @endcan

                            <li class="nav-item">
                                <a class="nav-link {{ (Request::is('admin/products') ? 'active' : '') }}" href="{{ route('products_insumos_castilla.index') }}">
                                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                                        <i class="fa fa-shopping-basket text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                                    </div>
                                    <span class="sidenav-normal">Insumos</span>
                                </a>
                            </li>

                            @can('bodega-nas-pedido')
                                <a class="nav-link {{ (Request::is('admin/productos/stock') ? 'active' : '') }}" href="{{ route('productos_stock.index') }}">
                                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                                        <i class="fa fa-pencil text-sm opacity-10" style="color:#e6b449"></i>
                                    </div>
                                    <span class="nav-link-text ms-1">Pedidos Lab NAS</span>
                                </a>
                            @endcan



                            @can('bodega-cosmica-pedido')
                                <a class="nav-link {{ (Request::is('cosmica/admin/productos/stock') ? 'active' : '') }}" href="{{ route('productos_stock_cosmica.index') }}">
                                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                                        <i class="fa fa-pencil text-sm opacity-10" style="color:#322338"></i>
                                    </div>
                                    <span class="nav-link-text ms-1">Pedidos Lab Cosmi.</span>
                                </a>
                            @endcan

                            @can('bodega-cosmica-historial')
                                <a class="nav-link {{ (Request::is('cosmica/admin/productos/stock/ordenes') ? 'active' : '') }}" href="{{ route('ordenes_cosmica.index') }}">
                                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                                        <i class="fa fa-list text-sm opacity-10" style="color:#322338"></i>
                                    </div>
                                    <span class="nav-link-text ms-1">Historial P. Cosmi.</span>
                                </a>
                            @endcan

                            @can('bodega-nas-historial')
                                <a class="nav-link {{ (Request::is('admin/productos/stock/ordenes') ? 'active' : '') }}" href="{{ route('ordenes_nas.index') }}">
                                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                                        <i class="fa fa-list text-sm opacity-10" style="color:#e6b449"></i>
                                    </div>
                                    <span class="nav-link-text ms-1">Historial P. NAS</span>
                                </a>
                            @endcan

                            <a class="nav-link {{ (Request::is('productos/vendidos') ? 'active' : '') }}" href="{{ route('productsHistorialVendidos.index') }}">
                                <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                                    <i class="fa fa-file-pdf text-sm opacity-10" style="color:#322338"></i>
                                </div>
                                <span class="nav-link-text ms-1">Historial Productos Vendidos</span>
                            </a>

                        </li>
                    </ul>
                    </div>
                </li>
            @endcan

            @can('productos-menu')
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#pagesExamplescarrito" class="nav-link {{ (Request::is('admin/pagos*') ? 'active' : '') }}" aria-controls="pagesExamplescarrito" role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fa fa-shopping-basket text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                    </div>
                    <span class="nav-link-text ms-1">Productos</span>
                    </a>
                    <div class="collapse " id="pagesExamplescarrito">
                    <ul class="nav ms-4">
                        <li class="nav-item ">
                            <a class="nav-link {{ (Request::is('admin/products') ? 'active' : '') }}" href="{{ route('products.index') }}">
                                <span class="sidenav-mini-icon">C</span>
                                <span class="sidenav-normal">Productos</span>
                            </a>
                        </li>

                        @can('productos-show')
                            <li class="nav-item ">
                            <a class="nav-link {{ (Request::is('admin/products/bundle*') ? 'show' : '') }}" href="{{ route('bundle.index') }}">
                                <span class="sidenav-mini-icon">C</span>
                                <span class="sidenav-normal">Ver Kits </span>
                            </a>
                            </li>

                            <li class="nav-item ">
                                <a class="nav-link {{ (Request::is('/admin/products/create/bundle*') ? 'show' : '') }}" href="{{ route('bundle.create') }}">
                                <span class="sidenav-mini-icon">C</span>
                                <span class="sidenav-normal">Crear Kit</span>
                                </a>
                            </li>
                        @endcan

                    </ul>
                    </div>
                </li>
            @endcan

            {{-- @can('certificacion-webinar')
                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('/admin/certificaciones/webinar/*') ? 'active' : '') }}" href="{{ route('index.certificados_wbinar') }}" target="">
                        <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-certificate text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Certificacion Webinar</span>
                    </a>
                </li>
            @endcan

            @can('estatus-estandares')
                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('/notas/cam') ? 'active' : '') }}" href="{{ route('notascam.index') }}" target="">
                        <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-spinner text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Estatus Estandares</span>
                    </a>
                </li>
            @endcan

            @can('menu-profesores-admins')
            <li class="nav-item">
                <a class="nav-link {{ (Request::is('/profesor/inicio*') ? 'active' : '') }}" href="{{ route('dashboard.index') }}" target="">
                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-home text-sm opacity-10" style="color: #ccc"></i>
                    </div>
                    <span class="nav-link-text ms-1">Panel de Profesor</span>
                </a>
            </li>
            @endcan --}}

            @can('cursos-menu')
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#pagesExamplesCurso" class="nav-link {{ (Request::is('admin/cursos*') ? 'active' : '') }}" aria-controls="pagesExamplesCurso" role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fa fa-graduation-cap text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                    </div>
                    <span class="nav-link-text ms-1">Cursos</span>
                    </a>
                    <div class="collapse " id="pagesExamplesCurso">
                    <ul class="nav ms-4">
                        <li class="nav-item ">
                        @can('cursos-create')
                            <a class="nav-link {{ (Request::is('/admin/cursos/mes*') ? 'show' : '') }}" href="{{ route('cursos.create') }}">
                                <span class="sidenav-mini-icon"> P </span>
                                <span class="sidenav-normal">Crear Curso</span>
                            </a>
                        @endcan
                        @can('cursos-dev')
                            <a class="nav-link {{ (Request::is('/admin/cursos/mes*') ? 'show' : '') }}" href="{{ route('cursos.index_mes_dev') }}">
                                <span class="sidenav-mini-icon"> P </span>
                                <span class="sidenav-normal">Cursos</span>
                            </a>
                        @endcan
                        @can('cursos-show')
                            <a class="nav-link {{ (Request::is('/admin/cursos/dia*') ? 'show' : '') }}" href="{{ route('cursos.index_dia') }}">
                                <span class="sidenav-mini-icon"> P </span>
                                <span class="sidenav-normal">Cursos del Dia</span>
                            </a>

                            <a class="nav-link {{ (Request::is('/admin/cursos/mes*') ? 'show' : '') }}" href="{{ route('cursos.index_mes') }}">
                                <span class="sidenav-mini-icon"> P </span>
                                <span class="sidenav-normal">Cursos del Mes</span>
                            </a>

                            <a class="nav-link {{ (Request::is('/admin/cursos*') ? 'show' : '') }}" href="{{ route('cursos.index') }}">
                                <span class="sidenav-mini-icon"> P </span>
                                <span class="sidenav-normal">Todos los Cursos</span>
                            </a>
                        @endcan

                        @can('carpeta-compartida-show')
                            <a class="nav-link {{ (Request::is('/admin/carpetas*') ? 'show' : '') }}" href="{{ route('carpetas.index') }}">
                                <span class="sidenav-mini-icon"> P </span>
                                <span class="sidenav-normal">Carpeta Materiales</span>
                            </a>
                        @endcan

                        @can('biblioteca')
                            <a class="nav-link {{ (Request::is('/recursos') ? 'active' : '') }}" href="{{ route('recursos.index') }}">
                                <span class="sidenav-mini-icon"> B </span>
                                <span class="sidenav-normal">Biblioteca</span>
                            </a>
                        @endcan

                            <a class="nav-link {{ (Request::is('/admin/reporte/cursos') ? 'active' : '') }}" href="{{ route('reporte.index_cursos') }}">
                                <span class="sidenav-mini-icon"> R </span>
                                <span class="sidenav-normal">Reporte de Cursos</span>
                            </a>

                        </li>
                    </ul>
                    </div>
                </li>
            @endcan

            @can('notas-nas-menu')
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#pagesExamplesCursos" class="nav-link {{ (Request::is('admin/notas/cursos*') ? 'active' : '') }}" aria-controls="pagesExamplesCursos" role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fas fa-file-invoice-dollar text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                    </div>
                    <span class="nav-link-text ms-1">Notas NAS</span>
                    </a>
                    <div class="collapse " id="pagesExamplesCursos">
                    <ul class="nav ms-4">
                        <li class="nav-item ">
                            @can('nota-cursos-show')
                                <a class="nav-link {{ (Request::is('admin/notas/productos/*') ? 'show' : '') }}" href="{{ route('notas_cursos.index') }}">
                                    <span class="sidenav-mini-icon"> P </span>
                                    <span class="sidenav-normal">Notas Cursos</span>
                                </a>
                            @endcan

                            @can('nota-productos-show')
                                <a class="nav-link {{ (Request::is('admin/notas/productos/*') ? 'show' : '') }}" href="{{ route('notas_productos.index') }}">
                                    <span class="sidenav-mini-icon"> P </span>
                                    <span class="sidenav-normal">Notas Ventas</span>
                                </a>
                            @endcan

                            @can('nota-nas-cotizaciones')
                                <a class="nav-link {{ (Request::is('admin/notas/productos/*') ? 'show' : '') }}" href="{{ route('notas_cotizacion.index') }}">
                                    <span class="sidenav-mini-icon"> P </span>
                                    <span class="sidenav-normal">Notas Cotizaciones</span>
                                </a>
                            @endcan
                        </li>
                    </ul>
                    </div>
                </li>
            @endcan

            @can('pagos-externos-menu')
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#pagesExamplesPagos" class="nav-link {{ (Request::is('admin/pagos-por-fuera*') ? 'active' : '') }}" aria-controls="pagesExamplesPagos" role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fas fa-file-invoice-dollar text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                    </div>
                    <span class="nav-link-text ms-1">Pagos Externos</span>
                    </a>
                    <div class="collapse " id="pagesExamplesPagos">
                    <ul class="nav ms-4">
                        <li class="nav-item ">

                        <a class="nav-link {{ (Request::is('admin/pagos-por-fuera/create*') ? 'show' : '') }}" href="{{ route('pagos.create') }}">
                            <span class="sidenav-mini-icon"> P </span>
                            <span class="sidenav-normal">Subir Pago</span>
                        </a>

                        <a class="nav-link {{ (Request::is('admin/pagos-por-fuera/pendientes*') ? 'show' : '') }}" href="{{ route('pagos.pendientes') }}">
                            <span class="sidenav-mini-icon"> P </span>
                            <span class="sidenav-normal">Verificar Pagos</span>
                        </a>

                        {{-- <a class="nav-link {{ (Request::is('admin/comprobar_transferencias*') ? 'show' : '') }}" href="{{ route('trasnferencias.index') }}">
                            <span class="sidenav-mini-icon"> P </span>
                            <span class="sidenav-normal">Comprar Transferencias</span>
                        </a> --}}

                        <a class="nav-link {{ (Request::is('admin/pagos-por-fuera/deudores*') ? 'show' : '') }}" href="{{ route('pagos.deudores') }}">
                            <span class="sidenav-mini-icon"> P </span>
                            <span class="sidenav-normal">Deudores</span>
                        </a>

                        <a class="nav-link {{ (Request::is('admin/pagos-por-fuera/inscripcion*') ? 'show' : '') }}" href="{{ route('pagos.inscripcion') }}">
                            <span class="sidenav-mini-icon"> P </span>
                            <span class="sidenav-normal">Todas las notas</span>
                        </a>
                        </li>
                    </ul>
                    </div>
                </li>
            @endcan

            @can('marketing-menu')
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#pagesExamplesmarketing" class="nav-link {{ (Request::is('admin/marketing*') ? 'active' : '') }}" aria-controls="pagesExamplesmarketing" role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fas fa-bullhorn text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                    </div>
                    <span class="nav-link-text ms-1">Marketing</span>
                    </a>
                    <div class="collapse " id="pagesExamplesmarketing">
                    <ul class="nav ms-4">
                        @can('cupon-show')
                            <li class="nav-item ">
                            <a class="nav-link {{ (Request::is('admin/marketing/cupones*') ? 'show' : '') }}" href="{{ route('cupones.index') }}">
                                <span class="sidenav-mini-icon">C</span>
                                <span class="sidenav-normal">Cupones</span>
                            </a>
                            </li>
                        @endcan

                        @can('nota-productos-show')
                            <li class="nav-item ">
                                <a class="nav-link {{ (Request::is('/admin/publicidad*') ? 'show' : '') }}" href="{{ route('publicidad.index') }}">
                                <span class="sidenav-mini-icon">C</span>
                                <span class="sidenav-normal">Publicidad</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                    </div>
                </li>
            @endcan

            @can('ordenes-show')
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#pagesExamplescarrito" class="nav-link {{ (Request::is('admin/pagos*') ? 'active' : '') }}" aria-controls="pagesExamplescarrito" role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fas fa-bullhorn text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                    </div>
                    <span class="nav-link-text ms-1">Ordenes</span>
                    </a>
                    <div class="collapse " id="pagesExamplescarrito">
                    <ul class="nav ms-4">
                        <li class="nav-item ">
                            <a class="nav-link {{ (Request::is('admin/pagos*') ? 'show' : '') }}" href="{{ route('pagos.mp') }}">
                                <span class="sidenav-mini-icon">C</span>
                                <span class="sidenav-normal">Completados MP</span>
                            </a>
                        </li>

                        <li class="nav-item ">
                        <a class="nav-link {{ (Request::is('admin/pagos*') ? 'show' : '') }}" href="{{ route('pagos.index_pago') }}">
                            <span class="sidenav-mini-icon">C</span>
                            <span class="sidenav-normal">Completados</span>
                        </a>
                        </li>

                        <li class="nav-item ">
                            <a class="nav-link {{ (Request::is('/admin/pagos/pendiente*') ? 'show' : '') }}" href="{{ route('pagos.index_pago_pendiente') }}">
                            <span class="sidenav-mini-icon">C</span>
                            <span class="sidenav-normal">Carrito abandonado</span>
                            </a>
                        </li>
                    </ul>
                    </div>
                </li>
            @endcan

            @can('mercado-pago')
                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('admin/pagos/mercado*') ? 'active' : '') }}" href="{{ route('mercado.pago') }}">
                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                        <img src="https://plataforma.imnasmexico.com/utilidades/logo_mp.png" alt="" style="width: 25px">

                    </div>
                    <span class="nav-link-text ms-1">Mercado Pago</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('/admin/link/pagos/mercado*') ? 'active' : '') }}" href="{{ route('link_pago.index') }}">
                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                        <img src="https://plataforma.imnasmexico.com/utilidades/logo_mp.png" alt="" style="width: 25px">
                    </div>
                    <span class="nav-link-text ms-1">LinkS Pago</span>
                    </a>
                </li>

            @endcan

            @can('client-show')
                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('admin/clientes*') ? 'active' : '') }}" href="{{ route('clientes_admin.index') }}">
                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-users text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                    </div>
                    <span class="nav-link-text ms-1">Alumn@s</span>
                    </a>
                </li>
            @endcan

            @can('registro-imnas-menu')
                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('/registro/imnas*') ? 'active' : '') }}" href="{{ route('index.imnas') }}">
                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-list-alt text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                    </div>
                    <span class="nav-link-text ms-1">Registros IMNAS</span>
                    </a>
                </li>
            @endcan

            @can('registro-imnas-reportes')
                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('/registro/imnas/reporte/*') ? 'active' : '') }}" href="{{ route('registro_imnas.reporte') }}" target="">
                        <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-certificate text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Reporte Registros IMNAS</span>
                    </a>
                </li>
            @endcan

             @can('factura-show')
                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('admin/facturas*') ? 'active' : '') }}" href="{{ route('facturas.index') }}">
                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-sticky-note text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                    </div>
                    <span class="nav-link-text ms-1">Facturas</span>
                    </a>
                </li>
            @endcan

           {{-- @can('profesores-show')
                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('admin/profesores*') ? 'active' : '') }}" href="{{ route('profesores.index') }}">
                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-school text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profesores</span>
                    </a>
                </li>
            @endcan--}}

            {{-- @can('caja')
                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('admin/caja/cursos') ? 'active' : '') }}" href="{{ route('caja.index') }}">
                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-ticket text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                    </div>
                    <span class="nav-link-text ms-1">Caja</span>
                    </a>
                </li>
            @endcan --}}

            @can('carpeta-estandares-show')
                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('/admin/carpetas/estandares*') ? 'active' : '') }}" href="{{ route('carpetas_estandares.index') }}">
                        <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-school text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                        </div>
                        <span class="sidenav-normal">Carpeta Estandares</span>
                    </a>
                </li>
            @endcan

            {{-- @can('registros-form-menu')
                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('admin/registro/compras*') ? 'active' : '') }}" href="{{ route('registro_compras.index') }}">
                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-sticky-note text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                    </div>
                    <span class="nav-link-text ms-1">Registros Compras</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('admin/registro/llegada*') ? 'active' : '') }}" href="{{ route('registro_llegada.index') }}">
                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-sticky-note text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                    </div>
                    <span class="nav-link-text ms-1">Registros Bienvenida</span>
                    </a>
                </li>
            @endcan --}}

            @can('documentos-menu')
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#pagesExamplesdocumentos" class="nav-link {{ (Request::is('admin/reporte*') ? 'active' : '') }}" aria-controls="pagesExamplesdocumentos" role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fas fa-file-invoice-dollar text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                    </div>
                    <span class="nav-link-text ms-1">Documentos</span>
                    </a>
                    <div class="collapse" id="pagesExamplesdocumentos">
                    <ul class="nav ms-4">
                        <li class="nav-item ">
                            @can('nuevos-documentos')
                                <a class="nav-link {{ (Request::is('admin/documentos/tipos*') ? 'show' : '') }}" href="{{ route('documentos.index') }}">
                                    <span class="sidenav-mini-icon"> P </span>
                                    <span class="sidenav-normal">Tipos de Documentos</span>
                                </a>
                            @endcan

                            @can('generador-documentos')
                                <a class="nav-link {{ (Request::is('admin/documentos/generar*') ? 'show' : '') }}" href="{{ route('generar_documentos.index') }}">
                                    <span class="sidenav-mini-icon"> P </span>
                                    <span class="sidenav-normal">Reporte Generados</span>
                                </a>
                            @endcan

                            @can('faltantes-documentos')
                                <a class="nav-link {{ (Request::is('admin/documentos/faltantes*') ? 'show' : '') }}" href="{{ route('documentos.faltantes') }}">
                                    <span class="sidenav-mini-icon"> P </span>
                                    <span class="sidenav-normal">Documentos faltantes</span>
                                </a>
                            @endcan
                        </li>
                    </ul>
                    </div>
                </li>
            @endcan


            {{-- @can('envios-show')
                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('/admin/envios*') ? 'active' : '') }}" href="{{ route('envios.index') }}">
                        <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-box text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                        </div>
                        <span class="sidenav-normal">Envios</span>
                    </a>
                </li>
            @endcan --}}

            @can('cosmica-menu')
                <li class="nav-item mt-3">
                    <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Cosmica</h6>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('admin/pagos/mercadocosmica*') ? 'active' : '') }}" href="{{ route('mercado_cosmica.pago') }}">
                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                        <img src="https://plataforma.imnasmexico.com/utilidades/logo_mp.png" alt="" style="width: 25px">

                    </div>
                    <span class="nav-link-text ms-1">Mercado Pago Cosmica</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('cosmica/eventos/*') ? 'active' : '') }}" href="{{ route('eventos_cosmica.index') }}">
                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-graduation-cap text-sm opacity-10" style="color: #322338"></i>
                    </div>
                    <span class="nav-link-text ms-1">Eventos Cosmica</span>
                    </a>
                </li>

                @can('cosmica-cotizaciones')
                    <li class="nav-item">
                        <a class="nav-link {{ (Request::is('cosmica/cotizacion/*') ? 'active' : '') }}" href="{{ route('cotizacion_cosmica.index') }}">
                        <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-file-text text-sm opacity-10" style="color: #322338"></i>
                        </div>
                        <span class="nav-link-text ms-1">Cotizaciones Cosmica</span>
                        </a>
                    </li>
                @endcan

                @can('cosmica-cotizaciones')
                    <li class="nav-item">
                        <a class="nav-link {{ (Request::is('admin/cotizador/cosmica/expo/*') ? 'active' : '') }}" href="{{ route('index_cotizaciones_cosmica_expo.cotizador') }}">
                        <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-file-text text-sm opacity-10" style="color: #322338"></i>
                        </div>
                        <span class="nav-link-text ms-1">Cotizaciones EXPO Cosmica</span>
                        </a>
                    </li>
                @endcan

                @can('cosmica-distribuidora')
                    <li class="nav-item">
                        <a class="nav-link {{ (Request::is('cosmica/distribuidoras/*') ? 'active' : '') }}" href="{{ route('distribuidoras.index') }}">
                        <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-file-text text-sm opacity-10" style="color: #322338"></i>
                        </div>
                        <span class="nav-link-text ms-1">Distribuidoras</span>
                        </a>
                    </li>
                @endcan

                @can('cosmica-protocolos')
                    <li class="nav-item">
                        <a class="nav-link {{ (Request::is('cosmica/protocolos/*') ? 'active' : '') }}" href="{{ route('protocolos.index') }}">
                        <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-file-text text-sm opacity-10" style="color: #322338"></i>
                        </div>
                        <span class="nav-link-text ms-1">Protocolos Permanentes</span>
                        </a>
                    </li>
                @endcan
            @endcan

            <li class="nav-item mt-3">
                <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Meli</h6>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ (Request::is('meli/ventas*') ? 'active' : '') }}" href="{{ route('meli_ventas.index') }}">
                <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                    <img src="https://http2.mlstatic.com/frontend-assets/ml-web-navigation/ui-navigation/6.6.92/mercadolibre/logo_large_25years_v2.png" alt="" style="width: 35px">
                </div>
                <span class="nav-link-text ms-1">Ventas</span>
                </a>
            </li>

            <li class="nav-item">
                <a target="_blank" class="nav-link" href="{{ route('meli_token.index') }}">
                <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                </div>
                <span class="nav-link-text ms-1">Token</span>
                </a>
            </li>

            @can('menu-cam')
                <li class="nav-item mt-3">
                    <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder opacity-6">CONOCER</h6>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('dashboard*') ? 'active' : '') }}" href="{{ route('dashboard') }}" target="">
                        <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-home text-sm opacity-10" style="color: #6EC1E4"></i>
                        </div>
                        <span class="nav-link-text ms-1">Inicio</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#pagesExamplesCurso" class="nav-link {{ (Request::is('admin/cursos*') ? 'active' : '') }}" aria-controls="pagesExamplesCurso" role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fa fa-graduation-cap text-sm opacity-10" style="color:#6EC1E4"></i>
                    </div>
                    <span class="nav-link-text ms-1">Expedientes</span>
                    </a>
                    <div class="collapse " id="pagesExamplesCurso">
                    <ul class="nav ms-4">
                        <li class="nav-item ">
                        @can('nota-cam-create')
                            <a class="nav-link {{ (Request::is('/cam/expedientes*') ? 'show' : '') }}" href="{{ route('independiente.index') }}">
                                <span class="sidenav-mini-icon"> P </span>
                                <span class="sidenav-normal">Evaluador Independiente</span>
                            </a>

                            <a class="nav-link {{ (Request::is('/admin/cursos/dia*') ? 'show' : '') }}" href="{{ route('centro.index') }}">
                                <span class="sidenav-mini-icon"> P </span>
                                <span class="sidenav-normal">Centro de Evaluación</span>
                            </a>
                        @endcan

                        </li>
                    </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('notas/index') ? 'active' : '') }}" href="{{ route('index.notas') }}">
                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-ticket text-sm opacity-10" style="color:#6EC1E4"></i>
                    </div>
                    <span class="nav-link-text ms-1">Nota</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('/admin/carpetas/estandares*') ? 'active' : '') }}" href="{{ route('carpetas_estandares.index') }}">
                        <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-school text-sm opacity-10" style="color: #6EC1E4"></i>
                        </div>
                        <span class="sidenav-normal">Carpeta Estandares</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('documentos/index') ? 'active' : '') }}" href="{{ route('index.documentos') }}">
                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-ticket text-sm opacity-10" style="color:#6EC1E4"></i>
                    </div>
                    <span class="nav-link-text ms-1">Documentos</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('admin/videos_cam') ? 'active' : '') }}" href="{{ route('videos_cam.index') }}">
                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-ticket text-sm opacity-10" style="color:#6EC1E4"></i>
                    </div>
                    <span class="nav-link-text ms-1">Videos</span>
                    </a>
                </li>
            @endcan


                <li class="nav-item mt-3">
                    <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder opacity-6"><img src="{{ asset('stp/stp_logo.jpg') }}" alt="" style="width: 35px"></h6>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#stp" class="nav-link " aria-controls="stp" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                                <i class="fa fa-gear opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                        </div>
                        <span class="nav-link-text ms-1">STP Pruebas</span>
                    </a>
                    <div class="collapse " id="stp">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a href="{{ route('stp.firma.form') }}" class="nav-link">
                                    <span class="sidenav-mini-icon"></span>
                                    <span class="sidenav-normal">Prueba de firma</span>
                                </a>

                                <a href="{{ route('stp.consulta.form') }}" class="nav-link">
                                    <span class="sidenav-mini-icon"></span>
                                    <span class="sidenav-normal">Saldo de cuenta</span>
                                </a>

                                <a href="{{ route('stp.comprobante.form') }}" class="nav-link">
                                    <span class="sidenav-mini-icon"></span>
                                    <span class="sidenav-normal">Consulta Comprobante STP</span>
                                </a>

                                <a href="{{ route('stp.conciliacion.form') }}" class="nav-link">
                                    <span class="sidenav-mini-icon"></span>
                                    <span class="sidenav-normal">Consulta Conciliación Saldo</span>
                                </a>

                                <a href="{{ route('stp.instituciones.consulta') }}" class="nav-link">
                                    <span class="sidenav-mini-icon"></span>
                                    <span class="sidenav-normal">Consulta Instituciones</span>
                                </a>

                                <a href="{{ route('stp.operaciones.form') }}" class="nav-link">
                                    <span class="sidenav-mini-icon"></span>
                                    <span class="sidenav-normal">Consulta de Operaciones STP</span>
                                </a>

                                <a href="{{ route('stp.orden.rastreo.form') }}" class="nav-link">
                                    <span class="sidenav-mini-icon"></span>
                                    <span class="sidenav-normal">Consulta Orden por ClaveRastreo</span>
                                </a>

                                <a href="{{ route('stp.test_webhook') }}" class="nav-link">
                                    <span class="sidenav-mini-icon"></span>
                                    <span class="sidenav-normal">Cambio de estado</span>
                                </a>

                                <a href="{{ route('stp.test_abono') }}" class="nav-link">
                                    <span class="sidenav-mini-icon"></span>
                                    <span class="sidenav-normal">Enviar notificación SendAbono</span>
                                </a>

                                <a href="{{ route('stp.registra.form') }}" class="nav-link">
                                    <span class="sidenav-mini-icon"></span>
                                    <span class="sidenav-normal">Registra Orden SPEI</span>
                                </a>

                            </li>
                        </ul>
                    </div>
                 </li>

            @can('pagina-menu')
                <li class="nav-item mt-3">
                    <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Web Page</h6>
                </li>

                @can('pagina-configuracion')
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#webpahe" class="nav-link {{ (Request::is('admin/estandares*') ? 'active' : '') }}" aria-controls="webpahe" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa fa-gear opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Configuraciones de la pag</span>
                        </a>
                        <div class="collapse " id="webpahe">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                @can('pagina-web')
                                    <a class="nav-link {{ (Request::is('users*') ? 'active' : '') }}" href="{{ route('webpage.edit',1) }}">
                                        <span class="sidenav-mini-icon"></span>
                                        <span class="sidenav-normal">Pagina Web</span>
                                    </a>
                                @endcan

                                @can('pagina-estandares')
                                    <a class="nav-link {{ (Request::is('admin/estandares*') ? 'active' : '') }}" href="{{ route('estandares.index') }}">
                                        <span class="sidenav-mini-icon"></span>
                                        <span class="sidenav-normal">Estandares</span>
                                    </a>
                                @endcan

                                @can('pagina-rvoes')
                                    <a class="nav-link {{ (Request::is('admin/revoes*') ? 'active' : '') }}" href="{{ route('revoes.index') }}">
                                        <span class="sidenav-mini-icon"></span>
                                        <span class="sidenav-normal">Rvoes</span>
                                    </a>
                                @endcan

                                @can('pagina-comentarios')
                                    <a class="nav-link {{ (Request::is('admin/comentarios*') ? 'active' : '') }}" href="{{ route('comentarios.index') }}">
                                        <span class="sidenav-mini-icon"></span>
                                        <span class="sidenav-normal">Comentarios</span>
                                    </a>
                                @endcan

                                @can('pagina-noticias')
                                    <a class="nav-link {{ (Request::is('admin/noticias*') ? 'active' : '') }}" href="{{ route('noticias.index') }}">
                                        <span class="sidenav-mini-icon"></span>
                                        <span class="sidenav-normal">Noticias</span>
                                    </a>
                                @endcan

                                @can('pagina-paquetes')
                                    <a class="nav-link {{ (Request::is('admin/paquetes') ? 'active' : '') }}" href="{{ route('paquetes.index') }}">
                                        <span class="sidenav-mini-icon"></span>
                                        <span class="sidenav-normal">Paquetes</span>
                                    </a>
                                @endcan
                            </li>
                        </ul>
                        </div>
                    </li>
                @endcan

                @can('manual-usuario')
                    <li class="nav-item">
                        <a class="nav-link {{ (Request::is('admin/manual') ? 'active' : '') }}" href="{{ route('manual.index') }}">
                        <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-ticket text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Manual de Usuario</span>
                        </a>
                    </li>
                @endcan

                @can('configuracion')
                    <li class="nav-item">
                        <a class="nav-link {{ (Request::is('configuracion*') ? 'show' : '') }}" href="{{ route('index.configuracion') }}">
                        <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-ticket text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Pagina</span>
                        </a>
                    </li>
                @endcan
            @endcan

            @can('administrador-menu')

                <li class="nav-item mt-3">
                    <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Recursos Humanos</h6>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#pagesExampLERH" class="nav-link {{ (Request::is('admin/reporte*') ? 'active' : '') }}" aria-controls="pagesExampLERH" role="button" aria-expanded="false">

                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fas fa-file-invoice-dollar text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                    </div>

                    <span class="nav-link-text ms-1">Panel</span>
                    </a>
                    <div class="collapse" id="pagesExampLERH">
                    <ul class="nav ms-4">

                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('panel.index') }}">
                                <span class="sidenav-mini-icon"> P </span>
                                <span class="sidenav-normal">Panel</span>
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('index.bancos') }}">
                                <span class="sidenav-mini-icon"> B </span>
                                <span class="sidenav-normal">Bancos</span>
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('index.proveedores') }}">
                                <span class="sidenav-mini-icon"> P </span>
                                <span class="sidenav-normal">Proveedores</span>
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a class="nav-link" href="">
                                <span class="sidenav-mini-icon"> I </span>
                                <span class="sidenav-normal">Ingresos</span>
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a class="nav-link" href="">
                                <span class="sidenav-mini-icon">E </span>
                                <span class="sidenav-normal">Egresos</span>
                            </a>
                        </li>

                    </ul>
                    </div>
                </li>

                <li class="nav-item mt-3">
                    <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Administrativo</h6>
                </li>

                @can('administrador-reportes')
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#pagesExamplesReportes" class="nav-link {{ (Request::is('admin/reporte*') ? 'active' : '') }}" aria-controls="pagesExamplesReportes" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fas fa-file-invoice-dollar text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Reportes</span>
                        </a>
                        <div class="collapse" id="pagesExamplesReportes">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                            @can('reporte-personalizado')
                                <a class="nav-link {{ (Request::is('admin/reporte/custom*') ? 'show' : '') }}" href="{{ route('reporte.index_custom') }}">
                                    <span class="sidenav-mini-icon"> P </span>
                                    <span class="sidenav-normal">Personalizado</span>
                                </a>
                            @endcan
                            @can('reporte-dia')
                                <a class="nav-link {{ (Request::is('admin/reporte/dia*') ? 'show' : '') }}" href="{{ route('reporte.index_dia') }}">
                                    <span class="sidenav-mini-icon"> P </span>
                                    <span class="sidenav-normal">Dia</span>
                                </a>
                            @endcan
                            @can('reporte-semana')
                                <a class="nav-link {{ (Request::is('admin/reporte/semana*') ? 'show' : '') }}" href="{{ route('reporte.index_semana') }}">
                                    <span class="sidenav-mini-icon"> P </span>
                                    <span class="sidenav-normal">Semana</span>
                                </a>
                            @endcan
                            @can('reporte-mes')
                                <a class="nav-link {{ (Request::is('admin/reporte/mes*') ? 'show' : '') }}" href="{{ route('reporte.index_mes') }}">
                                    <span class="sidenav-mini-icon"> P </span>
                                    <span class="sidenav-normal">Mes</span>
                                </a>
                            @endcan
                            </li>
                        </ul>
                        </div>
                    </li>
                @endcan

                @can('roles-permisos')
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#pagesExamples" class="nav-link {{ (Request::is('users*') ? 'active' : '') }}{{ (Request::is('roles*') ? 'active' : '') }}" aria-controls="pagesExamples" role="button" aria-expanded="false">
                            <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa fa-tools text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                            </div>
                            <span class="nav-link-text ms-1">Roles y Permisos</span>
                        </a>
                        <div class="collapse " id="pagesExamples">
                            <ul class="nav ms-4">
                            <li class="nav-item ">
                                @can('usuarios-list')
                                    <a class="nav-link {{ (Request::is('users*') ? 'show' : '') }}" href="{{ route('users.index') }}">
                                        <span class="sidenav-mini-icon"> P </span>
                                    <span class="sidenav-normal">Usuarios</span>
                                    </a>
                                @endcan

                                @can('role-list')
                                    <a class="nav-link {{ (Request::is('roles*') ? 'show' : '') }}" href="{{ route('roles.index') }}">
                                        <span class="sidenav-mini-icon"> P </span>
                                    <span class="sidenav-normal">Roles</span>
                                    </a>
                                @endcan
                            </li>
                            </ul>
                        </div>
                    </li>
                @endcan
            @endcan
        </ul>

    </aside>
@endcan
