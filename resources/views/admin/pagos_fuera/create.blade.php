@extends('layouts.app_admin')

@section('template_title')
    Subir pago
@endsection

@section('content')
<div class="container-fluid mt-3">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="mb-3">Subir pago</h3>
                    </div>
                </div>

                <div class="card-body mb-5">
                    <form method="POST" action="{{ route('pagos.store') }}" enctype="multipart/form-data" role="form">
                        @csrf

                        <input id="fecha_hora_1" name="fecha_hora_1" type="hidden"  value="{{ $fechaActual }}">
                        <input id="usuario" name="usuario" type="hidden"  value="{{ Auth::user()->name }}">

                            <div class="modal-body">
                                <div class="row">

                                        <div class="form-group col-6">
                                            <label for="name">Nombre(s) *</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="35px">
                                                </span>
                                                <input id="name" name="name" type="text" class="form-control" placeholder="Nombre" required>@error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="name">Apellido(s) *</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="35px">
                                                </span>
                                                <input id="apellido" name="apellido" type="text" class="form-control" placeholder="Apellido" required>@error('apellido') <span class="error text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>


                                        <div class="form-group col-6">
                                            <label for="name">Correo *</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('assets/cam/correo-electronico.png') }}" alt="" width="35px">
                                                </span>
                                                <input id="email" name="email" type="email" class="form-control" placeholder="Correo">@error('email') <span class="error text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="name">Telefono *</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('assets/cam/foldable-phone.png') }}" alt="" width="35px">
                                                </span>
                                                <input id="telefono" name="telefono" type="tel" minlength="10" maxlength="10" class="form-control" placeholder="55-55-55-55-55" required>@error('telefono') <span class="error text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>


                                    <div class="col-6 mt-3">
                                        <button class="btn btn-secondary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#clienteExample" aria-expanded="false" aria-controls="clienteExample">
                                            Agregar otra persona
                                        </button>
                                    </div>

                                    <div class="col-12">
                                        <div class="collapse" id="clienteExample">
                                            <div class="row">

                                                <div class="form-group col-6">
                                                    <label for="name">Apellido(s) </label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="35px">
                                                        </span>
                                                        <input id="name2" name="name2" type="text" class="form-control" placeholder="Nombre">
                                                    </div>
                                                </div>


                                                <div class="form-group col-6">
                                                    <label for="name">Apellido(s) </label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="35px">
                                                        </span>
                                                        <input id="apellido2" name="apellido2" type="text" class="form-control" placeholder="Apellido">
                                                    </div>
                                                </div>

                                                <div class="form-group col-6">
                                                    <label for="name">Correo 2 </label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img src="{{ asset('assets/cam/correo-electronico.png') }}" alt="" width="35px">
                                                        </span>
                                                        <input id="email2" name="email2" type="email" class="form-control" placeholder="Correo">
                                                    </div>
                                                </div>


                                                <div class="form-group col-6">
                                                    <label for="name">Telefono 2 </label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img src="{{ asset('assets/cam/foldable-phone.png') }}" alt="" width="35px">
                                                        </span>
                                                        <input id="telefono2" name="telefono2" type="tel" minlength="10" maxlength="10" class="form-control" placeholder="55-55-55-55-55">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-10">
                                        <label class="mt-2">Curso</label> <br>
                                        <select name="campo1" class="form-select d-inline-block curso">
                                            <option value="">Seleccione Curso</option>
                                            <option value="{{ $envio->id }}">{{ $envio->nombre }}</option>
                                            @foreach ($cursos as $curso)
                                                @if ($curso->Cursos->id == 647)
                                                    <option value="{{ $curso->id }}" data-precio="{{ $curso->precio }}">{{ $curso->nombre }} - ${{ $curso->precio }}</option>
                                                @else
                                                    <option value="{{ $curso->id }}" data-precio="{{ $curso->precio }}">{{ $curso->nombre }} - {{ $curso->Cursos->modalidad }} / {{ $curso->Cursos->fecha_inicial }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-2">
                                        <label for="name">Cantidad</label>
                                        <div class="input-group mb-3">
                                            <input id="cantidad" name="cantidad" type="number" class="form-control" value="1">
                                        </div>
                                    </div>

                                    <div class="col-6 mt-3">
                                        <button class="btn btn-secondary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                            Agregar otro curso
                                        </button>
                                    </div>

                                    <div class="col-12">
                                        <div class="collapse " id="collapseExample">
                                                <div class="row">
                                                    <div class="col-10">
                                                        <label class="mt-2">Curso 2</label> <br>
                                                        <select name="campo2" class="form-select d-inline-block curso2" style="width: 70%!important;">
                                                            <option value="">Seleccione Curso</option>
                                                            <option value="{{ $envio->id }}">{{ $envio->nombre }}</option>
                                                            @foreach ($cursos as $curso)
                                                                @if ($curso->Cursos->id == 647)
                                                                    <option value="{{ $curso->id }}" data-precio="{{ $curso->precio }}">{{ $curso->nombre }} - ${{ $curso->precio }}</option>
                                                                @else
                                                                    <option value="{{ $curso->id }}" data-precio="{{ $curso->precio }}">{{ $curso->nombre }} - {{ $curso->Cursos->modalidad }} / {{ $curso->Cursos->fecha_inicial }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-2">
                                                        <label for="name">Cantidad 2</label>
                                                        <div class="input-group mb-3">
                                                            <input id="cantidad2" name="cantidad2" type="number" class="form-control" value="1" style="width: 30%!important;">
                                                        </div>
                                                    </div>

                                                    <div class="col-10">
                                                        <label class="mt-2">Curso 3</label> <br>
                                                        <select name="campo3" class="form-select d-inline-block curso3" style="width: 70%!important;">
                                                            <option value="">Seleccione Curso</option>
                                                            <option value="{{ $envio->id }}">{{ $envio->nombre }}</option>
                                                            @foreach ($cursos as $curso)
                                                                @if ($curso->Cursos->id == 647)
                                                                    <option value="{{ $curso->id }}" data-precio="{{ $curso->precio }}">{{ $curso->nombre }} - ${{ $curso->precio }}</option>
                                                                @else
                                                                    <option value="{{ $curso->id }}" data-precio="{{ $curso->precio }}">{{ $curso->nombre }} - {{ $curso->Cursos->modalidad }} / {{ $curso->Cursos->fecha_inicial }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-2">
                                                        <label for="name">Cantidad 3</label>
                                                        <div class="input-group mb-3">
                                                            <input id="cantidad3" name="cantidad3" type="number" class="form-control" value="1" style="width: 30%!important;">
                                                        </div>
                                                    </div>

                                                    <div class="col-10">
                                                        <label class="mt-2">Curso 4</label> <br>
                                                        <select name="campo4" class="form-select d-inline-block curso4" style="width: 70%!important;">
                                                            <option value="">Seleccione Curso</option>
                                                            <option value="{{ $envio->id }}">{{ $envio->nombre }}</option>
                                                            @foreach ($cursos as $curso)
                                                                @if ($curso->Cursos->id == 647)
                                                                    <option value="{{ $curso->id }}" data-precio="{{ $curso->precio }}">{{ $curso->nombre }} - ${{ $curso->precio }}</option>
                                                                @else
                                                                    <option value="{{ $curso->id }}" data-precio="{{ $curso->precio }}">{{ $curso->nombre }} - {{ $curso->Cursos->modalidad }} / {{ $curso->Cursos->fecha_inicial }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-2">
                                                        <label for="name">Cantidad 4</label>
                                                        <div class="input-group mb-3">
                                                            <input id="cantidad4" name="cantidad4" type="number" class="form-control" value="1" style="width: 30%!important;">
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-12">
                                        <label class="mt-2">Clase grabada</label> <br>
                                        <select name="clase_grabada" class="form-select d-inline-block curso" style="width: 70%!important;">
                                            <option value="">Seleccione Curso</option>
                                            @foreach ($clases_grabadas as $clase_grabada)
                                            <option value="{{ $clase_grabada->id }}" data-precio="{{ $clase_grabada->precio }}">{{ $clase_grabada->nombre }} - {{ $clase_grabada->Cursos->modalidad }} / {{ $clase_grabada->Cursos->fecha_inicial }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-4 mt-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="toggleFactura" name="factura" value="1">
                                            <h4 class="form-check-h4" for="flexCheckDefault">
                                                <p class="" style="display: inline-block;font-size: 20px;padding: 5px;color: #3b8b00;">Si</p> <strong> (¿Factura?)</strong>
                                            </h4>
                                        </div>
                                    </div>

                                    <div class="form-group col-4 mt-3">
                                        <label for="name">Método de Pago *</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/cam/metodo-de-pago.png') }}" alt="" width="35px">
                                            </span>
                                            <select name="forma_pago" id="forma_pago" class="form-select d-inline-block">
                                                <option value="" >Selecione una opcion</option>
                                                <option value="Efectivo" {{ old('forma_pago') == 'Efectivo' ? 'selected' : '' }}>Efectivo</option>
                                                <option value="Tarjeta" {{ old('forma_pago') == 'Tarjeta' ? 'selected' : '' }}>Tarjeta</option>
                                                <option value="Nota" {{ old('forma_pago') == 'Nota' ? 'selected' : '' }}>Nota Fisica</option>
                                                <option value="transferencia inbursa" {{ old('forma_pago') == 'transferencia inbursa' ? 'selected' : '' }}>Transferencia Inbursa</option>
                                                <option value="transferencia bancomer" {{ old('forma_pago') == 'transferencia bancomer' ? 'selected' : '' }}>Transferencia BBVA Bancomer</option>
                                                <option value="deposito inbursa" {{ old('forma_pago') == 'deposito inbursa' ? 'selected' : '' }}>Deposito Inbursa</option>
                                                <option value="deposito bancomer" {{ old('forma_pago') == 'deposito bancomer' ? 'selected' : '' }}>Deposito BBVA Bancomer</option>
                                                <option value="oxxo inbursa" {{ old('forma_pago') == 'oxxo inbursa' ? 'selected' : '' }}>OXXO Inbursa</option>
                                                <option value="oxxo bancomer" {{ old('forma_pago') == 'oxxo bancomer' ? 'selected' : '' }}>OXXO Bancomer</option>
                                                <option value="Mercado Pago" {{ old('forma_pago') == 'Mercado Pago' ? 'selected' : '' }}>Mercado Pago</option>
                                                <option value="otro" {{ old('forma_pago') == 'otro' ? 'selected' : '' }}>Otro</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group col-4 mt-3">
                                        <label for="name">Foto (Comprobante) *</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/cam/camara.png') }}" alt="" width="35px">
                                            </span>
                                            <input id="foto" name="foto" type="file" class="form-control" placeholder="foto" required>@error('foto') <span class="error text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group col-6 mt-3">
                                        <label for="name">Foto (Comprobante) 2</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/cam/camara.png') }}" alt="" width="35px">
                                            </span>
                                            <input id="foto2" name="foto2" type="file" class="form-control" placeholder="foto2">
                                        </div>
                                    </div>

                                    <div class="form-group col-6 mt-3">
                                        <label for="name">Monto *</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="35px" style="margin-right: 1rem">
                                            </span>
                                            <input class="form-control" type="number" id="pago" name="pago" required>
                                        </div>
                                    </div>

                                    <div class="col-12">

                                        <p class="d-inline-flex gap-1">
                                            <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseComprobante" role="button" aria-expanded="false" aria-controls="collapseComprobante">
                                                Comprobar pago Banxico <img src="https://www.banxico.org.mx/DIBM/resources/img/logoBM-Monograma.png" alt="" style="width: 20px">
                                            </a>
                                        </p>

                                        <div class="collapse" id="collapseComprobante">
                                            <div class="card card-body row" style="padding: 0 !important;border: solid 5px #836263;border-radius: 10px;">
                                                <div class="col-12">
                                                    <iframe src="https://www.banxico.org.mx/cep/" frameborder="0" style="width: 100%;height: 600px;"></iframe>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group col-1 mt-3">
                                        <label>Deudor</label>
                                        <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="deudor" name="deudor" value="1" id="flexCheckChecked">
                                        </div>
                                    </div>

                                    <div class="form-group col-5 mt-3" id="abono-container">
                                        <label for="name">Abono *</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="35px" style="margin-right: 1rem">
                                            </span>
                                            <input id="abono" name="abono" type="number" class="form-control" placeholder="Abono">@error('abono') <span class="error text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                        <label for="comentario">Comentarios y/o Nota</label>
                                        <textarea class="form-control" name="comentario" id="comentario" cols="30" rows="3"></textarea>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff" id="btnGuardar">Guardar</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('datatable')
    <script src="{{ asset('assets/admin/vendor/select2/dist/js/select2.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function(){
            // 1) Inicializar Select2
            $('.curso, .curso2, .curso3, .curso4, [name="clase_grabada"]').select2();

            // 2) Función que calcula el subtotal (sin IVA)
            function calcularSubtotal(){
                let total = 0;
                // Curso 1…4
                for(let i=1; i<=4; i++){
                    let precio = parseFloat($(`.curso${i>1?i:''} option:selected`).data('precio')) || 0;
                    let qty    = parseInt($(`#cantidad${i>1?i:''}`).val()) || 1;
                    total += precio * qty;
                }
                // Clase grabada
                total += parseFloat($('[name="clase_grabada"] option:selected').data('precio'))||0;
                return total;
            }

            // 3) Función que recalcula y muestra el total, con o sin IVA
            function calcularTotalConIVA(){
                const subtotal = calcularSubtotal();
                const aplicaIVA = $('#toggleFactura').is(':checked');
                const total = aplicaIVA ? subtotal * 1.16 : subtotal;
                $('#pago').val(total.toFixed(0));
            }

            // 4) Enlazar TODOS los inputs/selects al mismo recalculo
            $('.curso, .curso2, .curso3, .curso4, [name="clase_grabada"]').on('change', calcularTotalConIVA);
            $('#cantidad, #cantidad2, #cantidad3, #cantidad4').on('input', calcularTotalConIVA);
            $('#toggleFactura').on('change', calcularTotalConIVA);

            // 5) Recalcular al cargar la página
            calcularTotalConIVA();
        });
    </script>
    @if(session('success_pdf'))
        <script>
            document.addEventListener('DOMContentLoaded', function(){
            Swal.fire({
                title: '¡Éxito!',
                text: '{{ session("success") }}',
                icon: 'success',
                showCancelButton: true,
                confirmButtonText: 'Descargar PDF',
                cancelButtonText: 'Cerrar'
            }).then((result) => {
                if (result.isConfirmed) {
                // Redirige a la URL que guardaste en la sesión
                window.location.href = '{{ session("pdf_url") }}';
                }
            });
            });
        </script>
    @endif
@endsection
