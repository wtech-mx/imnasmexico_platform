@php
    // Preparamos los datos para el WhatsApp
    $fechaFormateada = date('d-m-Y', strtotime($order->Cursos->fecha_inicial));
    $horaFormateada  = date('h:i A',   strtotime($order->Cursos->hora_inicial));
    $mensajeModalidad = $order->Cursos->modalidad === 'Online'
        ? '%0A%0ACon esta liga podrás acceder a tu clase el día '
          . $fechaFormateada . ' a las ' . $horaFormateada
          . '%0A%0A' . $order->Cursos->recurso
        : 'Recuerda asistir a nuestras instalaciones el día '
          . $fechaFormateada . ' a las ' . $horaFormateada;
    $mensajeAdicional = $order->Cursos->stps == 1
        ? 'Si tus diplomas no te llegaron al correo, podrás checarlos en tu perfil.'
        : '';
@endphp

{{-- WhatsApp --}}
<a class="btn btn-sm btn-success"
   href="https://api.whatsapp.com/send?phone={{ $order->User->telefono }}
         &text={{ urlencode('Hola ' . $order->User->name . $mensajeModalidad . '%0A%0A' . $mensajeAdicional) }}"
   target="_blank">
  <i class="fa fa-whatsapp"></i>
</a>

{{-- Documentos --}}
@switch($ticket->descripcion)
  @case('Con opción a Documentos de certificadora IMNAS')
    <a class="btn btn-sm btn-warning"
       data-bs-toggle="modal"
       data-bs-target="#modal_imnas_documentos_{{ $order->User->id }}">
      <i class="fa fa-file"></i>
    </a>
    @break

  @case('Opción a certificación a masaje holístico EC0900')
    <a class="btn btn-sm btn-warning">
      <i class="fa fa-file"></i>
    </a>
    @break

  @default
    <a class="btn btn-sm btn-warning"
       data-bs-toggle="modal"
       data-bs-target="#modal_documentos_{{ $order->User->id }}">
      <i class="fa fa-file"></i>
    </a>
@endswitch

{{-- Guía IMNAS --}}
<a class="btn btn-sm btn-dark"
   data-bs-toggle="modal"
   data-bs-target="#modal_imnas_guia_{{ $order->User->id }}">
  <i class="fa fa-truck"></i>
</a>

{{-- Enviar correo liga (si lo quieres mantener, revisa esta línea) --}}
{{--
<form method="POST" action="{{ route('cursos.correo', $order->id) }}" style="display:inline">
  @csrf
  <button class="btn btn-sm btn-primary" title="Enviar liga">
    <i class="fas fa-envelope"></i>
  </button>
</form>
--}}

{{-- Ver orden --}}
<a class="btn btn-sm btn-danger" href="{{ route('pagos.edit_pago', $order->orders->id) }}">
  <i class="fa fa-newspaper" title="Ver Orden"></i>
</a>

{{-- Descargar comprobante --}}
@if($order->orders->id_externo)
  @php $foto = $order->orders->PagosFuera->foto; @endphp
  <a class="btn btn-sm btn-primary"
     href="{{ asset('pago_fuera/'.$foto) }}"
     download>
    <i class="fa fa-credit-card-alt" title="Descargar comprobante"></i>
  </a>
@elseif($order->orders->id_admin)
  <a class="btn btn-sm btn-primary"
     href="{{ route('notas_cursos.imprimir', $order->orders->id_nota) }}"
     target="_blank">
    <i class="fa fa-credit-card-alt" title="Descargar comprobante"></i>
  </a>
@else
  <a class="btn btn-sm btn-primary"
     href="{{ route('lista.imprimir_mp', $order->orders->id) }}"
     target="_blank">
    <i class="fa fa-credit-card-alt" title="Descargar comprobante"></i>
  </a>
@endif
