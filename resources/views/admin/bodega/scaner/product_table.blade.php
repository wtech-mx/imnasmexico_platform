{{-- filepath: /c:/laragon/www/imnasmexico_platform/resources/views/admin/bodega/scaner/product_table.blade.php --}}
<table class="table">
    <thead class="text-center">
        <tr>
            <th>Cantidad</th>
            <th>Producto</th>
            <th>Progreso</th>
            <th>Estatus</th>
        </tr>
    </thead>
    <tbody class="text-center">
        @foreach ($productos_scaner as $nota_producto)
            <tr data-id="{{ $nota_producto->id_notas_productos }}">
                <td>
                   <b></b> {{ $nota_producto->cantidad }}</b> <br> <br>
                   @if ($nota_producto->Productos->sku == NULL)
                       <b>SKU no disponible</b>
                   @else
                    @php
                        // Si tu SKU viene con guiones bajos y sólo quieres la parte antes del primero:
                        $codigo = $nota_producto->Productos->sku;
                    @endphp
                    <img
                        src="data:image/png;base64,{{
                        DNS1D::getBarcodePNG(
                            $codigo,
                            'C128',
                            1.6,
                            35,
                            [0,0,0],
                            true
                        )
                        }}"
                        alt="Barcode de {{ $codigo }}">
                  @endif
                </td>
                <td>
                    <img src="{{ $nota_producto->Productos->imagenes }}" alt="" style="width: 60px"><br>
                    {{ $nota_producto->Productos->nombre }}
                </td>
                <td data-sku="{{ $nota_producto->Productos->sku ?? '' }}" data-cantidad="{{ $nota_producto->cantidad }}">
                    <span class="contador">{{ $nota_producto->escaneados }}/{{ $nota_producto->cantidad }}</span>
                </td>
                <td id="status-{{ $nota_producto->Productos->sku ?? '' }}">
                    @if ($nota_producto->estatus === 1)
                        ✔️
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
