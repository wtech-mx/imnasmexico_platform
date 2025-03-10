
<!-- Card Basic Info -->
@php
    use Carbon\Carbon;
    $fechaFormateada = Carbon::parse($cliente->created_at)->locale('es')->isoFormat('DD [de] MMMM YYYY hh:mm a');
@endphp
<form method="POST" action="{{ route('perfil.update_situacionfiscal', $cliente->id) }}" enctype="multipart/form-data" role="form">
    @csrf
    <input type="hidden" name="_method" value="PATCH">
        <div class="card mt-4" id="basic-info">
            <div class="card-header">
                <h5>Información basica</h5>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                <div class="col-12">
                    <label class="form-label">Fecha de registro</label>
                    <div class="input-group">
                    <p>{{$fechaFormateada }}</p>
                    </div>
                </div>
                <div class="col-6">
                    <label class="form-label">Nombre</label>
                    <div class="input-group">
                    <input id="name" name="name" class="form-control" type="text" value="{{$cliente->name}}" >
                    </div>
                </div>
                <div class="col-6">
                    <label class="form-label">Correo</label>
                    <div class="input-group">
                    <input id="email" name="email" class="form-control" type="email" value="{{$cliente->email}}" >
                    </div>
                </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 col-6">
                        <label class="form-label mt-4">Telefono</label>
                        <input id="telefono" name="telefono" class="form-control" type="number" value="{{$cliente->telefono}}" >
                    </div>
                    <div class="col-sm-4 col-6">
                        <label class="form-label mt-4">Ciudad</label>
                        <input id="city" name="city" class="form-control" type="text" value="{{$cliente->city}}" >
                    </div>
                    <div class="col-sm-4 col-6">
                        <label class="form-label mt-4">Estado</label>
                        <input id="estado" name="estado" class="form-control" type="text" value="{{$cliente->state}}" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label class="form-label mt-4">Dirección</label>
                        <div class="input-group">
                        <input id="direccion" name="direccion" class="form-control" type="email" value="{{$cliente->direccion}}">
                        </div>
                    </div>
                    <div class="col-3">
                        <label class="form-label mt-4">Codigo postal</label>
                        <div class="input-group">
                        <input id="postcode" name="postcode" class="form-control" type="email" value="{{$cliente->postcode}}">
                        </div>
                    </div>
                    <div class="col-3">
                        <label class="form-label mt-4">Ciudad</label>
                        <div class="input-group">
                        <input id="country" name="country" class="form-control" type="email" value="{{$cliente->country}}">
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
            </div>
        </div>


    </form>
