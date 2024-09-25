@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Notas de pedidosss</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Usuario</th>
                <th>ID Cliente</th>
                <th>Dinero Recibido</th>
                <th>Método de Pago</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Restante</th>
                <th>Cambio</th>
                <th>Descuento</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if($usuarioArray['success'] && !empty($usuarioArray['data']))
                @foreach($usuarioArray['data'] as $pedido)
                    <tr>
                        <td>{{ $pedido['id'] }}</td>
                        <td>{{ $pedido['id_user'] }}</td>
                        <td>{{ $pedido['id_client'] }}</td>
                        <td>{{ $pedido['dinero_recibido'] }}</td>
                        <td>{{ $pedido['metodo_pago'] }}</td>
                        <td>{{ $pedido['fecha'] }}</td>
                        <td>{{ $pedido['total'] }}</td>
                        <td>{{ $pedido['restante'] }}</td>
                        <td>{{ $pedido['cambio'] }}</td>
                        <td>{{ $pedido['descuento'] }}</td>
                        <td>
                            <!-- Aquí puedes agregar botones para editar/eliminar el pedido, por ejemplo -->
                            <a href="#" class="btn btn-primary">Ver</a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="11">No hay datos disponibles.</td>
                </tr>
            @endif
        </tbody>
    </table>
