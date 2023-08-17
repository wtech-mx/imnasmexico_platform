@extends('layouts.app_user')

@section('template_title')
    Paquetes
@endsection

@section('css_custom')
    <link href="{{asset('assets/user/custom/paquetes.css')}}" rel="stylesheet" />
@endsection

@section('content')

<section class="primario bg_overley" style="background-color:#fff;">
    <div id="paquete1">
        <div class="row">
            <div class="col-12 col-md-6 space_paquetes">
                <img class="img_paquetes" src="{{asset('webpage/'.$webpage->stpaquetesone_image) }}" alt="">
            </div>

            <div class="col-12 col-md-6 space_paquetes">
                <h3 class="mt-3" style="color:#836262!important;">Paquete 1</h3>
                <h3 class="mt-2" style="color:#836262!important;">Selecciona tus 4 cursos</h3>
                <h3 style="color: #836262"><strong>
                    <del style="color: #836262">$7,400</del>
                    $5,400</strong>
                </h3>
                <h5 style="color:#836262!important;">Descuento: <strong>$2,000</strong></h5>
                <form class="mt-4" action="{{ route('carrito.resultado') }}" method="post">
                    @csrf
                    <h5 style="color:#836262!important;">Seleccione la canasta</h5>
                    <div class="col-6">
                        <select class="form-control" style="background: #F5ECE4!important;color: #836262;font-weight: bold;" name="canasta" id="canasta">
                            <option value="Canasta facial">Canasta facial</option>
                            <option value="Canasta Corporal">Canasta Corporal</option>
                        </select>
                    </div>

                    @foreach ($tickets as $ticket)
                    @php
                        $fecha_inicial = $ticket->Cursos->fecha_inicial;
                        $fmt = new IntlDateFormatter('es_ES', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
                        $fecha_formateada = $fmt->format(strtotime($fecha_inicial));
                    @endphp
                        <div class="mt-2 mt-md-5 mt-lg-3">
                            <input class="input_paquetes" type="checkbox" name="ticket[]" id="checkbox{{ $ticket->id }}" data-grupo="grupo1" value="{{ $ticket->id }}" onclick="limitarSeleccionGrupo1()">
                            <label class="label_paquetes">{{ $ticket->nombre }} - {{ $fecha_formateada }}</label>
                        </div>
                    @endforeach
                    <input type="hidden" name="opciones_seleccionadas" value="">
                    <input type="hidden" name="paquete" value="1">
                    <button class="btn_paquetes btn-submit" type="submit" id="boton-compra" disabled>Comprar<i class="fas fa-cart-plus icon_paquetes"></i></button>
                </form>
            </div>
        </div>
    </div>
</section>

<section class="primario bg_overley" style="background-color:#F5ECE4;">
    <div id="paquete2">
        <div class="row">
            <div class="col-12 col-md-6 order-dos space_paquetes">
                <h3 class="mt-3" style="color:#836262!important;">Paquete 2</h3>
                <h3 class="mt-2" style="color:#836262!important;">Selecciona tus 4 cursos</h3>
                <h3 style="color: #836262"><strong>
                    <del style="color: #836262">$9,400</del>
                    $8,000</strong>
                </h3>
                <h5 style="color:#836262!important;">Descuento: <strong>$1,400</strong></h5>
                <form class="mt-4" action="{{ route('carrito.resultado2') }}" method="post">
                    @csrf
                    <h5 style="color:#836262!important;">Seleccione la canasta</h5>
                    <div class="col-6">
                        <select class="form-control" style="background: #836262!important;color: #F5ECE4;font-weight: bold;" name="canasta" id="canasta">
                            <option value="Canasta facial">Canasta facial</option>
                            <option value="Canasta Corporal">Canasta Corporal</option>
                        </select>
                    </div>
                    @foreach ($tickets as $ticket)
                    @php
                        $fecha_inicial = $ticket->Cursos->fecha_inicial;
                        $fmt = new IntlDateFormatter('es_ES', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
                        $fecha_formateada = $fmt->format(strtotime($fecha_inicial));
                    @endphp
                        <div class="mt-2 mt-md-5 mt-lg-3">
                            <input class="input_paquetes" type="checkbox" name="ticket2[]" data-grupo="grupo2" value="{{ $ticket->id }}" onclick="limitarSeleccionGrupo2()">
                            <label class="label_paquetes">{{ $ticket->nombre }} - {{ $fecha_formateada }}</label>
                        </div>
                    @endforeach
                    <input type="hidden" name="opciones_seleccionadas2" value="">
                    <input type="hidden" name="paquete" value="2">
                    <button class="btn_paquetes btn-submit" type="submit" id="boton-compra2" disabled>Comprar<i class="fas fa-cart-plus icon_paquetes"></i></button>
                </form>
            </div>

            <div class="col-12 col-md-6 order-uno space_paquetes">
                <img class="img_paquetes" src="{{asset('webpage/'.$webpage->stpaquetestwo_image) }}" alt="">
            </div>
        </div>
    </div>
</section>

<section class="primario bg_overley" style="background-color:#fff;">
    <div id="paquete3">
        <div class="row">
            <div class="col-12 col-md-6 space_paquetes">
                <img class="img_paquetes" src="{{asset('webpage/'.$webpage->stpaquetesthree_image) }}" alt="">
            </div>

            <div class="col-12 col-md-6 space_paquetes">
                <h3 class="mt-3" style="color:#836262!important;">Paquete 3</h3>
                <h3 class="mt-2" style="color:#836262!important;">Selecciona tus 4 cursos</h3>
                <h3 style="color: #836262"><strong>
                    <del style="color: #836262">$12,400</del>
                    $11,000</strong>
                </h3>
                <h5 style="color:#836262!important;">Descuento: <strong>$1,400</strong></h5>
                <form class="mt-4" action="{{ route('carrito.resultado3') }}" method="post">
                    @csrf
                    <div class="col-6">
                        <h5 style="color:#836262!important;">Seleccione la canasta</h5>
                        <select class="form-control" style="background: #F5ECE4!important;color: #836262;font-weight: bold;" name="canasta" id="canasta">
                            <option value="Canasta facial">Canasta facial</option>
                            <option value="Canasta Corporal">Canasta Corporal</option>
                        </select>
                    </div>
                    @foreach ($tickets as $ticket)
                    @php
                        $fecha_inicial = $ticket->Cursos->fecha_inicial;
                        $fmt = new IntlDateFormatter('es_ES', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
                        $fecha_formateada = $fmt->format(strtotime($fecha_inicial));
                    @endphp
                        <div class="mt-2 mt-md-5 mt-lg-3">
                            <input class="input_paquetes" type="checkbox" name="ticket3[]" data-grupo="grupo3" value="{{ $ticket->id }}" onclick="limitarSeleccionGrupo3()">
                            <label class="label_paquetes">{{ $ticket->nombre }} - {{ $fecha_formateada }}</label>
                        </div>
                    @endforeach
                    <input type="hidden" name="opciones_seleccionadas3" value="">
                    <input type="hidden" name="paquete" value="3">
                    <button class="btn_paquetes btn-submit" type="submit" id="boton-compra3" disabled>Comprar<i class="fas fa-cart-plus icon_paquetes"></i></button>
                </form>
            </div>
        </div>
    </div>
</section>

<section class="primario bg_overley" style="background-color:#F5ECE4;">
    <div id="paquete4">
        <div class="row">
            <div class="col-12 col-md-6 order-dos space_paquetes">
                <h3 class="mt-3" style="color:#836262!important;">Paquete 4</h3>
                <h3 class="mt-2" style="color:#836262!important;">Selecciona tus 4 cursos</h3>
                <h3 style="color: #836262"><strong>
                    <del style="color: #836262">$14,400</del>
                    $13,000</strong>
                </h3>
                <h5 style="color:#836262!important;">Descuento: <strong>$1,400</strong></h5>
                <form class="mt-4" action="{{ route('carrito.resultado4') }}" method="post">
                    @csrf
                    <h5 style="color:#836262!important;">Seleccione la canasta</h5>
                    <div class="col-6">
                        <select class="form-control" style="background: #836262!important;color: #F5ECE4;font-weight: bold;" name="canasta" id="canasta">
                            <option value="Canasta facial">Canasta facial</option>
                            <option value="Canasta Corporal">Canasta Corporal</option>
                        </select>
                    </div>
                    @foreach ($tickets as $ticket)
                    @php
                        $fecha_inicial = $ticket->Cursos->fecha_inicial;
                        $fmt = new IntlDateFormatter('es_ES', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
                        $fecha_formateada = $fmt->format(strtotime($fecha_inicial));
                    @endphp
                        <div class="mt-2 mt-md-5 mt-lg-3">
                            <input class="input_paquetes" type="checkbox" name="ticket4[]" data-grupo="grupo4" value="{{ $ticket->id }}" onclick="limitarSeleccionGrupo4()">
                            <label class="label_paquetes">{{ $ticket->nombre }} - {{ $fecha_formateada }}</label>
                        </div>
                    @endforeach
                    <input type="hidden" name="opciones_seleccionadas4" value="">
                    <input type="hidden" name="paquete" value="4">
                    <button class="btn_paquetes btn-submit" type="submit" id="boton-compra4" disabled>Comprar<i class="fas fa-cart-plus icon_paquetes"></i></button>
                </form>
            </div>

            <div class="col-12 col-md-6 order-uno  space_paquetes">
                <img class="img_paquetes" src="{{asset('webpage/'.$webpage->stpaquetesfour_image) }}" alt="">
            </div>
        </div>
    </div>
</section>

<section class="primario bg_overley" style="background-color:#fff;">
    <div id="paquete5">
        <div class="row">
            <div class="col-12 col-md-6 order-uno  space_paquetes">
                <img class="img_paquetes" src="{{asset('webpage/'.$webpage->stpaquetesfive_image) }}" alt="">
            </div>

            <div class="col-12 col-md-6 order-dos space_paquetes">
                <h3 class="mt-3" style="color:#836262!important;">Paquete 5</h3>
                <h3 class="mt-2" style="color:#836262!important;">Selecciona tus 4 cursos</h3>
                <h3 style="color: #836262"><strong>
                    <del style="color: #836262">$15,900</del>
                    $14,500</strong>
                </h3>
                <h5 style="color:#836262!important;">Descuento: <strong>$1,400</strong></h5>
                <form class="mt-4" action="{{ route('carrito.resultado5') }}" method="post">
                    @csrf
                    <h5 style="color:#836262!important;">Seleccione la canasta</h5>
                    <div class="col-6">
                        <select class="form-control" style="background: #F5ECE4!important;color: #836262;font-weight: bold;" name="canasta" id="canasta">
                            <option value="Canasta facial">Canasta facial</option>
                            <option value="Canasta Corporal">Canasta Corporal</option>
                        </select>
                    </div>
                    @foreach ($tickets as $ticket)
                    @php
                        $fecha_inicial = $ticket->Cursos->fecha_inicial;
                        $fmt = new IntlDateFormatter('es_ES', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
                        $fecha_formateada = $fmt->format(strtotime($fecha_inicial));
                    @endphp
                        <div class="mt-2 mt-md-5 mt-lg-3">
                            <input class="input_paquetes" type="checkbox" name="ticket5[]" data-grupo="grupo5" value="{{ $ticket->id }}" onclick="limitarSeleccionGrupo5()">
                            <label class="label_paquetes">{{ $ticket->nombre }} - {{ $fecha_formateada }}</label>
                        </div>
                    @endforeach
                    <input type="hidden" name="opciones_seleccionadas5" value="">
                    <input type="hidden" name="paquete" value="5">
                    <button class="btn_paquetes btn-submit" type="submit" id="boton-compra5" disabled>Comprar<i class="fas fa-cart-plus icon_paquetes"></i></button>
                </form>
            </div>
        </div>
    </div>
</section>


@section('js')
    <script>
        const checkboxes = document.getElementsByName("ticket[]");
        const campoOculto = document.getElementsByName("opciones_seleccionadas")[0];

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener("click", () => {
                const opcionesSeleccionadas = [...checkboxes]
                    .filter(c => c.checked)
                    .map(c => c.value)
                    .join("|");
                campoOculto.value = opcionesSeleccionadas;
            });
        });
    </script>

    <script>
        function limitarSeleccionGrupo1() {
        var checkboxes = document.querySelectorAll('input[type=checkbox][data-grupo=grupo1]');
        var seleccionados = 0;
        var botonCompra = document.getElementById('boton-compra');

        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    seleccionados++;
                    if (seleccionados === 4) {
                        // Habilita el botón de compra cuando se seleccionan 4 checkboxes
                        botonCompra.disabled = false;
                    }
                    if (seleccionados > 4) {
                    this.checked = false;
                    seleccionados--;
                    }
                } else {
                    seleccionados--;
                    // Deshabilita el botón de compra si no se seleccionan 4 checkboxes
                    if (seleccionados !== 4) {
                        botonCompra.disabled = true;
                    }
                }

            });
        });
        }
    </script>

    <script>
        $(document).ready(function() {
        // Deshabilitar el botón al cargar la página
        $('.btn-submit').prop('', true);

        // Contar el número de casillas de verificación seleccionadas
        $('.checkbox').on('change', function() {
            var checkedCount = $('.checkbox:checked').length;
            // Habilitar el botón si se seleccionan 4 casillas de verificación
            if (checkedCount === 4) {
            $('.btn-submit').prop('', false);
            } else {
            $('.btn-submit').prop('', true);
            }
        });
        });
    </script>

    <script>
        function limitarSeleccionGrupo2() {
        var checkboxes = document.querySelectorAll('input[type=checkbox][data-grupo=grupo2]');
        var seleccionados = 0;
        var botonCompra = document.getElementById('boton-compra2');

        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    seleccionados++;
                    if (seleccionados === 4) {
                        // Habilita el botón de compra cuando se seleccionan 4 checkboxes
                        botonCompra.disabled = false;
                    }
                    if (seleccionados > 4) {
                    this.checked = false;
                    seleccionados--;
                    }
                } else {
                    seleccionados--;
                    // Deshabilita el botón de compra si no se seleccionan 4 checkboxes
                    if (seleccionados !== 4) {
                        botonCompra.disabled = true;
                    }
                }
            });
        });
        }
    </script>

    <script>
        const checkboxes2 = document.getElementsByName("ticket2[]");
        const campoOculto2 = document.getElementsByName("opciones_seleccionadas2")[0];

        checkboxes2.forEach(checkbox => {
            checkbox.addEventListener("click", () => {
                const opcionesSeleccionadas2 = [...checkboxes2]
                    .filter(c => c.checked)
                    .map(c => c.value)
                    .join("|");
                campoOculto2.value = opcionesSeleccionadas2;
            });
        });
    </script>

    <script>
        function limitarSeleccionGrupo3() {
        var checkboxes = document.querySelectorAll('input[type=checkbox][data-grupo=grupo3]');
        var seleccionados = 0;
        var botonCompra = document.getElementById('boton-compra3');

        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    seleccionados++;
                    if (seleccionados === 4) {
                        // Habilita el botón de compra cuando se seleccionan 4 checkboxes
                        botonCompra.disabled = false;
                    }
                    if (seleccionados > 4) {
                    this.checked = false;
                    seleccionados--;
                    }
                } else {
                    seleccionados--;
                    // Deshabilita el botón de compra si no se seleccionan 4 checkboxes
                    if (seleccionados !== 4) {
                        botonCompra.disabled = true;
                    }
                }
            });
        });
        }
    </script>

    <script>
        const checkboxes3 = document.getElementsByName("ticket3[]");
        const campoOculto3 = document.getElementsByName("opciones_seleccionadas3")[0];

        checkboxes3.forEach(checkbox => {
            checkbox.addEventListener("click", () => {
                const opcionesSeleccionadas3 = [...checkboxes3]
                    .filter(c => c.checked)
                    .map(c => c.value)
                    .join("|");
                campoOculto3.value = opcionesSeleccionadas3;
            });
        });
    </script>

    <script>
        function limitarSeleccionGrupo4() {
        var checkboxes = document.querySelectorAll('input[type=checkbox][data-grupo=grupo4]');
        var seleccionados = 0;
        var botonCompra = document.getElementById('boton-compra4');

        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    seleccionados++;
                    if (seleccionados === 4) {
                        // Habilita el botón de compra cuando se seleccionan 4 checkboxes
                        botonCompra.disabled = false;
                    }
                    if (seleccionados > 4) {
                    this.checked = false;
                    seleccionados--;
                    }
                } else {
                    seleccionados--;
                    // Deshabilita el botón de compra si no se seleccionan 4 checkboxes
                    if (seleccionados !== 4) {
                        botonCompra.disabled = true;
                    }
                }
            });
        });
        }
    </script>

    <script>
        const checkboxes4 = document.getElementsByName("ticket4[]");
        const campoOculto4 = document.getElementsByName("opciones_seleccionadas4")[0];

        checkboxes4.forEach(checkbox => {
            checkbox.addEventListener("click", () => {
                const opcionesSeleccionadas4 = [...checkboxes4]
                    .filter(c => c.checked)
                    .map(c => c.value)
                    .join("|");
                campoOculto4.value = opcionesSeleccionadas4;
            });
        });
    </script>

    <script>
        function limitarSeleccionGrupo5() {
        var checkboxes = document.querySelectorAll('input[type=checkbox][data-grupo=grupo5]');
        var seleccionados = 0;
        var botonCompra = document.getElementById('boton-compra5');

        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    seleccionados++;
                    if (seleccionados === 4) {
                        // Habilita el botón de compra cuando se seleccionan 4 checkboxes
                        botonCompra.disabled = false;
                    }
                    if (seleccionados > 4) {
                    this.checked = false;
                    seleccionados--;
                    }
                } else {
                    seleccionados--;
                    // Deshabilita el botón de compra si no se seleccionan 4 checkboxes
                    if (seleccionados !== 4) {
                        botonCompra.disabled = true;
                    }
                }
            });
        });
        }
    </script>

    <script>
        const checkboxes5 = document.getElementsByName("ticket5[]");
        const campoOculto5 = document.getElementsByName("opciones_seleccionadas5")[0];

        checkboxes5.forEach(checkbox => {
            checkbox.addEventListener("click", () => {
                const opcionesSeleccionadas5 = [...checkboxes5]
                    .filter(c => c.checked)
                    .map(c => c.value)
                    .join("|");
                campoOculto5.value = opcionesSeleccionadas5;
            });
        });
    </script>
@endsection


