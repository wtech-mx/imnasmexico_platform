@extends('layouts.app_user')

@section('template_title')
    Paquetes
@endsection

@section('css_custom')
    <link href="{{asset('assets/user/custom/paquetes.css')}}" rel="stylesheet" />
@endsection

@section('content')

    @if ($paquete->visible_6 == 1)
        <section class="primario bg_overley" style="background-color:#fff;">
            <div id="paquete5">
                <div class="row">
                    <div class="col-12 col-md-6 order-uno  space_paquetes">
                        <img class="img_paquetes" src="{{asset('webpage/kit_navideño.png') }}" alt="">
                    </div>

                    <div class="col-12 col-md-6 order-dos space_paquetes">
                        <h3 class="mt-3" style="color:#836262!important;">Kit cursos navideños</h3>
                        <h3 style="color: #836262"><strong>
                            <del style="color: #836262">${{number_format($paquete->precio_6, 2, '.', ',');}} mxn</del>
                            ${{number_format($paquete->precio_rebajado_6, 2, '.', ',');}} mxn</strong>
                        </h3>
                        <ul>
                            <li>Despigmentación Facial "Hipercromías" - <b>03 Enero 2025</b></li>
                            <li>Curso de Dermapen + BBGLOW - <b>07 Enero 2025</b></li>
                            <li>Curso de BB Virgin Blanqueamiento - <b>10 Enero 2025</b></li>
                            <li>Curso de Diástasis Abdominal con Cierre de Costillas - <b>13 Enero 2025</b></li>
                        </ul>
                        @php
                            $descuento6 = $paquete->precio_6 - $paquete->precio_rebajado_6;
                        @endphp
                        <h5 style="color:#836262!important;">Descuento: <strong>${{number_format($descuento6, 2, '.', ',');}} mxn</strong></h5>
                        <form class="mt-4" action="{{ route('carrito.resultado6') }}" method="post">
                            @csrf
                            <input type="hidden" name="opciones_seleccionadas6" value="">
                            <input type="hidden" name="paquete" value="6">
                            <button class="btn_paquetes btn-submit" type="submit">Comprar<i class="fas fa-cart-plus icon_paquetes"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if ($paquete->visible_1 == 1)
        <section class="primario bg_overley" style="background-color:#fff;">
            <div id="paquete1">
                <div class="row">
                    <div class="col-12 col-md-6 space_paquetes">
                        <img class="img_paquetes" src="{{asset('webpage/'.$webpage->stpaquetesone_image) }}" alt="">
                    </div>

                    <div class="col-12 col-md-6 space_paquetes">
                        <h3 class="mt-3" style="color:#836262!important;">Paquete 1</h3>
                        <h3 style="color: #836262"><strong>
                            <del style="color: #836262">${{number_format($paquete->precio_1, 2, '.', ',');}} mxn</del>
                            ${{number_format($paquete->precio_rebajado_1, 2, '.', ',');}} mxn</strong>
                        </h3>
                        @php
                          $descuento = $paquete->precio_1 - $paquete->precio_rebajado_1;
                        @endphp
                        <h5 style="color:#836262!important;">Descuento: <strong>${{number_format($descuento, 2, '.', ',');}} mxn</strong></h5>
                        <form class="mt-4" action="{{ route('carrito.resultado') }}" method="post">
                            @csrf
                            <input type="hidden" name="opciones_seleccionadas" value="">
                            <input type="hidden" name="paquete" value="1">
                            <button class="btn_paquetes btn-submit" type="submit">Comprar<i class="fas fa-cart-plus icon_paquetes"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if ($paquete->visible_2 == 1)
        <section class="primario bg_overley" style="background-color:#F5ECE4;">
            <div id="paquete2">
                <div class="row">
                    <div class="col-12 col-md-6 order-dos space_paquetes">
                        <h3 class="mt-3" style="color:#836262!important;">Paquete 2</h3>
                        <h3 style="color: #836262"><strong>
                            <del style="color: #836262">${{number_format($paquete->precio_2, 2, '.', ',');}} mxn</del>
                            ${{number_format($paquete->precio_rebajado_2, 2, '.', ',');}} mxn</strong>
                        </h3>
                        @php
                            $descuento2 = $paquete->precio_2 - $paquete->precio_rebajado_2;
                        @endphp
                        <h5 style="color:#836262!important;">Descuento: <strong>${{number_format($descuento2, 2, '.', ',');}} mxn</strong></h5>
                        <form class="mt-4" action="{{ route('carrito.resultado2') }}" method="post">
                            @csrf
                            <input type="hidden" name="opciones_seleccionadas2" value="">
                            <input type="hidden" name="paquete" value="2">
                            <button class="btn_paquetes btn-submit" type="submit">Comprar<i class="fas fa-cart-plus icon_paquetes"></i></button>
                        </form>
                    </div>

                    <div class="col-12 col-md-6 order-uno space_paquetes">
                        <img class="img_paquetes" src="{{asset('webpage/'.$webpage->stpaquetestwo_image) }}" alt="">
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if ($paquete->visible_3 == 1)
        <section class="primario bg_overley" style="background-color:#fff;">
            <div id="paquete3">
                <div class="row">
                    <div class="col-12 col-md-6 space_paquetes">
                        <img class="img_paquetes" src="{{asset('webpage/'.$webpage->stpaquetesthree_image) }}" alt="">
                    </div>

                    <div class="col-12 col-md-6 space_paquetes">
                        <h3 class="mt-3" style="color:#836262!important;">Paquete 3</h3>
                        <h3 style="color: #836262"><strong>
                            <del style="color: #836262">${{number_format($paquete->precio_3, 2, '.', ',');}} mxn</del>
                            ${{number_format($paquete->precio_rebajado_3, 2, '.', ',');}} mxn</strong>
                        </h3>
                        @php
                            $descuento3 = $paquete->precio_3 - $paquete->precio_rebajado_3;
                        @endphp
                        <h5 style="color:#836262!important;">Descuento: <strong>${{number_format($descuento3, 2, '.', ',');}} mxn</strong></h5>
                        <form class="mt-4" action="{{ route('carrito.resultado3') }}" method="post">
                            @csrf
                            <input type="hidden" name="opciones_seleccionadas3" value="">
                            <input type="hidden" name="paquete" value="3">
                            <button class="btn_paquetes btn-submit" type="submit">Comprar<i class="fas fa-cart-plus icon_paquetes"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if ($paquete->visible_4 == 1)
        <section class="primario bg_overley" style="background-color:#F5ECE4;">
            <div id="paquete4">
                <div class="row">
                    <div class="col-12 col-md-6 order-dos space_paquetes">
                        <h3 class="mt-3" style="color:#836262!important;">Paquete 4</h3>
                        <h3 style="color: #836262"><strong>
                            <del style="color: #836262">${{number_format($paquete->precio_4, 2, '.', ',');}} mxn</del>
                            ${{number_format($paquete->precio_rebajado_4, 2, '.', ',');}} mxn</strong>
                        </h3>
                        @php
                            $descuento4 = $paquete->precio_4 - $paquete->precio_rebajado_4;
                        @endphp
                        <h5 style="color:#836262!important;">Descuento: <strong>${{number_format($descuento4, 2, '.', ',');}} mxn</strong></h5>
                        <form class="mt-4" action="{{ route('carrito.resultado4') }}" method="post">
                            @csrf
                            <input type="hidden" name="opciones_seleccionadas4" value="">
                            <input type="hidden" name="paquete" value="4">
                            <button class="btn_paquetes btn-submit" type="submit">Comprar<i class="fas fa-cart-plus icon_paquetes"></i></button>
                        </form>
                    </div>

                    <div class="col-12 col-md-6 order-uno  space_paquetes">
                        <img class="img_paquetes" src="{{asset('webpage/'.$webpage->stpaquetesfour_image) }}" alt="">
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if ($paquete->visible_5 == 1)
        <section class="primario bg_overley" style="background-color:#fff;">
            <div id="paquete5">
                <div class="row">
                    <div class="col-12 col-md-6 order-uno  space_paquetes">
                        <img class="img_paquetes" src="{{asset('webpage/'.$webpage->stpaquetesfive_image) }}" alt="">
                    </div>

                    <div class="col-12 col-md-6 order-dos space_paquetes">
                        <h3 class="mt-3" style="color:#836262!important;">Paquete 5</h3>
                        <h3 style="color: #836262"><strong>
                            <del style="color: #836262">${{number_format($paquete->precio_5, 2, '.', ',');}} mxn</del>
                            ${{number_format($paquete->precio_rebajado_5, 2, '.', ',');}} mxn</strong>
                        </h3>
                        @php
                            $descuento5 = $paquete->precio_5 - $paquete->precio_rebajado_5;
                        @endphp
                        <h5 style="color:#836262!important;">Descuento: <strong>${{number_format($descuento5, 2, '.', ',');}} mxn</strong></h5>
                        <form class="mt-4" action="{{ route('carrito.resultado5') }}" method="post">
                            @csrf
                            <input type="hidden" name="opciones_seleccionadas5" value="">
                            <input type="hidden" name="paquete" value="5">
                            <button class="btn_paquetes btn-submit" type="submit">Comprar<i class="fas fa-cart-plus icon_paquetes"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    @endif


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


