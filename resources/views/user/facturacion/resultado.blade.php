{{-- resources/views/user/facturacion/_resultado.blade.php --}}
<div class="table-responsive">
    <table class="table table-bordered text-center">
      <thead class="table-dark">
        <tr>
          <th>Folio</th>
          <th>Cliente</th>
          <th>Fecha</th>
          <th>Total</th>
          <th>Estatus</th>
          <th>Acción</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{ $nota->folio  ?? '—' }}</td>
          <td>{{ optional($nota->User)->name ?? '—' }}</td>
          <td>{{ \Carbon\Carbon::parse($nota->fecha)->format('d-m-Y') }}</td>
          <td>${{ number_format($nota->total, 2) }}</td>
          <td>{{$nota->FacturaOrders->estatus}}</td>
          <td>
            @if($tipo === 'nas')
              <a target="_blank"
                 href="{{ route('notas_cotizacion.imprimir', ['id' => $nota->id]) }}"
                 class="btn btn-sm btn-primary">
                Ver Cotización NAS
              </a>
              @if ($nota->FacturaOrders->archivo_factura !== NULL)
                <a href="{{ asset('facturas_pdf/' . $nota->FacturaOrders->archivo_factura) }}" download="Factura_{{$nota->id}}.pdf">Descargar Factura</a>
              @endif
            @elseif ($tipo === 'cosmica')

              <a target="_blank"
                 href="{{ route('cotizacion_cosmica.imprimir', ['id' => $nota->id]) }}"
                 class="btn btn-sm btn-primary">
                Ver Cotización Cosmica
              </a><br>
              @if ($nota->FacturaOrders->archivo_factura !== NULL)
                <a href="{{ asset('facturas_pdf/' . $nota->FacturaOrders->archivo_factura) }}" download="Factura_{{$nota->id}}.pdf">Descargar Factura</a>
              @endif
            @endif
          </td>
        </tr>
      </tbody>
    </table>
</div>

@include('user.facturacion.datos_facturacion')


