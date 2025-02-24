@if($nota->total <= '700')
@else
    <a class="btn btn-xs" target="_blank" href="{{ route('cotizacion_cosmica.meli_show', $nota->id) }}" style="background: #FFE600; color: #ffff">
        <img src="https://http2.mlstatic.com/frontend-assets/ml-web-navigation/ui-navigation/6.6.92/mercadolibre/logo_large_25years_v2.png" alt="" style="width: 35px">
    </a>
@endif
<a class="btn btn-sm btn-info text-white" target="_blank" href="{{ route('cotizacion_cosmica.imprimir', ['id' => $nota->id]) }}">
    <i class="fa fa-file"></i>
</a>
@php
    $total = 0;$totalCantidad = 0;
@endphp
@can('nota-productos-editar')
    <a class="btn btn-sm btn-warning" href="{{ route('cotizacion_cosmica.edit', $nota->id) }}">
        <i class="fa fa-fw fa-edit"></i>
    </a>
@endcan

