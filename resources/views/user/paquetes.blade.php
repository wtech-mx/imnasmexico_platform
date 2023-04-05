@extends('layouts.app_user')

@section('template_title')
    Paquetes
@endsection

@section('css_custom')
    <link href="{{ asset('plataforma/assets/user/custom/paquetes.css')}}" rel="stylesheet" />
@endsection

@section('content')


<section class="primario bg_overley" style="background-color:#fff;">

    <div class="row">
        <div class="col-6 space_paquetes">
            <img class="img_paquetes" src="{{ asset('plataforma/assets/user/utilidades/PAQUETE-01.png')}}" alt="">
        </div>

        <div class="col-6 space_paquetes">
            <form action="{{ route('carrito.resultado') }}" method="post">
                @csrf
                @foreach ($tickets as $ticket)
                    <div class="mt-5">
                        <input type="checkbox" name="ticket[]" data-grupo="grupo1" value="{{ $ticket->id }}" onclick="limitarSeleccionGrupo1()">
                        <label>{{ $ticket->nombre }}</label>
                    </div>
                @endforeach
                <input type="hidden" name="opciones_seleccionadas" value="">
                <button type="submit">Comprar</button>
            </form>
        </div>
    </div>

</section>

<section class="primario bg_overley" style="background-color:#F5ECE4;">

    <div class="row">
        <div class="col-6 space_paquetes">
            @foreach ($tickets as $ticket)
                <div class="mt-5">
                    <input type="checkbox" name="ticket[]" data-grupo="grupo2" value="{{ $ticket->id }}" onclick="limitarSeleccionGrupo2()">
                    <label>{{ $ticket->nombre }}</label>
                </div>
            @endforeach
            <a class="btn_ticket_comprar text-center" href="{{ route('add.to.cart', 2) }}"  role="button">
                <i class="fas fa-ticket-alt"></i> Comprar
            </a>
        </div>

        <div class="col-6 space_paquetes">
            <img class="img_paquetes" src="{{ asset('plataforma/assets/user/utilidades/PAQUETE-02.png')}}" alt="">
        </div>
    </div>

</section>

<section class="primario bg_overley" style="background-color:#fff;">

    <div class="row">
        <div class="col-6 space_paquetes">
            <img class="img_paquetes" src="{{ asset('plataforma/assets/user/utilidades/PAQUETE-03.png')}}" alt="">
        </div>

        <div class="col-6 space_paquetes">
            @foreach ($tickets as $ticket)
                <div class="mt-5">
                    <input type="checkbox" name="ticket[]" data-grupo="grupo3" value="{{ $ticket->id }}" onclick="limitarSeleccionGrupo3()">
                    <label>{{ $ticket->nombre }}</label>
                </div>
            @endforeach
        </div>
    </div>

</section>

<section class="primario bg_overley" style="background-color:#F5ECE4;">

    <div class="row">
        <div class="col-6 space_paquetes">
            @foreach ($tickets as $ticket)
                <div class="mt-5">
                    <input type="checkbox" name="ticket[]" data-grupo="grupo4" value="{{ $ticket->id }}" onclick="limitarSeleccionGrupo4()">
                    <label>{{ $ticket->nombre }}</label>
                </div>
            @endforeach
        </div>

        <div class="col-6 space_paquetes">
            <img class="img_paquetes" src="{{ asset('plataforma/assets/user/utilidades/PAQUETE-04.png')}}" alt="">
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

        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
            if (this.checked) {
                seleccionados++;
                if (seleccionados > 4) {
                this.checked = false;
                seleccionados--;
                }
            } else {
                seleccionados--;
            }
            });
        });
        }
    </script>

    <script>
        function limitarSeleccionGrupo2() {
        var checkboxes = document.querySelectorAll('input[type=checkbox][data-grupo=grupo2]');
        var seleccionados = 0;

        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
            if (this.checked) {
                seleccionados++;
                if (seleccionados > 4) {
                this.checked = false;
                seleccionados--;
                }
            } else {
                seleccionados--;
            }
            });
        });
        }
    </script>

    <script>
        function limitarSeleccionGrupo3() {
        var checkboxes = document.querySelectorAll('input[type=checkbox][data-grupo=grupo3]');
        var seleccionados = 0;

        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
            if (this.checked) {
                seleccionados++;
                if (seleccionados > 4) {
                this.checked = false;
                seleccionados--;
                }
            } else {
                seleccionados--;
            }
            });
        });
        }
    </script>

    <script>
        function limitarSeleccionGrupo4() {
        var checkboxes = document.querySelectorAll('input[type=checkbox][data-grupo=grupo4]');
        var seleccionados = 0;

        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
            if (this.checked) {
                seleccionados++;
                if (seleccionados > 4) {
                this.checked = false;
                seleccionados--;
                }
            } else {
                seleccionados--;
            }
            });
        });
        }
    </script>
@endsection


