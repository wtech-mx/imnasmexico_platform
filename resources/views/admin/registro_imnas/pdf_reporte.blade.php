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
            color: #fff;
            text-align: center;
        }
        .header-cotizacion {
            background-color: #0560776c;
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
            border-bottom: 2px solid #322338;
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
        .table-cotizacion {
            background-color: #783E5D;
            color: #F7EAED;
        }

        .table-distribuidora {
            background-color: #322338;
            color: #F7EAED;
        }
  </style>
<body>
  <header class="header-cotizacion">
    <h1>Reporte Documentos realizados <br> Registro IMNAS</h1>
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

    <table class="table table-flush" id="datatable-search">
        <thead class="thead">
            <tr>
                <th>No</th>
                <th>Cliente</th>
                <th>Curso</th>
                <th>tipo_documento</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($registros_imnas as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->cliente }}</td>
                    <td>{{ $item->curso }}</td>
                    <td>
                        @if ($item->tipo_documento == 1)
                        Diploma STPS General
                        @elseif ($item->tipo_documento == 2)
                        RN-Cedula de identidad de papel General
                        @elseif ($item->tipo_documento == 3)
                        RN - Titulo Honorifico QRS
                        @elseif ($item->tipo_documento == 4)
                        RN - Diploma Imnas
                        @elseif ($item->tipo_documento == 5)
                        RN - Credencial General
                        @elseif ($item->tipo_documento == 6)
                        CN - Tira de materias aparatologia
                        @elseif ($item->tipo_documento == 7)
                        CN - Tira de materias alasiados progresivos
                        @elseif ($item->tipo_documento == 8)
                        CN - Tira de materias cosmetologia facial y corporal
                        @elseif ($item->tipo_documento == 9)
                        CN - Tira de materias cosmeatria estetica avanzada
                        @elseif ($item->tipo_documento == 10)
                        CN - Tira de materias auxiliar en cuidados de atencion medica
                        @elseif ($item->tipo_documento == 11)
                        CN - Tira de materias masoterapia
                        @elseif ($item->tipo_documento == 12)
                        CN - Tira de materias Cosmetologia
                        @elseif ($item->tipo_documento == 15)
                        CN - Tira de materias drenaje linfatico
                        @elseif ($item->tipo_documento == 16)
                        Titulo honorifico Nuevo
                        @elseif ($item->tipo_documento == 17)
                        Formato DC-3
                        @elseif ($item->tipo_documento == 18)
                        Tira materias Afiliados
                        @endif
                    </td>
                    <td>{{ $item->created_at->format('d F h:i a') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
  </div>
</body>
</html>
