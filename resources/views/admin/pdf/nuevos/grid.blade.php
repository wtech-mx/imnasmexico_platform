<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini-Grid en Pixeles</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            width: 480px; /* Ancho del PDF */
            height: 668px; /* Altura del PDF */
        }
        .container {
            width: 480px; /* Ancho total */
            margin: 0 auto;
            padding: 0;
            overflow: hidden;
        }
        .row {
            width: 100%;
            clear: both;
        }
        [class^="col-"] {
            float: left;
            padding-left: 5px;
            padding-right: 5px;
            box-sizing: border-box;
        }

        /* .col-1 { width: 18px; }
        .col-2 { width: 58px; }
        .col-3 { width: 98px; }
        .col-4 { width: 138px; }
        .col-5 { width: 178px; }
        .col-6 { width: 218px; }
        .col-7 { width: 258px; }
        .col-8 { width: 298px; }
        .col-9 { width: 338px; }
        .col-10 { width: 378px; }
        .col-11 { width: 418px; }
        .col-12 { width: 458px; }  */

        .col-1 { width: 3.69%; }  /* 8.33% - 4.64% */
        .col-2 { width: 12.02%; } /* 16.66% - 4.64% */
        .col-3 { width: 20.36%; } /* 25% - 4.64% */
        .col-4 { width: 28.69%; } /* 33.33% - 4.64% */
        .col-5 { width: 37.02%; } /* 41.66% - 4.64% */
        .col-6 { width: 45.36%; } /* 50% - 4.64% */
        .col-7 { width: 53.69%; } /* 58.33% - 4.64% */
        .col-8 { width: 62.02%; } /* 66.66% - 4.64% */
        .col-9 { width: 70.36%; } /* 75% - 4.64% */
        .col-10 { width: 78.69%; } /* 83.33% - 4.64% */
        .col-11 { width: 87.02%; } /* 91.66% - 4.64% */
        .col-12 { width: 95.36%; } /* 100% - 4.64% */

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
