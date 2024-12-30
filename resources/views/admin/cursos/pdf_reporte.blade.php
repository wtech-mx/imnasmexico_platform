<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte Completo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.5;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th, .table td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
        .chart {
            text-align: center;
            margin: 20px 0;
        }
        .chart img {
            width: 80%;
        }
    </style>
</head>
<body>

    <h1>Reporte de Cursos del año 2024</h1>

    <h2>5 Cursos Mas Inscritos</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre del Curso</th>
                <th>Total Inscritos</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cursosMasInscritos as $curso)
                <tr>
                    <td>{{ $curso->curso }}</td>
                    <td>{{ $curso->inscritos }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>5 Cursos Menos Inscritos</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre del Curso</th>
                <th>Total Inscritos</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cursosMenosInscritos as $curso)
                <tr>
                    <td>{{ $curso->curso }}</td>
                    <td>{{ $curso->inscritos }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Cursos</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre del Curso</th>
                <th>Total Inscritos</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cursosComprados as $curso)
                <tr>
                    <td>{{ $curso->curso }}</td>
                    <td>{{ $curso->inscritos }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
