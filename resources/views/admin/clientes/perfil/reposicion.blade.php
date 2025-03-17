<!-- Card Basic Info -->
<div class="card mt-4" id="basic-info">
    <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
        Crear Reposición
    </a>

    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            @include('admin.clientes.perfil.cotizaciones.reposicion')
        </div>
    </div>
</div>
<div class="card mt-4" id="basic-info">
    <div class="card-header">
        <h5>Reposiciones</h5>
    </div>
    <div class="card-body pt-0">
        <div class="row">
            <table class="table table-flush" id="datatable-tiendita">
                <thead class="thead">
                    <tr>
                        <th>Folio</th>
                        <th>Fecha</th>
                        <th>Folio de Reposioción</th>
                        <th>Estatus</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cotizaciones as $nota)
                        <tr>
                            <th>
                                {{ $nota->folio }}
                            </th>

                            <th>
                                @php
                                $fecha = $nota->fecha;
                                $fecha_timestamp = strtotime($fecha);
                                $fecha_formateada = date('d \d\e F \d\e\l Y', $fecha_timestamp);
                                @endphp
                                {{$fecha_formateada}}
                            </th>

                             <td>
                                @if ($nota->id_reposicion_nas == null)
                                    <p style="color: #322338">Cosmica</p>
                                    {{ $nota->NotasCosmica->folio }}
                                @elseif ($nota->id_reposicion_cosmica == null)
                                    <p style="color: #836262">NAS</p>
                                    {{ $nota->NotasNAS->folio }}
                                @endif
                             </td>
                             <td>
                                @if ($nota->estatus_reposicion == 'Cancelar')
                                    Cancelada
                                @else
                                    @if ($nota->estatus_reposicion ==  'Aprobada')
                                        <label class="badge" style="color: #9fe300;background-color: #9fe30048;">Aprobada</label>
                                    @else
                                        <label class="badge" style="color: #636363;background-color: #5f5f5f40;">Pendiente de aprobación</label>
                                    @endif
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-xs btn-info text-white" target="_blank" href="{{ route('reposicion.liga', ['id' => $nota->id]) }}">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                @if ($nota->estatus_reposicion == 'Pendiente')
                                    <a class="btn btn-xs btn-warning text-white" type="button" data-bs-toggle="modal" data-bs-target="#guiaModal{{$nota->id}}">
                                        <i class="fa fa-file"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                        @include('admin.cotizacion_cosmica.guia')
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@section('datatable')
    <script src="{{ asset('assets/admin/vendor/select2/dist/js/select2.min.js')}}"></script>
    <script>
        const dataTableTiendita = new simpleDatatables.DataTable("#datatable-tiendita", {
            deferRender:true,
            paging: true,
            pageLength: 10
        });
    </script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const opcionSelect = document.getElementById('opcion');
    const notasContainer = document.getElementById('notas-container');
    const notasSelect = document.getElementById('notas');
    const productosContainer = document.getElementById('productos-container');
    const productosList = document.getElementById('productos-list');
    const clienteId = document.getElementById('id_cliente').value;

    opcionSelect.addEventListener('change', function () {
        if (this.value === 'Nas' || this.value === 'Cosmica') {
            notasContainer.classList.remove('d-none');
            const url = this.value === 'Nas'
                ? `/perfil/cliente/api/notas/${clienteId}`
                : `/perfil/cliente/api/notas-cosmica/${clienteId}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    notasSelect.innerHTML = '<option value="">Seleccione una nota</option>';
                    data.forEach(nota => {
                        const option = document.createElement('option');
                        option.value = nota.id;
                        option.textContent = `Nota #${nota.id} - ${nota.descripcion || 'Sin descripción'}`;
                        notasSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error al obtener las notas:', error);
                    alert('Hubo un error al cargar las notas. Intente nuevamente.');
                });
        } else {
            notasContainer.classList.add('d-none');
            notasSelect.innerHTML = '<option value="">Seleccione una nota</option>';
        }
    });

    notasSelect.addEventListener('change', function () {
        const notaId = this.value;

        if (notaId) {
            productosContainer.classList.remove('d-none');

            fetch(`/perfil/cliente/api/productos-nota/${notaId}`)
                .then(response => response.json())
                .then(data => {
                    productosList.innerHTML = '';

                    // Obtener todos los productos disponibles para el select de reemplazo
                    fetch(`/perfil/cliente/api/productos`)
                        .then(response => response.json())
                        .then(productosDisponibles => {
                            data.forEach(producto => {
                                const div = document.createElement('div');
                                div.classList.add('mb-3');

                                // Crear el select de reemplazo
                                let selectOptions = '<option value="">Seleccione un producto de reemplazo</option>';
                                productosDisponibles.forEach(productoDisponible => {
                                    selectOptions += `<option value="${productoDisponible.id}">${productoDisponible.nombre}</option>`;
                                });

                                div.innerHTML = `
                                    <div class="row">
                                        <h4 for="producto_${producto.id}">${producto.cantidad} - ${producto.producto}</h4>
                                        <input type="hidden" name="productos[${producto.id}][original]" value="${producto.id}">
                                        <div class="col-6">
                                            <select name="productos[${producto.id}][reemplazo]" class="form-select">
                                                ${selectOptions}
                                            </select>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="number" name="productos[${producto.id}][cantidad]" value="1">
                                        </div>
                                    </div>
                                `;

                                productosList.appendChild(div);
                            });
                        })
                        .catch(error => {
                            console.error('Error al obtener los productos disponibles:', error);
                            alert('Hubo un error al cargar los productos de reemplazo. Intente nuevamente.');
                        });
                })
                .catch(error => {
                    console.error('Error al obtener los productos:', error);
                    alert('Hubo un error al cargar los productos. Intente nuevamente.');
                });
        } else {
            productosContainer.classList.add('d-none');
            productosList.innerHTML = '';
        }
    });
});
</script>
@endsection
