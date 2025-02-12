
<!-- Card Basic Info -->
<div class="card mt-4" id="basic-info">
    <div class="card-header">
        <h5>Información basica</h5>
    </div>
    <div class="card-body pt-0">
        <div class="row">
        <div class="col-12">
            <label class="form-label">Fecha de registro</label>
            <div class="input-group">
            <p>{{$cliente->created_at}}</p>
            </div>
        </div>
        <div class="col-6">
            <label class="form-label">Nombre</label>
            <div class="input-group">
            <input id="nombre" name="nombre" class="form-control" type="text" value="{{$cliente->name}}" readonly>
            </div>
        </div>
        <div class="col-6">
            <label class="form-label">Correo</label>
            <div class="input-group">
            <input id="email" name="email" class="form-control" type="email" value="{{$cliente->email}}" readonly>
            </div>
        </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-6">
                <label class="form-label mt-4">Telefono</label>
                <input id="telefono" name="telefono" class="form-control" type="number" value="{{$cliente->telefono}}" readonly>
            </div>
            <div class="col-sm-4 col-6">
                <label class="form-label mt-4">Ciudad</label>
                <input id="city" name="city" class="form-control" type="text" value="{{$cliente->city}}" readonly>
            </div>
            <div class="col-sm-4 col-6">
                <label class="form-label mt-4">Estado</label>
                <input id="estado" name="estado" class="form-control" type="text" value="{{$cliente->state}}" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <label class="form-label mt-4">Dirección</label>
                <div class="input-group">
                <input id="direccion" name="direccion" class="form-control" type="email" value="{{$cliente->direccion}}"readonly>
                </div>
            </div>
            <div class="col-3">
                <label class="form-label mt-4">Codigo postal</label>
                <div class="input-group">
                <input id="postcode" name="postcode" class="form-control" type="email" value="{{$cliente->postcode}}"readonly>
                </div>
            </div>
            <div class="col-3">
                <label class="form-label mt-4">Ciudad</label>
                <div class="input-group">
                <input id="country" name="country" class="form-control" type="email" value="{{$cliente->country}}"readonly>
                </div>
            </div>
        </div>
    </div>
</div>

