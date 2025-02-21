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
                                <div class="row">
                                    <div class="col-2 text-center">
                                        <label>Acompañante: </label>
                                        <h5>{{$multi + $multi_nas}}</h5>
                                    </div>

                                    <div class="col-2 text-center">
                                        <label>Sin Acompañante: </label>
                                        <h5>{{$ordenes_sin_acompañante + $ordenes_nas_sin_acompañante}}</h5>
                                    </div>

                                    <div class="col-2 text-center">
                                        <label>Basico: </label>
                                        <h5>{{$ordenes_basico + $ordenes_nas_basico}}</h5>
                                    </div>

                                    <div class="col-3 text-center">
                                        <label>Total de Registros: </label>
                                        <h5>{{$totalRegistros}}</h5>
                                    </div>

                                    <div class="col-3 text-center">
                                        <label>Total de Personas: </label>
                                        <h5>{{$totalPersonas}}</h5>
                                    </div>

                                    <div class="col-6 text-center" style="background-color:#81e31e57">
                                        <label>Asistencia: </label>
                                        <h5>{{$asistencia + $asistencia_nas}}</h5>
                                    </div>

                                    <div class="col-6 text-center" style="background-color: #9b1ee357">
                                        <label>Inasistencia: </label>
                                        <h5>{{$inasistencia}}</h5>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-flush" id="datatable-search">
                                        <thead class="thead">
                                            <tr>
                                                <th>Cliente</th>
                                                <th>Tipo</th>
                                                <th>Cantidad</th>
                                                <th>Asistencia</th>
                                                <th>WhatsApp</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($ordenes as $item)
                                                <tr id="row-{{ $item->id }}" style="background-color: {{ $item->confirmacion ? 'pink' : 'transparent' }};">
                                                    <td>
                                                        {{ $item->id }}
                                                        <h5>
                                                            @if ($item->Nota->id_usuario == NULL)
                                                                {!! nl2br(implode(' ', array_map(function($word, $index) {
                                                                    return $index > 0 && $index % 2 == 0 ? "\n$word" : $word;
                                                                }, explode(' ', $item->Nota->nombre), array_keys(explode(' ', $item->Nota->nombre))))) !!} <br>
                                                                {{ $item->Nota->telefono }}
                                                            @else
                                                                {!! nl2br(implode(' ', array_map(function($word, $index) {
                                                                    return $index > 0 && $index % 2 == 0 ? "\n$word" : $word;
                                                                }, explode(' ', $item->Nota->User->name), array_keys(explode(' ', $item->Nota->User->name))))) !!} <br>
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
                                                            <input data-id="{{ $item->id }}" data-table="cosmica" data-index="{{ $i }}" class="toggle-class" type="checkbox"
                                                            data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                            data-on="Active" data-off="InActive" {{ $i < $item->asistencia ? 'checked disabled' : '' }}>
                                                        @endfor
                                                    </td>
                                                    <td>
                                                        @php
                                                            $telefono = $item->Nota->id_usuario == NULL ? $item->Nota->telefono : $item->Nota->User->telefono;
                                                            $mensaje = urlencode("✨ ¡RECORDATORIO ESPECIAL: Este DOMINGO 23 es nuestra jornada especial! ✨\n\n📢 IMPORTANTE: LEE CON ATENCIÓN ESTAS INDICACIONES 📢\n\n🔸 Si compraste boleto VIP:\nTe pedimos llegar puntualmente a las 10:00 AM para realizar tu registro. Esto nos permitirá iniciar a tiempo el desayuno a las 10:30 AM y comenzar la jornada sin retrasos.\n\n🔸 Si tienes boleto básico:\nDe igual manera, te invitamos a llegar temprano, ya que debes completar tu registro antes de ingresar.\n\n💡 El registro es indispensable, ya que en este momento recibirás:\n✅ Pulsera de acceso\n✅ Kit de muestras\n✅ Producto gratis (para VIP que asistieron solos)\n✅ Material extra para la jornada\n\nPara agilizar tu ingreso, por favor llega con anticipación y colócate en la fila correspondiente. Si eres VIP, así también podrás disfrutar tu desayuno y snack sin prisas.\n\n📍 DIRECCIÓN: Miguel Laurent #961, Delegación Benito Juárez, CDMX\n📌 Waze: Busca ANUIES\n🗓 Fecha: Domingo 23 de febrero\n🕒 Horario: 10:00 AM - 2:00 PM\n🚍 Ubicación: A solo 1 cuadra del Metrobús Miguel Laurent\n🅿 Estacionamiento disponible (primer piso)\n\n📸 Adjuntamos foto de la entrada y la ubicación para que llegues sin problema.\n\n💖 Este evento ha sido preparado con muchísimo amor, pensando en cada detalle para que lo disfrutes al máximo. Estamos ansiosas por verte, compartir esta experiencia contigo y aprender juntas.\n\n¡Nos vemos muy pronto! ✨");
                                                        @endphp
                                                        <a class="btn btn-xs btn-success text-white whatsapp-btn" data-id="{{ $item->id }}" target="_blank" href="https://api.whatsapp.com/send?phone={{$telefono}}&text={{$mensaje}}">
                                                            <i class="fa fa-whatsapp"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            @foreach ($ordenes_nas as $item)
                                                <tr id="row-{{ $item->id }}" style="background-color: {{ $item->confirmacion ? 'pink' : 'transparent' }};">
                                                    <td>
                                                        {{ $item->id }}
                                                        <h5>
                                                            @if ($item->Nota->id_usuario == NULL)
                                                                {!! nl2br(implode(' ', array_map(function($word, $index) {
                                                                    return $index > 0 && $index % 2 == 0 ? "\n$word" : $word;
                                                                }, explode(' ', $item->Nota->nombre), array_keys(explode(' ', $item->Nota->nombre))))) !!} <br>
                                                                {{ $item->Nota->telefono }}
                                                            @else
                                                                {!! nl2br(implode(' ', array_map(function($word, $index) {
                                                                    return $index > 0 && $index % 2 == 0 ? "\n$word" : $word;
                                                                }, explode(' ', $item->Nota->User->name), array_keys(explode(' ', $item->Nota->User->name))))) !!} <br>
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
                                                            <input data-id="{{ $item->id }}" data-table="nas" data-index="{{ $i }}" class="toggle-class" type="checkbox"
                                                            data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                            data-on="Active" data-off="InActive" {{ $i < $item->asistencia ? 'checked disabled' : '' }}>
                                                        @endfor
                                                    </td>
                                                    <td>
                                                        @php
                                                            $telefono = $item->Nota->id_usuario == NULL ? $item->Nota->telefono : $item->Nota->User->telefono;
                                                            $mensaje = urlencode("✨ ¡RECORDATORIO ESPECIAL: Este DOMINGO 23 es nuestra jornada especial! ✨\n\n📢 IMPORTANTE: LEE CON ATENCIÓN ESTAS INDICACIONES 📢\n\n🔸 Si compraste boleto VIP:\nTe pedimos llegar puntualmente a las 10:00 AM para realizar tu registro. Esto nos permitirá iniciar a tiempo el desayuno a las 10:30 AM y comenzar la jornada sin retrasos.\n\n🔸 Si tienes boleto básico:\nDe igual manera, te invitamos a llegar temprano, ya que debes completar tu registro antes de ingresar.\n\n💡 El registro es indispensable, ya que en este momento recibirás:\n✅ Pulsera de acceso\n✅ Kit de muestras\n✅ Producto gratis (para VIP que asistieron solos)\n✅ Material extra para la jornada\n\nPara agilizar tu ingreso, por favor llega con anticipación y colócate en la fila correspondiente. Si eres VIP, así también podrás disfrutar tu desayuno y snack sin prisas.\n\n📍 DIRECCIÓN: Miguel Laurent #961, Delegación Benito Juárez, CDMX\n📌 Waze: Busca ANUIES\n🗓 Fecha: Domingo 23 de febrero\n🕒 Horario: 10:00 AM - 2:00 PM\n🚍 Ubicación: A solo 1 cuadra del Metrobús Miguel Laurent\n🅿 Estacionamiento disponible (primer piso)\n\n📸 Adjuntamos foto de la entrada y la ubicación para que llegues sin problema.\n\n💖 Este evento ha sido preparado con muchísimo amor, pensando en cada detalle para que lo disfrutes al máximo. Estamos ansiosas por verte, compartir esta experiencia contigo y aprender juntas.\n\n¡Nos vemos muy pronto! ✨");
                                                        @endphp
                                                        <a class="btn btn-xs btn-success text-white whatsapp-btn" data-id="{{ $item->id }}" target="_blank" href="https://api.whatsapp.com/send?phone={{$telefono}}&text={{$mensaje}}">
                                                            <i class="fa fa-whatsapp"></i>
                                                        </a>
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
            var table = $(this).data('table');
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
                    'table': table,
                    'asistencia': asistencia
                },
                success: function(data){
                    console.log(data.success);
                    // Deshabilitar el checkbox después de marcarlo
                    $(this).prop('disabled', true);
                }.bind(this),
                error: function(data){
                    console.log(data.error);
                }
            });
        });

        $(document).on('click', '.whatsapp-btn', function(e) {
            var id = $(this).data('id');
            e.preventDefault();

            $.ajax({
                type: "POST",
                dataType: "json",
                url: '{{ route('updateConfirmacion') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'id': id
                },
                success: function(data){
                    console.log(data.success);
                    // Cambiar el color de la fila a rosa
                    $(`#row-${id}`).css('background-color', 'pink');
                    // Redirigir a WhatsApp
                    window.open($(this).attr('href'), '_blank');
                }.bind(this),
                error: function(data){
                    console.log(data.error);
                }
            });
        });
    });
</script>
@endsection


