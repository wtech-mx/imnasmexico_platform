<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WhatsApp UI Clone</title>
    <link rel="stylesheet" href="{{asset('assets/whatsapp/style.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .container .rightSide::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('http://imnasmexico_platform.test/assets/whatsapp/pattern.png');
            opacity: 0.06;
        }
        /* Contenedor del dropdown */
.emoji-container {
    position: relative;
    display: inline-block;
}

/* Dropdown de emojis oculto por defecto */
.emoji-dropdown {
    position: absolute;
    bottom: 40px; /* Se despliega hacia arriba */
    left: 0;
    background: white;
    border-radius: 8px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    padding: 10px;
    display: none; /* Oculto por defecto */
    flex-wrap: wrap;
    width: 180px;
    max-height: 150px;
    overflow-y: auto;
    z-index: 100;
}

/* Mostrar el dropdown cuando esté activo */
.emoji-dropdown.show {
    display: flex;
}

/* Estilo de cada emoji */
.emoji {
    font-size: 22px;
    cursor: pointer;
    margin: 5px;
    transition: transform 0.2s;
}

.emoji:hover {
    transform: scale(1.2);
}

    </style>
</head>
<body>
    <div class="container">
        <div class="leftSide">

            <!-- Header -->
            <div class="header">


                <div class="userimg">
                    <img src="images/user.jpg" alt="" class="cover">
                </div>

                <ul class="nav_icons">
                    <li><ion-icon name="scan-circle-outline"></ion-icon></li>
                    <li><ion-icon name="chatbox"></ion-icon></li>
                    <li><ion-icon name="ellipsis-vertical"></ion-icon></li>
                </ul>
            </div>

            <!-- Search Chat -->
            <div class="search_chat">
                <div>
                    <input type="text" placeholder="Search or start new chat">
                    <ion-icon name="search-outline"></ion-icon>
                </div>
            </div>
            <!-- CHAT LIST -->
            <div class="chatlist">



                @yield('content_chats')

                {{--<div class="block">
                    <div class="imgBox">
                        <img src="images/img4.jpg" class="cover" alt="">
                    </div>
                    <div class="details">
                        <div class="listHead">
                            <h4>Parker</h4>
                            <p class="time">Yesterday</p>
                        </div>
                        <div class="message_p">
                            <p>Hey!</p>
                        </div>
                    </div>
                </div> --}}

            </div>
        </div>

        <div class="rightSide">

            @yield('content_messages')

            {{-- @include('whatsapp.components.chat_input') --}}

        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    @yield('js')

</body>
</html>
