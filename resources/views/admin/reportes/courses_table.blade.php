<table class="table table-flush" id="datatable-search">
    <thead class="text-center">
        <tr class="tr_checkout">
            <th>Nombre</th>
            <th>Personas</th>
        </tr>
    </thead>
    <tbody>
        @foreach($cursosComprados as $curso)
            <tr>
                <td>
                    @php
                    $words = explode(' ', $curso['nombre']);
                    $chunks = array_chunk($words, 4);
                    foreach ($chunks as $chunk) {
                        echo implode(' ', $chunk) . '<br>';
                    }
                    @endphp
                </td>
                <td>{{ $curso['total'] }} personas</td>
            </tr>
        @endforeach
    </tbody>
</table>
