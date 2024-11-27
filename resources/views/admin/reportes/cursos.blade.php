@extends('layouts.app_admin')

@section('template_title')
    Reporte Cursos
@endsection

@section('content')

<style>
    .grafica_syle{
        width: 30px;
        margin-left: 10px;
        border-radius: 9px;
        font-variant: diagonal-fractions;
        display: inline-block;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">

                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="mb-3">Reporte Personalizado</h3>
                        <a type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                            ¿Como funciona?
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-6">
                            <h4 class="text-center mb-3">Seleciona las fechas</h4>
                            <div class="d-flex justify-content-center mt-3">
                                <div class="row">
                                    <div class="col-4">
                                        <label for="">Fecha de inicio</label>
                                        <input class="form-control" type="date" id="fecha_inicio"  name="fecha_inicio">
                                    </div>

                                    <div class="col-4">
                                        <label for="">Fecha de fin</label>
                                        <input class="form-control" type="date" id="fecha_fin"  name="fecha_fin">
                                    </div>

                                    <div class="col-4">
                                        <label for="usuario">Usuario</label>
                                        <select class="form-control" id="usuario" name="usuario">
                                            <option value="">Seleccionar Usuario</option>
                                            @foreach ($usuarios as $usuario)
                                                <option value="{{ $usuario->name }}">{{ $usuario->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-4">
                                        <label for="generar_pdf">Generar PDF</label>
                                        <input type="checkbox" id="generar_pdf" name="generar_pdf">
                                    </div>


                                    <div class="col-12">
                                        <div class="d-flex justify-content-center mt-3">
                                            <button type="submit" class="btn close-modal"  id="btn-buscar" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Calcular</button>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div id="outputSummary"></div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="col-6">
                            <h4 class="text-center mb-3">Grafica</h4>
                            <div id="grafica"></div>
                        </div>

                    </div>
                    <div class="row mt-3">

                        <div class="d-flex justify-content-center">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Ordenes</button>
                                </li>

                                <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Tcikets</button>
                                </li>

                            </ul>
                        </div>

                          <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                                <div id="resultados"></div>

                            </div>

                            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                                <div id="resultados3"></div>

                            </div>
                          </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

@endsection

@section('datatable')
<script src="{{asset('assets/admin/js/plugins/chartjs.min.js')}}"></script>

<script>

    $(document).ready(function() {
        $('#btn-buscar').click(function() {
            buscar();
        });

    });

    function buscar() {
        var fecha_inicio = $('#fecha_inicio').val();
        var fecha_fin = $('#fecha_fin').val();
        var usuario = $('#usuario').val();
        var generar_pdf = $('#generar_pdf').is(':checked') ? 1 : 0;  // Verificar si el checkbox está marcado

        var token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '{{ route('cursos_reporte.store_custom') }}',
            type: 'POST',
            data: {
                'fecha_inicio': fecha_inicio,
                'fecha_fin': fecha_fin,
                'usuario': usuario,
                'generar_pdf': generar_pdf,  // Incluir el parámetro de generar PDF
                '_token': token // Agregar el token CSRF a los datos enviados
            },
            success: function(response) {
                $('#outputSummary').html(response.outputSummary);
                $('#resultados').html(response.resultados);
                $('#resultados3').html(response.resultados3);
                $('#grafica').html(response.grafica);
                $('body').append(response.script);

            // Manejo de la primera tabla
            if (window.dataTableSearch1) {
                window.dataTableSearch1.destroy(); // Destruir si existe
            }
            const tableId1 = "#datatable-search";
            window.dataTableSearch1 = new simpleDatatables.DataTable(tableId1, {
                deferRender: true,
                paging: true,
                pageLength: 10
            });

            // Manejo de la segunda tabla
            if (window.dataTableSearch2) {
                window.dataTableSearch2.destroy(); // Destruir si existe
            }
            const tableId2 = "#datatable-search2";
            window.dataTableSearch2 = new simpleDatatables.DataTable(tableId2, {
                deferRender: true,
                paging: true,
                pageLength: 10
            });

            }
        });
    }

</script>

@endsection
