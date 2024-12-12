@extends('layouts.app_admin')

@section('template_title')
    Registro IMNAS
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header">

                        <div class="d-flex justify-content-between">

                            <h3 class="mb-3">Registros IMNAS Show</h3>

                            <a type="button" class="btn btn-sm bg-danger" data-bs-toggle="modal" data-bs-target="#manual_instrucciones" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                ¿Como fucniona?
                            </a>

                            <a class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#registro_imnas" title="Editar Estatus" style="background: #b600e3;">
                                Crear
                            </a>
                        </div>
                    </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-flush" id="datatable-search">
                                    <thead class="thead">
                                        <tr>
                                            <th>No</th>
                                            <th>Cliente</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($registros_imnas as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>
                                                    <a href=" {{ route('clientes.imnas', $item->User->code) }} " target="_blank" rel="noopener noreferrer" style="text-decoration: revert;color: blue;">
                                                        {{ $item->User->name }}
                                                    </a><br>
                                                    <p>{{ $item->User->telefono }}</p>
                                                    <p>{{ $item->User->email }}</p>
                                                    @if(empty($item->logo))
                                                        <p class="text-left">
                                                            <img id="blah" src="{{asset('documentos/'. $item->User->telefono . '/' .$item->User->logo) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                         </p>
                                                    @endif

                                                    @php
                                                        $nombreDeEscuela = $item->User->escuela;
                                                        $nombreDeEscuela = str_replace('Curso de ', '', $nombreDeEscuela);
                                                        $nombreDeEscuela = str_replace('Curso ', '', $nombreDeEscuela);

                                                        $palabras = explode(' ', $nombreDeEscuela);

                                                        // Inicializa la cadena formateada
                                                        $nombre_formateado = '';
                                                        $contador_palabras = 0;

                                                        foreach ($palabras as $palabra) {
                                                            // Agrega la palabra actual a la cadena formateada
                                                            $nombre_formateado .= $palabra . ' ';

                                                            // Incrementa el contador de palabras
                                                            $contador_palabras++;

                                                            // Agrega un salto de línea después de cada tercera palabra
                                                            if ($contador_palabras % 4== 0) {
                                                                $nombre_formateado .= "<br>";
                                                            }
                                                        }
                                                    @endphp
                                                <p>{!! $nombre_formateado !!}</p>

                                                </td>
                                                <td>
                                                    <a type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#registro_imnas_edit_{{ $item->id }}">
                                                        Editar
                                                    </a>

                                                    <a class="btn btn-sm btn-info" href="{{ route('show_cliente.imnas', $item->User->code) }}" target="_blank">
                                                        Afiliaciones
                                                    </a>

                                                    <a class="btn btn-sm btn-succes" href="{{ route('contrato.edit', $item->User->code) }}" target="_blank">
                                                        Formato
                                                    </a>

                                                    <a class="btn btn-sm btn-success" href="{{ route('contrato_afiliacion.edit', $item->id) }}" target="_blank">
                                                        Contraro
                                                    </a>

                                                    <a class="btn btn-sm btn-danger" href="{{ route('show_especialidades.imnas', $item->User->id) }}" target="_blank">
                                                        Especialidad
                                                    </a>
                                                </td>
                                            </tr>

                                            @include('admin.registro_imnas.modal_edit')

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.registro_imnas.crear')

@endsection

@section('datatable')

<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
        deferRender:true,
        paging: true,
        pageLength: 10
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Manejo de selects en los modales de edición
        document.querySelectorAll('.clave-clasificacion').forEach(function (selectElement) {
            selectElement.addEventListener('change', function () {
                // Contenedor del input dinámico
                const container = this.closest('.modal-content').querySelector('.otra-clave-container');

                if (this.value === 'Otra') {
                    // Mostrar input si seleccionan "Otra"
                    container.classList.remove('d-none');
                } else {
                    // Ocultar el input si no es "Otra"
                    container.classList.add('d-none');
                }
            });
        });

        // Manejo del select en el modal de creación
        const createSelect = document.querySelector('#registro_imnas .clave-clasificacion');
        const createContainer = document.querySelector('.otra-clave-container-create');

        if (createSelect) {
            createSelect.addEventListener('change', function () {
                if (this.value === 'Otra Clave') {
                    createContainer.classList.remove('d-none');
                } else {
                    createContainer.classList.add('d-none');
                }
            });
        }
    });
</script>


@endsection
