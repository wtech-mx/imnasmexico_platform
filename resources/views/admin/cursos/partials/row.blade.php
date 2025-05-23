<tr class="{{ ($order->estatus_doc && $order->estatus_cedula && $order->estatus_titulo
               && $order->estatus_diploma && $order->estatus_credencial && $order->estatus_tira)
               ? 'estatus-doc-green' : 'estatus-doc-red' }}">
  <td>{{ $counter }}</td>

  <td>
    <a href="{{ route('perfil.show', $order->User->id) }}"
       target="_blank"
       class="text-primary">
      {{ $order->User->name }}
    </a><br>
    {{ $order->User->telefono }}<br>
    {{ $order->User->email }}
  </td>

  <td>
    {{ $order->orders->forma_pago }}<br>
      Subido por: <br>
      @if($order->orders->id_externo)
        {{ $order->orders->PagosFuera->usuario }}
      @elseif($order->orders->id_admin)
        {{ $order->orders->Admin->name }}
      @else
        Pago por página
      @endif
  </td>

  <td>
    ${{ number_format($order->orders->pago,2) }}<br>
    <small>{{ $order->orders->fecha }}</small>
  </td>

  <td>{{ $order->orders->id_externo ?? '' }}</td>

  <td>
    {{-- Documentación resumida --}}
    @switch($ticket->descripcion)
      @case('Con opción a Documentos de certificadora IMNAS') IMNAS @break
      @case('Opción a certificación a masaje holístico EC0900') Certificación a masaje holístico @break
      @default
        @if($ticket->Cursos->imnas) IMNAS @endif
        @if($ticket->Cursos->titulo_hono) - Título Honorífico @endif
        @if($ticket->Cursos->stps) STPS @endif
        @if($ticket->Cursos->redconocer) SepConocer @endif
        @if($ticket->Cursos->unam) UNAM @endif
    @endswitch
  </td>


  <td>
    @if(optional($order->orders->PagosFuera)->deudor)
      <span class="badge bg-danger">DEUDOR</span>
    @else
    No
    @endif
  </td>

  {{-- Aquí incluimos nuestros botones --}}
  <td>
    @include('admin.cursos.partials.buttons', ['order' => $order, 'ticket' => $ticket])
                                                            @include('admin.cursos.modal_imnas_documentos')
                                                        @include('admin.cursos.modal_documentos')
                                                        @include('admin.cursos.modal_guia')
  </td>

</tr>
