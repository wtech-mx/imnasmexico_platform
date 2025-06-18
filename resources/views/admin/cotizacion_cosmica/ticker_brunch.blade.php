<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Ticket Brunch </title>
  <meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="https://public.codepenassets.com/css/reset-2.0.min.css">
    <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

  <style>
        @import url("https://fonts.googleapis.com/css2?family=Staatliches&display=swap");
        @import url("https://fonts.googleapis.com/css2?family=Nanum+Pen+Script&display=swap");

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body,
        html {
            height: 100vh;
            display: grid;
            font-family: "Staatliches", cursive;
            background: #fff;
            color: black;
            font-size: 14px;
            letter-spacing: 0.1em;
        }

        .ticket {
            margin: auto;
            display: flex;
            background: white;
            box-shadow: rgba(0, 0, 0, 0.3) 0px 19px 38px, rgba(0, 0, 0, 0.22) 0px 15px 12px;
        }

        .nombre{
            position: absolute;
            color:#fff;
            left:670px;
            top: 125px;
            line-height: 30px
        }

        img{
            width: 900px;
        }

        @media screen and (max-width: 900px) {
            img {
                width: 600px;
            }
            .nombre {
                left: 450px;
                top: 79px;
                font-size: 9px;
                line-height: 30px;
            }
        }

        @media screen and (max-width: 600px) {
            img {
                width: 450px;
            }
            .nombre {
                left: 336px;
                top: 56px;
                font-size: 7px;
                line-height: 30px;
            }
        }

        @media screen and (max-width: 450px) {
            img {
                width: 350px;
            }
            .nombre {
                left: 261px;
                top: 47px;
                font-size: 7px;
                line-height: 15px;
            }
        }

  </style>

</head>
    <body>

        <div class="ticket" style="position: relative">
            <img class="img" src="{{ asset('cosmika/elementos/entrada.png') }}" alt="">
            <p class="nombre">{{ ucwords(str_replace('-', ' ', $nombre ?? 'SIN NOMBRE' )) }}</p>

        </div>

    </body>
</html>
