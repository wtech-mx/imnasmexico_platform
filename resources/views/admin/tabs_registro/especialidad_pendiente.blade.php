<div class="table-responsive">
    <table class="table table-flush" id="datatable-search">
        <thead class="thead">
            <tr>
                <th>Accion</th>
                <th>Cliente</th>
                <th>Especialidad</th>
                <th>Fecha en <br> que solicita.</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($especialidades_pendientes as $registro_pendiente)
                <tr>
                    <td>
                        @php
                            $subtemas = \App\Models\RegistroImnasTemario::where('id_materia', $registro_pendiente->id)->pluck('subtema')->toArray();
                        @endphp
                        {{-- <a class="btn btn-sm btn-info text-white" target="_blank" href="{{ route('imprimir_especialidad.imprimir', $registro_pendiente->id) }}">
                            <i class="fa fa-list-alt"></i>
                        </a> --}}
                        <button class="btn btn-sm btn-primary"
                                data-especialidad="{{ $registro_pendiente->especialidad }}"
                                data-subtemas="{{ json_encode($subtemas) }}"
                                onclick="copyToClipboard(this)">
                            Copiar Temario
                        </button><br><br>

                        <div class="form-check">
                            <label for="">Enviado a la Lic</label>
                            <input type="checkbox" class="form-check-input change-status" data-id="{{ $registro_pendiente->id }}" {{ $registro_pendiente->estatus_imnas == 0 ? 'checked' : '' }}>
                        </div>
                    </td>
                    <td>
                        <h5> @php
                            $words = explode(' ', $registro_pendiente->User->name);
                            $chunks = array_chunk($words, 3);
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
                            $words = explode(' ', $registro_pendiente->especialidad);
                            $chunks = array_chunk($words, 4);
                            foreach ($chunks as $chunk) {
                                echo implode(' ', $chunk) . '<br>';
                            }
                        @endphp
                    </td>
                    <td>{{ \Carbon\Carbon::parse($registro_pendiente->created_at)->translatedFormat('d F \\d\\e\\l Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@section('js_custom')
<script>
    function copyToClipboard(button) {
        // Obtener la especialidad y los subtemas desde los data attributes
        const especialidad = button.getAttribute('data-especialidad');
        const subtemas = JSON.parse(button.getAttribute('data-subtemas'));

        // Formato del texto a copiar
        let text = `*${especialidad}*\n\nSubtemas:\n`;
        subtemas.forEach(subtema => {
            text += `${subtema}\n`;
        });

        // Crear un elemento temporal para copiar
        const tempInput = document.createElement('textarea');
        tempInput.value = text;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand('copy');
        document.body.removeChild(tempInput);

        // Confirmación de copiado
        alert("Texto copiado al portapapeles");
    }

    $(document).ready(function() {
        $('.change-status').on('change', function() {
            var especialidadId = $(this).data('id');
            var estatus = $(this).is(':checked') ? 0 : 1;  // Si el checkbox está marcado, el estatus será 0

            $.ajax({
                url: '{{ route("actualizar.estatus") }}',  // Ruta al controlador
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',  // Token de seguridad de Laravel
                    id: especialidadId,
                    estatus: estatus
                },
                success: function(response) {
                    alert('Estatus actualizado');
                },
                error: function(xhr) {
                    console.log(xhr.responseText);  // Mostrar error en consola si hay problemas
                }
            });
        });

        $('.change-status-envio').on('change', function() {
            var especialidadId = $(this).data('id');
            var estatus = $(this).is(':checked') ? 0 : 1;  // Si el checkbox está marcado, el estatus será 0
            console.log(especialidadId);
            $.ajax({
                url: '{{ route("actualizar.estatus_envio") }}',  // Ruta al controlador
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',  // Token de seguridad de Laravel
                    id: especialidadId,
                    estatus: estatus
                },
                success: function(response) {
                    alert('Estatus actualizado');
                },
                error: function(xhr) {
                    console.log(xhr.responseText);  // Mostrar error en consola si hay problemas
                }
            });
        });
    });
</script>

@endsection
