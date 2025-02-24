<div class="row d-block">
    <div class="col-6">
        <a class="btn btn-sm btn-info text-white" target="_blank" href="{{ route('cotizacion_cosmica.imprimir', ['id' => $nota->id]) }}">
            <i class="fa fa-file"></i>
        </a>
        {{-- @can('nota-productos-editar')
            <a class="btn btn-sm btn-warning" href="{{ route('cotizacion_cosmica.edit', $nota->id) }}">
                <i class="fa fa-fw fa-edit"></i>
            </a>
        @endcan --}}
    </div>
    {{-- <div class="col-6">
        <a class="btn btn-xs" target="_blank" href="{{ route('cotizacion_cosmica.meli_show', $nota->id) }}" style="background: #FFE600; color: #ffff">
            <img src="https://http2.mlstatic.com/frontend-assets/ml-web-navigation/ui-navigation/6.6.92/mercadolibre/logo_large_25years_v2.png" alt="" style="width: 35px">
        </a>
        <a type="button" class="btn btn-xs" data-bs-toggle="modal" data-bs-target="#guiaModal{{ $nota->id }}" style="background: #e6ab2d; color: #ffff">
            <i class="fa fa-truck"></i>
        </a>
        <a type="button" class="btn btn-xs" data-bs-toggle="modal" data-bs-target="#pagoModal{{ $nota->id }}" style="background: #2d6ee6; color: #ffff">
            <i class="fa fa-credit-card-alt"></i>
        </a>
    </div> --}}
</div>
@include('admin.cotizacion_cosmica.guia', ['nota' => $nota])
@include('admin.cotizacion_cosmica.modal_pago', ['nota' => $nota])
@include('admin.cotizacion_cosmica.modal_estatus', ['nota' => $nota])
