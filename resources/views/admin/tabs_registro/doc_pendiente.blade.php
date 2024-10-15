<div class="table-responsive">
    <table class="table table-flush" id="datatable-search">
        <thead class="thead">
            <tr>
                <th>Accion</th>
                <th>Cliente</th>
                <th>Alumno</th>
                <th>Fecha en <br> que subio Doc.</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($registros_pendientes as $registro_pendiente)
                <tr>
                    <td>
                        <a class="btn btn-sm btn-info" href="{{ route('show_cliente.imnas', $registro_pendiente->User->code) }}" target="_blank">
                            Ver
                        </a>
                    </td>
                    <td>
                       <h5> @php
                            $words = explode(' ', $registro_pendiente->User->name);
                            $chunks = array_chunk($words, 2);
                            foreach ($chunks as $chunk) {
                                echo implode(' ', $chunk) . '<br>';
                            }
                        @endphp</h5>
                        <h6>{{ $registro_pendiente->User->telefono }}</h6>
                        @php
                            $words = explode(' ', $registro_pendiente->User->escuela);
                            $chunks = array_chunk($words, 4);
                            foreach ($chunks as $chunk) {
                                echo implode(' ', $chunk) . '<br>';
                            }
                        @endphp
                    </td>
                    <td>
                        @php
                            $words = explode(' ', $registro_pendiente->nombre);
                            $chunks = array_chunk($words, 2);
                            foreach ($chunks as $chunk) {
                                echo implode(' ', $chunk) . '<br>';
                            }
                        @endphp
                    </td>
                    <td>{{ \Carbon\Carbon::parse($registro_pendiente->fecha_compra)->translatedFormat('d F \\d\\e\\l Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
