<!-- filepath: c:\laragon\www\imnasmexico_platform\resources\views\admin\products\index_categorias.blade.php -->
@extends('layouts.app_admin')

@section('template_title')
    Categorías
@endsection

@section('css')
    <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="container-fluid mt-3">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                @include('admin.products.botones')

                <div class="table-responsive p-4">
                    <table class="table table-flush" id="datatable-search">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Línea</th>
                                <th>Inicio</th>
                                <th>Fin</th>

                                <th>Imagen</th>
                                <th>Portada</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categorias as $categoria)
                                <tr>
                                    <td>{{ $categoria->id }}</td>
                                    <td>{{ $categoria->nombre }}</td>
                                    <td>{{ $categoria->linea }}</td>
                                    <td>{{ $categoria->fecha_inicio }}</td>
                                    <td>{{ $categoria->fecha_fin }}</td>
                                    <td><img src="{{ asset('categorias/' . $categoria->imagen) }}" alt="Imagen" style="width: 60px; height: 60px;"></td>
                                    <td><img src="{{ asset('categorias/' . $categoria->portada) }}" alt="Portada" style="width: 60px; height: 60px;"></td>
                                    <td>
                                        <!-- Aquí puedes agregar botones de acción como editar o eliminar -->
                                        <a class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#edit_categoria_{{ $categoria->id }}">
                                            Editae
                                        </a>
                                        @include('admin.products.modal_edit_categorias')

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@include('admin.products.modal_create')
@endsection

@section('datatable')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

<script>
    $('#datatable-search').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'print',
                text: 'Imprimir',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'excel',
            'pdf',
            'colvis'
        ],
        responsive: true,
        stateSave: true,

        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
        }
    });
</script>
@endsection
