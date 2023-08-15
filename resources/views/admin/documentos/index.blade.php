@extends('layouts.app_admin')

@section('template_title')
Generar Documentos
@endsection

@section('content')

<div class="container-fluid mt-3">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="mb-3">Generar Documentos </h3>
                    <a type="button" class="btn btn-sm bg-danger" data-bs-toggle="modal" data-bs-target="#manual_instrucciones" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                        ¿Como fucniona?
                    </a>
                    <a type="button" class="btn btn-sm bg-primary" data-bs-toggle="modal" data-bs-target="#create_manual" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                        <i class="fa fa-fw fa-plus"></i> Crear
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-flush" id="datatable-search">
                    <thead class="thead-light">
                        <tr>
                            <th>Nombre</th>
                            <th>tipo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    @foreach ($documentos as $item)
                    <tr>
                        <td>{{ $item->User->name }}</td>
                        <td>{{ $item->tipo }}</td>
                        <td>
                            <a type="button" class="btn btn-sm bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#manual_update_{{ $item->id }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                <i class="fa fa-pencil"></i>
                            </a>
                        </td>
                    </tr>
                    @include('admin.documentos.modal_update')
                    @endforeach
                </table>
            </div>
          </div>
        </div>
      </div>
</div>

@include('admin.documentos.modal_create')

@endsection
@section('datatable')

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const curpOption = document.getElementById("curp_option");
        const tipoOption = document.getElementById("tipo");

        const curpContent = document.querySelector(".curp_content");

        const cnContent = document.querySelector(".gc_cn");
        const gcContent = document.querySelector(".gc_content");

        // Mostrar u ocultar los contenedores según la opción seleccionada
        curpOption.addEventListener("change", function () {
            if (curpOption.value === "Curp") {
                curpContent.style.display = "block";
                gcContent.style.display = "none";
            } else if (curpOption.value === "Generar curp") {
                curpContent.style.display = "none";
                gcContent.style.display = "block";
            }
        });

        tipoOption.addEventListener("change", function () {
            if (tipoOption.value != 1) {
                cnContent.style.display = "block";
            }else {
                cnContent.style.display = "none";
            }
        });
    });
</script>


<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      searchable: true,
      fixedHeight: false
    });

</script>

<script>
    const usuarioSelect = document.getElementById('usuarioSelect');
    const ordenesSelect = document.getElementById('ordenesSelect');

    usuarioSelect.addEventListener('change', function() {
        const usuarioId = this.value;

        if (usuarioId) {
            // Habilitar el segundo select
            ordenesSelect.removeAttribute('disabled');

            // Realizar la solicitud AJAX para obtener las órdenes del usuario
            fetch(`/obtener-ordenes/${usuarioId}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data); // Verifica si la relación "curso" se está cargando correctamente
                    ordenesSelect.innerHTML = '<option value="">Selecciona una orden</option>';
                    data.forEach(ordenTicket => {
                        console.log(ordenTicket.CursosTickets.nombre);
                        const option = document.createElement('option');
                        option.value = ordenTicket.id;
                        option.textContent = ordenTicket.CursosTickets ? ordenTicket.CursosTickets.nombre : 'Nombre no disponible';
                        ordenesSelect.appendChild(option);
                    });
            });
        } else {
            // Si no se selecciona un usuario, deshabilitar el segundo select
            ordenesSelect.innerHTML = '<option value="">Selecciona una orden</option>';
            ordenesSelect.setAttribute('disabled', true);
        }
    });
</script>

@endsection
