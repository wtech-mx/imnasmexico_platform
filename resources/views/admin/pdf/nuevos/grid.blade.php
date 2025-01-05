<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini-Grid PDF</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
        }
        .container {
            width: 100%;
            margin: 0 auto;
            padding: 0px;
            overflow: hidden;
        }
        .row {
            width: 100%;
            clear: both;
        }
        [class^="col-"] {
            float: left;
            padding-left: 15px;
            padding-right: 15px;
            box-sizing: border-box;
        }
        .col-1 { width: 8.33%; }
        .col-2 { width: 16.66%; }
        .col-3 { width: 25%; }
        .col-4 { width: 33.33%; }
        .col-5 { width: 41.66%; }
        .col-6 { width: 50%; }
        .col-7 { width: 58.33%; }
        .col-8 { width: 66.66%; }
        .col-9 { width: 75%; }
        .col-10 { width: 83.33%; }
        .col-11 { width: 91.66%; }
        .col-12 { width: 100%; }
        .text-center {
            text-align: center;
        }
        .border {
            border: 1px solid #000;
        }
        .p-2 {
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center border p-2">Columna 12</div>
        </div>
        <div class="row">
            <div class="col-6 text-center border p-2">Columna 6</div>
            <div class="col-6 text-center border p-2">Columna 6</div>
        </div>
        <div class="row">
            <div class="col-4 text-center border p-2">Columna 4</div>
            <div class="col-4 text-center border p-2">Columna 4</div>
            <div class="col-4 text-center border p-2">Columna 4</div>
        </div>
        <div class="row">
            <div class="col-3 text-center border p-2">Columna 3</div>
            <div class="col-3 text-center border p-2">Columna 3</div>
            <div class="col-3 text-center border p-2">Columna 3</div>
            <div class="col-3 text-center border p-2">Columna 3</div>
        </div>
        <div class="row">
            <div class="col-2 text-center border p-2">Columna 2</div>
            <div class="col-2 text-center border p-2">Columna 2</div>
            <div class="col-2 text-center border p-2">Columna 2</div>
            <div class="col-2 text-center border p-2">Columna 2</div>
            <div class="col-2 text-center border p-2">Columna 2</div>
            <div class="col-2 text-center border p-2">Columna 2</div>
        </div>
    </div>
</body>
</html>
