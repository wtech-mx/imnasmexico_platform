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
    <h1>Registro IMNAS</h1>
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
    <table class="table table-bordered border-primary">
        <thead class="thead">
            <tr>
                <th>Accion</th>
                <th>Cliente</th>
                <th>Especialidad</th>
                <th>Fecha en <br> que solicita.</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach ($especialidades_pendientes as $registro_pendiente)
                <tr>
                    <td>
                        <a class="btn btn-sm btn-info text-white" target="_blank" href="{{ route('cotizacion_cosmica.imprimir', $item->id) }}">
                            <i class="fa fa-list-alt"></i>
                        </a>
                    </td>
                    <td>
                        <h5> @php
                            $words = explode(' ', $registro_pendiente->User->name);
                            $chunks = array_chunk($words, 3);
                            foreach ($chunks as $chunk) {
                                echo implode(' ', $chunk) . '<br>';
                            }
                        @endphp</h5>
                        <h6>{{ $registro_pendiente->User->telefono }}</h6>
                        @php
                            $words = explode(' ', $registro_pendiente->User->escuela);
                            $chunks = array_chunk($words, 4);
                            foreach ($chunks as $chunk) {
                                echo implode(' ', $chunk) . '<br>';
                            }
                        @endphp
                    </td>
                    <td>
                        @php
                            $words = explode(' ', $registro_pendiente->especialidad);
                            $chunks = array_chunk($words, 4);
                            foreach ($chunks as $chunk) {
                                echo implode(' ', $chunk) . '<br>';
                            }
                        @endphp
                    </td>
                    <td>{{ \Carbon\Carbon::parse($registro_pendiente->created_at)->translatedFormat('d F \\d\\e\\l Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
  </div>
</body>
</html>
