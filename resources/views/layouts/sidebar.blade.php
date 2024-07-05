
@can('menu-cam')

    <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
        <div class="sidenav-header mt-4">
            <a class="nav-link active" id="pills-imnas-tab" data-bs-toggle="pill" data-bs-target="#pills-imnas" type="button" role="tab" aria-controls="pills-imnas" aria-selected="true">
                <img src="{{asset('assets/user/logotipos/cam.png')}}" class="navbar-brand-img h-100" alt="main_logo">
            </a>
        </div>

        <hr class="horizontal dark mt-0">
        <ul class="navbar-nav">

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
                <a class="nav-link {{ (Request::is('estandares/index') ? 'active' : '') }}" href="{{ route('index.estandares') }}">
                <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-ticket text-sm opacity-10" style="color:#6EC1E4"></i>
                </div>
                <span class="nav-link-text ms-1">Estandares</span>
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

        </ul>

    </aside>

@endcan

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
                <a class="nav-link {{ (Request::is('dashboard*') ? 'active' : '') }}" href="{{ route('dashboard') }}" target="">
                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-home text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                    </div>
                    <span class="nav-link-text ms-1">Inicio</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ (Request::is('/admin/certificaciones/webinar/*') ? 'active' : '') }}" href="{{ route('index.certificados_wbinar') }}" target="">
                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-home text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                    </div>
                    <span class="nav-link-text ms-1">Certificacion Webinar</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ (Request::is('/notas/cam') ? 'active' : '') }}" href="{{ route('notascam.index') }}" target="">
                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-spinner text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                    </div>
                    <span class="nav-link-text ms-1">Estatus Estandares</span>
                </a>
            </li>

            @can('menu-profesores-admins')
            <li class="nav-item">
                <a class="nav-link {{ (Request::is('/profesor/inicio*') ? 'active' : '') }}" href="{{ route('dashboard.index') }}" target="">
                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-home text-sm opacity-10" style="color: #ccc"></i>
                    </div>
                    <span class="nav-link-text ms-1">Panel de Profesor</span>
                </a>
            </li>
            @endcan

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

                    </li>
                </ul>
                </div>
            </li>

            @can('productos-show')
                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('admin/products') ? 'active' : '') }}" href="{{ route('products.index') }}">
                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-ticket text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                    </div>
                    <span class="nav-link-text ms-1">Productos</span>
                    </a>
                </li>
            @endcan

                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('/recursos') ? 'active' : '') }}" href="{{ route('recursos.index') }}">
                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-camera text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                    </div>
                    <span class="nav-link-text ms-1">Biblioteca</span>
                    </a>
                </li>
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#pagesExamplesCursos" class="nav-link {{ (Request::is('admin/notas/cursos*') ? 'active' : '') }}" aria-controls="pagesExamplesCursos" role="button" aria-expanded="false">
                <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                    <i class="fas fa-file-invoice-dollar text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                </div>
                <span class="nav-link-text ms-1">Notas</span>
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
                                <span class="sidenav-normal">Notas Productos</span>
                            </a>
                        @endcan

                        <a class="nav-link {{ (Request::is('admin/notas/productos/*') ? 'show' : '') }}" href="{{ route('notas_cotizacion.index') }}">
                            <span class="sidenav-mini-icon"> P </span>
                            <span class="sidenav-normal">Notas Cotizaciones</span>
                        </a>

                    </li>
                </ul>
                </div>
            </li>

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

                    <a class="nav-link {{ (Request::is('admin/pagos-por-fuera/pendientes*') ? 'show' : '') }}" href="{{ route('pagos.pendientes') }}">
                        <span class="sidenav-mini-icon"> P </span>
                        <span class="sidenav-normal">Verificar Pagos</span>
                    </a>

                    <a class="nav-link {{ (Request::is('admin/comprobar_transferencias*') ? 'show' : '') }}" href="{{ route('trasnferencias.index') }}">
                        <span class="sidenav-mini-icon"> P </span>
                        <span class="sidenav-normal">Comprar Transferencias</span>
                    </a>

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
                        <i class="fa fa-money text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                    </div>
                    <span class="nav-link-text ms-1">Mercado Pago</span>
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

            <li class="nav-item">
                <a class="nav-link {{ (Request::is('/registro/imnas*') ? 'active' : '') }}" href="{{ route('index.imnas') }}">
                <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-list-alt text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                </div>
                <span class="nav-link-text ms-1">Registros IMNAS</span>
                </a>
            </li>

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

            @can('profesores-show')
                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('admin/profesores*') ? 'active' : '') }}" href="{{ route('profesores.index') }}">
                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-school text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profesores</span>
                    </a>
                </li>
            @endcan

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

            @can('envios-show')
                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('/admin/envios*') ? 'active' : '') }}" href="{{ route('envios.index') }}">
                        <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-box text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                        </div>
                        <span class="sidenav-normal">Envios</span>
                    </a>
                </li>
            @endcan

            <li class="nav-item mt-3">
                <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Web Page</h6>
            </li>

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
                        @can('envios-show')
                            <a class="nav-link {{ (Request::is('users*') ? 'active' : '') }}" href="{{ route('webpage.edit',1) }}">
                                <span class="sidenav-mini-icon"></span>
                                <span class="sidenav-normal">Pagina Web</span>
                            </a>
                        @endcan

                        <a class="nav-link {{ (Request::is('admin/estandares*') ? 'active' : '') }}" href="{{ route('estandares.index') }}">
                            <span class="sidenav-mini-icon"></span>
                            <span class="sidenav-normal">Estandares</span>
                        </a>

                        <a class="nav-link {{ (Request::is('admin/revoes*') ? 'active' : '') }}" href="{{ route('revoes.index') }}">
                            <span class="sidenav-mini-icon"></span>
                            <span class="sidenav-normal">Rvoes</span>
                        </a>

                        <a class="nav-link {{ (Request::is('admin/comentarios*') ? 'active' : '') }}" href="{{ route('comentarios.index') }}">
                            <span class="sidenav-mini-icon"></span>
                            <span class="sidenav-normal">Comentarios</span>
                        </a>

                        <a class="nav-link {{ (Request::is('admin/noticias*') ? 'active' : '') }}" href="{{ route('noticias.index') }}">
                            <span class="sidenav-mini-icon"></span>
                            <span class="sidenav-normal">Noticias</span>
                        </a>

                    </li>
                </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ (Request::is('admin/manual') ? 'active' : '') }}" href="{{ route('manual.index') }}">
                <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-ticket text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                </div>
                <span class="nav-link-text ms-1">Manual de Usuario</span>
                </a>
            </li>


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

                        <a class="nav-link {{ (Request::is('admin/documentos/tipos*') ? 'show' : '') }}" href="{{ route('documentos.index') }}">
                            <span class="sidenav-mini-icon"> P </span>
                            <span class="sidenav-normal">Tipos de Documentos</span>
                        </a>

                        <a class="nav-link {{ (Request::is('admin/documentos/generar*') ? 'show' : '') }}" href="{{ route('generar_documentos.index') }}">
                            <span class="sidenav-mini-icon"> P </span>
                            <span class="sidenav-normal">Reporte Generados</span>
                        </a>

                        <a class="nav-link {{ (Request::is('admin/documentos/faltantes*') ? 'show' : '') }}" href="{{ route('documentos.faltantes') }}">
                            <span class="sidenav-mini-icon"> P </span>
                            <span class="sidenav-normal">Documentos faltantes</span>
                        </a>

                    </li>
                </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ (Request::is('admin/paquetes') ? 'active' : '') }}" href="{{ route('paquetes.index') }}">
                <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-shopping-bag text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                </div>
                <span class="nav-link-text ms-1">Paquetes</span>
                </a>
            </li>

            <li class="nav-item mt-3">
            <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Administrativo</h6>
            </li>

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

            @can('configuracion')
                <li class="nav-item mt-3">
                <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Configuraciones</h6>
                </li>

                <li class="nav-item">
                <a data-bs-toggle="collapse" href="#sistem" class="nav-link {{ (Request::is('users*') ? 'active' : '') }}{{ (Request::is('roles*') ? 'active' : '') }}" aria-controls="sistem" role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                    <i class="ni ni-settings-gear-65 text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                    </div>
                    <span class="nav-link-text ms-1">Configuraciones</span>
                </a>

                <div class="collapse " id="sistem">
                    <ul class="nav ms-4">
                    <li class="nav-item ">
                        <a class="nav-link {{ (Request::is('configuracion*') ? 'show' : '') }}" href="{{ route('index.configuracion') }}">
                        <span class="sidenav-mini-icon">U</span>
                        <span class="sidenav-normal">Pagina</span>
                        </a>
                    </li>
                    </ul>
                </div>
                @endcan

                @can('menu-cam')

                <li class="nav-item mt-3">
                    <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Menu CAM</h6>
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
                            <a data-bs-toggle="collapse" href="#pagesExamplesAdmin" class="nav-link {{ (Request::is('admin/cursos*') ? 'active' : '') }}" aria-controls="pagesExamplesAdmin" role="button" aria-expanded="false">
                            <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                                <i class="fa fa-graduation-cap text-sm opacity-10" style="color:#6EC1E4"></i>
                            </div>
                            <span class="nav-link-text ms-1">Expedientes</span>
                            </a>
                            <div class="collapse " id="pagesExamplesAdmin">
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
                            <a class="nav-link {{ (Request::is('estandares/index') ? 'active' : '') }}" href="{{ route('index.estandares') }}">
                            <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                                <i class="fa fa-ticket text-sm opacity-10" style="color:#6EC1E4"></i>
                            </div>
                            <span class="nav-link-text ms-1">Estandares</span>
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
        </ul>

    </aside>
@endcan
