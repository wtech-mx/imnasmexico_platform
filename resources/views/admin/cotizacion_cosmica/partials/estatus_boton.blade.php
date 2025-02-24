@if ($nota->estatus_cotizacion == 'Aprobada')
    <a class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#estatus_{{ $nota->id }}" style="background: #06a306;">
        Aprobada
    </a>
    @elseif($nota->estatus_cotizacion == NUll)
    <a class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#estatus_{{ $nota->id }}" title="Editar Estatus" style="background: #b105e0;">
        Pendiente
    </a>

@elseif($nota->estatus_cotizacion == 'Cancelada')
    <a class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#estatus_{{ $nota->id }}" title="Editar Estatus" style="background: #ff0202;">
        Cancelada
    </a>
@else
    <a class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#estatus_{{ $nota->id }}" title="Editar Estatus" style="background: #19da53;">
        {{ $nota->estatus_cotizacion }}
    </a>
@endif
@include('admin.cotizacion_cosmica.modal_estatus', ['nota' => $nota])
