@if (pathinfo($documento->curp, PATHINFO_EXTENSION) == 'pdf')
<p class="text-center ">
    <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->curp)}}" style="width: 60%; height: auto;"></iframe>
</p>
        <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->curp) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver archivo</a>
@elseif (pathinfo($documento->curp, PATHINFO_EXTENSION) == 'doc')
<p class="text-center ">
    <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 60px; height: auto;"/>
</p>
<a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->curp) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
@elseif (pathinfo($documento->curp, PATHINFO_EXTENSION) == 'docx')
<p class="text-center ">
    <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 60px; height: auto;"/>
</p>
<a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->curp) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
@else
    <p class="text-center mt-2">
        <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->curp) }}" alt="Imagen" style="width: 60px;height: auto;"/><br>
    </p>
        <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->curp) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver Imagen</a>
@endif
@if ($cliente->name != 'Asiyadeth Virginia Hernández Cruz')
    <button type="button" class="btn btn-danger btn-sm mt-2" onclick="eliminarDocumento('{{ route('eliminar.documentoper', ['id' => $documento->id, 'tipo' => 'curp']) }}')">Eliminar</button>
@endif
