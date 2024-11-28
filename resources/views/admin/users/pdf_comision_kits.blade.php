<!doctype html>
<html lang="en">
<head>
  <style>
        body{
            font-family: sans-serif;
        }
        @page {
            margin: 160px 50px;
        }
        header {
            position: fixed;
            left: 0px;
            top: -160px;
            right: 0px;
            height: 100px;
            background-color: #836262;
            color: #fff;
            text-align: center;
        }
        header h1{
            margin: 10px 0;
        }
        header h2{
            margin: 0 0 10px 0;
        }
        footer {
            position: fixed;
            left: 0px;
            bottom: -50px;
            right: 0px;
            height: 40px;
            border-bottom: 2px solid #836262;
        }
        footer .page:after {
            content: counter(page);
        }
        footer table {
            width: 100%;
        }
        footer p {
            text-align: right;
        }
        footer .izq {
            text-align: left;
        }
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            text-align: center;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #F7EAED;
        }
  </style>
<body>
  <header>
    <h1>Comisiones kits</h1>
    <h2>{{$user_comision_kit->name}}</h2>
  </header>

  <footer>
    <table>
      <tr>
        <td>
            <p class="izq">
               Fecha: {{ date('d/n/y', strtotime($today)) }}
            </p>
        </td>
        <td>
          <p class="page">
            Página
          </p>
        </td>
      </tr>
    </table>
  </footer>

  <div id="content">
    @php
        $mitad = $user_comision_kit->comision_kit/2;
    @endphp
    <span class="badge rounded-pill text-white" style="background:rgba(24, 160, 184, 0.397)">Ventas individuales: <b>${{$user_comision_kit->comision_kit}}</b></span>
    <span class="badge rounded-pill text-white " style="background:rgba(137, 43, 226, 0.295)">Ventas compartidas: <b>${{$mitad}}</b></span>

    <table class="table table-bordered border-primary">
        <thead class="text-center" style="background-color: #836262; color: #fff">
            <tr>
                <th>Folio</th>
                <th>kits</th>
                <th>Subtotal</th>
                <th>Descuento</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @php
                $notas_nas_individual = 0;
                $notas_nas_comp = 0;
                $notas_nas_comp2 = 0;
                $sum_comp = 0;
                $notas_nas_individual_pares = 0;
                $comision_comp = 0;
                $notas_nas_compartida_pares = 0;
                $division_comp = 0;
                $comision = 0;
                $comision_uno = 0;

                //C O M I S I O N E S  C O S M I C A
                $notas_nas_individual_cosmica = 0;
                $notas_nas_comp_cosmica = 0;
                $notas_nas_comp2_cosmica = 0;
                $sum_comp_cosmica = 0;
                $notas_nas_individual_pares_cosmica = 0;
                $comision_comp_cosmica = 0;
                $notas_nas_compartida_pares_cosmica = 0;
                $division_comp_cosmica = 0;
                $comision_cosmica = 0;
                $comision_uno_cosmica = 0;

                $suma_individual = 0;
                $suma_compartidas = 0;
            @endphp
            @foreach ($notasAprobadasNASComision as $notas)
                @if ($notas->id_admin == $user_comision_kit->id && $notas->id_admin_venta == $user_comision_kit->id)
                    @php
                        $notas_nas_individual += $notas->cantidad_kit + $notas->cantidad_kit2 + $notas->cantidad_kit3 + $notas->cantidad_kit4 + $notas->cantidad_kit5 + $notas->cantidad_kit6;
                    @endphp
                @endif
                @if ($notas->id_admin == $user_comision_kit->id && $notas->id_admin_venta !== $user_comision_kit->id)
                    @php
                        $notas_nas_comp += $notas->cantidad_kit + $notas->cantidad_kit2 + $notas->cantidad_kit3 + $notas->cantidad_kit4 + $notas->cantidad_kit5 + $notas->cantidad_kit6;
                    @endphp
                @endif
                @if ($notas->id_admin !== $user_comision_kit->id && $notas->id_admin_venta == $user_comision_kit->id)
                    @php
                        $notas_nas_comp2 += $notas->cantidad_kit + $notas->cantidad_kit2 + $notas->cantidad_kit3 + $notas->cantidad_kit4 + $notas->cantidad_kit5 + $notas->cantidad_kit6;
                    @endphp
                @endif
                @php
                    $sum_comp = $notas_nas_comp + $notas_nas_comp2;

                    $notas_nas_individual_pares = $notas_nas_individual;
                    if ($notas_nas_individual_pares % 2 != 0) {
                        $notas_nas_individual_pares--; // Reducir en 1 si es impar
                    }

                    $division = $notas_nas_individual_pares / 2;
                    $comision = $division * $user_comision_kit->comision_kit;

                    $notas_nas_compartida_pares = $sum_comp;
                    if ($notas_nas_compartida_pares % 2 != 0) {
                        $notas_nas_compartida_pares--; // Reducir en 1 si es impar
                    }
                    $comision_comp = $user_comision_kit->comision_kit / 2;
                    $division_comp = $notas_nas_compartida_pares / 2;
                    $comision_uno = $division_comp * $comision_comp;
                @endphp
            @endforeach
                {{-- C O M I S I O N E S  C O S M I C A --}}
            @foreach ($notasAprobadasCosmicaComision as $notas)
                @if ($notas->id_admin == $user_comision_kit->id && $notas->id_admin_venta == $user_comision_kit->id)
                    @php
                        $notas_nas_individual_cosmica += $notas->cantidad_kit + $notas->cantidad_kit2 + $notas->cantidad_kit3 + $notas->cantidad_kit4 + $notas->cantidad_kit5 + $notas->cantidad_kit6;
                    @endphp
                @endif
                @if ($notas->id_admin == $user_comision_kit->id && $notas->id_admin_venta !== $user_comision_kit->id)
                    @php
                        $notas_nas_comp_cosmica += $notas->cantidad_kit + $notas->cantidad_kit2 + $notas->cantidad_kit3 + $notas->cantidad_kit4 + $notas->cantidad_kit5 + $notas->cantidad_kit6;
                    @endphp
                @endif
                @if ($notas->id_admin !== $user_comision_kit->id && $notas->id_admin_venta == $user_comision_kit->id)
                    @php
                        $notas_nas_comp2_cosmica += $notas->cantidad_kit + $notas->cantidad_kit2 + $notas->cantidad_kit3 + $notas->cantidad_kit4 + $notas->cantidad_kit5 + $notas->cantidad_kit6;
                    @endphp
                @endif
                @php
                    $sum_comp_cosmica = $notas_nas_comp_cosmica + $notas_nas_comp2_cosmica;

                    $notas_nas_individual_pares_cosmica = $notas_nas_individual_cosmica;
                    if ($notas_nas_individual_pares_cosmica % 2 != 0) {
                        $notas_nas_individual_pares_cosmica--; // Reducir en 1 si es impar
                    }

                    $division = $notas_nas_individual_pares_cosmica / 2;
                    $comision_cosmica = $division * $user_comision_kit->comision_kit;

                    $notas_nas_compartida_pares_cosmica = $sum_comp_cosmica;
                    if ($notas_nas_compartida_pares_cosmica % 2 != 0) {
                        $notas_nas_compartida_pares_cosmica--; // Reducir en 1 si es impar
                    }
                    $comision_comp_cosmica = $user_comision_kit->comision_kit / 2;
                    $division_comp_cosmica = $notas_nas_compartida_pares_cosmica / 2;
                    $comision_uno_cosmica = $division_comp_cosmica * $comision_comp_cosmica;

                    $suma_individual = $notas_nas_individual + $notas_nas_individual_cosmica;
                    $suma_compartidas = $sum_comp + $sum_comp_cosmica;
                @endphp
            @endforeach

            @foreach ($notasAprobadasNASComision as $notas)
                @if ($notas->id_admin == $user_comision_kit->id && $notas->id_admin_venta == $user_comision_kit->id)
                    <tr style="background-color:rgba(24, 160, 184, 0.397)">
                        <td class="form-group col-3">NAS - {{$notas->folio}}</td>
                        <td>
                            @if ($notas->id_kit != NULL)
                                <li><b>Kit:</b> {{$notas->cantidad_kit}} - {{$notas->Kit->nombre}}</li>
                            @endif
                            @if ($notas->id_kit2 != NULL)
                                <li><b>Kit:</b> {{$notas->cantidad_kit2}} - {{$notas->Kit2->nombre}}</li>
                            @endif
                            @if ($notas->id_kit3 != NULL)
                                <li><b>Kit:</b> {{$notas->cantidad_kit3}} - {{$notas->Kit3->nombre}}</li>
                            @endif
                            @if ($notas->id_kit4 != NULL)
                                <li><b>Kit:</b> {{$notas->cantidad_kit4}} - {{$notas->Kit4->nombre}}</li>
                            @endif
                            @if ($notas->id_kit5 != NULL)
                                <li><b>Kit:</b> {{$notas->cantidad_kit5}} - {{$notas->Kit5->nombre}}</li>
                            @endif
                            @if ($notas->id_kit6 != NULL)
                                <li><b>Kit:</b> {{$notas->cantidad_kit6}} - {{$notas->Kit6->nombre}}</li>
                            @endif
                        </td>
                        <td class="form-group col-3">${{$notas->tipo}}</td>
                        <td class="form-group col-3">{{$notas->restante}}%</td>
                        <td class="form-group col-3">${{$notas->total}}</td>
                    </tr>
                @endif
                @if ($notas->id_admin == $user_comision_kit->id && $notas->id_admin_venta !== $user_comision_kit->id)
                    <tr style="background-color:rgba(137, 43, 226, 0.295)">
                        <td class="form-group col-3">NAS - {{$notas->folio}}</td>
                        <td>
                            @if ($notas->id_kit != NULL)
                                <li><b>Kit:</b> {{$notas->cantidad_kit}} - {{$notas->Kit->nombre}}</li>
                            @endif
                            @if ($notas->id_kit2 != NULL)
                                <li><b>Kit:</b> {{$notas->cantidad_kit2}} - {{$notas->Kit2->nombre}}</li>
                            @endif
                            @if ($notas->id_kit3 != NULL)
                                <li><b>Kit:</b> {{$notas->cantidad_kit3}} - {{$notas->Kit3->nombre}}</li>
                            @endif
                            @if ($notas->id_kit4 != NULL)
                                <li><b>Kit:</b> {{$notas->cantidad_kit4}} - {{$notas->Kit4->nombre}}</li>
                            @endif
                            @if ($notas->id_kit5 != NULL)
                                <li><b>Kit:</b> {{$notas->cantidad_kit5}} - {{$notas->Kit5->nombre}}</li>
                            @endif
                            @if ($notas->id_kit6 != NULL)
                                <li><b>Kit:</b> {{$notas->cantidad_kit6}} - {{$notas->Kit6->nombre}}</li>
                            @endif
                        </td>
                        <td class="form-group col-3">${{$notas->tipo}}</td>
                        <td class="form-group col-3">{{$notas->restante}}%</td>
                        <td class="form-group col-3">${{$notas->total}}</td>
                    </tr>
                @endif
                @if ($notas->id_admin !== $user_comision_kit->id && $notas->id_admin_venta == $user_comision_kit->id)
                    <tr style="background-color:rgba(137, 43, 226, 0.295)">
                        <td class="form-group col-3">NAS - {{$notas->folio}}</td>
                        <td>
                            @if ($notas->id_kit != NULL)
                                <li><b>Kit:</b> {{$notas->cantidad_kit}} - {{$notas->Kit->nombre}}</li>
                            @endif
                            @if ($notas->id_kit2 != NULL)
                                <li><b>Kit:</b> {{$notas->cantidad_kit2}} - {{$notas->Kit2->nombre}}</li>
                            @endif
                            @if ($notas->id_kit3 != NULL)
                                <li><b>Kit:</b> {{$notas->cantidad_kit3}} - {{$notas->Kit3->nombre}}</li>
                            @endif
                            @if ($notas->id_kit4 != NULL)
                                <li><b>Kit:</b> {{$notas->cantidad_kit4}} - {{$notas->Kit4->nombre}}</li>
                            @endif
                            @if ($notas->id_kit5 != NULL)
                                <li><b>Kit:</b> {{$notas->cantidad_kit5}} - {{$notas->Kit5->nombre}}</li>
                            @endif
                            @if ($notas->id_kit6 != NULL)
                                <li><b>Kit:</b> {{$notas->cantidad_kit6}} - {{$notas->Kit6->nombre}}</li>
                            @endif
                        </td>
                        <td class="form-group col-3">${{$notas->tipo}}</td>
                        <td class="form-group col-3">{{$notas->restante}}%</td>
                        <td class="form-group col-3">${{$notas->total}}</td>
                    </tr>
                @endif
            @endforeach

            @foreach ($notasAprobadasCosmicaComision as $notas)
                @if ($notas->id_admin == $user_comision_kit->id && $notas->id_admin_venta == $user_comision_kit->id)
                    <tr style="background-color:rgba(24, 160, 184, 0.397)">
                        <td class="form-group col-3">Cosmica - {{$notas->folio}}</td>
                        <td>
                            @if ($notas->id_kit != NULL)
                                <li><b>Kit:</b> {{$notas->cantidad_kit}} - {{$notas->Kit->nombre}}</li>
                            @endif
                            @if ($notas->id_kit2 != NULL)
                                <li><b>Kit:</b> {{$notas->cantidad_kit2}} - {{$notas->Kit2->nombre}}</li>
                            @endif
                            @if ($notas->id_kit3 != NULL)
                                <li><b>Kit:</b> {{$notas->cantidad_kit3}} - {{$notas->Kit3->nombre}}</li>
                            @endif
                            @if ($notas->id_kit4 != NULL)
                                <li><b>Kit:</b> {{$notas->cantidad_kit4}} - {{$notas->Kit4->nombre}}</li>
                            @endif
                            @if ($notas->id_kit5 != NULL)
                                <li><b>Kit:</b> {{$notas->cantidad_kit5}} - {{$notas->Kit5->nombre}}</li>
                            @endif
                            @if ($notas->id_kit6 != NULL)
                                <li><b>Kit:</b> {{$notas->cantidad_kit6}} - {{$notas->Kit6->nombre}}</li>
                            @endif
                        </td>
                        <td class="form-group col-3">${{$notas->tipo}}</td>
                        <td class="form-group col-3">{{$notas->restante}}%</td>
                        <td class="form-group col-3">${{$notas->total}}</td>
                    </tr>
                @endif
                @if ($notas->id_admin == $user_comision_kit->id && $notas->id_admin_venta !== $user_comision_kit->id)
                    <tr style="background-color:rgba(137, 43, 226, 0.295)">
                        <td class="form-group col-3">Cosmica - {{$notas->folio}}</td>
                        <td>
                            @if ($notas->id_kit != NULL)
                                <li><b>Kit:</b> {{$notas->cantidad_kit}} - {{$notas->Kit->nombre}}</li>
                            @endif
                            @if ($notas->id_kit2 != NULL)
                                <li><b>Kit:</b> {{$notas->cantidad_kit2}} - {{$notas->Kit2->nombre}}</li>
                            @endif
                            @if ($notas->id_kit3 != NULL)
                                <li><b>Kit:</b> {{$notas->cantidad_kit3}} - {{$notas->Kit3->nombre}}</li>
                            @endif
                            @if ($notas->id_kit4 != NULL)
                                <li><b>Kit:</b> {{$notas->cantidad_kit4}} - {{$notas->Kit4->nombre}}</li>
                            @endif
                            @if ($notas->id_kit5 != NULL)
                                <li><b>Kit:</b> {{$notas->cantidad_kit5}} - {{$notas->Kit5->nombre}}</li>
                            @endif
                            @if ($notas->id_kit6 != NULL)
                                <li><b>Kit:</b> {{$notas->cantidad_kit6}} - {{$notas->Kit6->nombre}}</li>
                            @endif
                        </td>
                        <td class="form-group col-3">${{$notas->tipo}}</td>
                        <td class="form-group col-3">{{$notas->restante}}%</td>
                        <td class="form-group col-3">${{$notas->total}}</td>
                    </tr>
                @endif
                @if ($notas->id_admin !== $user_comision_kit->id && $notas->id_admin_venta == $user_comision_kit->id)
                    <tr style="background-color:rgba(137, 43, 226, 0.295)">
                        <td class="form-group col-3">Cosmica - {{$notas->folio}}</td>
                        <td>
                            @if ($notas->id_kit != NULL)
                                <li><b>Kit:</b> {{$notas->cantidad_kit}} - {{$notas->Kit->nombre}}</li>
                            @endif
                            @if ($notas->id_kit2 != NULL)
                                <li><b>Kit:</b> {{$notas->cantidad_kit2}} - {{$notas->Kit2->nombre}}</li>
                            @endif
                            @if ($notas->id_kit3 != NULL)
                                <li><b>Kit:</b> {{$notas->cantidad_kit3}} - {{$notas->Kit3->nombre}}</li>
                            @endif
                            @if ($notas->id_kit4 != NULL)
                                <li><b>Kit:</b> {{$notas->cantidad_kit4}} - {{$notas->Kit4->nombre}}</li>
                            @endif
                            @if ($notas->id_kit5 != NULL)
                                <li><b>Kit:</b> {{$notas->cantidad_kit5}} - {{$notas->Kit5->nombre}}</li>
                            @endif
                            @if ($notas->id_kit6 != NULL)
                                <li><b>Kit:</b> {{$notas->cantidad_kit6}} - {{$notas->Kit6->nombre}}</li>
                            @endif
                        </td>
                        <td class="form-group col-3">${{$notas->tipo}}</td>
                        <td class="form-group col-3">{{$notas->restante}}%</td>
                        <td class="form-group col-3">${{$notas->total}}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
        <tfoot >
            @php
                $suma_comisiones_indv = $comision + $comision_cosmica;
                $suma_comisiones_comp = $comision_uno + $comision_uno_cosmica;
                $suma_comisiones = $comision + $comision_uno + $comision_cosmica + $comision_uno_cosmica;
            @endphp
            <tr style="background-color: #ffffff;">
                <td></td>
                <td></td>
                <td></td>
              <td style="text-align: right"><b>Comision individual</b> </td>
              <td>${{ $suma_comisiones_indv }}</td>
            </tr>
            <tr style="background-color: #ffffff;">
                <td></td>
                <td></td>
                <td></td>
              <td style="text-align: right"><b>Comision compartida</b> </td>
              <td>${{ $suma_comisiones_comp }}</td>
            </tr>
            <tr style="background-color: #ffffff;">
                <td></td>
                <td></td>
                <td></td>
              <td style="text-align: right"><b>Total</b> </td>
              <td><b>${{ $suma_comisiones }}</b> </td>
            </tr>
        </tfoot>
    </table>

  </div>
</body>
</html>
