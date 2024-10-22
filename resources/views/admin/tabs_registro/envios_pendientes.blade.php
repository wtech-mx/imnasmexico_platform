<div class="table-responsive">
    <table class="table table-flush" id="datatable-search">
        <thead class="thead">
            <tr>
                <th>Accion</th>
                <th>Cliente</th>
                <th>Fecha en <br> que pago.</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($envios_pendientes as $envio_pendiente)
                <tr>
                    <td>
                        <div class="form-check">
                            <label for="">Envio utilizado</label>
                            <input type="checkbox" class="form-check-input change-status-envio" data-id="{{ $envio_pendiente->id }}" {{ $envio_pendiente->estatus_imnas != 0 ? 'checked' : '' }}>
                        </div>
                    </td>
                    <td>
                        <h5> @php
                            $words = explode(' ', $envio_pendiente->User->name);
                            $chunks = array_chunk($words, 3);
                            foreach ($chunks as $chunk) {
                                echo implode(' ', $chunk) . '<br>';
                            }
                        @endphp</h5>
                        <h6>{{ $envio_pendiente->User->telefono }}</h6>
                        @php
                            $words = explode(' ', $envio_pendiente->User->escuela);
                            $chunks = array_chunk($words, 4);
                            foreach ($chunks as $chunk) {
                                echo implode(' ', $chunk) . '<br>';
                            }
                        @endphp
                    </td>
                    <td>{{ \Carbon\Carbon::parse($envio_pendiente->Orders->fecha)->translatedFormat('d F \\d\\e\\l Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
