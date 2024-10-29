@extends('layouts.app_admin')

@section('template_title')
Productos solicitados
@endsection
<style>
    #guardarBtn {
        display: none;
    }
</style>
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <h2 class="mb-3">Folio #{{$nota_scaner->folio}}</h2>

                            <a type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                                ¿Como funciona?
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <input class="form-control" type="text" id="scanInput" placeholder="Escanea el código aquí" autofocus>
                        <form method="POST" action="{{ route('notas_cotizacion.update_estatus', $nota_scaner->id) }}" enctype="multipart/form-data" role="form">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <input type="hidden" name="estatus_cotizacion" value="Enviado">

                                <div class="modal-body">
                                    <table class="table">
                                        <thead class="text-center">
                                            <tr>
                                                <th>Cantidad</th>
                                                <th>Producto</th>
                                                <th>Estatus</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            @foreach ($productos_scaner as $nota_producto)
                                                    @php
                                                        $producto = App\Models\Products::where('nombre', '=', $nota_producto->producto)->first();
                                                    @endphp
                                                    <tr data-id="{{ $nota_producto->id_notas_productos }}">
                                                        <td>
                                                            {{ $nota_producto->cantidad }}
                                                        </td>
                                                        <td>
                                                            <img src="{{ $producto->imagenes }}" alt="" style="width: 60px"><br>
                                                            {{ $nota_producto->producto }}
                                                        </td>
                                                        <td id="status-{{ $producto->sku ?? '' }}">
                                                            @if ($nota_producto->estatus === 1)
                                                                ✔️
                                                            @endif
                                                        </td>
                                                    </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" id="guardarBtn" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <audio id="successSound" src="{{ asset('notificaciones/success.mp3') }}" preload="auto"></audio>
    <audio id="errorSound" src="{{ asset('notificaciones/error-8-206492.mp3') }}" preload="auto"></audio>
@endsection
@section('datatable')
<script>
    function checkAllProductsChecked() {
        let allChecked = true;
        document.querySelectorAll('td[id^="status-"]').forEach((statusCell) => {
            if (statusCell.innerHTML.trim() !== '✔️') {
                allChecked = false;
            }
        });
        document.getElementById('guardarBtn').style.display = allChecked ? 'block' : 'none';
    }

    function playSound(success) {
        const successSound = document.getElementById("successSound");
        const errorSound = document.getElementById("errorSound");

        if (success) {
            successSound.play();
        } else {
            errorSound.play();
        }
    }

    document.getElementById('scanInput').addEventListener('change', function() {
        let sku = this.value.trim(); // Asegúrate de eliminar espacios en blanco al inicio o al final
        console.log(sku);

        // Aquí puedes validar si el SKU tiene la longitud esperada (por ejemplo, 6 dígitos)
        if (sku.length === 6) {
            let idNotaProducto = document.querySelector(`tr[data-id]`)?.getAttribute('data-id');

            fetch("{{ route('check.product') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ sku: sku, id_notas_productos: idNotaProducto })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    document.getElementById('status-' + sku).innerHTML = '✔️';
                    checkAllProductsChecked();
                    playSound(true);
                } else {
                    playSound(false);
                    console.log(data);
                    alert(data.message);
                }
            })
            .catch(error => {
                playSound(false); // Reproduce el sonido de error en caso de fallo en la solicitud
                console.error('Error:', error);
            });

            this.value = ''; // Limpia el campo de entrada después de procesar el SKU
        } else {
            console.log('El SKU no tiene la longitud correcta.');
        }
    });

    document.addEventListener("DOMContentLoaded", checkAllProductsChecked);
</script>
@endsection
