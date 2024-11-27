<h4 class="text-center mb-3">Total</h4>
<h5 class="text-center">${{ $totalPagadoFormateado }}</h5>
<div class="d-flex justify-content-center mt-3">
    <form method="POST" action="{{ route('reporte_custom.store') }}" enctype="multipart/form-data" role="form">
        @csrf
        <input type="hidden" name="fecha_inicio" value="{{ $fechaInicioSemana }}">
        <input type="hidden" name="fecha_fin" value="{{ $fechaFinSemana }}">
        <button type="submit" class="btn close-modal">Enviar Reporte</button>
    </form>
</div>
