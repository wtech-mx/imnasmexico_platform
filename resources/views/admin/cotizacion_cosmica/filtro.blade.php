<div class="card">
    <form action="{{ route('cotizacion_cosmica.imprimir_reporte') }}" method="GET">
        <div class="card-body" style="padding-left: 1.5rem; padding-top: 1rem;">
            <h5>Filtro</h5>
            <div class="row">
                <div class="col-3">
                    <label for="user_id">Fecha Inicio:</label>
                    <input type="date" class="form-control" name="fecha_inicio" value="{{ date('Y-m-d') }}">
                </div>
                <div class="col-3">
                    <label for="user_id">Fecha Fin:</label>
                    <input type="date" class="form-control" name="fecha_fin" value="{{ date('Y-m-d') }}">
                </div>
                <div class="col-3 align-self-end">
                    <button type="submit" name="action" value="Filtrar" class="btn btn-primary">Filtrar</button>
                    <button type="submit" name="action" value="Generar PDF" class="btn btn-success">Generar PDF</button>
                    <button type="submit" name="action" value="Generar PDF Global" class="btn btn-success">Generar PDF Global Ventas</button>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('cotizacion_cosmica.index') }}" class="btn btn-sm btn-success m-2" style="background: #322338">Cotizaciones
                            <img src="{{asset('assets/user/icons/prueba.webp') }}" alt="Imagen" style="width: 25px; height: 25px;"/>
                        </a>
                        <a href="{{ route('pedidos_cosmica_woo.index') }}" class="btn btn-sm m-2 text-white" style="background:#B600E3;">Tienda Online
                            <img src="{{asset('assets/user/icons/carrito-de-compras.webp') }}" alt="Imagen" style="width: 25px; height: 25px;"/>
                        </a>
                        <a href="{{ route('pedidos_cosmica_ecommerce.index') }}" class="btn btn-sm m-2 text-white" style="background:#660080;">Ecommerce
                            <img src="{{asset('assets/user/icons/order.webp') }}" alt="Imagen" style="width: 25px; height: 25px;"/>
                            <span class="badge rounded-pill bg-danger">
                                {{ $oreder_cosmica ? $oreder_cosmica->count() : 0 }}
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
