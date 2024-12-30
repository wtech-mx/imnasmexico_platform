<form action="{{ route('notas_cotizacion.imprimir_reporte') }}" method="GET" >
    @csrf
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

                <div class="col-6 align-self-end">
                    <button type="submit" name="action" value="Filtrar" class="btn btn-primary">Filtrar</button>
                    <button type="submit" name="action" value="Generar PDF" class="btn btn-success">Generar PDF</button>
                    <button type="submit" name="action" value="Resetear" class="btn btn-danger">Resetear</button>
                    <button type="submit" name="action" value="Generar PDF Global" class="btn btn-success">Generar PDF Global Ventas</button>
                </div>
            </div>
    </div>
</form>
