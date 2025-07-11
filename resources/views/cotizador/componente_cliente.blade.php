                <div class="col-12">
                    <h5 class="p-2">Cliente</h5>

                    <div class="row">

                        <div class="col-12">
                            <div id="reconocimiento-container" class="mt-2">
                                <!-- Este bloque sólo aparece si NO hay reconocimiento -->
                                <div id="reconocimiento-upload" class="d-none">
                                    <label for="reconocimiento">Sube su diploma:</label>
                                    <input type="file" name="reconocimiento" id="reconocimiento" accept="image/*,application/pdf" class="form-control" form="formGuardarPedido"/>
                                </div>

                                <!-- Este bloque sólo aparece si YA hay reconocimiento -->
                                <div id="reconocimiento-message" class="alert alert-info d-none">
                                    📄 Ya tiene un diploma cargado.
                                </div>

                                <!-- Este bloque es para membresía -->
                                <div id="membership-container" class="mt-2">
                                    <div id="membership-message" class="alert d-none"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-4  col-md-2 col-lg-2 my-auto">
                            <button class="btn btn-success btn-sm w-100" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                <i class="bi bi-plus-circle"></i> Agregar
                            </button>
                        </div>

                        <div class="col-8 col-md-10 col-lg-10">
                            <input type="text" id="usuarioInput" class="form-control" placeholder="Escribe nombre o teléfono…"/>
                        </div>

                        <div class="col-12">
                            <div class="collapse" id="collapseExample">
                                <div class="card card-body sidebar mt-3" style="border: solid 0px;">
                                    <div class="row">

                                        <div class="form-group col-12 col-md-5 col-lg-5">
                                            <label for="name">Nombre *</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="25px">
                                                </span>
                                                {{-- <input id="name" name="name" type="text" class="form-control" placeholder="Nombre" value="{{old('name')}}" form="formGuardarPedido"> --}}
                                                <input type="text" id="name" name="name" class="form-control" placeholder="Nombre" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" title="Solo letras y espacios" value="{{ old('name') }}" form="formGuardarPedido">
                                            </div>
                                        </div>

                                        <div class="form-group col-12 col-md-3 col-lg-3">
                                            <label for="name">Telefono *</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('assets/cam/llamar.png') }}" alt="" width="25px">
                                                </span>
                                                {{-- <input type="tel" id="telefono" name="telefono" class="form-control" placeholder="Telefono" pattern="[0-9]{10}"  minlength="10" maxlength="10" value="{{old('telefono')}}" form="formGuardarPedido"> --}}
                                                <input type="tel" id="telefono" name="telefono" class="form-control" placeholder="Teléfono" pattern="[0-9]{10}" inputmode="numeric" maxlength="10" minlength="10" title="Debe contener exactamente 10 dígitos numéricos" value="{{ old('telefono') }}" form="formGuardarPedido">
                                            </div>
                                        </div>

                                        <div class="form-group col-12 col-md-4 col-lg-4">
                                            <label for="reconocimiento">Sube su diploma:</label>
                                            <input type="file" name="reconocimiento_new" id="reconocimiento_new" accept="image/*,application/pdf" class="form-control" form="formGuardarPedido"/>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const inputTelefono = document.getElementById('telefono');
    const inputNombre = document.getElementById('name');
    console.log(inputTelefono);
    if (inputTelefono) {
        inputTelefono.addEventListener('input', function () {
            this.value = this.value.replace(/\D/g, '');
        });
    }

    if (inputNombre) {
        inputNombre.addEventListener('input', function () {
            this.value = this.value.replace(/[0-9]/g, '');
        });
    }

    // 🟡 Aquí continúa tu código actual de búsqueda, toast, etc...
});


</script>
