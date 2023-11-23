@extends('layouts.app_admin')

@section('template_title')
    Reporte Personalizado
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
                                    <div class="col-6">
                                        <label for="">Fecha de inicio</label>
                                        <input class="form-control" type="date" id="fecha_inicio"  name="fecha_inicio">
                                    </div>

                                    <div class="col-6">
                                        <label for="">Fecha de fin</label>
                                        <input class="form-control" type="date" id="fecha_fin"  name="fecha_fin">
                                    </div>

                                    <div class="col-12">
                                        <div class="d-flex justify-content-center mt-3">
                                            <button type="submit" class="btn close-modal"  id="btn-buscar" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Calcular</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div id="resultados2"></div>
                                </div>
                            </div>

                        </div>

                        <div class="col-6">
                            <h4 class="text-center mb-3">Grafica</h4>
                            <div id="grafica"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="resultados"></div>


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
        var token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '{{ route('reporte.store_custom') }}',
            type: 'POST',
            data: {
                'fecha_inicio': fecha_inicio,
                'fecha_fin': fecha_fin,
                '_token': token // Agregar el token CSRF a los datos enviados
            },
            success: function(response) {
                $('#resultados2').html(response.resultados2);
                $('#resultados').html(response.resultados);
                $('#grafica').html(response.grafica);
                $('body').append(response.script);

            const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
                deferRender:true,
                paging: true,
                pageLength: 10
            });
            const dataTableSearch2 = new simpleDatatables.DataTable("#datatable-search2", {
                deferRender:true,
                paging: true,
                pageLength: 10
            });
            }
        });
    }

</script>

@endsection
