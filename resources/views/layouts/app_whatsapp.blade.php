<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WhatsApp UI Clone</title>
    <link rel="stylesheet" href="{{asset('assets/whatsapp/style.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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


    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>
</html>
