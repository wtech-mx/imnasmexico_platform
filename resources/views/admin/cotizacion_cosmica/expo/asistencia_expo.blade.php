@extends('layouts.app_admin')

@section('template_title')
    Asistencia Expo
@endsection

@section('content')

    <div class="container-fluid">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <div style="display: flex; justify-content: space-between; align-items: center;">

                                    <h2 class="mb-3">Asistencia Expo</h2>

                                    <a type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                                        ¿Como funciona?
                                    </a>

                                    @can('nota-productos-crear')
                                        <a class="btn btn-sm btn-success" href="{{ route('corizacion_expo.create') }}" style="background: #322338; color: #ffff; font-size: 20px;">
                                            <i class="fa fa-fw fa-edit"></i> Crear
                                        </a>
                                    @endcan
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-flush" id="datatable-search">
                                        <thead class="thead">
                                            <tr>
                                                <th>Cliente</th>
                                                <th>Tipo</th>
                                                <th>Cantidad</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($ordenes as $item)
                                                <tr>
                                                    <td>
                                                        {{ $item->id }}
                                                        <h5>
                                                            @if ($item->Nota->id_usuario == NULL)
                                                                {{ $item->Nota->nombre }} <br>
                                                                {{ $item->Nota->telefono }}
                                                            @else
                                                                {{ $item->Nota->User->name }} <br>
                                                                {{ $item->Nota->User->telefono }}
                                                            @endif
                                                        </h5>
                                                    </td>
                                                    <td>
                                                        <h5>
                                                            {{ $item->producto }}
                                                        </h5>
                                                    </td>
                                                    <td><h5>{{ $item->cantidad }}</h5></td>
                                                    <td>
                                                        @for ($i = 0; $i < $item->cantidad; $i++)
                                                            <input data-id="{{ $item->id }}" data-index="{{ $i }}" class="toggle-class" type="checkbox"
                                                            data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                            data-on="Active" data-off="InActive" {{ $i < $item->asistencia ? 'checked' : '' }}>
                                                        @endfor
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
            </div>
    </div>
@endsection

@section('datatable')
        <script src="{{ asset('assets/admin/vendor/select2/dist/js/select2.min.js')}}"></script>

        <script type="text/javascript">

            $(document).ready(function() {
                    $('.cliente').select2();
                    $('.phone').select2();
                    $('.administradores').select2();

                    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
                        searchable: true,
                        fixedHeight: false
                    });

                    $(document).on('change', '.toggle-class', function() {
                        var id = $(this).data('id');
                        var checkboxes = $(`input[data-id="${id}"]`);
                        var asistencia = checkboxes.filter(':checked').length;
                        console.log(asistencia);

                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: '{{ route('updateAsistencia') }}',
                            data: {
                                '_token': '{{ csrf_token() }}',
                                'id': id,
                                'asistencia': asistencia
                            },
                            success: function(data){
                                console.log(data.success);
                            }
                        });
                    });
                });
        </script>
@endsection


