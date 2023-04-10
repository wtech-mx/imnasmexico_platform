@extends('layouts.app_user')

@section('template_title')
    Paquetes
@endsection

@section('css_custom')
    <link href="{{asset('assets/user/custom/paquetes.css')}}" rel="stylesheet" />
@endsection

@section('content')


<section class="primario bg_overley" style="background-color:#fff;">

    <div class="row">
        <div class="col-6 space_paquetes">
            <img class="img_paquetes" src="{{asset('assets/user/utilidades/PAQUETE-01.png')}}" alt="">
        </div>

        <div class="col-6 space_paquetes">
            <form action="{{ route('carrito.resultado') }}" method="post">
                @csrf
                @foreach ($tickets as $ticket)
                    <div class="mt-5">
                        <input type="checkbox" name="ticket[]" id="checkbox{{ $ticket->id }}" data-grupo="grupo1" value="{{ $ticket->id }}" onclick="limitarSeleccionGrupo1()">
                        <label>{{ $ticket->nombre }}</label>
                    </div>
                @endforeach
                <input type="hidden" name="opciones_seleccionadas" value="">
                <input type="hidden" name="paquete" value="1">
                <button class="btn btn-primary btn-submit" type="submit" id="boton-compra" disabled>Comprar</button>
            </form>
        </div>
    </div>

</section>

<section class="primario bg_overley" style="background-color:#F5ECE4;">

    <div class="row">
        <div class="col-6 space_paquetes">
            <form action="{{ route('carrito.resultado2') }}" method="post">
                @csrf
                @foreach ($tickets as $ticket)
                    <div class="mt-5">
                        <input type="checkbox" name="ticket2[]" data-grupo="grupo2" value="{{ $ticket->id }}" onclick="limitarSeleccionGrupo2()">
                        <label>{{ $ticket->nombre }}</label>
                    </div>
                @endforeach
                <input type="hidden" name="opciones_seleccionadas2" value="">
                <input type="hidden" name="paquete" value="2">
                <button class="btn btn-primary btn-submit" type="submit" id="boton-compra2" disabled>Comprar</button>
            </form>
        </div>

        <div class="col-6 space_paquetes">
            <img class="img_paquetes" src="{{asset('assets/user/utilidades/PAQUETE-02.png')}}" alt="">
        </div>
    </div>

</section>

<section class="primario bg_overley" style="background-color:#fff;">

    <div class="row">
        <div class="col-6 space_paquetes">
            <img class="img_paquetes" src="{{asset('assets/user/utilidades/PAQUETE-03.png')}}" alt="">
        </div>

        <div class="col-6 space_paquetes">
            <form action="{{ route('carrito.resultado3') }}" method="post">
                @csrf
                @foreach ($tickets as $ticket)
                    <div class="mt-5">
                        <input type="checkbox" name="ticket3[]" data-grupo="grupo3" value="{{ $ticket->id }}" onclick="limitarSeleccionGrupo3()">
                        <label>{{ $ticket->nombre }}</label>
                    </div>
                @endforeach
                <input type="hidden" name="opciones_seleccionadas3" value="">
                <input type="hidden" name="paquete" value="3">
                <button class="btn btn-primary btn-submit" type="submit" id="boton-compra3" disabled>Comprar</button>
            </form>
        </div>
    </div>

</section>

<section class="primario bg_overley" style="background-color:#F5ECE4;">

    <div class="row">
        <div class="col-6 space_paquetes">
            <form action="{{ route('carrito.resultado4') }}" method="post">
                @csrf
                @foreach ($tickets as $ticket)
                    <div class="mt-5">
                        <input type="checkbox" name="ticket4[]" data-grupo="grupo4" value="{{ $ticket->id }}" onclick="limitarSeleccionGrupo4()">
                        <label>{{ $ticket->nombre }}</label>
                    </div>
                @endforeach
                <input type="hidden" name="opciones_seleccionadas4" value="">
                <input type="hidden" name="paquete" value="4">
                <button class="btn btn-primary btn-submit" type="submit" id="boton-compra4" disabled>Comprar</button>
            </form>
        </div>

        <div class="col-6 space_paquetes">
            <img class="img_paquetes" src="{{asset('assets/user/utilidades/PAQUETE-04.png')}}" alt="">
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
@endsection


