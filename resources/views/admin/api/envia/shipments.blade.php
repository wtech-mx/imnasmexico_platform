@extends('layouts.app_admin')

@php
    use Carbon\Carbon;
@endphp

@section('template_title')
    Api ENVIA
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header">

                        <div class="d-flex justify-content-between">

                            <a class="btn" id="regresar_btn" style="background: {{$configuracion->color_boton_close}}; color: #fff"><i class="fas fa-arrow-left"></i> Regresar </a>

                            <h3 class="mb-3">API ENVIA</h3>

                            <a type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                                ¿Como funciona?
                            </a>

                            @can('client-create')
                            <a class="btn btn-sm btn-success" href="{{ route('comentarios.create') }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                <i class="fa fa-fw fa-edit"></i> Crear </a>
                            @endcan

                        </div>

                            <!-- Formulario de filtro de fechas -->
                            <form method="GET" action="{{ route('shipments.index') }}" class="mb-4">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="start_date">Fecha de inicio</label>
                                        <input type="date" id="start_date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="end_date">Fecha de fin</label>
                                        <input type="date" id="end_date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label>&nbsp;</label>
                                        <button type="submit" class="btn btn-primary d-block">Filtrar</button>
                                    </div>
                                </div>
                            </form>
                    </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="datatable-search">
                                    <thead>
                                        <tr>

                                            <th>Seguimiento</th>
                                            <th>Estado</th>
                                            <th>Fecha</th>
                                            <th>Cliente</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($shipments as $shipment)
                                            <tr>
                                                <td>
                                                    <ul>
                                                        <strong style="color: transparent">{{ $shipment['name'] }}</strong>
                                                        @php
                                                            $carrierLogo = match($shipment['name']) {
                                                                'amPm' => 'assets/admin/img/icons/ampm.png',
                                                                'dhl' => 'assets/admin/img/icons/dhl.png',
                                                                'fedex' => 'assets/admin/img/icons/fedex.png',
                                                                'noventa9Minutos' => 'assets/admin/img/icons/99.png',
                                                                'ups' => 'assets/admin/img/icons/ups.png',
                                                                'uber' => 'assets/admin/img/icons/uber.png',
                                                                'paquetexpress' => 'assets/admin/img/icons/express.png',
                                                                default => 'assets/admin/img/icons/envia.webp', // Imagen por defecto si no coincide
                                                            };
                                                        @endphp
                                                        <br>
                                                        <img src="{{ asset($carrierLogo) }}" alt="{{ $shipment['name'] }}" width="50px" >
                                                        {{ $shipment['tracking_number'] }}                                                    </ul>
                                                <td>
                                                    @php
                                                        $estadoColor = [
                                                            'Picked Up' => ['text' => 'Recogido', 'class' => 'badge badge-info'],
                                                            'Delivered' => ['text' => 'Entregado', 'class' => 'badge badge-success'],
                                                            'Delayed' => ['text' => 'Demorado', 'class' => 'badge badge-dark'],
                                                            'Canceled' => ['text' => 'Cancelado', 'class' => 'badge badge-danger'],
                                                            'Shipped' => ['text' => 'Enviado', 'class' => 'badge badge-primary'],
                                                            'Out for Delivery' => ['text' => 'En camino', 'class' => 'badge badge-warning'],
                                                            'Created' => ['text' => 'Creado', 'class' => 'badge badge-secondary'],
                                                        ];
                                                    @endphp

                                                    <span class="{{ $estadoColor[$shipment['status']]['class'] ?? 'badge badge-light' }}">
                                                        {{ $estadoColor[$shipment['status']]['text'] ?? 'Estado desconocido' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    {{ Carbon::parse($shipment['created_at'])->format('d F y') }} <br>
                                                    {{ Carbon::parse($shipment['created_at'])->format('g:i A') }}
                                                </td>
                                                <td>
                                                    <ul>
                                                            <strong>Contacto:</strong><br>
                                                        <li>{{ $shipment['consignee_name'] }}</li>
                                                        <li>{{ $shipment['consignee_phone'] }}</li>
                                                        <li>{{ $shipment['consignee_email'] }}</li><br>
                                                        <strong>Direccion:</strong> <br>
                                                        <li>
                                                            {{ $shipment['consignee_street'] }} {{ $shipment['consignee_number'] }}, <br>
                                                            {{ $shipment['consignee_district'] }},<br>
                                                             {{ $shipment['consignee_city'] }}, <br>
                                                            {{ $shipment['consignee_state'] }} - {{ $shipment['consignee_postalcode'] }} <br>
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td>${{ number_format($shipment['grand_total'], 2) }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center">No hay envíos para mostrar.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('datatable')

<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
        deferRender:true,
        paging: true,
        pageLength: 10
    });
</script>

@endsection
