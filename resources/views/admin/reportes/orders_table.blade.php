<table class="table table-flush" id="datatable-search2">
    <thead class="text-center">
        <tr class="tr_checkout">
            <th>Cliente</th>
            <th>Fecha de Compra</th>
            <th>Total</th>
            <th>Forma de Pago</th>
            <th>Estado</th>
            <th>Vendedor</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
            <tr>
                <td>
                    @php
                        $words = explode(' ', $order->User->name);
                        $chunks = array_chunk($words, 2);
                        foreach ($chunks as $chunk) {
                            echo implode(' ', $chunk) . '<br>';
                        }
                    @endphp
                </td>

                <td>
                    @php
                        $fecha = $order->fecha;
                        $fecha_timestamp = strtotime($fecha);
                        $fecha_formateada = date('d \d\e F \d\e\l Y', $fecha_timestamp);

                        $words = explode(' ', $fecha_formateada);
                        $chunks = array_chunk($words, 3);
                        foreach ($chunks as $chunk) {
                            echo implode(' ', $chunk) . '<br>';
                        }
                    @endphp
                </td>

                <td>${{ number_format($order->pago, 2) }}</td>
                <td>
                    @php
                        $words = explode(' ', $order->forma_pago);
                        $chunks = array_chunk($words, 1);
                        foreach ($chunks as $chunk) {
                            echo implode(' ', $chunk) . '<br>';
                        }
                    @endphp
                </td>
                <td>{{ $order->estatus == '1' ? 'Completado' : 'En espera' }}</td>
                <td>{{ $order->PagosFuera->usuario }}</td>
                <td>
                    <a target="_blank" class="btn btn-sm btn-success" href="{{ route('pagos.edit_pago', $order->id) }}">
                        <i class="fa fa-fw fa-edit"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
