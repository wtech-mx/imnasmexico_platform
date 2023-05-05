<div class="row space_laaterales_profile">

    <div class="col-12 space_laaterales_profile">
        <h2 class="title_curso mb-5">Mis compras</h2>
    </div>
    <table class="table">
        <thead class="text-center">
          <tr class="tr_checkout">
            <th >Num. Pedido</th>
            <th >Fecha de Compra</th>
            <th >Total</th>
            <th>Curso/Diplomado</th>
            <th>Estado</th>
            <th>Acciones</th>
          </tr>
        </thead>

        <tbody class="text-center">
        @if(!empty($orders))
            @foreach($orders as $order)
            @include('user.profile_show')
                <tr>
                    <th>
                        #{{$order->id}}
                    </th>
                    <th>
                        {{$order->fecha}}
                    </th>
                    <td>
                        @php
                            $precio = number_format($order->pago, 2, '.', ',');
                        @endphp
                        ${{$precio}} mxn
                    </td>
                    <td class="td_title_checkout">
                        {{$order->forma_pago}}
                    </td>
                    <td>
                        @if ($order->estatus == '1')
                            Completado
                        @else
                            En espera
                        @endif
                    </td>
                    <th>
                        <a type="button" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#showDataModal{{$order->id}}" style="color: #ffff; background: #836262"><i class="fa fa-fw fa-eye"></i></a>
                    </th>
                </tr>
            @endforeach
            @else
            <p>Upps... aun no tiene compras de Curosos o Diplomados</p>
        @endif
        </tbody>
    </table>
</div>
