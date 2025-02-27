
<style>
    .chat-container {
        max-height: 400px;
        overflow-y: auto;
    }

    .message {
        margin-bottom: 15px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .message-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 5px;
    }

    .message-body img {
        max-width: 100%;
        height: auto;
        margin-top: 10px;
    }

    .message-body a {
        display: block;
        margin-top: 10px;
    }
</style>
<!-- Modal -->
<div class="modal fade" id="reporte_{{ $nota->id }}" tabindex="-1" aria-labelledby="chatModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="chatModalLabel">Reporte de Chat {{ $nota->folio }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color: red"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body">
                <!-- Mensajes -->
                @foreach ($reportes as $reporte)
                    @if ($nota->id == $reporte->id_cotizacion_cosmica)
                        <div class="chat-messages" id="chatMessages">
                            <div class="message">
                                <div class="message-header">
                                    <strong>{{$reporte->User->name}}</strong> <span class="text-muted">{{$reporte->fecha}}</span>
                                </div>
                                <div class="message-body">
                                    <div class="row">
                                        <p>{{$reporte->descripcion}}</p>
                                        @foreach ($reportes_archivos as $reporte_archivo)
                                            @if ($reporte_archivo->id_reporte == $reporte->id)
                                                <div class="col-3">
                                                    <img src="{{ asset('reportes_cosmica/'.$reporte_archivo->foto) }}" alt="Imagen" class="img-fluid" style="max-width: 50px;">
                                                    <a href="{{ asset('reportes_cosmica/'.$reporte_archivo->foto) }}" download>Descargar</a>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

                <!-- Formulario para enviar mensajes -->
                <form method="POST" action="{{ route('peril_cliente.reporte_cosmica') }}" enctype="multipart/form-data" role="form" >
                    @csrf
                    <div class="input-group mt-3">
                        <input type="text" name="id_cotizacion" id="id_cotizacion" value="{{ $nota->id }}" hidden>
                        <textarea class="form-control" id="mensaje" name="mensaje" cols="30" rows="3" placeholder="Escribe un mensaje..."></textarea>
                        <input type="file" class="form-control" id="fileInput" name="fotos[]" multiple>
                        <button class="btn btn-primary" type="submit">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


