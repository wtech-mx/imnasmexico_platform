<!-- MODAL -->
<div class="modal fade" id="modalAlertas" tabindex="-1" aria-labelledby="modalAlertasLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Alertas de Membresías IMNAS</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">

        {{-- VENCIDOS --}}
        @if(count($vencidos))
          <h6 class="text-danger">🔴 Vencidos</h6>
          <ul>
            @foreach($vencidos as $v)
              <li>
                {{ $v->User->name }} - {{ $v->User->escuela }} <br>
                <b>(Venció: {{ \Carbon\Carbon::parse($v->fecha)->addYear()->format('d/m/Y') }})</b>
                {{-- <form action="{{ route('registro-imnas.ignorar', $v->id) }}" method="POST" class="d-inline">
                  @csrf
                  @method('PUT')
                  <button type="submit" class="btn btn-sm btn-outline-secondary">Quitar</button>
                </form> --}}
              </li>
            @endforeach
          </ul>
        @endif

        {{-- POR VENCER 1 A 5 --}}
        @if(count($por_vencer_1_5))
          <h6 class="text-warning">🟠 Por vencer (1 a 5 días)</h6>
          <ul>
            @foreach($por_vencer_1_5 as $v)
              <li>{{ $v->User->name }} - {{ $v->User->escuela }}<br> <b>(Vence: {{ \Carbon\Carbon::parse($v->fecha)->addYear()->format('d/m/Y') }})</b></li>
            @endforeach
          </ul>
        @endif

        {{-- POR VENCER 6 A 10 --}}
        @if(count($por_vencer_6_10))
          <h6 class="text-info">🟡 Próximos a vencer (6 a 10 días)</h6>
          <ul>
            @foreach($por_vencer_6_10 as $v)
              <li>{{ $v->User->name }} - {{ $v->User->escuela }} <br><b>(Vence: {{ \Carbon\Carbon::parse($v->fecha)->addYear()->format('d/m/Y') }})</b></li>
            @endforeach
          </ul>
        @endif

      </div>
    </div>
  </div>
</div>
